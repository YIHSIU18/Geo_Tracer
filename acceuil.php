<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="acceuil.css">
    <title>Acceuil</title>
</head>
<style>
    *,*::before,*::after{
    margin: 0;
    padding: 0;
    box-sizing: 0;
}
body {
    font-family: 'Raleway', sans-serif;
    font-size: 14px;
    background-color: aliceblue;
    background-size: cover;
    
    
    


}
h1{
    font-size: 40px;
    color: rgb(23, 109, 185);
    
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
   margin-left: 20px;
   
    
}

</style>
<body>
    <header>
    <!--<?php
        session_start();
        if(!isset($_SESSION["sess_user"])){
             header("location:login.php");
        } else {
        ?>-->
        <nav>
            <a href="#"><img src="photos/geo tracer-3.png" alt=""class="logo"> </a>
            <ul>
                
                <li><a href="#">Acceuil</a></li> 
                <li><?= $_SESSION['sess_user'] ?></li>
                <li><a href="#">Shop</a></li>
                
                <li><a href="#">A propos</a></li>    
            </ul>
            
        </nav>
    </header>
    <section>
        <h1>J'explore le monde avec mon Geo-Tracer<span class="auto-typing"></span></h1>
        <div> 
            <a href="#"><img src="photos/france.png" alt=""class="cartefr"></a>
            <a href="#"><img src="photos/espagne.png" alt=""class="carteesp"></a>
            <a href="#"><img src="photos/uk.png" alt=""class="carteuk"></a>
            <a href="#"><img src="photos/italie.png" alt=""class="carteitalie"></a>
        </div>
    </section>
    <script src="https://cdn.jsdelivr.net/npm/typed.js@2.0.12"></script>  
    <!--<script>
        let typed =new typed('.auto-typing',{
            strings:["Culture","Loisir","Voyage","3 en 1"],
            typespeed: 100,
            backspeed:100,
            loop:true,
            fadeout:true,
            fadeOutClass:'typed-fade-out',
            fadeOutDelay:500,
        })

    </script>-->
</body>

</html>

<!--<?php
}
?>-->