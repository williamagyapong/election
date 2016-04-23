<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="styles.css">
</head>
 <body>

<div class="wrapper">
<?php
require("config.php");
if(isset($_POST['submit']))  {
	if (empty($_POST['firstname'])|| empty($_POST['lastname']) 
		|| empty($_POST['office']) || empty($_FILES['image']['name'])) {
		echo "Please all fields are required. Fill out the form again";
	}else {
         $tmp_name =$_FILES['image']['tmp_name'];
         $image_name=$_FILES['image']['name'];
         $location ='images2/';
         if(move_uploaded_file($tmp_name, $location.$image_name)){
		$query ="INSERT INTO candidates(firstName, lastName, office_id, images)
		VALUES('".ucwords($_POST['firstname'])."', '".ucwords($_POST['lastname'])."', '".$_POST['office']."',
			'$image_name') ";
        if (mysql_query($query)) {
        	echo "<font color='red' size='9'>"."The candidate has been successfully registered".
        	"</font>";
        } else {
        	echo "<font color='red' size='9'>"."The registration was not successful.
        	Please try again."."</font>";
        }
      } else {
          echo "There was an error in uploading image.try again.";
      }   
	}
}

?>


<!-- <h2>CANDIDATES REGISTRATION FORM</h2> -->

<form action="" method="POST" enctype="multipart/form-data">
  <fieldset class="fieldset">
    <legend>Register Candidates</legend>
    <table class="table">
    <tr>
      <td>First Name</td><td><input type ="text" name="firstname"></td>
    </tr>
     <tr>
      <td>Last Name</td><td><input type ="text" name="lastname"></td>
    </tr>
    <tr>
      <td>Image</td><td><input type ="file" name="image"></td>
    </tr>
    <tr>
      <td>Office</td><td><select name="office">
      <?php
         $sql = "SELECT * FROM offices";
         $result = mysql_query($sql);
         while($row = mysql_fetch_assoc($result)) {
          echo "<option value='".$row['id']."'>".$row['office']."</option>";
         }
      ?> 
      
  </select></td>
    </tr>
     <tr>
      <td></td><td><input type ="submit" name="submit" value="REGISTER"></td>
    </tr>
  </table>
  </fieldset>
  
  </form>
 </div>
</body>
</html>