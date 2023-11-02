<?php
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS"); 
header("Access-Control-Allow-Headers: Content-Type, Authorization"); 

include('conection.php');



$sql = "SELECT * FROM filmes";
$result = $conn->query($sql);

$filmes = array();

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $filmes[] = $row;
    }
} else {
    $filmes['error'] = "Nenhum filme encontrado.";
}

echo json_encode($filmes);

$conn->close();
?>
