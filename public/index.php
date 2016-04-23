<!DOCTYPE html>
<html>
   <head>
    <title></title>
    <link rel="stylesheet" type="text/css" href="styles.css">
   </head>
 
  <frameset rows="20%, *">
    <frame src="title.php"/>
   
<frameset cols = "20%, *">
<frame src="menu.php"/>
<frame name = "content">
</frameset>
</frameset>

<?php
require("create_db.php");
?>
 
</html>