<?php
// Database connection parameters
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "wonderbeatz";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve user input
    $userId = $_POST["userId"];
    $password = $_POST["password"];
    $password = "%".$password."%";
    // SQL query to check user credentials
    $sql = "SELECT * FROM user WHERE ID = '$userId' AND password like'$password'";
    
    $result = $conn->query($sql);
    if($result){
        $rowcount=mysqli_num_rows($result);
        // confrims an account exists
        if ($rowcount > 0) {
            // find account type
            $listener_sql = "SELECT listenerID FROM listener where listenerID='$userId'";
            $creator_sql = "SELECT creatorID FROM creator where creatorID='$userId'";
            $admin_sql = "SELECT adminID FROM admin where adminID='$userId'";
            $result = $conn->query($listener_sql);

            if($result){
                if(mysqli_num_rows($result) > 0){
                    setcookie("listenerID",$userId);
                    echo "<script>
                        location.assign('./ListenerAccount.php');
                    </script>";
                }
                else{
                    $result = $conn->query($creator_sql);
                    if($result){
                        if(mysqli_num_rows($result) > 0){
                                setcookie("creatorID",$userId);
                                echo "<script>
                                    location.assign('./creatorHomePage.php');
                                </script>";
                        }
                        else{
                            $result=$conn->query($admin_sql);
                            if($result){
                                if(mysqli_num_rows($result) > 0){
                                    setcookie("supportID",$userId);
                                    echo "<script>
                                    location.assign('./adminHomePage.php');
                                    </script>";
                                        
                                }
                            }
                        }
                    }
    
                }
            }
        } 
        else {
            // User not found or incorrect credentials
            echo "<script>
                    alert('Login failed. Please check your credentials.'); 
                    window.history.go(-1);
                  </script>";

        }
    }
    else{
        echo "Query Fail";

    }
}

// Close the database connection
$conn->close();
?>
