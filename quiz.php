<?php session_start(); ?>
<?php
 //Get questions
 include('dbconfig.php');
 $id = $_GET['id_questions'];

 if(empty($id))
 {
    $sql = mysqli_query($con, "SELECT count(id_questions) AS sentence FROM questions");
    $resultR = mysqli_fetch_assoc($sql);
    $id = rand(1, $resultR['sentence']);
 }


 $question = "SELECT * FROM questions WHERE id_questions = '$id'";
 $result = mysqli_query($con,$question);
 $row = mysqli_fetch_assoc($result);

 //Repond
 /*if(repond est corr)
 {
    $score ++;
 }*/

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
             left: 10%;   
             top:50%;
            }
            #selection-b{
             position: absolute;
             left: 50%; 
             top:50%;
            }
            #selection-c{
             position: absolute;
             left: 85%; 
             top:50%; 
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
                width: 3%;
                height: 30vh;
                margin-left: 90%;
                bottom: 28%;
                background: white;
                position: absolute;
                transform: translateX(-50%) rotate(-90deg);
            }
            /*Style the lines of road*/
            #line-1{
             right:20%;
            }
            #line-2{
             right:43%;
            }
            #line-3{
             right:66%;
            }
            /*Style the car*/
            img{
              width: 25%;
              height: auto;
              transform: translateX(-8%)translateY(100%) rotate(-180deg);
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
        <form action="reponses.php" method="post">
        <div class="header-section">
            <div class="header-section-1">Player</div>
            <div class="header-section-2">SHOP</div>
            <div class="header-section-3"></div>
            <div class="header-section-4"></div>

            <div class="header-section-5">
                <span>Score :</span>
                <span id="score">0</span>
            </div>

            <div class="header-section-6">
                <span>Piece(s) :</span>
                <span id="Pieces">0</span>
            </div>
        </div>
        <!--Quiz section-->
        <div class="section-quiz">
            <div class="question" name="question"><?= $row['phrase']?></div>
            <div class="selection" id="selection-a" name="option1">(A)<?= $row['option1']?></div>
            <div class="selection" id="selection-b" name="option2">(B)<?= $row['option2']?></div>
            <div class="selection" id="selection-c" name="option3">(C)<?= $row['option3']?></div>
        </div>
        <!--start to make the road-->
        <div class="container" id="container">
            <div class="line" id="line-1"></div>
            <div class="line" id="line-2"></div>
            <div class="line" id="line-3"></div>
            <img src="photos/car1.png" class="carimg" alt="car">
            <div onmousemove="mouseMoveFunction()" class="answer" id="answer-a">A</div>
            <div onmousemove="mouseMoveFunction()" class="answer" id="answer-b">B</div>
            <div onmousemove="mouseMoveFunction()" class="answer" id="answer-c">C</div>
        </div>
        </form>
        <!--JavaScript-->
        <script type="text/javascript" src="carbutton.js"></script>
    </body>
</html>
  

    

