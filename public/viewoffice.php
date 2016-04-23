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
$sql ="SELECT * FROM offices";
$result =mysql_query($sql);
$numrow =mysql_num_rows($result);

 if(isset($_GET['deloffi'])) {
 	echo "<font size='6' color='ff0000'>"."The office has been removed!"."</font>"."<br>";
 } elseif (isset($_GET['delerror'])) {
 	echo "<font size='6' color='red'>"."Could not remove office!"."</font>"."<br>";
 }

echo "<table class='table2'>";
echo "<tr>";
echo "<th></th>";
echo "<th>OFFICES</th>";
echo "<th>REMOVE</th>";
echo "</tr>";
if($numrow==0){
      echo "<font size='6' color='0000ff'>"."<b>"."No office has been created! <br>".
      "You can click "."<a href ='office.php'>"."HERE"."</a>"." to create officess for election."."</b>"."</font>";
    } else{
       echo "<font size='5' color='0000ff'>"."Available offices for election"."</font>";
    }
 $i =0;
while ($row=mysql_fetch_assoc($result)) {
     
       
     $i++;
     
      
	echo "<tr>";
	echo "<td>".$i."</td>";
	echo "<td>".$row['office']."</td>";
	

	echo "<td class='undo'>";
echo "<form action='viewoffice.php' method='POST'>";
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
      echo "<h2>Are you sure you want to remove this office?";
  echo "<form action='delete.php' method='POST'>";
    echo "<input type='hidden' name='id' value='".$_POST['id']."'>";
    echo "<input type='submit' name='offino' value='NO'>";
    echo "<input type='submit' name='offiyes' value='YES'>";
  echo "</form>";
echo "</div>";
}
?>
</body>
</html>