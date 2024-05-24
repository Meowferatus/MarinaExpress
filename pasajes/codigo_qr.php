<?php
if (!isset($_GET['id'])) {
    header("Location: index.php");
    exit();
}

include("../conexion.php");

$id_reserva = $_GET['id'];
$query = "SELECT * FROM reservas WHERE id = $id_reserva";
$result = mysqli_query($conex, $query);
if (mysqli_num_rows($result) == 0) {
    header("Location: index.php");
    exit();
}
$row = mysqli_fetch_assoc($result);
$token = $row['codigo_qr'];
$fecha_creacion = $row['fecha_creacion'];
$usuario = $row['usuario']; 
$email= $row['email'];
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detalles del Código QR</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet"> 

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />

    <!-- Customized Bootstrap Stylesheet -->
    <link href="../css/style.css" rel="stylesheet">

    <style>
        .contact-form {
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            background-color: #fff;
        }
        .contact-form p {
            margin-bottom: 0.5rem;
        }
        #qrcode {
            padding: 10px;
            background: #f8f9fa;
            border: 1px solid #dee2e6;
            border-radius: 10px;
            margin-top: 10px;
        }
        .btn-back {
            margin-top: 20px;
            display: inline-block;
        }
    </style>
</head>
<body>
<!-- Navbar Start -->
<div class="container-fluid position-relative nav-bar p-0">
        <div class="container-lg position-relative p-0 px-lg-3" style="z-index: 9;">
            <nav class="navbar navbar-expand-lg bg-light navbar-light shadow-lg py-3 py-lg-0 pl-3 pl-lg-5">
                <a href="" class="navbar-brand">
                    <h1 class="m-0 text-primary"><span class="text-dark">MARINA</span>EXPRESS</h1>
                </a>
                <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-between px-3" id="navbarCollapse">
                    <div class="navbar-nav ml-auto py-0">
                        <a href="../index.php" class="nav-item nav-link active">Inicio</a>
                        <a href="../sobre_nosotros.php" class="nav-item nav-link">Sobre Nosotros</a>
                        <a href="../comprar_ticket.php" class="nav-item nav-link">Comprar Ticket</a>
                        <a href="../contactanos.php" class="nav-item nav-link">Contactanos</a>
                    </div>
                </div> 
            </nav>
        </div>
    </div>
<!-- Navbar End -->
<br>

    <div class="container-fluid py-0">
        <div class="container py-2">
            <div class="text-center mb-3 pb-3">
                <div class="row justify-content-center">
                    <div class="col-lg-8">
                        <div class="contact-form p-4">
                            <h1 class="text-center">Detalles del Código QR</h1>
                            <p class="text-left"><strong>ID de Reserva:</strong> <?php echo $id_reserva; ?></p>

                            <p class="text-left"><strong>Usuario:</strong> <?php echo $usuario; ?></p>

                            <p class="text-left"><strong>Email:</strong> <?php echo $email; ?></p> 

                            <p class="text-left"><strong>Fecha de Creación:</strong> <?php echo $fecha_creacion; ?></p>
                            <br>
                            <p class="text-left"><strong>Código QR:</strong></p>
                            <div id="qrcode" class="text-left"></div>
                            <a class="btn btn-primary btn-back" href="reservas_usuario.php">Volver a Mis Reservas</a>

                            <script>
                                var qrCode = new QRCode(document.getElementById("qrcode"), {
                                    text: "<?php echo $token; ?>",
                                    width: 200,
                                    height: 200
                                });
                            </script>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
