<?php

// database connection
$conn = new mysqli('localhost', 'root', '', 'wonderbeatz') or die('Connection Failed: '.mysqli->connect_error);


	$sName = $_POST['sName'];
	$pitch = $_POST['pitch'];
	$bpm = $_POST['bpm'];
   $creatorID = $_COOKIE["creatorID"];

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
      $stmt = $conn->prepare("update song set pitch = ?, BPM = ? where title = ? AND creatorID=?");
      if($stmt){
         //$sName = $sName."%";
         $stmt->bind_param("iiss",$pitch, $bpm, $sName, $creatorID);
         $stmt->execute();

         echo "<script>
         alert('Song updated'); 
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