<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Capturas</title>
</head>
<body>
    <h1>Lista de Capturas</h1>

    <?php
    // Faz a conexão com o banco de dados
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "vidapet_db";

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Verifica a conexão
    if ($conn->connect_error) {
        die("Conexão falhou: " . $conn->connect_error);
    }

    // Consulta para recuperar as capturas
    $sql = "SELECT * FROM captures";
    $result = $conn->query($sql);

    // Exibe as capturas em uma tabela
    if ($result->num_rows > 0) {
        echo "<table>";
        echo "<tr><th>ID</th><th>Imagem</th><th>Data/Hora</th><th>Localização</th></tr>";
        while ($row = $result->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row["id"] . "</td>";
            echo "<td><img src='/WebApp/uploads/" . $row["image_name"] . "' alt='Captura' width='100'></td>";
            echo "<td>" . $row["capture_time"] . "</td>";
            $latitude = substr($row["location"], 0, strpos($row["location"], ','));
            $longitude = substr($row["location"], strpos($row["location"], ',') + 2);
            $googleMapsLink = "https://www.google.com/maps/place/$latitude,$longitude";
            echo "<td>Localização: " . $row["location"] . " <a href='$googleMapsLink' target='_blank'>Ver no Google Maps</a></td>";
            echo "</tr>";
        }
        echo "</table>";
    } else {
        echo "Nenhuma captura encontrada.";
    }

    $conn->close();
    ?>
</body>
</html>
