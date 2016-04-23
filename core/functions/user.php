<?php
//user registration function
	function  register($name, $username, $password)
	{
		$message = [];


		if(empty($name)||empty($username)||empty($password))
		{
			$message[] = "Please all fields are required";
		}
		else{

		$passlength = strlen($password);
		if($passlength>=5 && $passlength<=20)
		{
			 $query_run = mysql_query("SELECT * FROM `users` WHERE 
	                  	`username`='$username'");
	                  if(mysql_num_rows($query_run)>=1)
	                  {
	                  	 $message[] = "Username already exists!"; 
	                  }
	                  


		               if(count($message) == 0)
		                   {
			                     // no errors
			                    $password = md5($password);
			              if(insert('users',
			               [
				             'name' => $name,
				             'username' => $username,
				             'password' => $password,
			                ])) {
				               $message[] = "Thank you for joining! <a href='login.php'>Click here to log in</a>";
			              }
		              }

	                } 
	            else
				{
					$message[] ="Password characters out of required range( 5 - 20 )";
				}
			}

	   return  $message;

	} //End of register function





		 function login($username, $password, $table="users")
		   
		 {
		     $errors = array(); // initializes error variable

		 	//validates username and password
		 	if(empty($username)|| empty($password))
		 	{
		 		$errors[] = "You forgot to enter username or password";
		 	}
		 	else{
		 		 $username = escape(trim($username));
		 		 $password = escape(trim(md5($password)));
		 	}
		 	      if(empty($errors))// handles user login upon no errors
		 	       {
		 	         $userData = select("SELECT `id` FROM `$table` WHERE `username`='$username' 
		 		               AND password='$password'");
		             if(count($userData)==1) // got the right user
		             {
		             	
		                return array(true, $userData);
		             } 
		             else{
		             	$errors[] = "Invalid username or password";
		             }
		 	    } 
		 	    return array(false, $errors);
		 }



		function isLoggedIn()
		{
			return isset($_SESSION['user_id']);
		}

		function auth()
		{
			if(!isLoggedIn())
				redirect('index');
		}

		function getLoggedInUser()
		{
			$loginId = $_SESSION['user_id'];
			$data = [];
			//return select("SELECT * FROM users WHERE id = ".$loginId);
			$data['user']['user_info'] = select("SELECT * FROM users WHERE id = ".$loginId);
			
			$data['user']['test_records'] = getTestRecords($loginId);
			return $data;
		}

		function getTestRecords()
		{
			$loginId = $_SESSION['user_id'];
			return select("SELECT test_info.*, category.* FROM test_info, category 
				WHERE test_info.user_id ='$loginId' AND category.id=test_info.course_id ORDER BY test_info.started_at DESC");
		}



		function changePassword($userId, $prevPass, $newPass1, $newPass2)
		{
			 $msg = [];
			if(empty($prevPass) || empty($newPass1) || empty($newPass2))
			{
				$msg[] = "All fields are required";
			}
			else{
				   // retrieve user previous password
			       $password =  select("SELECT password FROM users WHERE id =".$userId)[0];
			      if($password['password'] != md5($prevPass))
			       {
                      $msg[] = " Incorrect current password";
			       }

			       if($newPass1 == $newPass2)
			       {
				       	  $passlength = strlen($newPass1);
			       	    if(!($passlength>=5 && $passlength<=20))
			       	    {
			       	    	$msg[] = "New password characters out of required range( 5 - 20 )";
			       	    }
			       	  
			       }
			       else{
			       	     $msg[] = "New passwords do not match";
			       }
			      
		       	   
			       
                   

			          if(count($msg)== 0)
			          {
			          	// no errors 
			          	 $newPass1 = escape($newPass1);
			          	 $password_hash = md5($newPass1);
                         if(mysql_query("UPDATE users SET password = '".$password_hash."' WHERE id ='".$userId."'"))
                         {
                         	$msg[] = "Password has been successfully updated";
                         }
                         else{
                         	$msg[] = "Unable to save changes";
                         }
			          }

			}
              return $msg;
		}
  
   