<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario Persona</title>
    <style>
       body {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    margin: 0;
    font-family: 'Helvetica Neue', sans-serif; /* Tipo de letra */
    background-color: #1E3A8A; /* Color de fondo azul oscuro */
}

.form-container {
    background-color: #F0F9FF; /* Color de fondo azul claro */
    padding: 40px;
    border-radius: 12px;
    box-shadow: 0px 8px 20px rgba(0, 0, 0, 0.15);
    width: 90%;
    max-width: 400px;
    text-align: center;
    border: 2px solid #3B82F6; /* Borde azul */
}

.form-container h2 {
    margin-bottom: 24px;
    color: #3B82F6; /* Color del encabezado azul */
    font-size: 24px;
    font-weight: bold; /* Negrita para el encabezado */
}

input[type="text"],
select {
    width: 100%;
    padding: 14px;
    margin: 12px 0;
    border: 1px solid #3B82F6; /* Color del borde azul */
    border-radius: 6px;
    box-sizing: border-box;
    transition: border-color 0.3s ease;
}

input[type="text"]:focus,
select:focus {
    border-color: #1D4ED8; /* Color al enfocar más intenso */
    outline: none;
}

input[type="submit"] {
    background-color: #3B82F6; 
    color: white;
    padding: 14px;
    border: none;
    border-radius: 6px;
    cursor: pointer;
    transition: background-color 0.3s ease, transform 0.2s ease;
    width: 100%;
    font-size: 16px;
}

input[type="submit"]:hover {
    background-color: #1D4ED8; /* Color más oscuro al pasar el ratón */
    transform: translateY(-2px);
}

input[type="submit"]:active {
    transform: translateY(0);
}

        
    </style>
</head>
<body>

    <div class="form-container">
        <h2>Formulario Persona</h2>
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $nombre = $_POST['nombre'];
            $apePa = $_POST['apellidoPaterno'];
            $apeMa = $_POST['apellidoMaterno'];
            $edad = $_POST['edad'];
            $sexo = $_POST['sexo'];

            $servername = "localhost";  
            $username = "root";   
            $password = ""; 
            $dbname = "base_imc";

            $conn = new mysqli($servername, $username, $password, $dbname);

            if ($conn->connect_error) {
                die("Conexión fallida: " . $conn->connect_error);
            }

            $sql = "INSERT INTO persona (id_nombre, ape_pa_nombre, ape_ma_nombre, edad, sexo) 
                    VALUES ('$nombre', '$apePa', '$apeMa', '$edad', '$sexo')";

            if ($conn->query($sql) === TRUE) {
                echo "<script>
                        alert('Datos guardados exitosamente');
                        window.location.href = 'test.php';
                      </script>";
            } else {
                echo "<script>alert('Error al guardar los datos');</script>";
            }

            $conn->close();
        }
        ?>

        <form method="POST" action="">
            <input type="text" id="nombre" name="nombre" placeholder="Nombre" required><br>
            <input type="text" id="apellidoPaterno" name="apellidoPaterno" placeholder="Apellido Paterno" required><br>
            <input type="text" id="apellidoMaterno" name="apellidoMaterno" placeholder="Apellido Materno" required><br>
            <input type="text" id="edad" name="edad" maxlength="2" placeholder="Edad" required><br>
            <select id="sexo" name="sexo" required>
                <option value="Masculino">Masculino</option>
                <option value="Femenino">Femenino</option>
            </select><br>
            <input type="submit" value="Enviar y seguir con el siguiente formulario">
        </form>
    </div>

    <script>
        function Validanum() {
            if (event.keyCode >= 48 && event.keyCode <= 57) {
                event.returnValue = true;
            } else {
                event.returnValue = false;
            }
        }

        function Validarlet() {
            if ((event.keyCode >= 97 && event.keyCode <= 122) || (event.keyCode >= 65 && event.keyCode <= 90)) {
                event.returnValue = true;
            } else {
                event.returnValue = false;
            }
        }
    </script>
</body>
</html>
