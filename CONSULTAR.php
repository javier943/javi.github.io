<?php

$servername = "localhost";  
$username = "root";         
$password = "";             
$dbname = "base_imc";         


$cn = new mysqli("localhost", "root", "", "base_imc");


if ($conn->connect_error) {
    die("La conexión ha fallado: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Consulta a la base de datos
    $sql = "SELECT * FROM plan_salud";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        // Mostrar los datos utilizando fetch_array
        while($row = $result->fetch_array(MYSQLI_ASSOC)) {
            echo "<p><strong>Nombre del plan:</strong> " . $row['nombre'] . "</p>";
            echo "<p><strong>Descripción:</strong> " . $row['descripcion'] . "</p>";
            echo "<p><strong>Precio:</strong> $" . $row['precio'] . "</p>";
            echo "<hr>";
        }
    } else {
        echo "No se encontraron resultados.";
    }
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consulta de Planes de Salud</title>
</head>
<body>
    <h1>Consulta de Planes de Salud</h1>
    
    <!-- Formulario para consultar -->
    <form method="POST">
        <button type="submit">Consultar</button>
    </form>
    
</body>
</html>
                                                                                         <