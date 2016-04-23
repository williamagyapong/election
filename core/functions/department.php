<?php

function getCollege($collegeId = "*")
{
  if ($collegeId == "*")
    {
     return select("SELECT * FROM colleges");
   }
   else{
     return select("SELECT * FROM colleges WHERE id = $collegeId");
   }
}

function getDepartment($departmentId="*")
{
  if ($departmentId == "*")
    {
     return select("SELECT * FROM departments");
   }
   else{
     return select("SELECT * FROM departments WHERE id = $departmentId");
   }
}


function getDepartments($collegeId)
{
  return select("SELECT * FROM departments WHERE college_id = $collegeId");
}


function getCourse($courseId="*")
{
   if($courseId == "*")
   {
      return select("SELECT * FROM category");
   }
   else{
      return select("SELECT * FROM category WHERE id =$courseId");
   }
     
}









function getCategories($departmentId) //retrieves courses related to a particular department
{
  
     return select("SELECT * FROM category INNER JOIN department_category
      ON category.id = department_category.category_id WHERE department_category.
      department_id = '$departmentId'");
     

 
} // end of function


function getAllCategories() //retrieves courses relating to each department
{

 $data = [];
	$ids = [];
  $departments = getDepartments();
  foreach ($departments as $key => $value) {

  	// $courses[] .= $value['name'];
  	 $ids[] = $value['id'];
  }
  //return $courses;
  //return $ids;

  foreach ($ids as $key => $id) {
 	
 	   $data[] = select("SELECT * FROM category INNER JOIN department_category
      ON category.id = department_category.category_id WHERE department_category.
      department_id = '$id'");
     
}
return $data;
 
}//end of function



function getDepartmentWithCourses($collegeId)
{
  //initialise array variables
  $data = [];
  $courses = [];
  $ids = [];

  //fetch departments
  $departments = getDepartments($collegeId);
  //append departments to data array
  //$data['departments'] = $departments;

  //get the ids of each department
  foreach ($departments as $key => $value) {

     //$ids[] = $value['id'];
     $data[$key]['department'] = $value;
     $data[$key]['courses'] = getCategories($value['id']);
  }
 

  return $data;
  
} //end of function


?>