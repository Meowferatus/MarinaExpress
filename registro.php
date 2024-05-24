<!DOCTYPE html>
<html lang="es">

<head>
<meta charset="utf-8">
    <title>Marina Express</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
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
    <link href="css/style.css" rel="stylesheet">

    <style>
        .password-container {
            position: relative;
        }

        .password-container input {
            width: 100%;
            padding-right: 40px; /* Espacio para el ícono */
        }

        .password-container .toggle-password {
            position: absolute;
            top: 50%;
            right: 10px;
            transform: translateY(-50%);
            cursor: pointer;
        }
    </style>
</head>

<body>
<!-- Registration Start -->
<div class="container-fluid bg-registration py-5">
    <div class="container py-5">
        <div class="row align-items-center">
            <div class="col-lg-12">
                <div class="card border-0">
                    <div class="card-header bg-primary text-center p-4">
                        <h1 class="text-white m-0">Iniciar Sesion</h1>
                    </div>
                    <div class="card-body rounded-bottom bg-white p-5">
                        <form method="post">
                            <div class="form-group">
                                <label for="usuario" class="form-label">Usuario:</label>
                                <input type="text" class="form-control p-3" id="usuario" name="usuario" placeholder="Usuario"> 
                            </div>
                            <div class="form-group">
                                <label for="contraseña" class="form-label">Contraseña:</label>
                                <div class="password-container">
                                    <input type="password" class="form-control p-3" id="contraseña" name="contraseña" placeholder="Contraseña">
                                    <i class="fa fa-eye toggle-password"></i>
                                </div>
                            </div>
                            <br>
                            <div>
                                <input class="btn btn-primary btn-block py-3" type="submit" class="btn" name="ingresar" value="Ingresar">
                                <a href="crear_cuenta.php" class="btn btn-primary btn-block py-2">Crear nueva cuenta</a>
                                <a href="invitado.html" class="btn btn-primary btn-block py-2">Ingresar como invitado</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Registration End -->

<?php
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    include("conexion.php");

    $usuario = $_POST['usuario'];
    $contraseña = $_POST['contraseña'];

    $consulta = "SELECT * FROM registro_datos WHERE usuario='$usuario'";
    $resultado = mysqli_query($conex, $consulta);

    if (mysqli_num_rows($resultado) == 1) {
        $fila = mysqli_fetch_assoc($resultado);
        $contraseña_hash = $fila['contraseña'];

        if (password_verify($contraseña, $contraseña_hash)) {
            $_SESSION['usuario'] = $usuario;
            $_SESSION['email'] = $fila['email'];
            
            $rol = $fila["rol"];
            if($rol == "admin"){
                header("Location: index_admin.php");
            }else{
                header("Location: index.php");
            }
            exit();
        } else {
            echo "<script>alert('Usuario o contraseña incorrectos. Por favor, inténtalo de nuevo.');</script>";
        }
    } else {
        echo "<script>alert('Usuario o contraseña incorrectos. Por favor, inténtalo de nuevo.');</script>";
    }
}
?>

<script>
document.querySelector('.toggle-password').addEventListener('click', function () {
    var passwordField = document.getElementById('contraseña');
    var passwordFieldType = passwordField.getAttribute('type');
    if (passwordFieldType === 'password') {
        passwordField.setAttribute('type', 'text');
        this.classList.remove('fa-eye');
        this.classList.add('fa-eye-slash');
    } else {
        passwordField.setAttribute('type', 'password');
        this.classList.remove('fa-eye-slash');
        this.classList.add('fa-eye');
    }
});
</script>

</body>
</html>
