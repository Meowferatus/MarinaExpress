<?php
session_start();

if (!isset($_SESSION['usuario'])) {
    header("Location: registro.php"); 
}
include("../conexion.php");

$query = "SELECT * FROM reservas";
$where_clauses = [];
if (isset($_GET['usuario']) && !empty($_GET['usuario'])) {
    $usuario_filtro = mysqli_real_escape_string($conex, $_GET['usuario']);
    $where_clauses[] = "usuario = '$usuario_filtro'";
}
if (isset($_GET['email']) && !empty($_GET['email'])) {
    $email_filtro = mysqli_real_escape_string($conex, $_GET['email']);
    $where_clauses[] = "email = '$email_filtro'";
}
if (!empty($where_clauses)) {
    $query .= " WHERE " . implode(" OR ", $where_clauses);
}


$query .= " ORDER BY fecha_creacion DESC";

$result = mysqli_query($conex, $query);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Administrador - Reservas</title>
    <meta content="Free HTML Templates" name="keywords">
    <meta content="Free HTML Templates" name="description">

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
                        <?php
                        if (isset($_SESSION['usuario']) && isset($_SESSION['email'])) {
                            $usuario = $_SESSION['usuario'];
                            $email = $_SESSION['email'];
                        ?>
                        <div class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <?php echo $usuario[0]; ?> <!-- Muestra la inicial del nombre de usuario -->
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="registro.php">Cerrar Sesión</a>
                                <a class="dropdown-item" href="#">Ver Reservas</a>
                            </div>
                        </div>
                        <?php
                        } else {
                        ?>
                        <a href="registro.php" class="nav-item nav-link">Iniciar Sesión</a>
                        <?php
                        }
                        ?>
                    </div>
                </div> 
            </nav>
        </div>
    </div>
<!-- Navbar End -->


    <div class="container-fluid py-5">
        <div class="container py-5">
            <div class="text-center mb-3 pb-3">
                <h6 class="text-primary text-uppercase" style="letter-spacing: 5px;">admin</h6>
                <h1>Panel de Administrador - Reservas</h1>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="contact-form bg-white" style="padding: 30px;">
                    <!-- FORMULARIO DEL PANEL DE RESERVAS -->
                    <form action="" method="GET">
                        <div class="form-row">
                            <div class="control-group col-sm-6">
                                <!-- FILTRO POR USUARIO -->
                                <label for="usuario">Filtrar por usuario:</label>
                                <input class="form-control p-4" type="text" id="usuario" name="usuario" placeholder="Nombre de usuario">
                            </div>
                            <div class="control-group col-sm-6">
                                <label for="email">Filtrar por email:</label>
                                <input class="form-control p-4" type="text" id="email" name="email" placeholder="Email del usuario">
                            </div>
                            <div class="text-center py-2 px-1">
                                <button class="btn btn-primary py-2 px-5" type="submit">Filtrar</button>
                            </div>
                        </div>
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="container-fluid py-0">
        <div class="container py-2">
            <div class="text-center mb-3 pb-3">
                <div class="row justify-content-center">
                    <div class="col-lg-8">
                        <div class="contact-form bg-white p-4" style="padding: 30px;">
                            <table class="table table-bordered table-striped">
                                <thead class="thead-light">
                                    <tr>
                                        <th>ID Reserva</th>
                                        <th>Usuario</th>
                                        <th>Email</th>
                                        <th>Fecha de Creación</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if (mysqli_num_rows($result) > 0) {
                                        while ($row = mysqli_fetch_assoc($result)) {
                                            $id_reserva = $row['id'];
                                            $usuario = $row['usuario'];
                                            $email = $row['email'];
                                            $fecha_creacion = $row['fecha_creacion'];
                                            echo "<tr>";
                                            echo "<td>$id_reserva</td>";
                                            echo "<td>$usuario</td>";
                                            echo "<td>$email</td>";
                                            echo "<td>$fecha_creacion</td>";
                                            echo "<td><a href='codigo_qr.php?id=$id_reserva'>Ver código QR</a></td>";
                                            echo "</tr>";
                                        }
                                    } else {
                                        echo "<tr><td colspan='5'>No hay reservas que mostrar.</td></tr>";
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
