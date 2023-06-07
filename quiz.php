<?php session_start(); ?>
<?php
 //Get questions
 include('dbconfig.php');
 $id = $_GET['id_questions'];
 echo($_POST['rep']);
 echo($_POST['formData']);

 // Check if 'formData.rep' is not empty and call the 'scoring' function
 if (!empty($_POST['formData'].rep)){
    scoring($_POST['rep']);
 }

// If 'id_questions' is empty, generate a random number between 1 and 10
// Issue!!! The number of id_question has duplicated with this loop!!!
if (empty($id)) {
    $sql = mysqli_query($con, "SELECT COUNT(id_questions) AS sentence FROM questions");
    $resultR = mysqli_fetch_assoc($sql);
    $totalQuestions = $resultR['sentence'];

    $id = rand(1, $totalQuestions);
}

// Fetch the question with the given 'id_questions'
 $question = "SELECT * FROM questions WHERE id_questions = '$id'";
 $result = mysqli_query($con,$question);
 $row = mysqli_fetch_assoc($result);

//Add score++
$score = isset($_POST['score']) ? $_POST['id_users'] : 0;

function scoring($value){
    global $score;
    echo($value);
    if($value == $row['reponses'])
    {
        $_SESSION['score'] += 1;
        $score += 1;
        $updateScore = $_POST['score'];
        $idUsers = $_POST['id_users'];
        $idUsers1 = substr($idUsers, 9);
        //connect server to add score
        $score = mysqli_real_escape_string($con, $updateScore);
        $idUsers1 = mysqli_real_escape_string($con, $idUsers);

        //insert into SQL query
        $query = "INSERT INTO 'users' ('id_users', 'score') VALUES ('$idUsers', '$score') ON DUPLICATE KEY UPDATE `score`='$scores'";
         echo $idUsers1;
        // Execute the SQL query
        $result = mysqli_query($con, $query);
        if ($result) 
        {
           echo "Score updated successfully.";
        } else 
        {
           echo "Error updating score: " . mysqli_error($con);
        }

    }
}

?>

