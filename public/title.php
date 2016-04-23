<?php
require("config.php");
?>

<!DOCTYPE html>
<html>
<head>
<title></title>
<style type="text/css">
#header{
	width: 100%; height: 116px;
	color: black;  padding-top: 15px;
	font-size: 40px; text-align: center;
	background-image: url(images/10.jpg);
}
</style>
</head>
<body>
<div id="header"> <?php 
echo $config_appName.'<br>'; 
echo "<font face='arial' size='+1' color='red'>"."<i>"."Experience smartness in voting"."</i>"."</font>";
?>
</div>
