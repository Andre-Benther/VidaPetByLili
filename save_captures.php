<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "vidapet_db";

$conn = new mysqli($servername, $username, $password, $dbname);

// Verificação da conexão
if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

// Receber os dados da solicitação
$location = $_POST["location"];
$captureTime = $_POST["captureTime"];
$imageName = $_POST["imageName"]; // Adicionado

// Verificação e tratamento do arquivo de imagem
if (isset($_FILES['imageFile'])) {
    $uploadDir = __DIR__ . '/uploads/';
    $fileName = $_FILES['imageFile']['name'];
    $fileTmpPath = $_FILES['imageFile']['tmp_name'];
    $targetFilePath = $uploadDir . $fileName;

    // Mova o arquivo temporário para a pasta "uploads"
    move_uploaded_file($fileTmpPath, $targetFilePath);

    // Inserir os dados no banco de dados
    $sql = "INSERT INTO captures (image_path, image_name, location, capture_time) VALUES ('$targetFilePath', '$imageName', '$location', '$captureTime')"; // Atualizado

    if ($conn->query($sql) === TRUE) {
        echo "Captura salva com sucesso!";
    } else {
        echo "Erro ao salvar captura: " . $conn->error;
    }
} else {
    echo "Erro no upload do arquivo de imagem.";
}

$conn->close();
?>
