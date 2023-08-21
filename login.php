<?php
session_start();
require_once('conexao.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $senha = $_POST['password'];

    $sql = "SELECT * FROM users WHERE email = '$email'";
    $result = $conn->query($sql);

    if ($result->num_rows == 1) {
        $user = $result->fetch_assoc();
        if (password_verify($senha, $user['password'])) {
            $_SESSION['loggedin'] = true;
            $_SESSION['id'] = $user['id'];
            header('Location: dashboard.php');
            exit;
        } else {
            $mensagem = "Email ou senha inválidos";
        }
    } else {
        $mensagem = "Email ou senha inválidos";
    }
}
?>

<!-- Seu HTML para o formulário de login -->
<!DOCTYPE html>
<html>
<head>
    <!-- Restante dos cabeçalhos -->
</head>
<body>
    <!-- Restante do corpo do HTML -->
</body>
</html>
