<!DOCTYPE html>
<html>
 <head>
<link rel="stylesheet" type="text/css" href="styles.css">
 <style type="text/css">
  body{
  margin:0;
  padding: 0;
  background-color: #c0c0c0;
}
 </style>
 </head>
 <body>
 	<div class="wrapper">
<?php
 require_once("config.php");
 require_once 'core/init.php';

  if (isset($_POST['create'])) {
      if (empty($_POST['office'])) {
      	   echo "The office field can't be empty!";
      } else{
        if(isset($_POST['ignore'])&&$_POST['ignore']=="yes")
        {
          $office = ucwords($_POST['office']);
          if(insert('offices',[
               'office'=>$office
            ])) echo "The action was successful";
          else {
          echo "A problem might have occurred. Please try again";
         }
        }
        else{
          $office  = ucwords($_POST['office']);
          $office2 = ucwords($_POST['office2']);
          $office3 = ucwords($_POST['office3']);
          $office4 = ucwords($_POST['office4']);

          if(insert('offices',[
               'office'=>$office
            ])&& insert('offices',[
               'office'=>$office2
            ])&& insert('offices',[
               'office'=>$office3
            ])&& insert('offices',[
               'office'=>$office4
            ]))echo "The action was successful";
          else {
          echo "A problem might have occurred. Please try again";
         }
        }
      	
        
  	/*$query ="INSERT INTO Offices( office)
  	        VALUES('$office') ";
  	     if (mysql_query($query)) {
  	     	echo "The action was successful";
  	     } else {
  	     	echo "A problem might have occurred. Please try again";
  	     }*/
  	    }
  }
?>

  <!-- <h2>Create Offices For Election</h2> -->
  <form action="" method="POST">
    <fieldset class="fieldset">
       <legend>Create Offices</legend>
      <table class="table" style="margin-left: 240px;">
      <tr><td>Office</td><td><input type="text" name="office" required></td>
      </tr>
      <tr>
         <td>
        <input type="checkbox" name="ignore" value="yes" checked="checked" style="width:22px; height:22px"><span id = "ignore">Ignore</span>
        </td><td></td>
      </tr>
      <tr>
        <td>Office</td>
        <td>
           <input type="text" name="office2">
        </td>
      </tr>
      <tr>
        <td>Office</td>
        <td>
           <input type="text" name="office3">
        </td>
      </tr>
      <tr>
        <td>Office</td>
        <td>
           <input type="text" name="office4">
        </td>
      </tr>
      <tr><td></td><td><input type="submit" name="create" value="CREATE"></td></tr>
    </table>
    </fieldset>
    
  </form>
</div>
 </body>
</html>