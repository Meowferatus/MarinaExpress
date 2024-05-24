<!DOCTYPE html>
<html lang="es">
<?php
    session_start();

    if (!isset($_SESSION['usuario']) || !isset($_SESSION['email'])) {
        header("Location: registro.php");
        exit();
    }

    $usuario = $_SESSION['usuario'];
    $email = $_SESSION['email'];
?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulario de Tarjeta</title>
    <link rel="stylesheet" href="estilos.css">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/uuid/8.3.2/uuid.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
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
        .form-container {
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            background-color: #fff;
            padding: 30px;
        }
        .form-container h1 {
            margin-bottom: 20px;
        }
        .form-container input {
            margin-bottom: 15px;
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
                    <a href="../comprar_ticket.php" class="nav-item nav-link active">Atras</a>
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
                            <a class="dropdown-item" href="/pasajes/reservas_usuario.php">Ver Reservas</a>
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
<br><br>

<div class="container-fluid py-0">
        <div class="container py-2">
            <div class="text-center mb-3 pb-3">
                <div class="row justify-content-center">
                    <div class="col-lg-6">
                        <div class="form-container">
                            <h1>Formulario de Pago</h1>
                            <form id="paymentForm" action="#" method="post" autocomplete="off">
                                <div class="form-group">
                                    <label for="tarjeta"><strong>Número de tarjeta</strong></label>
                                    <input type="text" class="form-control" id="tarjeta" name="tarjeta" placeholder="XXXX XXXX XXXX XXXX" pattern="\d{4} \d{4} \d{4} \d{4}" maxlength="19" required>
                                </div>
                                <div class="form-group">
                                    <label for="vencimiento"><strong>Vencimiento</strong></label>
                                    <input type="text" class="form-control" id="vencimiento" name="vencimiento" placeholder="MM/AA" maxlength="5" pattern="\d{2}/\d{2}" required>
                                </div>
                                <div class="form-group">
                                    <label for="cvv"><strong>CVV</strong></label>
                                    <input type="text" class="form-control" id="cvv" name="cvv" placeholder="XXX" pattern="[0-9]{3}" maxlength="3" required>
                                </div>
                                <div class="form-group">
                                    <label for="nombre"><strong>Nombre del titular</strong></label>
                                    <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Ingrese su nombre" required>
                                </div>
                                <button type="submit" class="btn btn-primary py-2 px-4" id="QRcode">Pagar</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<script>
document.getElementById('tarjeta').addEventListener('input', function (e) {
    var target = e.target;
    var position = target.selectionStart;
    var value = target.value.replace(/\D/g, '').substring(0,16);
    var newValue = '';

    for (var i = 0; i < value.length; i++) {
        if (i > 0 && i % 4 === 0) {
            newValue += ' ';
            if (i <= position) position++;
        }
        newValue += value[i];
    }
    
    target.value = newValue;
    target.setSelectionRange(position, position);
});

document.getElementById('vencimiento').addEventListener('input', function (e) {
    var target = e.target;
    var value = target.value.replace(/\D/g, '').substring(0,4);
    var newValue = '';
    
    for (var i = 0; i < value.length; i++) {
        if (i == 2) {
            newValue += '/';
        }
        newValue += value[i];
    }
    
    target.value = newValue;
});

document.getElementById('cvv').addEventListener('input', function (e) {
    var target = e.target;
    target.value = target.value.replace(/\D/g, '');
});

document.getElementById('paymentForm').addEventListener('submit', function(event) {
    event.preventDefault(); 
    const token = uuid.v4();
    console.log('Token generado:', token);
    const xhr = new XMLHttpRequest();
    xhr.open('POST', 'guardar_qr.php', true);
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    xhr.onreadystatechange = function() {
        if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
                console.log('Código QR guardado en la base de datos.');
                alert('Código QR guardado en la base de datos.');
                window.location.href = 'confirmacion_pagos.html';
            } else {
                console.error('Error al guardar el código QR en la base de datos.');
            }
        }
    };
    xhr.send('token=' + encodeURIComponent(token) + '&usuario=' + encodeURIComponent('<?php echo $usuario; ?>'));

    // Generar el código QR
    const qrContainer = document.createElement('div');
    qrContainer.id = 'qrcode';

    new QRCode(qrContainer, {
        text: token,
        width: 128,
        height: 128,
    });

    // Crear el PDF del QR
    const qrCanvas = qrContainer.querySelector('canvas');
    const imgData = qrCanvas.toDataURL('image/png');
    const { jsPDF } = window.jspdf;
    const doc = new jsPDF();

    const usuario = "<?php echo $usuario; ?>";
    const email = "<?php echo $email; ?>";

    doc.setFontSize(18);
    doc.text('Pasaje de Abordaje', 10, 10);
    doc.setFontSize(12);
    doc.text('Fecha de Generación:', 10, 30);
    doc.text(new Date().toLocaleString(), 10, 40);
    doc.text('Usuario:', 10, 50);
    doc.text(usuario, 10, 60);
    doc.text('Correo Electrónico:', 10, 70);
    doc.text(email, 10, 80); 
    const pageWidth = doc.internal.pageSize.width;
    const qrImageWidth = 50;
    const qrXPosition = (pageWidth - qrImageWidth) / 2;

    doc.addImage(imgData, 'PNG', qrXPosition, 110, qrImageWidth, qrImageWidth);

    doc.save('Codigo_QR.pdf');
});
</script>


</body>
</html>