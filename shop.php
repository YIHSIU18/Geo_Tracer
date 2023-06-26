<?php session_start(); ?>
<?php
include('dbconfig.php');

$id_user = $_SESSION['user']['id_users'];
$sql = "SELECT * FROM users WHERE id_users = $id_user";
$row = mysqli_fetch_assoc(mysqli_query($con, $sql));

// Retrieve the new piece count from the GET request parameter
$newCount = !empty($_GET["newCount"]) ? htmlspecialchars($_GET["newCount"]) : null;

// Update the piece count in the database
$query = "UPDATE users SET pieces = $newCount WHERE id_users = $id_user"; 
$result = mysqli_query($con, $query);

// Check if the query executed successfully
if ($result) {
    // Send a success response back to the JavaScript code
    echo "success";
} else {
    // Send an error response back to the JavaScript code
    echo "error";
}

?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <title>Shop</title>
    <meta charest="UTF-8">
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
<!--Header section-->
<div class="header-section">
    <div class="header-section-1">Player</div>
    <div class="header-section-2">Game</div>
    <div class="header-section-3">SHOP</div>
    <div class="header-section-4"></div>
    <div class="header-section-5" id="header5">Pieces :<?= $row['pieces'] ?></div>
</div>
<!--car section-->
<div class="car-container">
    <a target="car-image" href="photos/car1.png">
        <img src="photos/car1.png" class="car-thumb" alt="car1">
        <button class="car-btn">Mario</button>
    </a>
</div>
<div class="car-container">
    <a target="car-image" href="photos/p1.jpg">
        <img src="photos/p1.jpg" class="car-thumb" id="p2" alt="p1">
        <button class="car-btn" id="carbutton2">3 Pieces</button>
        <input type="hidden" id="pie" value="<?= $row['pieces']?>"/>
    </a>
</div>
<div class="car-container">
    <a target="car-image" href="photos/p1.jpg">
        <img src="photos/p1.jpg" class="car-thumb" alt="p1">
        <button class="car-btn" id="carbutton3" >15 Pieces</button>
    </a>
</div>
<div class="car-container">
    <a target="car-image" href="photos/p1.jpg">
        <img src="photos/p1.jpg" class="car-thumb" alt="p1">
        <button class="car-btn" id="carbutton4">20 Pieces</button>
    </a>
</div>
<div class="car-container">
    <a target="car-image" href="photos/p1.jpg">
        <img src="photos/p1.jpg" class="car-thumb" alt="p1">
        <button class="car-btn" id="carbutton5">25 Pieces</button>
    </a>
</div>
<div class="car-container">
    <a target="car-image" href="photos/p1.jpg">
        <img src="photos/p1.jpg" class="car-thumb" alt="p1">
        <button class="car-btn" id="carbutton6">30 Pieces</button>
    </a>
</div>
<!----------- JavaScript -------------->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script>
const buttonCar2 = document.getElementById("carbutton2");
const buttonCar3 = document.getElementById("carbutton3");
const buttonCar4 = document.getElementById("carbutton4");
const buttonCar5 = document.getElementById("carbutton5");
const buttonCar6 = document.getElementById("carbutton6");
const imgcar2 = document.getElementById("p2");
buttonCar3.disabled = true;
buttonCar4.disabled = true;
buttonCar5.disabled = true;
buttonCar6.disabled = true;
var piec = parseInt(document.getElementById("pie").value);   

//disabled carbutton2 if pieces less than 3 points
if(piec < 3)
{
    buttonCar2.disabled = true;
}
else
{
    buttonCar2.disabled = false;
}

//button click to change photo and reduce 3 the piece 
buttonCar2.addEventListener("click", () =>
{
    //change img car1 -> car2
    imgcar2.src="photos/car2.jpg";

    const newPieceCount = piec - 3;
    document.getElementById("pie").value = newPieceCount;
    buttonCar2.textContent = `Luigi`;
    
    // Update the piece count in the database 
    document.getElementById("header5").textContent = `Pieces: ${newPieceCount}`;
    var newURL = `/fullstack/shop.php?newCount=${newPieceCount}`;
    history.replaceState(null, '', newURL);
}, {once: true});

//TODO let the photo car2 stays shown once it has opened
//TODO create a function that allow user to select a car to play in the game

</script>
</body>
</html>
