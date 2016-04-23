<?php
$mysql_host = 'Localhost';
$mysql_name = 'root';
$mysql_pass = '';
$mysql_db_name = 'election';

@mysql_connect($mysql_host,$mysql_name,$mysql_pass) || die("Could not 
	connect to server. Please check the mysql server connection");
mysql_select_db($mysql_db_name) || die("database not found");
?>
