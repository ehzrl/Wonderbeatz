<?php
$creatorID = $_COOKIE["creatorID"];


// database connection
$conn = new mysqli('localhost', 'root', '', 'wonderbeatz') or die('Connection Failed: '.mysqli->connect_error);


	$sName = $_POST['sName'];
   $creatorID = $_COOKIE["creatorID"];

   if(empty($sName) ){
      echo "<script>
      alert('Missing Song Name. Try again'); 
      window.history.go(-1);
      </script>";
   }
   else{
      $stmt = $conn->prepare("delete from song where title = ? AND creatorID=?");
      if($stmt){
         
         $stmt->bind_param("ss", $sName, $creatorID);
         $stmt->execute();

         echo "<script>
         alert('Song removed '); 
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