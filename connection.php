<?php
$host="localhost";
$user="root";
$pass="";
$db="project";

$con=mysqli_connect($host,$user,$pass,$db);

if ($con) {
echo "";
}
else {
    echo "db not connected";
}


?>