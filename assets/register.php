<?php
// Configuración de la conexión a la base de datos
$servername = "localhost";
$username = "root"; // Nombre de usuario de MySQL por defecto en XAMPP
$password = "12345"; // Contraseña de MySQL por defecto en XAMPP
$database = "jp_database"; // Nombre de la base de datos que has creado en MySQL

// Crear conexión
$conn = new mysqli($servername, $username, $password, $database);

// Verificar la conexión
if ($conn->connect_error) {
    die("La conexión falló: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Obtener los datos del formulario
    $nombre = $_POST["nombre"];
    $apellido = $_POST["apellido"];
    $email = $_POST["email"];
    $contraseña = $_POST["contraseña"];

    // Almacenamiento seguro de la contraseña
    $contraseña_hash = password_hash($contraseña, PASSWORD_DEFAULT);

    // Preparar la consulta SQL para insertar los datos en la tabla de admins
    $sql = "INSERT INTO admins (nombre, apellido, email, contraseña) VALUES ('$nombre', '$apellido', '$email', '$contraseña_hash')";
    if ($conn->query($sql) === TRUE) {
        echo "Registro exitoso";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Cerrar la conexión
$conn->close();
?>