<!DOCTYPE html>
<html lang="fr">
    <head>
        <title>Quiz</title>
        <meta charest="UTF-8">
        <!--
        <link rel="stylesheet" type="text/css" href="css/style.css">
        -->
        <style type="text/css">
            body {
                height: 100%;
                width:100%;
                margin:0;
                background: white;
                font-family: 'Josefin Sans', sans-serif;
                background-position: center center;
            }

            /*Styling the player*/
            .header-section{
             display: flex;
             flex-wrap: wrap;
            }
            /*Styling the section*/
            .header-section > div{
             width: calc(100% / 6);
             color: #000;
            }

            .header-section-1{
             text-align: center;
             font-size: 30px;
            }

            .header-section-2{
             text-align: left;
             font-size: 30px;
            }
            
            .header-section-5{
             text-align: center;
             font-size: 30px;
            }

            .header-section-6{
            text-align: center;
             font-size: 30px;
            }
            /*Styling the Quiz*/
            .section-quiz{
             position: absolute;
             margin-top: 6%;
             margin-left: 20%;
             box-shadow: 4px 4px 4px 1px #808080;
             -webkit-box-shadow: 4px 4px 4px 1px #808080;
             width: 900px;
             height: 60px;
             box-sizing: border-box;
            }
            .question{
             text-align: center;
            }
            #selection-a{
             position: absolute;
             left: 1%;   
             top:40%;
            }
            #selection-b{
             position: absolute;
             left: 36%; 
             top:40%;
            }
            #selection-c{
             position: absolute;
             left: 71%; 
             top:40%; 
            }
            /*Styling the road*/
            #container{
             width: 100%;
             height: 80vh;
             left: 50%;
             top:70%;
             background:grey;
             overflow: hidden;
             position: absolute;
             transform: translateX(-50%) translateY(-50%) rotate(-180deg);
            }

            .line{
                width: 10vw;
                height: 3vw;
                bottom: 43%;
                background: white;
                position: absolute;
                animation: moving 3s linear infinite 0.1s;
            }

            @keyframes moving
            {
                100%
                {
                    transform: translateX(-100vw);
                }

            }
            /*Style the lines of road*/
            #line-1{
             right:0%;
            }
            #line-2{
             right:23%;
            }
            #line-3{
             right:43%;
            }
            #line-4{
             right:63%;
            }
            #line-5{
             right:83%;
            }
            #line-6{
             right:103%;
            }
            /*Style the car*/
            img{
              width: 25%;
              height: auto;
              transform: translateX(-8%)translateY(100%) rotate(-180deg);
              position: absolute;
            } 
            /*Style answers*/
            .answer{
             width: 6%;
             height: 10vh;
             margin-left: 96%;
             bottom: 28%;
             background: pink;
             position: absolute;
             transform: translateX(-50%) rotate(-180deg);
             font-size: 60px;
            }
            
            #answer-a{
             top:80%;
            }

            #answer-b{
             top:45%;
            }

            #answer-c{
             top: 10%;
            } 
            
            .next-questionbutton
            {
             margin-left: 100%;
            }

           .next-question
           {
             margin-left: 100%;
           }
        </style>
        
    </head>
    <body>
        <link href="https://fonts.googleapis.com/css?family=Jo+Sans:400,600" rel="stylesheet">
        <!--Header section-->
        <form id="myForm" method="post"> <!-- add action?--> 
        <div class="header-section">
            <div class="header-section-1">Player</div>
            <div class="header-section-2"><a href="shop.php">SHOP</a></div>
            <div class="header-section-3"></div>
            <div class="header-section-4"></div>

            <div class="header-section-5">
                <span>Score :<?= $row['score'] ?></span>
                <span id="score"></span>
            </div>

            <div class="header-section-6">
                <span>Piece(s) :</span>
                <span id="Pieces">0</span>
            </div>
        </div>
        <!--Quiz section-->
        <div class="section-quiz">
            <div class="question" id="question" name="question"><?= $row['phrase']?></div>
            <div class="selection" id="selection-a" name="option1">(A)<?= $row['option1']?></div>
            <div class="selection" id="selection-b" name="option2">(B)<?= $row['option2']?></div>
            <div class="selection" id="selection-c" name="option3">(C)<?= $row['option3']?></div>
            <?php echo $row['id_questions']?>
            <?php 
               if ($id == $totalQuestions) {
                echo '<div class="next-question">Game Over!</div>';
                echo '<div class="country"><a href="acceuil.html">Play other game</a></div>';
                exit;
            } else {
                // Display the next question button
                echo '<form method="POST" action="quiz.php?id_questions='.($id+1).'">';
                echo '<input class="next-questionbutton" type="submit" value="Next Question">';
                echo '</form>';
            }
            ?>
        </div>
        <!--start to make the road-->
        <div class="container" id="container">
            <div class="line" id="line-1"></div>
            <div class="line" id="line-2"></div>
            <div class="line" id="line-3"></div>
            <div class="line" id="line-4"></div>
            <div class="line" id="line-5"></div>
            <div class="line" id="line-6"></div>
            <img src="photos/car1.png" class="carimg" id="carimg" alt="car" draggable="true" ondragstart="drag(event)" value="search">
            <div class="answer" id="answer-a" ondragover="allowDrop(event)" ondrop="drop('<?= $row['option1']?>')"><?= $row['option1']?'A':'hidden';?></div>
            <div class="answer" id="answer-b" ondragover="allowDrop(event)" ondrop="drop('<?= $row['option2']?>')"><?= $row['option2']?'B':'hidden';?></div>
            <div class="answer" id="answer-c" ondragover="allowDrop(event)" ondrop="drop('<?= $row['option3']?>')"><?= $row['option3']?'C':'hidden';?></div>
            <input type="hidden" id="rep" value="<?= $row['reponses'] ?>"></input>
        </div>
        </div>
        </form>
        <!--JavaScript-->
        <script type="text/javascript" src="carbutton.js"></script>
        <script>
            <?php include 'quiz.php'; ?>
               var value = "<?php echo $value; ?>";

        </script>
    </body>
</html>
  

    

