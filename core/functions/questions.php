<?php
 require_once '../init.php';



  if(isset($_POST['ok']))
  {
  	  $question      = escape($_POST['question']);
  	  $difficulty    = escape($_POST['difficulty']);
  	  $courseId      = escape($_POST['course']);
  	  $option1       = escape($_POST['option1']);
  	  $option2       = escape($_POST['option2']);
  	  $option3       = escape($_POST['option3']);
  	  $option4       = escape($_POST['option4']);
  	  $correct       = $_POST['correct'];

  	  
  	  $solution      = "";

  	 
  	  $options = array($option1, $option2, $option3, $option4);


  	  $correctOption = "";
      //determine the correct option indicated
  	  if($correct=="A")
  	  {
        $correctOption = 0;
  	  }
  	  elseif($correct == "B")
  	  {
  	  	$correctOption = 1;
  	  }
  	  elseif($correct == "C")
  	  {
  	  	$correctOption = 2;
  	  }
  	  elseif($correct == "D")
  	  {
  	  	$correctOption = 3;
  	  }
      

  	   // check if a solution is to be inclueded 
      if(isset($_POST['addsolution']))
      {
        $addSolution   = $_POST['addsolution'];
         if($addSolution == "yes")
          {
             $solution   = escape($_POST['solution']);
          }
      }
  	 
      
  	  
  	  /****** begin to insert data ******/

        // insert questions
  	   $questionInserted = insert( 'questions', 
            [
              'questions'=>$question,
              'difficulty'=>$difficulty,
              'category_id'=>$courseId
              
              ]);
  	    // grab question id for next level insertion
  	    if($questionInserted)
  	    {
  	    	$questionId = select("SELECT id FROM questions  ORDER BY id DESC LIMIT 1")[0];
          
           for($i=0; $i<=3; $i++)
           {
              if($correctOption == $i)
              {
                   $insertOptions = insert( 'options',
                  [
                     'question_id'=>$questionId['id'],
                     'option'=>$options[$i],
                     'status'=>1
                  ]); 
              }
                else
                {

                   $insertOptions = insert( 'options',
                  [
                     'question_id'=>$questionId['id'],
                     'option'=>$options[$i],
                     'status'=>0
                  ]); 
                }
           }
            
          
  	    	
          
          if(!empty($solution))
          {

             $insertSolution = insert( 'solutions',
              [
              'question_id'=>$questionId['id'],
              'solution'=>$solution
            ]);
          }
            

          
  	    	
  	    		/*if($insertOptions && $insertSolution) 
  	    		{*/
  	    			//echo "action successful";
              redirect('../../public/addquestions');
  	    		//}


  	    }
  	    else{
  	    	echo "no";
  	    }


  }

 
  if(isset($_POST['edit']))
  {
      $question      = escape($_POST['question']);
      $difficulty    = escape($_POST['difficulty']);
      $questionId    = escape($_POST['question_id']);
      //$courseId      = escape($_POST['course']);
      $option1       = escape($_POST['option1']);
      $option2       = escape($_POST['option2']);
      $option3       = escape($_POST['option3']);
      $option4       = escape($_POST['option4']);
      $option1_id    = escape($_POST['option1_id']);
      $option2_id    = escape($_POST['option2_id']);
      $option3_id    = escape($_POST['option3_id']);
      $option4_id    = escape($_POST['option4_id']);
      $correct       = $_POST['correct'];

      
      $solution      = "";

     
      $options = array($option1, $option2, $option3, $option4);
      $optionIds = array($option1_id, $option2_id, $option3_id, $option4_id);


      $correctOption = "";
      //determine the correct option indicated
      if($correct=="A")
      {
        $correctOption = 0;
      }
      elseif($correct == "B")
      {
        $correctOption = 1;
      }
      elseif($correct == "C")
      {
        $correctOption = 2;
      }
      elseif($correct == "D")
      {
        $correctOption = 3;
      }
      

       // check if a solution is to be inclueded 
      if(isset($_POST['addsolution']))
      {
        $addSolution   = $_POST['addsolution'];
         if($addSolution == "yes")
          {
             $solution   = escape($_POST['solution']);
          }
      }
     
      
      
      /****** begin update tables ******/

         //update questions table
         $sql1 = "UPDATE questions SET questions ='$question', difficulty='$difficulty' WHERE id ='$questionId'"; 
             
           for($i=0; $i<=3; $i++)
           {
              if($correctOption == $i)
              {
                  mysql_query("UPDATE options SET option ='".$options[$i]."', status=1 WHERE id = '".$optionIds[$i]."' AND question_id ='$questionId' ");
                  //$queryRun1 = mysql_query($sql2);
              }
                else
                {

                    mysql_query("UPDATE options SET option ='".$options[$i]."', status= 0 WHERE id = '".$optionIds[$i]."' AND question_id ='$questionId'");
                   //$queryRun2 = mysql_query($sql2);
                }
           }
            
          
          
          
          if(!empty($solution))
          {

             $soluExist  = select("SELECT * FROM solutions WHERE question_id = '$questionId'");
             if(count($soluExist)==1)
             {
                $sql3 = mysql_query("UPDATE solutions SET solution = '$solution' WHERE question_id = '$questionId'");
             }
             else{
                         $insertSolution = insert('solutions',
                            [
                            'question_id'=>$questionId,
                            'solution'=>$solution
                            ]);
              }
             
           
              
              
          }
            

          
          
            if((mysql_query($sql1)/*&&$queryRun1&&$queryRun2*/) || $sql3 || $insertSolution)
            {
              redirect('../../public/edit_questions');
            }
            else{
              echo "could not update tables";
            }


        }
       

   
   
   
?>