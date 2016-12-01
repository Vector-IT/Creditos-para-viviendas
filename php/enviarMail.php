<?php
	if($_SERVER["REQUEST_METHOD"] == "POST") {
		$nombre = $_POST['Nombre'];
		$email = $_POST['Email'];
		$mensaje = $_POST['Mensaje'];
		
		$titulo = 'Solicitud en Créditos para viviendas';
		
		$header  = 'MIME-Version: 1.0' . "\r\n";
		$header.= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
		$header.= 'From: Creditos para viviendas <info@creditosparaviviendas.com>' . "\r\n";
		//$header.= 'Bcc: jmperro@gmail.com' . "\r\n";
		$header.= 'Bcc: defabricaofertas@gmail.com' . "\r\n";
		
		$msjCorreo = '<html><head><title>' . $titulo . '</title></head><body>';
		//$msjCorreo.= str_replace(array("á","é","í","ó","ú","ñ","Á","É","Í","Ó","Ú","Ñ"), array("&aacute;","&eacute;","&iacute;","&oacute;","&uacute;","&ntilde;","&Aacute;","&Eacute;","&Iacute;","&Oacute;","&Uacute;","&Ntilde;"), $mensaje);
		$msjCorreo.= $mensaje;
		$msjCorreo.= '</body></html>';

		if (mail($email, $titulo, $msjCorreo, $header)) {
			echo "OK";
		}
		else {
			echo "ERROR";
		}
			
/*		
		$para = $_POST['para'];
		$titulo = $_POST['asunto'];
		$mensaje = $_POST['mensaje'];
		
		if (isset($_POST['cco']))
			$cco = $_POST['cco'];
		
		require("phpmailer/PHPMailerAutoload.php");
		$mail = new PHPMailer;
		
		$mail->CharSet = 'UTF-8';
		$mail->setLanguage('es', 'language');
		$mail->isSMTP();                                      // Set mailer to use SMTP
		$mail->Host = 'server.iconntravel.com.mx';            // Specify main and backup server
		$mail->Port = 25;                                    //Set the SMTP port number - 587 for authenticated TLS
		$mail->SMTPAuth = true;                               // Enable SMTP authentication
		$mail->Username = 'consultasweb@iconntravel.com.mx';  // SMTP username
		$mail->Password = 'Vectorit23';               		  // SMTP password
		//$mail->SMTPSecure = 'tls';                            // Enable encryption, 'ssl' also accepted
		$mail->setFrom('consultasweb@iconntravel.com.mx', 'Iconn Travel');     //Set who the message is to be sent from
		$mail->addAddress($para);  // Add a recipient
		
		if (isset($cco))
			$mail->addBCC($cco);

		$mail->isHTML(true);                                  // Set email format to HTML
		
		$mail->Subject = $titulo;
		$mail->Body    = $mensaje;
		//$mail->AltBody = $mensaje;
		
		if($mail->send()) {
			echo "Exito";
		} 
		else {
			echo "Error";
		}
*/
	} 
	else {
		header('HTTP/1.1 403 Forbidden');
		header('Status: 403 Forbidden');
	}	
?>
