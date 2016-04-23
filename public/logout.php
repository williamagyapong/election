<?php
session_start();
if (isset($_POST['exit'])) {

	session_destroy();
//require("config.php");
header("Location: login.php" );

	
}
?>