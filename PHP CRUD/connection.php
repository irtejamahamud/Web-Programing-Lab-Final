<?php
$username = "root";
$password ="";
$database="personal_info";

$mysqli = new mysqli("localhost",$username,$password,$database);

if($mysqli->connect_error){
    die("connection failed!".$mysqli->connect_error);
}
?>