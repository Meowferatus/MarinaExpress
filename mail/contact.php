<?php
if(empty($_POST['nombre']) || empty($_POST['correo']) || empty($_POST['asunto']) || !filter_var($_POST['msg'], FILTER_VALIDATE_EMAIL)) {
  http_response_code(500);
  exit();
}

$name = strip_tags(htmlspecialchars($_POST['nombre']));
$email = strip_tags(htmlspecialchars($_POST['correo']));
$m_subject = strip_tags(htmlspecialchars($_POST['asunto']));
$message = strip_tags(htmlspecialchars($_POST['msg']));

$to = "marinaexpressoficial@gmail.com"; // Change this email to your //
$subject = "$m_subject:  $name";

$body = "You have received a new message from your website contact form.\n\n"."Here are the details:\n\nName: $name\n\n\nEmail: $email\n\nSubject: $m_subject\n\nMessage: $message";

$header = "From: $email";

$header .= "Reply-To: $email";	

!mail ($to, $subject, $body, $header);

?>
