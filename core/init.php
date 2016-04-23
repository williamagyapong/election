<?php
date_default_timezone_set("UTC");
    require_once 'database/connection.php';
    require_once "functions/general.php";
    require_once 'database/helper.php';
    
    
    
    
  
  
if(isLoggedIn())
{
	$userData = getLoggedInUser();
	
	
}
 
 
 
