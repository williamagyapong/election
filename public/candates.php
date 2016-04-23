<!DOCTYPE html>
<html>
<head>
   <link rel="stylesheet" type="text/css" href="styles.css">
   <style type="text/css">
table {
  margin top: 30px; position: absolute; left: 100px;
}
</style>
</head>
<body>
	
<?php
require("config.php");

if (isset($_GET['del'])) {
	 echo "<font size='6' color='ff0000'>"."The delete action was successful"."</font>"."<br>";
} elseif (isset($_GET['error1'])) {
	 echo "<font size='6' color='ff0000'>"."The delete action was unsuccessful"."</font>"."<br>";
} elseif (isset($_GET['error2'])) {
	echo "<font size='6' color='ff0000'>"."You can't remove this candidate!"."</font>"."<br>";
}
$sql ="SELECT candidates.*,office FROM candidates, offices WHERE candidates.office_id=offices.id ";
 $result = mysql_query($sql);
 $numrows = mysql_num_rows($result);
  
 
 echo "<table cellpadding='10'>";
 echo "<tr>";
 echo "<th>Name</th>";
 echo "<th>Office</th>";
 echo "<th>Picture</th>";
 echo "<th>Remove</th>";
 echo "</tr>";
  if ($numrows==0) {
    echo "<font size='6' color='red'>"."No candidate exist for election! <br>".
    "You can click "."<a href ='candregister.php'>"."HERE"."</a>"." to register candidates".
      "</font>" ;
  } else{
    echo "<font size='6' color='blue'>"."Candidates approved for election".
       "</font>" ;
while($row =mysql_fetch_assoc($result)) {
	echo "<tr>";
echo "<td>".$row['firstName']." ".$row['lastName']."</td>";
echo "<td>".$row['office']."</td>";
echo "<td><img src='./images2/".$row['images']."' width='85' height='80' 
title='".$row['firstName']."'></td>";


echo "<td class='undo'>";
echo "<form action='candates.php' method='POST'>";
echo "<input type='hidden' name='id' value='".$row['id']."'>";
echo "<input type='submit' name='delcand' value='[ X ]'>";
echo "</form>";
echo "</td>";
echo "</tr>";


  }
 } 

   echo "</table>";
?>
<?php
if (isset($_POST['delcand'])) {
echo "<div class='alert'>";
      echo "<h2>Are you sure you want to delete this candidate?";
  echo "<form action='delete.php' method='POST'>";
    echo "<input type='hidden' name='id' value='".$_POST['id']."'>";
    echo "<input type='submit' name='no' value='NO'>";
     echo "<input type='submit' name='yes' value='YES'>";
  echo "</form>";
echo "</div>";
}
?>

</body>
</html>