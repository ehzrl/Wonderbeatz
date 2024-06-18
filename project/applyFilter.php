<?php
    
    // database connection
    $conn = new mysqli('localhost', 'root', '', 'wonderbeatz') or die('Connection Failed: '.mysqli->connect_error);

    if(isset($_POST['filters'])){
        setcookie("filterType", "");
        setcookie("filterType", $_POST['filters']);
        $selectedFilter = $_POST['filters'];
        echo "<script>
              window.history.go(-1);
              </script>";
    }
    else{
        $selectedFilter = $_COOKIE['filterType'];

        echo $selectedFilter;
        //the default is BPM
        $fname = (int) $_POST["fname"];
        $stmt = $conn->prepare("SELECT title, creatorID, pitch, BPM FROM song WHERE bpm = ?");
        $type = 'i';

        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            // Check if the search form was submitted
            if (isset($_POST['search'])) {
                $fname = $_POST['fname'];
            }

            if ($selectedFilter == "BPM") {
                $fname = (int) $fname;
                $stmt = $conn->prepare("SELECT title, creatorID, pitch, BPM FROM song WHERE BPM = ?");
                $type = 'i';
            }
            else if ($selectedFilter == "Name of Song") {
                $stmt = $conn->prepare("SELECT title, creatorID, pitch, BPM FROM song WHERE title = ?");
                $type = 's';
            }
            else if ($selectedFilter == "Pitch") {
                $fname = (int) $fname;
                $stmt = $conn->prepare("SELECT title, creatorID, pitch, BPM FROM song WHERE pitch = ?");
                $type = 'i';
            }
            if ($selectedFilter == "Creator") {
                $stmt = $conn->prepare("SELECT title, creatorID, pitch, BPM FROM song WHERE creatorID = ?");
                $type = 's';
            }
            //rest of the filters will be applied here

            
            if($stmt){
                $stmt->bind_param($type, $fname);
                $stmt->execute();
                $result = array();
               $stmt->bind_result($title, $creator, $pitch, $BPM);
                while($stmt->fetch()){
                    $result[] = array("title"=>$title,
                                      "creator"=>$creator,
                                      "pitch"=> $pitch,
                                      "BPM"=> $BPM,
                                );
                }
                setcookie("results", "");
                setcookie("results",json_encode($result) );
                
                echo "<script>
                        location.assign('./searchPage.php');
                    </script>";

        }
        else{
            echo ("error description:".$conn->error);
        }
        }

        $stmt->close();
        $conn->close();

    }
?>