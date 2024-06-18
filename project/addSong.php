<?php

// database connection
$conn = new mysqli('localhost', 'root', '', 'wonderbeatz') or die('Connection Failed: '.mysqli->connect_error);


	$sName = $_POST['sName'];
	$creatorID = $_COOKIE["creatorID"];
	$pitch = $_POST['pitch'];
	$bpm = $_POST['bpm'];

   if(empty($sName) ){
      echo "<script>
      alert('Missing Song Name. Try again'); 
      window.history.go(-1);
      </script>";
   }
   else if(empty($pitch)){

      echo "<script>
      alert('Missing Pitch. Try again'); 
      window.history.go(-1);
      </script>";
   }
   else if(empty($bpm)){

      echo "<script>
      alert('Missing BPM. Try again'); 
      window.history.go(-1);
      </script>";
   }
   else{
      $stmt = $conn->prepare("insert into song(title, creatorID, pitch, BPM) values(?,?,?,?)");
      if($stmt){
         $stmt->bind_param("ssii",$sName, $creatorID, $pitch, $bpm);
         $stmt->execute();

         echo "<script>
         alert('Song added '); 
         window.history.go(-1);
         </script>";
      }
      else{
         echo ("error description:".$conn->error);
      }
      $stmt->close();
   }
   $conn->close();



?>