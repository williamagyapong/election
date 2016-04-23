
<?php
 //insert function begins here
  

 function insert($table, array $data)
 {
 	          // builds  query statement
 	  $fields = '';

    $values = '';

    foreach ($data as $key => $value) 
    {
       $fields .= '`'.$key.'`,';
       if(is_numeric($value))
        $values .= $value.',';
      else
        $values .= "'".$value."',";
    }    

    $fields = rtrim($fields, ',');
    $values = rtrim($values, ',');

    $sql = 'INSERT INTO '.'`'.$table.'` '.'('.$fields.') VALUES ('.$values.')';

    // runs the query against database
    $query_run = mysql_query($sql);

    if ($query_run) 
    {
      return true;
    }
    else
    {
       return false;
    }
       
     
 } //end of insert function


// select function begins here

 function select($sql)
 {
    $results = [];

    if($queryrun = mysql_query($sql))
    {
      while($sqlresult = mysql_fetch_assoc($queryrun))
      {

        $results[] = $sqlresult;
      }

    }
    else{
      return "Please make sure to enter the right query statement";
    }
    return $results;
 }


?>
