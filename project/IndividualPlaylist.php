<!DOCTYPE html>
<html>
    <head>
        <title>Individual Playlist</title>
         <meta charset="utf-8">
        <!--meta name="viewport" content="width=device-width, initial-scale=1"-->
        <link rel="stylesheet" type="text/css" href="styles.css" />
       
        
    </head>
    <body>
        <?php

        $listenerID = $_COOKIE["listenerID"];

        if(isset($_POST['pName'])){
            $playName = $_POST['pName'];
            setcookie("playlistName",$playName);
        }
        else{
            $playName = $_COOKIE["playlistName"];
        }


       
        echo "Playlist: ".$playName;


        $conn = new mysqli("localhost", "root", "", "wonderbeatz") or die('Connection Failed: '.$conn->connect_error);

        // print name of playlist followed by songs in it.
        // SQL statement to get playlists

                $sql = "SELECT song.title, song.creatorID, song.pitch, song.BPM
                FROM contains, song, playlist
                WHERE playlist.name like '$playName' AND contains.playlistName = playlist.name AND playlist.listenerID='$listenerID'AND song.title= contains.title AND song.creatorID=contains.creatorID";

                echo '<pre>Song:               Artist:          Pitch:      BPM:<pre>';

               
                $result = $conn->query($sql);
                if($result)
                {
                    while ($row = $result->fetch_assoc())
                    {
                        printf("<pre>%-20s%-10s%10d %10d\n<pre>",$row["title"], $row["creatorID"], $row["pitch"], $row["BPM"]);
                    }
                }

        ?>

        

       
    <div class="inlineButtons">
       <a href="./modplaylist.php">
       <button >Modify Playlist</button>
       </a>
       <a href="./ListenerAccount.php">
       <button>Return Home</button>
       </a>
    </div>


    </body>
</html>