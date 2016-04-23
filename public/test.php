 

<html>
<head>
<style type="text/css">
.test{
	width: 400px; height: 200px; position: absolute; left: 200px;
	border: 1px solid black;  
	
}
{
	background-image: url(images2/boat.jpg);
}
</style>

</head >
<body >
	
	<!--
<form enctype="multipart/form-data"  action="script.php" method="post"> 
	<input type="hidden"  name="MAX_FILE_SIZE" value="30000" />
 File <input type="file" name="upload" />
 <button type ="submit" name="but" value="submit button">
 </form>

<style type="text/css">
body{
	background-image: url(images/10.jpj);
}
</style>
-->

<?php
//echo phpinfo();
require("config.php");

$sql2 ="SELECT id FROM candidates";
$result2=mysql_query($sql2);
while ($row2 =mysql_fetch_assoc($result2)) {

	$sql ="SELECT cand_id FROM voting WHERE cand_id = 2";
$result =mysql_query($sql);

  while($row =mysql_fetch_assoc($result)){
  	$numrow =mysql_num_rows($result);
//echo $numrow;die();
//echo $row['cand_id'];
	} 

	//$number =mt_rand(5,10);
	  
}

echo "<table border='1'>";
echo "<tr>";
echo "<th>ASCII CODE</th>";
echo "<th>CHARACTER</th>";
echo "</tr>";
$i=0;
for ($i; $i <=255 ; $i++) { 
	 $char =chr($i);
echo "<tr>";
echo "<td>".$i."</td>";
echo "<td>".$char."</td>";
echo "</tr>";
}
 echo "</table>";
?> 
<!--
  <form action="" method="POST">
   Enter Number <input type="text" name="number">
    <input type="submit" name="submit" value="Submit">
  </form>
-->

</body>

</html>


