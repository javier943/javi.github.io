<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cuestionario de PDF</title>
    <style>
    body {
        font-family: Arial, sans-serif;
        background-color: #4CAF50; /* Fondo verde */
        margin: 20px;
        padding: 20px;
        border-radius: 8px;
        position: relative; 
    }

    form {
        max-width: 600px;
        margin: auto;
    }

    .fecha {
        width: 100%; /* Ancho completo para la fecha */
        background-color: #fff;
        border: 1px solid #ccc;
        border-radius: 5px;
        padding: 10px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        margin-bottom: 20px; /* Separar del formulario */
    }

    .pregunta {
        background-color: #fff;
        border: 1px solid #ccc;
        border-radius: 5px;
        padding: 15px;
        margin-bottom: 15px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        transition: background-color 0.3s ease;
    }

    .pregunta:hover {
        background-color: #eaeaea; 
    }

    input[type="submit"] {
        background-color: #5a8e3c; /* Color del botón */
        color: white;
        border: none;
        border-radius: 5px;
        padding: 10px 15px;
        cursor: pointer;
        font-size: 16px;
        transition: background-color 0.3s ease;
        width: 100%; /* Botón de ancho completo */
    }

    input[type="submit"]:hover {
        background-color: #4a7e31; /* Color del botón al pasar el mouse */
    }

    label {
        font-weight: bold; 
        display: block; 
        margin-bottom: 10px;
    }

    input[type="radio"] {
        margin-right: 5px; 
    }

    input[type="date"] {
        width: 100%;
        padding: 10px;
        margin: 5px 0;
        border: 1px solid #ccc;
        border-radius: 5px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }
</style>


    <script type="text/javascript">
        function calcularSuma() {
            let suma = 0; 
            let form = document.forms['cuestionario']; 

            for (let i = 0; i < form.elements.length; i++) {
                if (form.elements[i].type === "radio" && form.elements[i].checked) {
                    suma += parseInt(form.elements[i].value); 
                }
            }

            document.getElementsByName('suma')[0].value = suma;

            let mensaje = "";
            let clavep_plan_salud1 = "";

            if (suma === 29) {
                mensaje = "1, Buena, Tu Dieta es buena, asegurate de seguir con tu misma dieta saludable con frutas y verduras";
                clavep_plan_salud1 = "1"; 
            } else if (suma <= 18) {
                mensaje = "2, Normal, Tu Dieta es normal, pero puedes mejorarla comiendo más frutas y verduras y no exagerar con la comida";
                clavep_plan_salud1 = "2"; 
            } else {
                mensaje = "3, Mala, Cambiar dieta para evitar problemas de salud";
                clavep_plan_salud1 = "3"; 
            }

            document.getElementsByName('clavep_plan_salud1')[0].value = clavep_plan_salud1;
            alert(mensaje);
            return suma;
        }

        function enviarRespuestas(event) {
            event.preventDefault(); 
            let suma = calcularSuma(); 
            document.forms['cuestionario'].submit();
        }
    </script>
</head>
<body>
    <?php
