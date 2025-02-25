<?php
$server = "localhost";
$username   = "root";
$password   = "";
$database   = "db_kedai_mungil";
$conn= new mysqli($server, $username, $password, $database);
if($conn->connect_error){
    die("Connection Gagal :". $conn->connect_error);
}
?>