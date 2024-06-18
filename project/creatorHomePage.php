<!DOCTYPE html>
<html>
<head>
    <title>Creator Home Page Form</title>
</head>
<body >

    <h2>Creator Home Page</h2><br>
    
    <div class="inlineButtons">
       <a href="./addSong.html">
       <button>Add Song</button>
       </a>
       <a href="./deleteSong.html">
       <button >Delete Song</button>
       </a>
       <a href="./modSong.html">
       <button >Modify Song</button>
       </a>
    </div>
    <div class="creatorPage">
    <form id="creater" >
        <h3><b> Song List:</b></h3>
           <?php
                $creatorID = $_COOKIE["creatorID"];
                $conn = new mysqli('localhost', 'root', '', 'wonderbeatz') or die('Connection Failed: '.mysqli->connect_error);
                $sql = "SELECT title, pitch, BPM 
                        FROM song
                        WHERE creatorID ='$creatorID'";
                
                echo '<pre>Song Name            Pitch      genre</pre>';
                $result = $conn->query($sql);
                if($result){
                    while($row = $result->fetch_assoc()){
                        printf("<pre>%-20s %-3d         %3d\n<pre>",$row["title"], $row['pitch'], $row['BPM'] );
                        
                    }
                }    
                
           
           ?>
            
        
    </form>
</div>
</body>
</html>