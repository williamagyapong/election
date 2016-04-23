<?php session_start();?>
<!DOCTYPE html>
<html>
<head>
   <title>Admin login</title>
   <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
  <div class="box">
    <?php

    require("config.php");

      if (isset($_POST['submit'])) {
        	if(empty($_POST['username']) || empty($_POST['password'])) {
        		echo "Please both fields are required.";
        	} else{
        		$username =trim($_POST['username']);
        		$password =trim($_POST['password']);

        		$sql ="SELECT * FROM admin WHERE `username` ='$username' AND `password` ='$password'";
        		$result = mysql_query($sql);
        		$numrow = mysql_num_rows($result);
        		//echo $numrow;die();
        		 if($numrow ==1 ) {
        		 	$row = mysql_fetch_assoc($result);

        		 	$_SESSION['ADMIN'] = $row['username'];
        		 	$_SESSION['ADMINID'] = $row['password'];

        		 	echo "<font size='6' color='ff0000'>"."Refresh the page to activate 
              the log in process."."</font>";
              //header("Location: menu.php");
        		 } else{
        		 	echo "Incorrect username or password. Please try again.";
        		 }
        	}

        }  


    ?>


<h2>Log in as an administrator</h2>

<form action="" method="POST">
    <table>
      <tr>
         <td>Username</td><td><input type="text" name="username"></td>
      </tr> 
      <tr> 
         <td>Password</td><td><input type="password" name ="password"></td>
      </tr> 
      <tr>
         <td></td><td><input type="submit" name="submit" value="Login"></td>
      </tr>
    </table>
</form>
</div>
</body>
</html>