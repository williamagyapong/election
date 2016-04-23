<?php
session_start();
require("config.php");
?>

<link rel="stylesheet" type="text/css" href="styles.css">
<div class="menu"> <?PHP
if($_SESSION['USERNAME']&& $_SESSION['ID']==TRUE) {

	$officesql = "SELECT * FROM offices";
	$officeresult = mysql_query($officesql);
	$office_num = mysql_num_rows($officeresult);
	if ($office_num==0) {

		echo "<font size='6'color='red'>"."No offices are available for voting. 
		Click "."<a href='officereg.php'>"."HERE"."</a>"."to create offices.","</font>";
	}else {
		while ($officerow =mysql_fetch_assoc($officeresult)) {
             echo "<span>"."<a href='castvote.php?id=".$officerow['id']."'>".
             $officerow['office']."</a>"."</span>";
			
		}
	}
	 
/*
  previous implementation for displaying available offices
	echo "<span>"."<a href='president.php'>"."PRESIDENCY"."</a>"."</span>";
	echo "<span>"."<a href='gensecretary.php'>"."GENERAL SECRETARY"."</a>"."</span>";
	echo "<span>"."<a href='finsecretary.php'>"."FINANCIAL SECRETARY"."</a>"."</span>";
	echo "<span>"."<a href='organiser.php'>"."ORGANISER"."</a>"."</span>";
	//echo "<span>"."<a href='summary2.php'>"."CONFIRM"."</a>"."</span>";
*/
	echo "<form action='logout.php' method='POST'>";
	echo "<input type='submit' name='exit' value='LOG OUT'>";
	echo "</form>";
} else{
	header("Location: login.php");
}
	?>
</div>

<div class="votingmain">
	<?php
 if(isset($_GET['id'])){
 	$year = date("Y");
 	$sql ="SELECT firstname, lastname, status FROM voters WHERE id =".$_GET['id'];
 	$result = mysql_query($sql);
 	$row =mysql_fetch_assoc($result);
 	 if($row['status']==1) {
 	 	echo "You have already voted. Please log out.";
 	 } else {
 	echo "Welcome "."<font color='white'>"."<i>".$row['firstname']." ".$row['lastname']."</i>".
 	"</font>"." to the voting page. Click the appropriate links above to cast your vote.";
 	  }
 } 
   
   elseif (isset($_GET['ID'])) {
      echo "You've finished voting.<br>
            Click the logout button to exit.";
   }
    elseif (isset($_GET['ID2'])) {
    	echo "You've just undone some voting. Navigate to that link to vote again.";
    }
  else{
  	 echo "Click on the next link to continue voting.";
  }
	?>

</div>