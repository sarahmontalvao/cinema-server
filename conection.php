<?php
header("Access-Control-Allow-Origin: *"); 
header("Content-Type: application/json"); 


$servername = "localhost";
$username = "root";
$password = "";
$database = "tickets";

$conn = new mysqli($servername, $username, $password, $database);


if ($conn->connect_error) {
    die("Erro na conexão: " . $conn->connect_error);
}
?>