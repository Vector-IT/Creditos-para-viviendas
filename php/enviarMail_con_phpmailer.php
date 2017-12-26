<?php
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\PHPMailer;

ini_set("log_errors", 1);
ini_set("error_log", "php-error.log");

if($_SERVER["REQUEST_METHOD"] == "POST") {

	require './vendor/autoload.php';

	$para = isset($_POST["Email"])? $_POST["Email"]: 'info@creditosparaviviendas.com';
	$titulo = isset($_POST["Titulo"])? $_POST["Titulo"]: 'Solicitud en Créditos para viviendas';

	$mensaje = $_POST['Mensaje'];

	$mensajeAlt = isset($_POST["MensajeAlt"])? $_POST["MensajeAlt"]: $_POST["Mensaje"];

	$mail = new PHPMailer();
	$mail->CharSet = 'UTF-8';
	$mail->isHTML(true);
	$mail->setLanguage('es', 'vendor/phpmailer/phpmailer/language/');

	$mail->isSMTP();
	$mail->SMTPAuth = true;
    $mail->SMTPAutoTLS = true;
	$mail->Port = 587;

	$mail->SMTPDebug = 2;
	$mail->Debugoutput = 'html';

	$mail->Host = 'c0340083.ferozo.com';
    $mail->Username = ' info@creditosparaviviendas.com';
    $mail->Password = 'Vector135';

	$mail->setFrom('info@creditosparaviviendas.com', 'Creditos para viviendas');
	$mail->addAddress($para);
	$mail->addBCC('defabricaofertas@gmail.com');
	$mail->Subject = $titulo;
	$mail->Body = $mensaje;
	$mail->AltBody = $mensajeAlt;

	$mail->SMTPOptions = array(
		'ssl' => array(
			'verify_peer' => false,
			'verify_peer_name' => false,
			'allow_self_signed' => true
		)
	);

	if (count($_FILES) > 0) {
		$mail->addAttachment($_FILES["Archivo"]["tmp_name"], $_FILES["Archivo"]["name"]);
	}

	if(!$mail->send()) {
		echo "Error al enviar datos!\n" . $mail->ErrorInfo;
	} else {
		echo "OK";
	}
}
else {
	header('HTTP/1.1 403 Forbidden');
	header('Status: 403 Forbidden');
}
?>
