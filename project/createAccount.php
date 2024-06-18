<?php

// database connection
$conn = new mysqli('localhost', 'root', '', 'wonderbeatz') or die('Connection Failed: '.mysqli->connect_error);


	$userID = $_POST['userID'];
	$password = $_POST["passwd"];
	$fName = $_POST['fName'];
	$lName = $_POST['lName'];
    $accountType = $_POST ["accountType"];

    // check user name < 6 char long
    if(strlen($userID)> 6){
        echo "<script>
            alert('Username too long. Six or less characters'); 
            window.history.go(-1);
            </script>";

    }
   // check unique username 
   $stmt = $conn->prepare("Select ID from user where ID=?");
   if($stmt){
        $stmt->bind_param("s",$userID);
        $stmt->execute();

        if($stmt->fetch()){
            echo "<script>
            alert('Username exists. Try another username '); 
            window.history.go(-1);
            </script>";

        }

        $accountType = $_POST ["accountType"];
    
        $stmt = $conn->prepare("insert into user(ID, firstName, lastName, password) values(?,?,?,?)");
        if($stmt){
            $stmt->bind_param("ssss",$userID, $fName, $lName, $password);
            $stmt->execute();

            if($accountType=="listener"){
                $stmt = $conn->prepare("insert into listener(listenerID) values(?)");
                if($stmt){
                    $stmt->bind_param("s",$userID);
                    $stmt->execute();
                    setcookie("listenerID",$userID);
                    echo "<script>
                    location.assign('./ListenerAccount.php');
                    </script>";

                }

            }
            else if ($accountType== "creator"){
                $stmt = $conn->prepare("insert into creator(creatorID) values(?)");
                if($stmt){
                    $stmt->bind_param("s",$userID);
                    $stmt->execute();
                    setcookie("creatorID",$userID);
                    echo "<script>
                    location.assign('./creatorHomePage.php');
                    </script>";

                }
            }
        }
        else{
            echo ("error description:".$conn->error);
        }
        $stmt->close();
    }
    
   $conn->close();



?>