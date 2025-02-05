<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Consultar API</title>
</head>
<body>
    <h1>Consultar API</h1>
    <!-- Formulario para que el usuario ingrese 1, 2 o 3 -->
    <form method="post" action="">
        <label for="numero">Ingresa 1, 2 o 3:</label>
        <input type="text" id="numero" name="numero" required>
        <button type="submit" name="consultar">Consultar</button>
    </form>

    <?php
     // Verifica si se envió el formulario
    if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['numero'])) {
        // Obtiene y verifica el valor ingresado por el usuario
        $numero = trim($_POST['numero']);

        // Selecciona la API a consultar según el número ingresado
        switch ($numero) {
            case '1':
                // API 1: Book's
                $apiUrl = "https://fakerapi.it/api/v2/books?_quantity=1";
                break;
            case '2':
                // API 2: companies
                $apiUrl = "https://fakerapi.it/api/v2/companies?_quantity=1";
                break;
            case '3':
                // API 3: Ussers
                $apiUrl = "https://fakerapi.it/api/v2/users?_quantity=1&_gender=male";
                break;
            default:
                echo "<p style='color:red;'>Valor no válido. Ingresa 1, 2 o 3.</p>";
                exit();
        }

        // Inicializa cURL para realizar la conexión a la API
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $apiUrl);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        // Ejecuta la solicitud a la API
        $response = curl_exec($ch);

        // Verifica si ocurrió algún error durante la conexión
        if (curl_errno($ch)) {
            echo "<p>Error en la conexión a la API: " . curl_error($ch) . "</p>";
        } else {
            // Decodifica la respuesta JSON obtenida de la API
            $data = json_decode($response, true);

            // Muestra la respuesta de la API en pantalla
            echo "<h2>Respuesta de la API:</h2>";
            echo "<pre>" . print_r($data, true) . "</pre>";
        }

        // Cierra la conexión cURL
        curl_close($ch);
    }
    ?>
</body>
</html>
