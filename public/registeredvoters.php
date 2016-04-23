<!DOCTYPE html>
<html>
 <head>
<link rel="stylesheet" type="text/css" href="css/main.css">
<style type="text/css">
table {
	margin top: 30px; position: absolute; left: 100px;
}
</style>
</head>
<body>
<?php
require("config.php");
$sql ="SELECT * FROM voters";
$result =mysql_query($sql);
$numrow =mysql_num_rows($result);

 if(isset($_GET['errorm'])) {
 	echo "<font size='6' color='ff0000'>"."You can't delete this voter because he 
 	has already votered!"."</font>"."<br>";
 } elseif (isset($_GET['errorf'])) {
 	echo "<font size='6' color='red'>"."You can't delete this voter because she 
 	has already votered!"."</font>"."<br>";
 } elseif (isset($_GET['del'])) {
 	echo"<font size='6' color='ff0000'>"."The voter has been removed from the database!".
 	"</font>"."<br>";
 } elseif (isset($_GET['error2'])) {
 	echo"<font size='6' color='ff0000'>"."The action was not successful!"."</font>"."<br>";
 }

echo "<table>";
echo "<tr>";
echo "<th>NAME</th>";
echo "<th>Gender</th>";
echo "<th>VOTER ID</th>";
echo "<th>STATUS</th>";
echo "<th>Delete</th>";
echo "</tr>";
if($numrow==0){
      echo "<font size='6' color='0000ff'>"."<b>"."No voter has been registered<br> "
      ."Click "."<a href ='register.php'>"."HERE"."</a>"." to register voters"."</b>"."</font>";
    } else{
       echo "<font size='5' color='0000ff'>"."List of registered voters"."</font>";
    }
while ($row=mysql_fetch_assoc($result)) {
     
     
      
	echo "<tr>";
	echo "<td>".$row['firstname']." ".$row['lastname']."</td>";
	echo "<td>".$row['gendar']."</td>";
	echo "<td>".$row['voterid']."</td>";
  echo "<td>".$row['status']."</td>";

	echo "<td class='undo'>";
echo "<form action='registeredvoters.php' method='POST'>";
echo "<input type='hidden' name='id' value='".$row['id']."'>";
echo "<input type='submit' name='delete' value='[ X ]'>";
echo "</form>";
echo "</td>";


	
}

echo "</table>";
?>

<?php
if (isset($_POST['delete'])) {
echo "<div class='alert'>";
      echo "<h2>Are you sure you want to delete this voter?";
  echo "<form action='delete.php' method='POST'>";
    echo "<input type='hidden' name='id' value='".$_POST['id']."'>";
    echo "<input type='submit' name='vno' value='NO'>";
    echo "<input type='submit' name='vyes' value='YES'>";
  echo "</form>";
echo "</div>";
}
?>
</body>
</html>