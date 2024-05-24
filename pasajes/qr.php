<!DOCTYPE html>
<html lang="es">
<?php
session_start();

if (!isset($_SESSION['usuario']) || !isset($_SESSION['email'])) {
    header("Location: ../registro.php");
    exit();
}
?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Generador de QR</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/uuid/8.3.2/uuid.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
</head>
<body>
    <h1>Generador de Código QR</h1>
    <button id="QRcode">Generar QR</button>
    <button id="qrpdfcode" style="display:none;">Descargar como PDF</button>
    <div id="qrcode"></div>

    <script src="guardar_qr.js"></script>
</body>
</html>