$servername = "localhost";
$username = "root"; 
$password = ""; 
$dbname = "base_imc";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $fecha = $_POST['fecha'];
    $suma_respuestas = $_POST['suma'];
    $clavep_plan_salud1 = $_POST['clavep_plan_salud1'];  

    $sql = "INSERT INTO test (fecha, resultado, clavep_plan_salud1) VALUES ('$fecha', '$suma_respuestas', '$clavep_plan_salud1')";

    if ($conn->query($sql) === TRUE) {
        $last_id = $conn->insert_id;

        $updateSql = "UPDATE persona SET id_test1 = '$last_id' WHERE id_persona = (SELECT MAX(id_persona) FROM persona)";
        if ($conn->query($updateSql) === TRUE) {
            echo "<script>alert('Respuestas guardadas correctamente.');</script>";
            echo "<script>window.location.href='imc.php';</script>";
        } else {
            echo "<script>alert('Error al actualizar la tabla persona: " . $conn->error . "');</script>";
        }
    } else {
        echo "<script>alert('Error al guardar las respuestas: " . $conn->error . "');</script>";
    }

    $conn->close();
}
?>


    <form name="cuestionario" method="POST" action="" onsubmit="enviarRespuestas(event);">
        <div class="fecha">
            <label for="fecha">Fecha:</label>
            <input type="date" id="fecha" name="fecha" required>
        </div>

        <div class="pregunta">
            <label>1.- ¿Cuántas comidas haces al día?</label>
            <input type="radio" name="rd_resp1" value="4"> Suelo tener 3 comidas principales y dos tentempiés entre horas <br>
            <input type="radio" name="rd_resp1" value="3"> Suelo tener 3 comidas principales y un tentempié a media mañana o a media tarde <br>
            <input type="radio" name="rd_resp1" value="1"> Suelo hacer 3 comidas principales <br>
        </div>

        <div class="pregunta">
            <label>2.- ¿Desayunas antes de ir al colegio o al instituto?</label>
            <input type="radio" name="rd_resp2" value="1"> No desayuno casi nunca <br>
            <input type="radio" name="rd_resp2" value="2"> Desayuno poco <br>
            <input type="radio" name="rd_resp2" value="4"> Hago un buen desayuno <br>
        </div>

        <div class="pregunta">
            <label>3.- ¿Cuántas raciones de frutas y verduras tomas al día?</label>
            <input type="radio" name="rd_resp3" value="1"> Entre 0 y 1 ración <br>
            <input type="radio" name="rd_resp3" value="2"> Entre 2 y 3 raciones <br>
            <input type="radio" name="rd_resp3" value="4"> 5 o más raciones <br>
        </div>

        <div class="pregunta">
            <label>4.- ¿Cuántas veces a la semana comes bollería industrial/comida rápida/chucherías?</label>
            <input type="radio" name="rd_resp4" value="4"> Nunca o casi nunca<br>
            <input type="radio" name="rd_resp4" value="2"> 1-2 veces a la semana <br>
            <input type="radio" name="rd_resp4" value="1"> Más de dos veces a la semana <br>
        </div>

        <div class="pregunta">
            <label>5.- ¿Cuánto caminas o corres al día?</label>
            <input type="radio" name="rd_resp5" value="1"> Menos de 1 hora<br>
            <input type="radio" name="rd_resp5" value="3"> Entre 1 hora y 3 horas <br>
            <input type="radio" name="rd_resp5" value="4"> Más de 3 horas <br>
        </div>

        <div class="pregunta">
            <label>6.- ¿Cuántas horas dedicas a hacer deporte a la semana?</label>
            <input type="radio" name="rd_resp6" value="1"> Menos de 1 hora<br>
            <input type="radio" name="rd_resp6" value="3"> Entre 1 hora y 3 horas <br>
            <input type="radio" name="rd_resp6" value="4"> Más de 3 horas <br>
        </div>

        <div class="pregunta">
            <label>7.- ¿Cuántas horas dedicas a realizar alguna actividad física que te distrae o te relaja a la semana?</label>
            <input type="radio" name="rd_resp7" value="1"> Menos de 1 hora<br>
            <input type="radio" name="rd_resp7" value="3"> Entre 1 hora y 3 horas <br>
            <input type="radio" name="rd_resp7" value="4"> Más de 3 horas <br>
        </div>

        <div class="pregunta">
            <label>8.- ¿Cuántas veces te duchas a la semana?</label>
            <input type="radio" name="rd_resp8" value="1"> Menos de 3 veces<br>
            <input type="radio" name="rd_resp8" value="2"> Entre 3 y 5 veces <br>
            <input type="radio" name="rd_resp8" value="4"> Más de 5 veces <br>
        </div>

        <div class="pregunta">
            <label>9.- ¿Cuántas horas duermes al día?</label>
            <input type="radio" name="rd_resp9" value="1"> Menos de 6 horas<br>
            <input type="radio" name="rd_resp9" value="3"> Entre 6 y 8 horas <br>
            <input type="radio" name="rd_resp9" value="4"> Más de 8 horas <br>
        </div>

        <div class="pregunta">
            <label>10.- ¿Has tenido problemas de salud en los últimos meses?</label>
            <input type="radio" name="rd_resp10" value="4"> No <br>
            <input type="radio" name="rd_resp10" value="2"> Uno <br>
            <input type="radio" name="rd_resp10" value="1"> Más de uno <br>
        </div>

        <input type="hidden" name="suma" value="">
        <input type="hidden" name="clavep_plan_salud1" value="">
        <input type="submit" value="Enviar respuestas">
    </form>
</body>
</html>
