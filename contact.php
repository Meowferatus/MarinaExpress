<?php

if(isset($_POST["enviar"])) {
    if(!empty($_POST['nombre']) && !empty($_POST['asunto']) && !empty($_POST['correo']) && !empty($_POST['msg'])) {
    $name = $_POST['nombre'];
    $email = $_POST['correo'];
    $m_subject = $_POST['asunto'];
    $message = $_POST['msg'];

    $header = "From: $email" . "\r\n";
    $header.= "Reply-To: $email" . "\r\n";
    $header.= "X-Mailer: PHP/". phpversion();

    $to = "jm102760@gmail.com"; // Change this email to your //
    $subject = "$m_subject:  $name";

    $body = "You have received a new message from your website contact form.\n\n"."Here are the details:\n\nName: $name\n\n\nEmail: $email\n\nSubject: $m_subject\n\nMessage: $message";

    $mail = @mail($to, $email, $m_subject, $message, $header);

    if($mail) {
        echo "<h4>Mensaje enviado exitosamente</h4>";
    }
    }
}


?>