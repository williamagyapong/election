<!DOCTYPE html>
<html>
<head>
   <link rel="stylesheet" type="text/css" href="styles.css">
</head>
<body>
 <div class="box">
<?php
require("config.php");

if(isset($_POST['submit']))
{
	if(empty($_POST['firstname'])||empty($_POST['lastname'])){
		echo "First name and Last name fields are both required. Please try again.";
	} else{

		$firstname = ucwords($_POST['firstname']);
	    $lastname =ucwords($_POST['lastname']);
	    $gendar =$_POST['gendar'];

	    //generate voter's id
		$d = date("n").date("d");
		$voterid = $d;
		for($i=0; $i<5; $i++) { 
			$voterid .= mt_rand(0, 9);	
		}
		
		$idsql ="SELECT voterid FROM voters WHERE voterid = $voterid";
		$idresult = mysql_query($idsql);
		$idnum =mysql_num_rows($idresult);
	
		if($idnum>0) {
			echo "The generated voter id for this new voter has already been taken.\n
			 Please try the registration again.";
		}else{

		$sql ="INSERT INTO voters(firstname, lastname, voterid, gendar)
		       VALUES('$firstname', '$lastname', '$voterid', '$gendar')";
		       if(mysql_query($sql)==TRUE){
		       	echo "The voter has been successfully registered";
		       }
		       else{
		       	echo "Voter registration was not successful. Try registering again";
		       }
       }
	}
}

?>


<h2>VOTERS REGISTRATION FORM</h2>

<form action="register.php" method="POST">
  <table>
    <tr>
      <td>First Name</td><td><input type ="text" name="firstname"></td>
    </tr>
     <tr>
      <td>Last Name</td><td><input type ="text" name="lastname"></td>
    </tr>
    <tr>
      <td>Gender</td><td><select name="gendar">
       <option value="Male">Male</option>
       <option value="Female">Female</option></select></td>
    </tr>
     <tr>
      <td></td><td><input type ="submit" name="submit" value="REGISTER"></td>
    </tr>


  </table>
</form>
</div>
</body>
<html>