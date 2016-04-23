<!DOCTYPE html>
 <html>
 <head>
  <link rel="stylesheet" type="text/css" href="css/main.css">
 </head>
 <body>
 	<div class="summary">
<?php
session_start();
 require("config.php");

 if(isset($_SESSION['ID'])==TRUE) {

 	echo "<font size='6px' color='blue'>"."<i>"."Below are the candidates you've voted for.<br>
 	Click the confirm button to accept votes or undo <br>any of your votes and vote again."."</i>"."</font>";
 	$votersql ="SELECT id FROM voters WHERE voterid=".$_SESSION['ID'];
 	$voterre = mysql_query($votersql);
 	$voterrow = mysql_fetch_assoc($voterre);

 	$sql ="SELECT cand_id FROM voting WHERE voter_id =".$voterrow['id'];
 	$result =mysql_query($sql);

 	echo "<div class='confirm'>";
   echo "<form action='confirm.php' method='POST'>"; 
   echo "<input type ='submit' name='confirm' value='CONFIRM'> ";
   
   echo "</form>";
   
   echo "</div>";


 	echo "<table cellpadding='10'>";
 echo "<tr>";
 echo "<th>Name</th>";
 echo "<th>Office</th>";
 echo "<th>Picture</th>";
 echo "<th>UNDO VOTES</th>";
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
echo "<td class='undo'>";
echo "<form action='summary2.php' method='POST'>";
echo "<input type='hidden' name='officeid' value='".$row3['id']."'>";
echo "<input type='hidden' name='candid' value='".$row2['id']."'>";
echo "<input type='submit' name='undo' value='undo'>";
echo "</form>";
echo "</td>";
echo "</tr>";


//}
}
   echo "</table>";
  
 } else{
 	echo "Get id does not exist.";
 }
 ?>


<?php
if (isset($_POST['undo'])) {
echo "<div class='alert'>";
      echo "<h2>Are you sure you want to undo the vote for this candidate 
      and vote for a different candidate?";
  echo "<form action='confirm.php' method='POST'>";
    echo "<input type='hidden' name='officeid' value='".$_POST['officeid']."'>";
    echo "<input type='hidden' name='candid' value='".$_POST['candid']."'>";
    echo "<input type='submit' name='uno' value='NO'>";
     echo "<input type='submit' name='uyes' value='YES'>";
  echo "</form>";
echo "</div>";
}
?>
 </div>

 </body>
 </html>