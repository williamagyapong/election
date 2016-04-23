<link rel="stylesheet" type="text/css" href="styles.css">
<?php
 require("config.php");

 if(isset($_GET['id'])==TRUE) {

 	echo "<font size='6px' color='blue'>"."You have successfully completed the voting process.<br> 
 	Below are the candidates you voted for."."</font>";

 	$sql ="SELECT cand_id FROM voting WHERE voter_id =".$_GET['id'];
 	$result =mysql_query($sql);

 	echo "<table cellpadding='10'>";
 echo "<tr>";
 echo "<th>Name</th>";
 echo "<th>Office</th>";
 echo "<th>Picture</th>";
 echo "</tr>";
 	while($row =mysql_fetch_assoc($result)) {

 	$sql2 = "SELECT *  FROM candidates WHERE id ='".$row['cand_id']."'";
 	$result2 =mysql_query($sql2);
 	$row2 =mysql_fetch_assoc($result2);

 	$sql3 ="SELECT * FROM offices WHERE id ='".$row2['office_id']."'";
 	$result3 =mysql_query($sql3);
 	$row3 =mysql_fetch_assoc($result3);

 
//while() {
	echo "<tr>";
echo "<td>".$row2['firstName']." ".$row2['lastName']."</td>";
echo "<td>".$row3['office']."</td>";
echo "<td><img src='./images2/".$row2['images']."' width='85' height='80' 
title='".$row2['firstName']."'></td>";
echo "</tr>";


//}
}
   echo "</table>";
  echo "<div class='exit'>";
   echo "<form action='logout.php' method='POST'>"; 
   echo "Click"." "."<input type ='submit' name='exit' value='HERE'> ";
   echo " to Exit";
   echo "</form>";
   
   echo "</div>";

 } else{
 	echo "Get id does not exist.";
 }
 ?>

 