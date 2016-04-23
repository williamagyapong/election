<?php

function escape($str)
{
	$str =  mysql_real_escape_string($str);
	//$str =  strip_tags($str);
	//$str =  htmlentities($str);

	return $str;
}


function redirect($destination)
{
   header("Location: {$destination}.php");
}

function isEven($value)
{
	return $value % 2 == 0;
}

function isOdd($value)
{
	return isEven($value - 1);
}

function print_array($array)
{
	echo '<pre>',print_r($array),'</pre>';
}

function formatTime($x)
{
	if ($x < 10) 
	{
		$x = '0'.$x;
	}
	return $x;
}

function countDown($dateStarted, $duration)
{
	date_default_timezone_set("UTC");

$startedAt = strtotime($dateStarted);
$currtime = time();


$timeElapsed = $currtime - $startedAt;
$remaining   = ($duration*60) - $timeElapsed; 

$seconds     = $remaining;
$minutes = floor($remaining/60);
$hours   = floor($remaining/3600);
//$days    = floor($diffInSeconds/86400);

$minutes %= 60;
$hours  %=24;
$seconds %=60;

if($remaining <=0)
{
	$mins = '00';
	$hrs  = '00';
	$secs = '00';

	
}
else{
	 	$mins = formatTime($minutes);
		$hrs  = formatTime($hours);
		$secs = formatTime($seconds);
}



   return  array($remaining, $hrs.":".$mins.":".$secs);
}


function numEncrypt($value)
{
  $result = $value/34534998876;
  return $result;
}

function numDecrypt($value)
{
	$result = $value*34534998876;
	return round($result);
}
	
function deleteRecord($table, $idField="id", $id)
{
	$sql = "DELETE FROM " .'`'.$table.'`'." WHERE ". '`'.$idField.'` = '. $id;
	
	if(mysql_query($sql))
	{
		return true;
	}
	else
		return false;
}	


function getSettings()
{
	return select("SELECT * FROM settings");
}

function updateSettings($questions, $duration)
{
	$queryRun = mysql_query("UPDATE `settings` SET `num_questions`='$questions', `duration`='$duration'");
	if($queryRun)
	{
		 return true;
	}
}

function truncateString($string)
{
	$length = strlen($string);
	if($length >= 19)
	{
		return substr($string, 0,17)."...";
	}else{
		return $string;
	}
}
?>