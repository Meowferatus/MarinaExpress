<?php
session_start();

if (!isset($_SESSION['usuario'])) {
    header("Location: registro.php");
    exit();
}
include("../conexion.php");

$usuario = $_SESSION['usuario'];

$query = "SELECT * FROM reservas WHERE usuario = '$usuario' ORDER BY fecha_creacion DESC"; 
$result = mysqli_query($conex, $query);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mis Reservas</title>
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
        .table-container {
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            background-color: #fff;
            padding: 30px;
        }
        table {
            width: 100%;
            margin-bottom: 1rem;
            color: #212529;
            border-collapse: collapse;
        }
        th, td {
            padding: 0.75rem;
            vertical-align: top;
            border-top: 1px solid #dee2e6;
        }
        th {
            text-align: left;
            background-color: #f8f9fa;
        }
        tbody tr:hover {
            background-color: #f1f1f1;
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
<br><br>

<div class="container-fluid py-0">
        <div class="container py-2">
            <div class="text-center mb-3 pb-3">
                <div class="row justify-content-center">
                    <div class="col-lg-8">
                        <div class="table-container">
                            <h1 class="text-center">Mis Reservas</h1>
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>ID Reserva</th>
                                        <th>Fecha de Creación</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if (mysqli_num_rows($result) > 0) {
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            $id_reserva = $row['id'];
                                            $fecha_creacion = $row['fecha_creacion'];
                                            echo "<tr>";
                                            echo "<td>$id_reserva</td>";
                                            echo "<td>$fecha_creacion</td>";
                                            echo "<td><a href='codigo_qr.php?id=$id_reserva' class='btn btn-primary'>Ver código QR</a></td>";
                                            echo "</tr>";
                                        }
                                    } else {
                                        echo "<tr><td colspan='3' class='text-center'>No tienes reservas.</td></tr>";
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
