<?php

// database connection
$conn = new mysqli('localhost', 'root', '', 'wonderbeatz') or die('Connection Failed: '.mysqli->connect_error);

    $listenerID = $_COOKIE["listenerID"];
	$pName = $_POST['pName'];
    $dayt = "".date("m-d-y")."";

   $stmt = $conn->prepare("INSERT INTO playlist(name, listenerID, dateCreated)
                           VALUES (?,?,?)");
   if($stmt){
      $stmt->bind_param("sss",$pName, $listenerID, $dayt);
      $stmt->execute();

      echo "<script>
      alert('Playlist added '); 
      window.history.go(-1);
      </script>";
   }
   else{
      echo ("error description:".$conn->error);
   }
   $stmt->close();
   $conn->close();



?>