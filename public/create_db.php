<?php
 $db=mysql_connect("localhost", "root", "");
 $sql ="CREATE DATABASE IF NOT EXISTS election ";
 if(mysql_query($sql)) {

 	mysql_query("USE election");
  $tablesql ="CREATE TABLE IF NOT EXISTS offices(
  	id INT UNSIGNED AUTO_INCREMENT,
  	office VARCHAR(40),
  	PRIMARY KEY(id))";
//mysql_query($tablesql);die("success");
  
  $tablesql2 ="CREATE TABLE IF NOT EXISTS candidates(
  id INT  UNSIGNED AUTO_INCREMENT,
  firstName VARCHAR(20),
  lastName VARCHAR(20),
  office_id INT,
  images VARCHAR(50),
  num_votes VARCHAR(10) DEFAULT'0',
  PRIMARY KEY(id))";

  $tablesql3 ="CREATE TABLE IF NOT EXISTS voters(
  	id INT UNSIGNED AUTO_INCREMENT,
  	firstname VARCHAR(20),
  	lastname VARCHAR(20),
  	voterid VARCHAR(10),
  	votingstatus VARCHAR(10) DEFAULT'0',
  	status VARCHAR(5) DEFAULT'0',
    gendar VARCHAR(16),
  	PRIMARY KEY(id))";
  $tablesql4 ="CREATE TABLE IF NOT EXISTS voting(
  	id INT UNSIGNED AUTO_INCREMENT,
  	cand_id INT,
  	office_id INT,
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
  	//echo "The database with all the tables has been created.";
    
     require("config.php");
    $sql = "SELECT * FROM  admin";
    $result = mysql_query($sql);
    $numrow = mysql_num_rows($result);
    if ($numrow==0) {
      $adminsql ="INSERT INTO admin(username, password)
       VALUES('willisco', 'willi0010'),('admin1', '234546'),('admin2', '237283') ,
       ('admin3', '238798'),('admin4','235768')";
       mysql_query($adminsql);
    } else{

    }
     
  } else {
  	echo "unable to create database";
  }
 
}

?>