<?php
try{
$servername = "127.0.0.1:8889"; //localhost at port 8889
$usernamesql = "root";
$passwordsql = "root";
$dbname = "geotracer";
$con = mysqli_connect($servername, $usernamesql ,$passwordsql ,$dbname);

//Check connection 
if(!$con)
{
   echo "Connect failed: " . mysql_connect_error();
}
echo "connected succesfully!";
}catch(Exception $e){
echo $e->getMessage();
}

?>