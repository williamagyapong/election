<!DOCTYPE html>
 <html>
  <head>
<link rel="stylesheet" type="text/css" href="styles.css">
  </head>
 <body>
  <div class="castvote">
<?php
session_start();
require("config.php");
?>


<?php
if($_SESSION['USERNAME'] && $_SESSION['ID'] ==TRUE) {
	if(isset($_POST['submit']))
	{
       if(empty($_POST['vote'])) 
       {
       	echo "You did not select any candidate. Please select one";
       } else {
       	 $vote =$_POST['vote'];
         $officeid =$_GET['id'];

           $sql ="SELECT * FROM offices WHERE id =".$officeid;
           $re =mysql_query($sql);
           $officerow =mysql_fetch_assoc($re);
           $sql = "SELECT id, votingStatus FROM voters WHERE voterid='".$_SESSION['ID']."'";
           $result =mysql_query($sql);
           //$numrow =mysql_num_rows($result);
           $row =mysql_fetch_assoc($result);

           //selects data from the offices table
           $offisql ="SELECT * FROM offices";
           $offire =mysql_query($offisql);
           $offinumrow =mysql_num_rows($offire);

           //selects data from the voting table
           
                      //echo $row['votingStatus'];die();
                      //echo $officerow['id']; die();
            $sql3 = "SELECT * FROM voting WHERE voter_id='".$row['id']."' AND office_id =
            '".$officerow['id']."'";
            $result3 =mysql_query($sql3);
            $numrow3 =mysql_num_rows($result3);
                if($numrow3 ==1)
                  { 
                  echo "<div class='back'>";
                   echo "<font size='7px' >"."Please double voting is not allowed.
                   Click the back button to continue"."</font>";
                   echo "<p>";
                   echo "<form action='back.php' method='POST'>";
                   echo "<input type='submit'name='submit' value='BACK'>";
                   echo "</form>";
                   echo "</div>";
                   die();
                  } else { 
            
       	    $votesql ="INSERT INTO voting(cand_id, voter_id, office_id, dateTime)
       	            VALUES('$vote','".$row['id']."', '".$officerow['id']."', NOW())";
                    
                    $update = "UPDATE voters SET votingStatus= '".$officerow['id']."'".
                     "WHERE id ='".$row['id']."'";

                     $candsql ="SELECT cand_id FROM voting WHERE cand_id=$vote";
                     $candresult =mysql_query($candsql);
                     $numvotes =mysql_num_rows($candresult);
                     $update2 ="UPDATE candidates SET num_votes =$numvotes+1 WHERE id =$vote";

       	     if(mysql_query($votesql)&&mysql_query($update)&&mysql_query($update2)==TRUE) {
       	     //	header("Location: voting.php");
              $sql2 ="SELECT voter_id FROM voting WHERE voter_id='".$row['id']."'";
           $result2 =mysql_query($sql2);
           $numrow2 =mysql_num_rows($result2);
           if($offinumrow==$numrow2) {
                //echo "You have finished voting. Please click the exit button.";
            header("Location: summary2.php");
             } 
             else{  header("Location: voting.php");
       	     } 
          }
         } 
       }
	}

} else{
  echo "Your voting time has expired!.Try logging in again.";
}



//display candidates 
 $sql ="SELECT * FROM offices WHERE id ='".$_GET['id']."'";
 $re =mysql_query($sql);
 $row =mysql_fetch_assoc($re);
 //echo $row['id']; die();

 $cansql = "SELECT * FROM candidates WHERE office_id = '".$row['id']."'";
 $canre = mysql_query($cansql);
 $cannumrow =mysql_num_rows($canre);
 echo "<form action='' method='POST'>";
 while ($canrow = mysql_fetch_assoc($canre)) {
 	//echo $canrow['firstName'];
echo "<span>";
echo"<input type ='radio' name='vote' value='".$canrow['id']."'>";


 	echo "<img src='./images2/".$canrow['images']."' width='150' height='250' 
title='"."Vote"." ".$canrow['firstName']." ".$canrow['lastName']." as ".$row['office']."'>";
echo "</span>";
 }
    echo "<p>";
    echo "<input type='submit' name='submit' value='CAST VOTE'>";
    echo "</p>";
    echo "</form>";

?>
 </div>
</body>
</html>