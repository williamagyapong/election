<?php
/**
* handles all php functions pertaining to the test
*===================================================================================================
******* function names **************
* @ insertQuestions
* @ getQuestionsByCategory
* @ getQuestionsId
* @ getQuestionsByDifficulty
* @ prepareQuestions
* @ markTest
*===================================================================================================
*/

  

  

/**
* Gets a set of question ids 
* using the provided courseId and 
* limit 
*
* @param $courseId | int
* @param $limit | int
*
* @return array
*
*/
function getQuestionsId( $courseId, $limit) 
{  
  return select("SELECT id FROM questions WHERE 
   category_id = $courseId ORDER BY RAND() LIMIT $limit");
}


/**
* Gets the question that corresponds to 
* the supplied id
*
* @param $id | int
*
* @return array | question
*
*/
function getQuestionById($id)
{

   return select("SELECT * FROM questions WHERE id = ".$id);

}


function getQuestionAlternatives($questionId)
{
  
  return  select("SELECT * FROM options WHERE question_id='$questionId' ORDER BY RAND()");
  
}

function getSolutions($questionId)
{
    /*return  select("SELECT solutions.*, options.* FROM solutions, options
                    WHERE solutions.question_id='$questionId' AND options.question_id='$questionId'
                    AND options.status=1");*/
  return select("SELECT * FROM solutions WHERE question_id ='$questionId'");
}

function getCorrectOptions($questionId)
{
   return select("SELECT * FROM options WHERE question_id ='$questionId' AND status=1");
}

function getTestQuestions($courseId, $limit) 
{
   $questions = [];
   $questionIds = getQuestionsId($courseId, $limit);

   foreach($questionIds as $key => $idArray)
    {

      $id = $idArray['id'];

       $questions[$key]['question'] = getQuestionById($id);
       $questions[$key]['alternatives'] = getQuestionAlternatives($id);
        
       
    }

    return $questions;

}


function formatQuestionsAsJson(array $questionsSet)
{
    $jsonQuestions = [];

    foreach($questionsSet as $set)
    {
        $questionId = $set['question'][0]['id'];
        $jsonQuestions[$questionId] = null;
    }

    return json_encode($jsonQuestions, true);

}


/**
* Stores test information to 
* the database for the first time.
*
* @param $jsonQuestions | string
*
* @return void
*
*/
function createTest($jsonQuestions)
{
  // date_default_timezone_set("UTC");
   
  $test_id   = "";
  $user_id   = $_SESSION['user_id'];
  $duration  = getSettings()[0]['duration'];
  $startedAt = date('Y-m-d H:i:s');

  $data = [
    'user_id' => $user_id,
    'started_at' => $startedAt,
    'json' => $jsonQuestions,
    'duration'=>$duration
  ];

  if(insert('test_info', $data))
  {
   return mysql_insert_id();
  }
    return false;
}


function resetTest($testId, $jsonQuestions)
{
    
  $startedAt = date('Y-m-d H:i:s');
  $sql = "UPDATE test_info SET json='$jsonQuestions', started_at=
           '$startedAt' WHERE test_id='$testId'";
   mysql_query($sql);
}



function getQuestionFromJson($testId)
{
  $data      = [];
  $questions = [];
  $optionId  = [];
  $solution  = [];

  $query = "SELECT * FROM `test_info` WHERE `test_id` = $testId";
  
   foreach(select($query) as $value)
   {
      $data[] = json_decode($value['json']);
   } 
  
      foreach($data as $key => $ids)
      {
           foreach ($ids as $key => $id) 
           {   
               $optionId[$key]= $id;
               $questions[$key]['question'] = getQuestionById($key);
               $questions[$key]['alternatives'] = getQuestionAlternatives($key);
               $questions[$key]['correctOption'] = getCorrectOptions($key);
               $questions[$key]['solution'] =getSolutions($key);
           }
          
      }
       return array($optionId, $questions);
  }


function getTestById($testId)
{
  return select("SELECT * FROM test_info WHERE test_id = {$testId}")[0];
}




function markTest($testId)
{
    $test = getTestById($testId); 

    $json = $test['json'];
    $jsonDecoded = json_decode($json);

    $options = [];
    $numQuestions = 0;
    foreach($jsonDecoded  as $key => $optionId)
    {
       $options[] = select("SELECT * FROM options WHERE id = '".$optionId."' AND question_id ='".$key."'");

       $numQuestions++;
    }
     
    $numCorrect = 0;
    foreach ($options as $value) {
      # code...
         foreach ($value as $response) {
             if( $response['status'] == 1)
             {
                $numCorrect ++;
             }

         }
    }
    $percent = ($numCorrect/$numQuestions)*100;
    $percent = intval($percent);
    return  array($numCorrect,  $numQuestions, $percent);
  
}




///////////////////////////////////////////////////////////

function getQuestion($test_id, $questionId)
{
  $data      = [];
  $question = [];
  $optionId  = [];

  $query = "SELECT * FROM `test_info` WHERE `test_id` = $test_id";
  
   foreach(select($query) as $value)
   {
      $data[] = json_decode($value['json']);
   } 
  
      foreach($data as $key => $ids)
      {
           foreach ($ids as $key => $id) 
           {   
               if($key == $questionId)
               {

                  $optionId[$key]= $id;
                  $question[$key]['question'] = getQuestionById($key);
                  $question[$key]['alternatives'] = getQuestionAlternatives($key);
               }
              
           }
          
      }
      //return $data;
       return array($optionId, $question);
  }




 function getJsonQuestionId($index)
 {
   $data = [];
   //$questionId = "";
   $test = getTestById($_SESSION['active_test_id']); 

    $testQuestion = $test['json'];
    $testQuestion = json_decode($testQuestion);
    foreach($testQuestion as $key => $id)
             {
              $data[] = $key;
             }

    return $data[$index];

 }

  //print_array(getQuestionId(4));die();

 function updateTestQuestion($testId)
  {


      $test = getTestById($testId);

      $testQuestions = json_decode($test['json']);

      $updatedTestQuestions = [];

      $skipFirst = true;

      foreach($testQuestions as $key => $value)
      {

           $updatedTestQuestions[$key] = null;

      }

      $updatedJson = json_encode($updatedTestQuestions, true);
      $sql = "UPDATE test_info SET json = '{$updatedJson}' WHERE test_id = {$testId}";
      if(mysql_query($sql))
      {
        return true;
      }
      return false;
  }


  
////////////////////////////////////////////////////////////////////////////////////////////
  function editQuestionId($courseId, $index)
  {
    $data = [];
     $questions= select("SELECT * FROM questions WHERE category_id ='$courseId'");
      
     foreach($questions as $key => $question)
     {
       $data[] = $question['id'];
     }
     
    return $data[$index];
  }

  function getEditQuestion($questionId)
  {
     return select("SELECT * FROM questions WHERE id ='{$questionId}'");
  }

  
  function getQuestionOptions($questionId)
{
  
  return  select("SELECT * FROM options WHERE question_id='$questionId'");
  
}

function deleteTest($index)
{
    $delTestId = numDecrypt($index);
     if(deleteRecord('test_info', 'test_id', $delTestId))
     {
        $sqlRun = mysql_query("UPDATE users SET tests_taken= tests_taken-1 WHERE id = '{$_SESSION['user_id']}'");
        if($sqlRun)
        {
           return true;
        }
     }
}

