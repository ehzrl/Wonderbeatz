<?php

// database connection
$conn = new mysqli('localhost', 'root', '', 'wonderbeatz') or die('Connection Failed: '.mysqli->connect_error);


	$pName = $_POST['pName'];
    
   $stmt = $conn->prepare("delete from playlist where name like ?");
   if($stmt){
      $pName = $pName."%";
      $stmt->bind_param("s", $pName);
      $stmt->execute();

      echo "<script>
      alert('Playlist removed '); 
      window.history.go(-1);
      </script>";
   }
   else{
      echo ("error description:".$conn->error);
   }
   $stmt->close();
   $conn->close();



?>