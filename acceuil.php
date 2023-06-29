<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <title>Acceuil</title>
    <style>
        *,*::before,*::after{
    margin: 0;
    padding: 0;
    box-sizing: 0;
    }

    body {
    font-family: 'Raleway', sans-serif;
    font-size: 14px;
    background-image: url("photos/Our\ Story.png");
    background-size: 105%;
    }
    
    .menu-tab {
            color: white;
            font-size: 20px;
    }
    
    h1{
    font-size: 40px;
    color:black;  
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

    h1{
    margin-top: 10px;
    text-align: center;
    justify-content: center;
    font-family:'Raleway', sans-serif;
    }

    .cartefr{
    width: 180px;
    margin-left: 120px;
    scroll-margin-top: 120px;
    cursor: pointer;
    }

    .carteesp{
    width: 180px;
    margin-left: 100px;
    margin-top: 80px;
    cursor: pointer;     
    }

    .carteuk{
    width: 150px;
    margin-left: 100px;
    margin-top: 80px;
    cursor: pointer;
    }

    .carteitalie{
    width: 200px;
    margin-left: 100px;
    margin-top: 80px;
    cursor: pointer;
    }

    div{
   justify-items: center;
   margin-left: 80px; 
    }
    </style>
</head>
<body>
<header>
    <nav>
        <a href="index.html"><img src="photos/LogoGEO.png" alt="" class="logo"> </a>
        <ul>

            <li><a href="acceuil.php">Accueil</a></li>
            <?php if (isset($_SESSION['user'])) { ?>
                <li class="menu-tab"><?= $_SESSION['user']['pseudo'] ?></li>
                <br>
                <li class="menu-tab"><a href="logout.php">Déconnexion</a></li>
                <li><a href="shop.php">Shop</a></li>
            <?php } else { ?>
                <li><a href="register.php">Mon compte</a></li>
                
            <?php } ?>

            <li><a href="apropos.html">A propos</a></li>
        </ul>

    </nav>
</header>
<section>
    <h1>GeoTracer <span class="auto-typing"></span></h1>

    <div>
        <a href="quiz.php"><img src="photos/france.png" alt="" class="cartefr"></a>
        <a href="quiz.php"><img src="photos/espagne.png" alt="" class="carteesp"></a>
        <a href="quiz.php"><img src="photos/uk.png" alt="" class="carteuk"></a>
        <a href="quiz.php"><img src="photos/italie.png" alt="" class="carteitalie"></a>
    </div>
</section>
<script src="https://cdn.jsdelivr.net/npm/typed.js@2.0.12"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var typed = new Typed('.auto-typing', {
            strings: ["Culture", "Loisir", "Voyage", "3 en 1"],
            typeSpeed: 100,
            backSpeed: 100,
            loop: true,
            fadeOut: true,
            fadeOutClass: 'typed-fade-out',
            fadeOutDelay: 500,
        });
    });
</script>
</body>

</html>
