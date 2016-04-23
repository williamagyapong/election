<!DOCTYPE html>
<html>
 <head>
    <link rel="stylesheet" type="text/css" href="styles.css">

 </head>
 <body>
<div class="box"> 
<?php
session_start();
require("config.php");

 if(isset($_POST['submit'])) {
 	 if(empty($_POST['id'])) {
 	 	echo "Please both fields are required for successful log in.";
 	 } else{
 	 	//$firstname =$_POST['firstname'];
 	 	$id = $_POST['id'];

 	 	$sql ="SELECT * FROM `voters` WHERE  `voterid` = '$id'";
 	 	$result =mysql_query($sql);
 	 	$numrow =mysql_num_rows($result);
 	 	  if($numrow ==1) {
 	 	  	$row =mysql_fetch_assoc($result);
 	 	  	  if ($row['status']==1) {
 	 	  	  	 echo "<font size='6' color='ff0000'>"."Please you have already voted"."</font>";
 	 	  	  }else {
 	 	  	 
 	 	  	$_SESSION['USERNAME'] =$row['firstname'];
 	 	  	$_SESSION['ID'] =$row['voterid'];

 	 	  	if ($_SESSION['ID']==TRUE) {
 	 	  		$query ="SELECT id FROM voters WHERE voterid='".$_SESSION['ID']."'
 	 	  		 AND status='0'";
	 $re =mysql_query($query);
	 $voterrow = mysql_fetch_assoc($re);

	 $query2 ="SELECT voter_id FROM voting WHERE voter_id=".$voterrow['id'];
	 $re2 = mysql_query($query2);
	 $numrows = mysql_num_rows($re2);

	 $query3 = "SELECT id FROM offices";
	 $re3 = mysql_query($query3);
	 $numrows2 = mysql_num_rows($re3);

	          if ($numrows==$numrows2) {
	          
	             header("Location: summary2.php");
	          }  else{
 	 	  	header("Location: voting.php?id='".$row['id']."'");
 	 	    }
 	 	} else {
 	 		//header("Location: login.php");
 	 	}

 	         }  	 	  
 	     } else{
 	 	  	    echo "Incorrect voter id";
             }
          }   
 }

?>


<h2>Log in with your voter id to begin voting</h2>
<form action="" method="POST">
<table>
<!--
<tr>
<td>First Name</td>
<td><input type="text" name="firstname"></td>
</tr>
-->
<tr>
<td>Voter Id</td>
<td><input type="text" name="id"></td>
</tr>
<tr>
<td></td>
<td><input type="submit" name="submit" value="LOG IN"></td>
</tr>
</table>
</form>
  </div>
 </body>
 <html>