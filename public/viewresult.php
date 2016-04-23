<!DOCTYPE html>
<<!DOCTYPE html>
<html>
<head>
  <title>view results</title>
  <link rel="stylesheet" type="text/css" href="css/main.css">
</head>
<body>
   <?php
  require("config.php");
    $voterssql ="SELECT id FROM voters";
    $votersre = mysql_query($voterssql);
    $num_voters = mysql_num_rows($votersre);

    $castsql ="SELECT status FROM voters WHERE status =1";
    $castre = mysql_query($castsql);
    $num_cast = mysql_num_rows($castre);

    $sql ="SELECT * FROM candidates"." ORDER BY office_id ASC";
    $result = mysql_query($sql);
    $num_rows =mysql_num_rows($result);
    echo "<div class='result'>";
      $year =date("Y");
           echo /*GBAWE CHURCH OF CHRIST YOUTH MINISTRY <br>*/ "$year ELECTION RESULTS";
    echo "</div>";
    echo "<table>";
    echo "<tr>";
    echo "<th>CANDIDATES</<th>";
    echo "<th>PICTURE</<th>";
    echo "<th>POSITION</<th>";
    echo "<th>VOTES<br> RECEIVED</<th>";
    echo "<th>PERCENTAGE</th>";
    echo "<th>REGISTERED<br> VOTERS</<th>";
    echo "<th>TOTAL VOTES<br>CAST</th>";
    echo "</tr>";

    if ($num_voters==0||$num_cast==0||$num_rows==0) {
        echo "<font size='6' color='red'>"."No result available. Voting has not started!".
              "</font>";
    } else {
    while($row = mysql_fetch_assoc($result))
    {
      $officesql ="SELECT * FROM offices WHERE id ='".$row['office_id']."'"." ORDER BY id ASC";
      $officere = mysql_query($officesql);
      $officerow =mysql_fetch_assoc($officere);
      $officenum =mysql_num_rows($officere);
        if($num_cast==0) {
          $percent=0;
        } else{
          $percent = sprintf("%.2f",($row['num_votes']/$num_cast)*100);
        }
      echo "<tr>";
      echo "<td>".$row['firstName']." ".$row['lastName']."</td>";
      echo "<td><img src='./images2/".$row['images']."' width='85' height='80' 
           title='".$row['firstName']."'></td>";
      echo "<td>".$officerow['office']."</td>";
      echo "<td>".$row['num_votes']."</td>";
      echo "<td>".$percent." %"."</td>";
      echo "<td>".$num_voters."</td>";
      echo "<td>".$num_cast."</td>";
      echo "</tr>";
    
    }
   } 
      echo "</table>";
?>
</body>
</html>



