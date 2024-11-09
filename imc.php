<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
    <title>Calculadora IMC</title> 
    <style>
       body {
    font-family: 'Verdana', sans-serif;
    background-color: #4A90E2; /* Color de fondo azul */
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    margin: 0;
}

.container {
    background-color: #FFFFFF; /* Color de fondo blanco */
    padding: 30px;
    border-radius: 12px;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
    text-align: left; /* Alineación a la izquierda */
    width: 400px; /* Ancho fijo */
}

input {
    margin: 15px 0; /* Espaciado aumentado */
    padding: 12px;
    width: calc(100% - 24px); /* Ajuste para el padding */
    border: 2px solid #3498DB; /* Borde azul */
    border-radius: 6px;
}

button {
    padding: 12px 25px;
    background-color: #E74C3C; /* Color de fondo rojo */
    color: white;
    border: none;
    border-radius: 6px;
    cursor: pointer;
    transition: background-color 0.3s, transform 0.2s; /* Transiciones adicionales */
}

button:hover {
    background-color: #C0392B; /* Color de fondo rojo más oscuro */
    transform: scale(1.05); /* Efecto de aumento al pasar el mouse */
}

    </style>
</head>
<body>
    <div class="container">
        <h1>Calculadora IMC</h1>
        <form action="fin.php" method="POST">
            <input type="number" name="altura" id="altura" placeholder="Altura en cm" step="0.01" required>
            <input type="number" name="peso" id="peso" placeholder="Peso en kg" step="0.01" required>
            <button type="submit">Enviar datos de mi IMC</button>
        </form>
    </div>
</body>
</html>
