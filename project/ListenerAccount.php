<!DOCTYPE html>
<html>
<head>
    <title>Listener Home Page</title>
    <meta charset="utf-8">
    <!--meta name="viewport" content="width=device-width, initial-scale=1"-->
    <link rel="stylesheet" type="text/css" href="styles.css" />

</head>
<body>

    <h2>Listener Home Page</h2><br>

    <div class="listenerPage">
    <form id="listener" >            
           <?php
                $listenerID = $_COOKIE["listenerID"];

                $conn = new mysqli("localhost", "root", "", "wonderbeatz") or die('Connection Failed: '.$conn->connect_error);

                 
                // sql statement to get name
                // SQL statement to get playlists

                $sql = "SELECT firstName, lastName
                        FROM user
                        WHERE ID = '$listenerID'";

                $result = $conn->query($sql);

                if($result)
                {
                    
                    if($row = $result->fetch_assoc())
                    {
                       printf("Hello, %s %s!\n", $row["firstName"], $row["lastName"]);
                    }
                }

            ?>

             <br>
             <h3><b> My Playlists:</b></h3>

            <?php

                $listenerID = $_COOKIE["listenerID"];

                $conn = new mysqli("localhost", "root", "", "wonderbeatz") or die('Connection Failed: '.$conn->connect_error);

                // SQL statement to get playlists
                $sql = "SELECT name, dateCreated
                        FROM playlist
                        WHERE listenerID = '$listenerID'";

                echo '<pre>Playlist Name           Date Created <pre>';

               
                $result = $conn->query($sql);
                if($result)
                {
                    while ($row = $result->fetch_assoc())
                    {
                        printf("<pre>%-20s    %-20s\n<pre>",$row["name"], $row["dateCreated"]);
                    }
                }

               
                      
           ?>
    </form>  
    </div>

    <p> To view individual playlist, enter the name of the playlist: <p>

    <div class="searchPlaylist">
        <form id="searchPlaylist" method="post" action="IndividualPlaylist.php">
            <label>
                <b>
                    Playlist Name
                </b>
            </label>
            <input type="text" name="pName" id="PName" placeholder="Playlist Name">
            <br><br>
            <input type="submit" name="searchPlaylist" id="searchPlaylist" value="Search Playlist">
            <br><br>
        </form>
    </div>

    <br><br>
    
    <div class="inlineButtons">
       <a href="./addPlaylist.html">
       <button>Add Playlist</button>
       </a>
       <a href="./deletePlaylist.html">
       <button >Delete Playlist</button>
       </a>
    </div>

</body>
</html>