<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('Location: login.php');
    exit;
}

require_once('conexao.php');

$id = $_SESSION['id'];
$sql = "SELECT * FROM users WHERE id = '$id'";
$result = $conn->query($sql);
if ($result->num_rows == 1) {
    $user = $result->fetch_assoc();
    $nome = $user['firstName'];
    $sobrenome = $user['lastName'];
    $data_nascimento = $user['birthDate'];
    $cpf = $user['cpf'];
    $email = $user['email'];
}
?>

<!DOCTYPE html>
<html>
<head>
    <!-- Restante dos cabeçalhos -->
</head>
<body>
    <p>Bem-vindo, <?php echo $nome; ?>!</p>
    <p>Seus dados:</p>
    <p>Nome: <?php echo $nome; ?></p>
    <p>Sobrenome: <?php echo $sobrenome; ?></p>
    <p>Data de Nascimento: <?php echo $data_nascimento; ?></p>
    <p>CPF: <?php echo $cpf; ?></p>
    <p>Email: <?php echo $email; ?></p>
</body>
</html>
