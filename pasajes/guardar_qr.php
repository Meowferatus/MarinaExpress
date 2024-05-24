<?php
session_start();
include("../conexion.php");

if (!isset($_SESSION['usuario'])) {
    http_response_code(403);
    echo "Usuario no autenticado";
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = $_SESSION['usuario'];
    $email = $_SESSION['email']; 
    $token = $_POST['token'];

    $token = mysqli_real_escape_string($conex, $token);
    $usuario = mysqli_real_escape_string($conex, $usuario);
    $email = mysqli_real_escape_string($conex, $email); 

    $query = "INSERT INTO reservas (codigo_qr, usuario, email) VALUES ('$token', '$usuario', '$email')"; 
    if (mysqli_query($conex, $query)) {
        echo "Código QR guardado exitosamente.";
    } else {
        echo "Error: " . mysqli_error($conex);
    }
} else {
    echo "Método de solicitud no permitido.";
}
?>
