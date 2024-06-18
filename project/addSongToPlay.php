<?php

// database connection
$conn = new mysqli('localhost', 'root', '', 'wonderbeatz') or die('Connection Failed: '.mysqli->connect_error);

    $playListName = $_COOKIE["playlistName"];
    $creatorID = $_POST['creatorID'];
    $songName = $_POST['sName'];

   $stmt = $conn->prepare("INSERT INTO contains(title, creatorID, playlistName)
                           VALUES (?,?,?)");
   if($stmt){
      $stmt->bind_param("sss",$songName, $creatorID, $playListName);
      $stmt->execute();

      echo "<script>
      alert('Song added to playlist'); 
      window.history.go(-1);
      </script>";
   }
   else{
      echo ("error description:".$conn->error);
   }
   $stmt->close();
   $conn->close();



?>