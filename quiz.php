<?php session_start(); ?>
<?php
//Get questions
include('dbconfig.php');
$response = !empty($_GET["response"]) ? htmlspecialchars($_GET["response"]) : null;
$idQuestion = !empty($_GET["idQuestion"]) ? htmlspecialchars($_GET["idQuestion"]) : null;

initVars();
if (!empty($response) && !empty($idQuestion) && !in_array($idQuestion, $_SESSION['answeredQuestions'])) {
    array_push($_SESSION['answeredQuestions'], $idQuestion);
    scoring($response, $idQuestion, $con);
}
if (count($_SESSION['answeredQuestions']) < 10) {

    $notAnsweredQuestions = getQuestions($con, $_SESSION['answeredQuestions']);
    $currentIdQuestion = getCurrentIdQuestion($notAnsweredQuestions);

    $question = findQuestion($notAnsweredQuestions, $currentIdQuestion);
} else {
    save_score($con);
}

function findQuestion(mysqli_result $notAnsweredQuestions, int $currentIdQuestion)
{
    foreach ($notAnsweredQuestions as $question) {
        if ($question['id_questions'] == $currentIdQuestion) {
            return $question;
        }
    }
}

function getCurrentIdQuestion($notAnsweredQuestions)
{
    if (empty($chosenIdQuestion)) {
        $chosenIndex = rand(1, mysqli_num_rows($notAnsweredQuestions));
        $row = mysqli_fetch_assoc($notAnsweredQuestions);
        $i = 1;
        while ($i < $chosenIndex) {
            $row = mysqli_fetch_assoc($notAnsweredQuestions);
            $i++;
        }
        $chosenIdQuestion = $row['id_questions'];
    }
    return $chosenIdQuestion;
}

function getQuestions($con, $answeredQuestions)
{
    $questions = !empty($answeredQuestions) ? "SELECT * FROM questions where id_questions NOT IN(" . implode(',', $answeredQuestions) . ")" : "SELECT * FROM questions";
    return mysqli_query($con, $questions);
}

function initVars()
{
    if (empty($_SESSION['score'])) {
        $_SESSION['score'] = 0;
    }
    if (empty($_SESSION['answeredQuestions'])) {
        $_SESSION['answeredQuestions'] = array();
    }
}

function scoring($response, $idQuestion, $con)
{
    $goodAnswer = "SELECT * FROM questions where id_questions = " . $idQuestion;
    $row = mysqli_fetch_assoc(mysqli_query($con, $goodAnswer));

    if ($response == $row['reponses']) {
        $_SESSION['score'] += 1;
    }
}

//TODO save score in DB
function save_score($con)
{
    $score = $_SESSION['score'];
    //$id_user = $_SESSION['id_user'];
    $id_user = 9;
    $sql = "UPDATE users SET score = $score WHERE id_users = $id_user";
    mysqli_query($con, $sql);
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
   
        </style>
        
    </head>
    <body>
        <link href="https://fonts.googleapis.com/css?family=Jo+Sans:400,600" rel="stylesheet">
        <!--Header section-->
<?php if (count($_SESSION['answeredQuestions']) < 10) { ?>
<form id="myForm" method="post"> <!-- add action?-->
        <div class="header-section">
            <div class="header-section-1">Player</div>
            <div class="header-section-2"><a href="shop.php">SHOP</a></div>
            <div class="header-section-3"></div>
            <div class="header-section-4"></div>

            <div class="header-section-5">
                <span>Score : <?php echo $_SESSION['score'] ?> / <?php echo count($_SESSION['answeredQuestions']) ?></span>
            </div>

            <div class="header-section-6"></div>
        </div>
        <!--Quiz section-->
        <div class="section-quiz">
            <div class="question" id="question"><?= $question['phrase'] ?></div>
            <div class="selection" id="selection-a">(A)<?= $question['option1'] ?></div>
            <div class="selection" id="selection-b">(B)<?= $question['option2'] ?></div>
            <div class="selection" id="selection-c">(C)<?= $question['option3'] ?></div>
            <?php echo $question['id_questions'] ?>
        </div>
        <!--start to make the road-->
        <div class="container" id="container">
            <div class="line" id="line-1"></div>
            <div class="line" id="line-2"></div>
            <div class="line" id="line-3"></div>
            <div class="line" id="line-4"></div>
            <div class="line" id="line-5"></div>
            <div class="line" id="line-6"></div>
            <img src="photos/car1.png" class="carimg" id="carimg" alt="car" draggable="true" ondragstart="drag(event)">
            <div class="answer" id="answer-a" ondragover="allowDrop(event)"
                 ondrop="drop('<?= $question['option1'] ?>', <?= $currentIdQuestion ?>)"><?= $question['option1'] ? 'A' : 'hidden'; ?></div>
            <div class="answer" id="answer-b" ondragover="allowDrop(event)"
                 ondrop="drop('<?= $question['option2'] ?>', <?= $currentIdQuestion ?>)"><?= $question['option2'] ? 'B' : 'hidden'; ?></div>
            <div class="answer" id="answer-c" ondragover="allowDrop(event)"
                 ondrop="drop('<?= $question['option3'] ?>', <?= $currentIdQuestion ?>)"><?= $question['option3'] ? 'C' : 'hidden'; ?></div>
            <input type="hidden" id="rep" value="<?= $question['reponses'] ?>"/>
        </div>
</form>
<?php } else { ?>

        <div>Game Over!</div>
        <div>Votre score : <?= $_SESSION['score'] ?></div>
        <div class="country"><a href="acceuil.html">Play other game</a></div>
<?php
} ?>
<!--JavaScript-->
<script type="text/javascript" src="carbutton.js"></script>
</body>
</html>
