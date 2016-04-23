<?php
session_start();
session_destroy();

echo "<font size='6' color='ff0000' weight='bold'>"."Refresh the page to activate the log out process!".
"</font>";
//header("Location: admin.php");
?>