<!DOCTYPE html>
<html>
<head>
<title>Registration</title>
<style type="text/css">
	
  body{
    display: flex;
    justify-content: center;
    align-items: center;
    font-family: 'Roboto', sans-serif;
    background-image: url("photos/inscrip.jfif") ;
    background-size:100%;
}

form{
    margin-top: 10px;
    background-color: rgba(255, 255, 255, 0.409);
    padding: 10px 30px;
    border-radius: 25px;
    min-width: 300px;
}

form p.choose-email{
    text-align: center;
    color: white;
}

form .input{
    display: flex;
    flex-direction: column;
}

form .input input[type="email"], input[type ="password"]{
    padding: 10px;
    border-radius: 25px;
    border: none;
    background-color:white;
    margin-bottom: 0px;
    outline: none;
}

form p.header{
    font-size: 15px;
    margin-bottom: -10px;
    color:rgb(9, 8, 8);
}

form p.registre span{
    color: rgb(3, 3, 3);
    cursor: pointer;
}

form button{
    display: flex;
    justify-content: center;
    justify-items: center;
    padding: 10px 25px;
    border: none;
    border-radius: 10px;
    font-size: 15px;
    color: rgb(27, 30, 199);
    background-color:white;
     cursor: pointer;
}
.button input{
    width: 35%;
    padding: 10px 25px;
    background-color:rgb(27, 30, 199);
    color:white;
    font-size: 15px;
    border: none;
    border: radius 25px;
    display: flex;
    justify-content: center;
    justify-items: center;
    transition: all .4 ease-in;
    margin: auto;
    display: flex;
    cursor: pointer;
}

h2{
    
    display: flex;
    justify-content: center;
    justify-items: center;
    color:rgb(27, 30, 199);
    font-weight:bold;
    text-align: center;
    text-transform: uppercase;
    padding: -10px;     
}

input{
    width: 220px;
    padding: 10px 10px;
    outline: none;
    display: flex;
    border: none;
    border-radius: 20px;
    
}

header {
    max-width: 80%;
    margin-right: auto;
    margin-left: 100px;
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
</head>
<body>
  <form method="post" action="server.php">
  	<?php include('errors.php'); ?>
            <header>
                <nav>
                   <a href="index.html"><img src="photos/geo tracer-3.png" alt=""class="logo" srcset=""></a>
       
                </nav>
       
             </header>
  <div class="header">
  	<h2>Register</h2>

  	<div class="form1">
  	  <label>Username</label>
  	  <input type="text" name="username" value="<?php echo $username; ?>">
  	</div><br>
	  <div class="form1">
  	  <label>Name</label>
  	  <input type="text" name="name" value="<?php echo $name; ?>">
  	</div><br>
  	<div class="form1">
  	  <label>Email</label>
  	  <input type="email" name="email" value="<?php echo $email; ?>">
  	</div><br>
  	<div class="form1">
  	  <label>Pseudo</label>
  	  <input type="text" name="pseudo" value="<?php echo $pseudo; ?>">
  	</div><br>
	  <div class="form1">
  	  <label>Password</label>
  	  <input type="text" name="password" value="<?php echo $password; ?>">
  	</div><br>
  	<div class="form1">
  	  <button type="submit" class="btn" name="reg_user">Register</button>
  	</div>
  	<p>
  		Already a member? <a href="connexion.html">Sign in</a>
  	</p>
  </form>
</body>
</html>