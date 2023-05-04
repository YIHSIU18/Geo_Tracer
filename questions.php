<?php session_start(); ?>
<?php

class Quiz
{
    public function get_questions()
    {   
        $db = include_once('dbconfig.php');   
        $phrase = $_POST["question"];
        $servedQuestions = array();
        if(isset($phrase))
        {
             //Get randome quesiton number
             while(count($servedQuestions) <= 10)
            {
                $nb =mt_rand(1,10); 
                if(in_array($nb, $servedQuestions)) continue;

             //Get the total nb of questions 
                $query = mysqli_query($db,"SELECT * FROM questions WHERE id_questions ='".$nb."'");
                $servedQuestions[] = $nb;
                return mysqli_fetch_all($servedQuestions);
                
            }
            
        }

    }

    /*public function quiz_options()
    {   
        $db = include_once('dbconfig.php');   
        $option1 = $_POST["option1"];
        $option2 = $_POST["option2"];
        $option3 = $_POST["option3"];
       
        //connect to option 1
        $option1 = mysqli_query($db, "SELECT option1 FROM questions WHERE id_questions = 1");
        //connect to option 2
        $option2 = mysqli_query($db, "SELECT option2 FROM questions WHERE id_questions = 1");
        //connect to option 3
        $option3 = mysqli_query($db, "SELECT option3 FROM questions WHERE id_questions = 1");
    }*/
   
   
  

    
}

