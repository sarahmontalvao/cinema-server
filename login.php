<?php
include('conection.php');

header("Access-Control-Allow-Origin: http://localhost:5173");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization, Cookie");
header("Access-Control-Allow-Credentials: true");



header("Content-Type: application/json"); 

if (isset($_POST['email']) && isset($_POST['password'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $verifica = "SELECT * FROM usuarios WHERE email = '$email'";
    $result = mysqli_query($conn, $verifica);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $bancoDeDados = $row['senha'];

        if (password_verify($password, $bancoDeDados)) {
            setcookie('auth', 'true', time() + 86400, '/');

            echo json_encode(array("message" => "Login realizado"));
        } else {
            echo json_encode(array("error" => "Senha incorreta. Por favor, tente novamente."));
        }
    } else {
        echo json_encode(array("error" => "Usuário não encontrado. Por favor, verifique seu e-mail e tente novamente."));
    }
} else {
    echo json_encode(array("error" => "Por favor, forneça um e-mail e uma senha."));
}
?>
