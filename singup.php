<?php
include('conection.php');

header("Access-Control-Allow-Origin: http://localhost:5173");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization, Cookie");
header("Access-Control-Allow-Credentials: true");

header("Content-Type: application/json"); 

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_BCRYPT); 

  
    $verifica = "SELECT * FROM usuarios WHERE email = '$email'";
    $result = mysqli_query($conn, $verifica);

    if (mysqli_num_rows($result) > 0) {
        echo json_encode(array("error" => "Email já cadastrado. Por favor, use um email diferente."));
    } else {
        $stmt = $conn->prepare("INSERT INTO usuarios (nome, email, senha) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $nome, $email, $password); 

        if ($stmt->execute()) {
            echo json_encode(array("message" => "cadastro bem-sucedido!"));
            setcookie('auth', 'true', time() + 86400, '/');
        } else {
            echo json_encode(array("error" => "Por favor, preencha todos os campos."));
        }

        $stmt->close();
    }

    $conn->close();
}
?>

