<?php
if(isset($_POST['submit'])) {


 $db=mysql_connect("localhost", "root", "");
 $sql ="CREATE DATABASE IF NOT EXISTS election3 ";
 if(mysql_query($sql)) {

 	mysql_query("USE election2");
  $tablesql ="CREATE TABLE IF NOT EXISTS offices(
  	id TINYINT UNSIGNED AUTO_INCREMENT,
  	office VARCHAR(40),
  	PRIMARY KEY(id))";
//mysql_query($tablesql);die("success");
  
  $tablesql2 ="CREATE TABLE IF NOT EXISTS candidates(
  id TINYINT  UNSIGNED AUTO_INCREMENT,
  firstName VARCHAR(20),
  lastName VARCHAR(20),
  office_id TINYINT,
  images VARCHAR(20),
  num_votes VARCHAR(10) DEFAULT'0',
  PRIMARY KEY(id))";

  $tablesql3 ="CREATE TABLE IF NOT EXISTS voters(
  	id INT UNSIGNED AUTO_INCREMENT,
  	firstname VARCHAR(20),
  	lastname VARCHAR(20),
  	voterid VARCHAR(10),
  	votingstatus VARCHAR(10) DEFAULT'0',
  	status VARCHAR(5) DEFAULT'0',
  	PRIMARY KEY(id))";
  $tablesql4 ="CREATE TABLE IF NOT EXISTS voting(
  	id INT UNSIGNED AUTO_INCREMENT,
  	cand_id TINYINT,
  	office_id TINYINT,
  	voter_id INT,
  	dateTime DATETIME,
  	PRIMARY KEY(id))";
  $tablesql5 ="CREATE TABLE IF NOT EXISTS admin(
  	id TINYINT UNSIGNED AUTO_INCREMENT,
  	username VARCHAR(20),
  	password VARCHAR(10),
  	PRIMARY KEY(id))"; 
  if(mysql_query($tablesql)&& mysql_query($tablesql2)&& mysql_query($tablesql3) &&
  	mysql_query($tablesql4)&& mysql_query($tablesql5)) {
  	echo "The database with all the tables has been created.";
  } else {
  	echo "unable to create database";
  }
 }
}
?>
<link rel="stylesheet" type="text/css" href="styles.css">
<form action="" method="POST">
 <table>

    <tr>
      <td><input type ="submit" name="submit" value="CREATE_DB"></td>
    </tr>
  </table>
</form>