<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Faz a conexão com o banco de dados
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "vidapet_db";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Erro na conexão com o banco de dados: " . $conn->connect_error);
    }

    $firstName = $_POST["firstName"];
    $lastName = $_POST["lastName"];
    $birthDate = $_POST["birthDate"];
    $cpf = $_POST["cpf"];
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Você deve implementar a lógica de inserção de dados no banco de dados aqui
    // Por exemplo:
    $query = "INSERT INTO users (firstName, lastName, birthDate, cpf, email, password) 
              VALUES ('$firstName', '$lastName', '$birthDate', '$cpf', '$email', '$password')";

    if ($conn->query($query) === TRUE) {
        $success_message = "Cadastro realizado com sucesso!";
    } else {
        $error_message = "Erro ao cadastrar: " . $conn->error;
    }

    $conn->close();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Cadastro</title>
</head>
<body>
    <h2>Cadastro</h2>
    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <!-- Campos de cadastro aqui -->
        <div>
            <!-- ... (campos de cadastro) ... -->
        </div>
        <div>
            <button type="submit">Cadastrar</button>
        </div>
        <?php if (isset($success_message)) { ?>
            <p><?php echo $success_message; ?></p>
        <?php } ?>
        <?php if (isset($error_message)) { ?>
            <p><?php echo $error_message; ?></p>
        <?php } ?>
    </form>
</body>
</html>
