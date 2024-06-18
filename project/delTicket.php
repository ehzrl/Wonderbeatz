<?php
$creatorID = $_COOKIE["creatorID"];


// database connection
$conn = new mysqli('localhost', 'root', '', 'wonderbeatz') or die('Connection Failed: '.mysqli->connect_error);


	$tNum = $_POST['ticketNum'];
    $adminID = $_COOKIE["supportID"];

    if(empty($tNum) ){
      echo "<script>
      alert('Missing Ticket Number. Try again'); 
      window.history.go(-1);
      </script>";
    }
    else{
      $stmt = $conn->prepare("delete from accountsupport where supportID=? AND ticketNumber=?");
      if($stmt){
         $stmt->bind_param("si", $adminID,$tNum);
         $stmt->execute();

         echo "<script>
         alert('Ticket removed '); 
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