<?php
session_start();
include('dbconfig.php');

$email = isset($_POST['email']) ? htmlspecialchars($_POST['email']) : "";
$password = isset($_POST['password']) ? md5(htmlspecialchars($_POST['password'])) : "";

validateCredentials($email, $password);
if (isset($_SESSION['user'])) {
    header('Location: acceuil.php');
} else {
    header('Location: connexion.html');
}

function validateCredentials($email, $password)
{
    global $con;
    $req = "SELECT * FROM users WHERE email ='" . $email . "' AND password = '" . $password . "'";

    $result = mysqli_query($con, $req);
    $row = mysqli_fetch_assoc($result);

    $_SESSION['user'] = $row;
}

?>
