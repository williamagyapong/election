<?php
require("config.php");
 if (isset($_POST['vyes'])) {

 	$id =$_POST['id'];

    $query ="SELECT status, votingstatus, gendar FROM voters WHERE id=".$id;
    $result = mysql_query($query);
    $row =mysql_fetch_assoc($result);
    if(($row['status']==1)&&($row['votingstatus']!==0)) {
    	if ($row['gendar']=='Male') {
    		header("Location: registeredvoters.php?errorm");
    	}
    	elseif ($row['gendar']=='Female') {
    		header("Location:registeredvoters.php?errorf");

    	}
    	    } else{ 
    $sql ="DELETE FROM voters WHERE id=".$id;
     if(mysql_query($sql)) {
     	header("Location: registeredvoters.php?del");
     } else {
     	header("Location:registeredvoters.php?error2");
     }
    } 
 }
 elseif (isset($_POST['vno'])) {
     header("Location:registeredvoters.php");
 }

  elseif (isset($_POST['yes'])) {
     $id =$_POST['id'];

     $candsql ="SELECT num_votes FROM candidates WHERE id=".$id;
     $candresult = mysql_query($candsql);
     $candrow = mysql_fetch_assoc($candresult);
     if($candrow['num_votes']==0) {

        $delsql = "DELETE FROM candidates WHERE id=".$id;
        if (mysql_query($delsql)) {
            header("Location:candates.php?del");
        } else {
            header("Location:candates.php?error1");
        }
     } else {
        header("Location: candates.php?error2");
     }
 } elseif (isset($_POST['no'])) {
     header("Location:candates.php");
 }
 //delete from offices
 elseif (isset($_POST['offiyes'])) {
    $offi_id = $_POST['id'];
     $offisql ="DELETE FROM offices WHERE id =".$offi_id;
      if (mysql_query($offisql)) {
          header("Location:viewoffice.php?deloffi");
      } else {
        header("Location: viewoffice.php?delerror");
      } 

 }  elseif (isset($_POST['offino'])) {
          header("Location: viewoffice.php");
      }
?>