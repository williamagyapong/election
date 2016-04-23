<?php
session_start();
require("config.php");
?>
<html>
   <head>
    <title></title>
    <style type="text/css">

body{
  background-image: url();
  text-decoration: none;
}
tr td a{
      text-decoration: none;
      font-size: 18px; font-family: verdana; font-weight:bold;
}
table { border: thin solid #cccccc;
        background: #ffffff; margin-top: -20px;
}
th { letter-spacing: 2.5px; background: #eeeeee; 
   color: #000000; text-transform: uppercase; 
   text-align: center; border-top: thick solid #eeeeee;
   border-bottom: thin solid #cccccc; 
}
tr { letter-spacing: 1.5px; background: #dddddd; 
   color: #000000; text-transform: uppercase; 
   border-top: thick solid #eeeeee; 
   border-bottom: thin solid #cccccc;
}
tr{ background: #ffffff; color: #000000; 
}
td { border: thin solid #cccccc; padding: 10px; 
     text-transform: uppercase; color: blue;
}
span{

}
    
    </style>
   </head>
<body VLINK ="blue">
	<h3><i>Click the links below to view content</i></h3>
  <?php
   echo "<table>";
   if ((isset($_SESSION['ADMIN'])&&isset($_SESSION['ADMINID']))==TRUE) {
    
  echo"<tr><td>"."<a href='office.php' target ='content'>"."Create Offices"."</a>"."</td></tr>";
  echo"<tr><td>"."<a href='candregister.php' target ='content'>"."Register Candidates"
  ."</a>"."</td></tr>";
  echo"<tr><td>"."<a href='register.php' target ='content'>"."Register Voters"."</a>"."</td></tr>";
  echo"<tr><td>"."<a href='viewoffice.php' target ='content'>"."View_Offices"."</a>"."</td></tr>";
  echo"<tr><td>"."<a href='candates.php' target ='content'>"." View_Candidates"."</a>"."</td></tr>";
  echo"<tr><td>"."<a href='registeredvoters.php' target ='content'>"."View_Voters"."</a>"."</td></tr>";
  echo"<tr><td>"."<a href='viewresult.php' target ='content'>"." Results"."</a>"."</td></tr>";
  echo"<tr><td>"."<a href='login.php' target ='blank'>"."Voting_Section"."</a>"."</td></tr>";
  echo"<tr><td>"."<a href='adminlogout.php' target ='content'>"."admin_logout"."</a>"."</td></tr>";
  echo"<tr><td>"."<a href='drop_table.php' target ='content'>"."Undo_Voting"."</a>"."</td></tr>";
  
  
  
} else {
  echo "<tr><td>"."<a href='admin.php' target='content'>"."Admin_Login"."</a>"."</td></tr>";
     $adminsql ="SELECT * FROM admin";
      
     //$numrows =mysql_num_rows($result);
     /*
     if (mysql_query($adminsql)==FALSE) {
         echo "<tr><td>"."<a href='createdb.php' target='content'>"."Create_Database"."</a>".
     "</td></tr>";
  
       
     } else {
       //code goes here
     } */
   

   
}
  echo"</table>";
 ?>
</body>
 
</html>