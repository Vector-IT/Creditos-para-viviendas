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
	} 
	else {
		header('HTTP/1.1 403 Forbidden');
		header('Status: 403 Forbidden');
	}	
?>
