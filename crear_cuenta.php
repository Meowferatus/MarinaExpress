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
</head>


<body>
<!-- Registration Start -->
<div class="container-fluid bg-registration py-5">
            <div class="container py-5">
                <div class="row align-items-center">
                    <div class="col-lg-12">
                        <div class="card border-0">
                            <div class="card-header bg-primary text-center p-4">
                                <h1 class="text-white m-0">Crear nueva cuenta</h1>
                            </div>
                            <div class="card-body rounded-bottom bg-white p-5">
                                <form method="post">
                                <div class="form-group">
                                    <label for="usuario" class="form-label">Usuario:</label>
                                    <input type="text" class="form-control p-3" id="usuario" name="usuario" placeholder="Usuario"> 
                                </div>
                                    <div class="form-group">
                                        <label for="contraseña" class="form-label">Contraseña:</label>
                                        <input type="password" class="form-control p-3" id="contraseña" name="contraseña" placeholder="Contraseña">
                                    </div>
                                    <div class="form-group">
                                        <label for="email" class="form-label">Email:</label>
                                        <input type="text" class="form-control p-3" id="email" name="email" placeholder="Email">
                                        </div>
                                    <div>
                                        <br>
                                        <input class="btn btn-primary btn-block py-3" type="submit" class="btn" name="registrarse" value="Crear cuenta">
                                        <a href="registro.php" class="btn-block py-1">Para iniciar sesion dar click aqui</a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
<!-- Registration End -->


    <?PHP
        include ("validacion_registro.php");
    ?> 
</body>
</html>