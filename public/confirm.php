<?php
session_start();
require("config.php");

if(isset($_POST['confirm']))
  {
  	$sql = "UPDATE voters SET status =1 WHERE voterid=".$_SESSION['ID'];
  	if(mysql_query($sql)){
  		header("Location: voting.php?ID=73");
  	} else{
  		echo "unable to confirm votes";
  	}

  }
   elseif (isset($_POST['uyes'])) {
   	  if(empty($_POST['officeid']) && empty($_POST['candid'])) 
   	  {
   	  	echo "Lost track of the required office id and candidate id";
   	  } else{
   	  	$officeid =$_POST['officeid'];
   	  	$candid = $_POST['candid'];

   	  	$sql2 ="SELECT id FROM voters WHERE voterid=".$_SESSION['ID'];
   	  	$result = mysql_query($sql2);
   	  	$row  = mysql_fetch_assoc($result);

   	  	$delsql ="DELETE FROM voting WHERE voter_id ='".$row['id']."' AND cand_id='".$candid."'";

   	  	$updatesql ="UPDATE candidates SET num_votes = num_votes-1 WHERE id =".$candid;

   	  	if(mysql_query($delsql)&&mysql_query($updatesql)==TRUE) {
   	  		//header("Location: voting.php?ID2=74");
        

          header("Location: castvote.php?id=".$officeid);
   	  	}
   	  	     

   	  }
   }
    elseif (isset($_POST['uno'])) {
      header("Location:summary2.php");
    }
?>