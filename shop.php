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

echo isset($_POST["carbutton2"]);

//if car2 button has clicked open car2 image
if(isset($_POST["carbutton2"])){ 
    $status = 'error'; 
    if(!empty($_FILES["photos"]["name"])) { 
        // Get file info 
        $fileName = basename($_FILES["photos"]["name"]); 
        $fileType = pathinfo($fileName, PATHINFO_EXTENSION); 
         
        // Allow certain file formats 
        $allowTypes = array('jpg','png','jpeg','gif'); 
        if(in_array($fileType, $allowTypes)){ 
            $image = $_FILES['car2']['tmp_name']; 
            $imgContent = addslashes(file_get_contents($image)); 
         
            // Insert image content into database 
            $insert = $con->query("INSERT into voiture (id_voiture, image, created) VALUES ('2', '$imgContent', NOW())"); 
             
            if($insert){ 
                $status = 'success'; 
                $statusMsg = "File uploaded successfully."; 
            }else{ 
                $statusMsg = "File upload failed, please try again."; 
            }  
        }else{ 
            $statusMsg = 'Sorry, only JPG, JPEG, PNG, & GIF files are allowed to upload.'; 
        } 
    }else{ 
        $statusMsg = 'Please select an image file to upload.'; 
    } 
} 

echo $statusMsg;
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
    <div class="header-section-1"><a href="acceuil.php">Accueil</a></div>
    <div class="header-section-2"></div>
    <div class="header-section-3">SHOP</div>
    <div class="header-section-4"></div>
    <div class="header-section-5" id="header5">Pieces :<?= $row['pieces'] ?></div>
</div>
<!--car section-->
<div class="car-container">
    <a target="car-image">
        <img src="photos/car1.png" class="car-thumb" alt="car1">
        <button class="car-btn" id="carbutton1">Mario</button>
    </a>
</div>
<div class="car-container">
    <a target="car-image">
        <img src="photos/p1.jpg" class="car-thumb" id="p2" alt="p1"><? echo $_SESSION['image']?>
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
    <a target="car-image">
        <img src="photos/p1.jpg" class="car-thumb" alt="p1">
        <button class="car-btn" id="carbutton4">20 Pieces</button>
    </a>
</div>
<div class="car-container">
    <a target="car-image">
        <img src="photos/p1.jpg" class="car-thumb" alt="p1">
        <button class="car-btn" id="carbutton5">25 Pieces</button>
    </a>
</div>
<div class="car-container">
    <a target="car-image">
        <img src="photos/p1.jpg" class="car-thumb" alt="p1">
        <button class="car-btn" id="carbutton6">30 Pieces</button>
    </a>
</div>
<!----------- JavaScript -------------->
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
    //change img car1 to img car2
    imgcar2.src="photos/car2.jpg";

    const newPieceCount = piec - 3;
    document.getElementById("pie").value = newPieceCount;
    buttonCar2.textContent = `Ninja`;
    
    // Update the piece count in the database 
    document.getElementById("header5").textContent = `Pieces: ${newPieceCount}`;
    var newURL = `/fullstack/shop.php?newCount=${newPieceCount}`;
    history.replaceState(null, '', newURL);
}, {once: true});

</script>
</body>
</html>
