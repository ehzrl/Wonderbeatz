<!DOCTYPE html>
<html>
<head>
    <title>Admin Home Page Form</title>
</head>
<body >

    <h2>Admin Home Page</h2><br>
    <div class="inlineButtons">
       <script>
            const creator = "adJoeR";
            const name = "supportID";
            document.cookie ="supportID=";
            document.cookie = name +"=" + creator;
        </script>
       <a href="./delTicket.html">
       <button>Delete Ticket</button>
       </a>
    <div class="adminPage">
    <form id="admin" >
        <h3><b> Help List:</b></h3>
           <?php
                $adminID = $_COOKIE["supportID"];
                $conn = new mysqli('localhost', 'root', '', 'wonderbeatz') or die('Connection Failed: '.mysqli->connect_error);
                $sql = "SELECT ticketNumber, firstName, lastName, ID 
                        FROM user, accountSupport
                        WHERE supportID ='$adminID' and listenerID=user.ID";
                
                echo '<pre> Ticket      Name                     listenerID </pre>';
                
                $result = $conn->query($sql);
                if($result){
                    while($row = $result->fetch_assoc()){
                        printf("<pre> %-10d %s %-15s     %-6s\n<pre>", $row['ticketNumber'], $row["firstName"], $row['lastName'], $row['ID'] );
                        
                    }
                }    
                
           
           ?>
            
        
    </form>
</div>
</body>
</html>