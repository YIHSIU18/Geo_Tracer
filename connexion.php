<?php
session_start();
include('dbconfig.php');

//initializing variables
$password = "";
$email = "";
$errors= array();

//se connecter
if(isset($_POST['connect_user']))
{

    $email = mysqli_real_escape_string($con, $_POST['email']);
    $password = mysqli_real_escape_string($con, $_POST['password']);

    //check if email and password aren't empty
    if(empty($email))
    {
        array_push($errors, "Email est nécessaire");
    } 

    if(empty($password))
    {
        array_push($errors, "Mot de passe est nécessaire");
    }

    if(isset($_POST['email']) && isset($_POST['password']))
    {
        function validate($data)
        {
            //removes whitespace and other predefined characters from both sides of a string
            $data = trim($data);

            $data = stripslashes($data);
     
            $data = htmlspecialchars($data);
     
            return $data;
        }
    }

}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <style>
     @import url('https://fonts.googleapis.com/css2? family=Raleway:ital@1&display=swap');

body{
    display: flex;
    justify-content: center;
     align-items: center;
     font-family: 'Raleway', sans-serif;
     
    background-image: url("photos/inscrip.jfif") ;
    background-size: 90%;
    
    

}
form{
    margin-top: 20px;
    background-color:rgba(255, 255, 255, 0.429);
    padding: 70px 50px;
    border-radius: 10px;
    min-width: 50px;
    
}
form h1{
    color: rgb(27, 30, 199);
    text-align:center;
   text-shadow: 20px;
    
   
}



form p.choose-email{
    text-align: center;
    color: black;

}
form .input{
    display: flex;
    flex-direction: column;

}
form .input input[type="email"], input[type ="password"]{
    padding: 10px;
    border-radius: 10px;
    border: none;
    background-color:white;
    margin-bottom: 10px;
    outline: none;

}
form p.inscription{
    font-size: 14px;
    margin-bottom: 20px;
    color:rgb(0, 0, 0);
}
form p.inscription span{
    color:rgb(4, 0, 255);
    cursor: pointer;
    
}
form button{
    padding: 10px 25px;
    border: none;
    border-radius: 10px;
    font-size: 15px;
    color:white;
    background-color:rgb(27, 30, 199);
    cursor: pointer;
    transition: color 3s;
    
    
}


header {
    max-width: 80%;
    margin-right: auto;
    margin-left: 90px;


}
nav{
    display: flex;
    flex-wrap: wrap;
    align-items: center;
    width: 100%;
    padding: 20px 0 10px;
    justify-items: center;

}
nav .logo{
    width: 90px;
    border-radius: 15px;
}
</style>
       
<body>
    <form method="POST" action="">
    <?php include('errors.php'); ?>
        <header>
            <nav>
               <a href="index.html"><img src="photos/geo tracer-3.png" alt=""class="logo" srcset=""></a>
            </nav>
         </header>
        <h1>Se Connecter</h1>    
        </div>
        <p class="choose-email"> utilisez votre adresse e-mail</p>
        <div class="input">
            <input type="email" placeholder="exemple.xx@gmail.com" value="<?php echo $email; ?>">
            <input type="password" placeholder="Mot de passe" value="<?php echo $password; ?>">
        </div>
        <p class="inscription "> Vous n'avez pas de compte?<a href="http://localhost:8888/fullstack/register.php">inscrivez-vous</a></p>  
        <div align="center">
            <button type="submit" name="connect_user">Se connecter</button>       
        </div>
    </form>   
</body>
</html>
