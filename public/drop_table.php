<!DOCTYPE html>
<html>
 <head>
  <link rel="stylesheet" type="text/css" href="styles.css">
 </head>
 <body>
<?php
require("config.php");
if(isset($_POST['drop'])){
	echo "<div class='alert'>";
      echo "<h2>Doing this will destroy all votings. Do you want to continue?";
  echo "<form action='drop_table.php' method='POST'>";
    echo "<input type='submit' name='no' value='NO'>";
    echo "<input type='submit' name='yes' value='YES'>";
  echo "</form>";
echo "</div>";

}

if(isset($_POST['yes'])){

$dropsql ="DROP TABLE voting";
if (mysql_query($dropsql)) {
	echo "<font size='6' color='ff0000'>"."All votings have been cancelled!"."</font>";

	//undoing voting for each candidate
	$sql ="UPDATE candidates SET num_votes=0";
	$sql2="UPDATE voters SET status = 0";

	mysql_query($sql);
	mysql_query($sql2);
}else {
	echo "unable to delete the voting table!";
}
} elseif (isset($_POST['no'])) {
	header("Location: drop_table.php");
}
?>


<form action="" method="POST">
	<table>
      <tr>
      	<td><input type ="submit" name="drop" value="Undo Voting"></td>
      </tr>
	</table>

</form>

  </body>
 </html> 