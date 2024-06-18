<?php
        
        $listenerID = $_COOKIE["listenerID"];
        $playListName = $_COOKIE["playlistName"];
       
        $conn = new mysqli("localhost", "root", "", "wonderbeatz") or die('Connection Failed: '.$conn->connect_error);

        // print name of playlist followed by songs in it.
        // SQL statement to get playlists

        printf( "<h1>Playlist Name: %s</h1>",$playListName);
        
        echo "<html>
                <div class='inlineButtons'>
                <a href='./searchPage.php'>
                <button>Search Songs</button>
                </a>
                <a href='./IndividualPlaylist.php'>
                <button >Back</button>
                </a>
                <a href='./ListenerAccount.php'>
                <button >Return Home</button>
                </a>
                </div>
            </html>";

                $sql = "SELECT song.title
                        FROM contains, song, playlist
                        WHERE playlist.name like '$playListName' AND contains.playlistName = playlist.name AND playlist.listenerID='$listenerID'AND song.title= contains.title AND song.creatorID=contains.creatorID";

                
                echo '<pre>Songs in playlist:<pre>';

       
                $result = $conn->query($sql);
                if($result)
                {
                    while ($row = $result->fetch_assoc())
                    {
                        printf("<pre>%-20s\n<pre>",$row["title"]);
                    }
                }

                printf("\n\n");
                
                $sql = "Select *
                        From song";

                 echo '<pre>All songs in Database:<pre>';

                $result = $conn->query($sql);
                if($result)
                {
                    while ($row = $result->fetch_assoc())
                    {
                        printf("<pre>%-20s%-20s%20d %20d\n<pre>",$row["title"], $row["creatorID"], $row["pitch"], $row["BPM"]);
                    }
                }


        ?>
<html>
<body>
    <form id="addSongToPlay" method="post" action="addSongToPlay.php">
        <label><b> Song Name To Add to Playlist
        </b>
        </label>
        <input type="text" name="sName" id="SName" placeholder="Song Name" required>
        <br><br>
        <label><b> Artist
        </b>
        </label>
        <input type="text" name="creatorID" id="creatorID" placeholder="CreatorID" required>
        <br><br>
        <input type="submit" name="addSongToPlay" id="addSongToPlay" value="Add song to playlist">
    </form>

    <form id="delSongFromPlay" method="post" action="delSongFromPlay.php">
        <label><b> Song Name To Remove from Playlist
        </b>
        </label>
        <input type="text" name="sName" id="SName" placeholder="Song Name" required>
        <br><br>
        <label><b> Artist
        </label>
        <input type="text" name="creatorID" id="creatorID" placeholder="CreatorID" required>
        <br>
        <input type="submit" name="delSongFromPlay" id="delSongFromPlay" value="Delete song from playlist">
    </form>
        
</body>
</html>