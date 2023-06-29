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
    if (empty($_SESSION['scoreFrance'])) {
        $_SESSION['scoreFrance'] = 0;
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
        $_SESSION['scoreFrance'] += 1;
    }
}

//save score in DB
function save_score($con)
{
    $score = $_SESSION['scoreFrance'];
    $sql = "UPDATE users SET score_france = $score, pieces = pieces + $score WHERE id_users =" . $_SESSION['user']['id_users'];
    mysqli_query($con, $sql);
}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
<title>Quiz</title>
<meta charest="UTF-8">
<style type="text/css">
body {
    height: 100%;
    width:100%;
    margin:0;
    background: white;
    font-family: 'Josefin Sans', sans-serif;
    background-position: center center;
 }
/*Styling the Quiz*/
.section-quiz {
text-align: center;
}

.question {
  font-size: 24px;
  margin-bottom: 20px;
}

.selection-row {
  display: flex;
  justify-content: center;
  margin-bottom: 10px;
}

.selection {
  display: inline-block;
  margin: 0 10px;
  padding: 10px;
  background-color: #f1f1f1;
  border-radius: 5px;
  cursor: pointer;
  transition: background-color 0.3s ease;
}

.selection:hover {
  background-color: gold;
}

/*Styling the road*/
#container {
    width: 100%;
    height: 70vh;
    left: 50%;
    top: 70%;
    background:grey;
    overflow: hidden;
    position: absolute;
    transform: translateX(-50%) translateY(-50%) rotate(-180deg);
}

.line {
    width: 10vw;
    height: 3vw;
    bottom: 43%;
    background: white;
    position: absolute;
    animation: moving 5s linear infinite;
}

@keyframes moving {
    0% {
      right: 0%;
    }
    100% {
      right: 100%;
    }
}

/* Style des lignes de la route */
#line-1 {
 animation-delay: 1s;
}

#line-2 {
 animation-delay: 2s;
}

#line-3 {
 animation-delay: 3s;
}

#line-4 {
 animation-delay: 4s;
}

#line-5 {
 animation-delay: 5s;
}

#line-6 {
 animation-delay: 5s;
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
background: red;
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

nav {
display:flex;
flex-wrap: wrap;
margin-top: 10px;
align-items: center;
width: 100%;
padding: 5px 0 5px;
background-color: rgb(22, 77, 144); 
}

nav .logo {
    width: 60px;
    border-radius: 20PX;
    margin-left:10px ;
}
nav .menu-icon {
    width: 60px;
    cursor: pointer;
    margin-right: 10px;
}
nav ul {
    flex: 1;
    display: flex;
    justify-content: flex-end;
    padding-right: 40px;
}

nav ul li{
    list-style: none;
    margin-left: 20px;
}

nav ul li a {
    text-decoration: none;
    color: rgb(255, 255, 255);
    font-size: 1.2rem;
    transition: color .3s;
}

nav ul li a:hover {
    color:rgb(12, 169, 104);

}

.aide{
display: flex;
justify-content: center;
align-items: center;
font-size: 30px;
color: red;
}

.score {
display: flex;
align-items: center;
justify-content: center;
background-color: #f2f2f2;
padding: 10px;
border-radius: 5px;
font-size: 24px;
font-weight: bold;
color: red;
}

.score span {
margin-right: 10px;
}

.game-over {
display: flex;
flex-direction: column;
align-items: center;
justify-content: center;
height: 100vh;
background-color: #f44336;
color: white;
font-family: Arial, sans-serif;
font-size: 24px;
text-align: center;
}

.fin {
font-size: 36px;
font-weight: bold;
margin-bottom: 20px;
text-transform: uppercase;
}

.score_fin {
font-size: 28px;
margin-bottom: 30px;
}

.play-again a {
color: white;
text-decoration: none;
background-color: #4CAF50;
padding: 12px 30px;
border-radius: 4px;
transition: background-color 0.3s;
font-size: 20px;
font-weight: bold;
}

.play-again a:hover {
background-color: #45a049;
}
        
</style>
</head>
<body>
<!--Header section-->
<header>
    <nav>
        <ul>
            <li><a href="acceuil.php">Accueil</a></li> 
            <li><a href="connexion.html">Mon compte</a></li>
            <li><a href="shop.php">Shop</a></li>
            <li><a href="apropos.html">A propos</a></li>    
        </ul>   
    </nav>
        <div class="score">
            <span>Score : <?php echo $_SESSION['scoreFrance'] ?> / <?php echo count($_SESSION['answeredQuestions']) ?></span>
        </div>
</header>
<link href="https://fonts.googleapis.com/css?family=Jo+Sans:400,600" rel="stylesheet">
<?php if (count($_SESSION['answeredQuestions']) < 10) { ?>
    <form id="myForm" method="post">
        <!--Quiz section-->
        <div class="section-quiz">
            <div class="question" id="question"><?= $question['phrase'] ?></div>
            <div class="selection" id="selection-a">(A)<?= $question['option1'] ?></div>
            <div class="selection" id="selection-b">(B)<?= $question['option2'] ?></div>
            <div class="selection" id="selection-c">(C)<?= $question['option3'] ?></div>    
        </div>
        <p class="aide">Conduisez votre voiture jusqu'à la bonne réponse</p>
        <!--Road section-->
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
    <div class="game-over">
    <div class="fin">Fin de jeu !</div>
    <div class="score_fin">Votre score : <?= $_SESSION['scoreFrance'] ?></div>
    <div class="play-again"><a href="acceuil.php">Jouer à un autre jeu</a></div>
    </div>
    <?php
} ?>
<!--JavaScript-->
<script type="text/javascript" src="carbutton.js"></script>
</body>
</html>
