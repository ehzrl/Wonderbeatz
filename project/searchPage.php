<!DOCTYPE html>
<html>
<style>
table, th, td {
  border:1px solid black;
}
</style>
<body>

<h2>Search Songs</h2>
<form action="./modPlaylist.php" method="post">
  <?php 
    setcookie("filter", "");
    setcookie("results", "");
  ?>
    <button type="submit" name="search">Back</button>
    
</form>
<label for="songName"></label>

<form action="./applyFilter.php" method="post">
    <label for="filters">Search by</label>
    <select name="filters" id="filters"> 
        <option value="BPM">BPM</option> 
        <option value="Name of Song">Name of Song</option> 
        <option value="Pitch">Pitch</option> 
        <option value="Creator">Creator</option>  
    </select>
    <input type="submit" name="applyFilter" value="Apply Filter">
</form>

<form action="./applyFilter.php" method="post">
    <input type="text" id="fname" name="fname" required>
    <button type="submit" name="search">Search</button>
    
</form>


<table style="width:100%">
  <tr>
    <th>Song</th>
    <th>Creator</th>
    <th>Pitch</th>
    <th>BPM</th>
  </tr>

</table>
<?php



  if(isset($_COOKIE['results'])){
    $data = json_decode($_COOKIE['results'], true);
    
    for($x=0; $x < count($data); $x++){

      printf("<pre>%-50s                             %-50s          %-20d                             %-15d\n<pre>", $data[$x]["title"],  $data[$x]["creator"],  $data[$x]["pitch"],  $data[$x]["BPM"]);

    }

  }

?>

</body>
</html>