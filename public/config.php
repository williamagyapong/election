<?php
$dbhost = "localhost"; 
$dbuser = "root"; 
$dbpassword = ""; 
$dbdatabase = "election";
// Add the name of the forums below 
$config_appName = "SMART ELECTION";
// Add your name below 
$config_admin = "William Ofosu Agyapong"; 
$config_adminemail = "willisco AT live DOT com";
// Add the location of your scripts/files below 
$config_basedir = "http://127.0.0.1//election/";
$headername = "Gbawe Church of Christ Youth Ministry";
?>


<?php
$db = mysql_connect($dbhost, $dbuser, $dbpassword);
      mysql_select_db($dbdatabase, $db);
?>