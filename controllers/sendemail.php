<?php

set_time_limit(300); // (5 minutos)

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

function sendemail($mail_ema, $mail_upa, $nommail, $mail_sfe, $mail_name, $file_path, $txt_mess, $mail_asun, $fir_mail, $template, $link_mail1, $link_mail2, $rut){

	require_once $rut.'vendor/phpmailer/phpmailer/src/Exception.php';
	require_once $rut.'vendor/phpmailer/phpmailer/src/PHPMailer.php';
	require_once $rut.'vendor/phpmailer/phpmailer/src/SMTP.php';


    $mail = new PHPMailer(true);
	try{
		$mail->isSMTP();
		$mail->Host = 'smtp.gmail.com';
		$mail->SMTPAuth = true;
		$mail->Username = $mail_ema;
		$mail->Password = $mail_upa;
		$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
		$mail->Port = 587;

	    // Remitente y destinatarios
		$mail->setFrom($mail_ema, $nommail);
		$mail->addAddress($mail_sfe);
	
	    // Cuerpo del correo
		$message = file_get_contents($template);
		$message = str_replace('{{first_name}}', $mail_name, $message);
		$message = str_replace('{{message}}', $txt_mess, $message);
		$message = str_replace('{{fir}}', $fir_mail, $message);
		$mail->addEmbeddedImage($rut.'img/firma.jpg', 'firma_cid');

		if($link_mail1 && $link_mail2){
			$message = str_replace('{{link1}}', $link_mail1, $message);
			$message = str_replace('{{link2}}', $link_mail2, $message);
		}

		$mail->isHTML(true);
		$mail->Subject = $mail_asun;

		$mail->CharSet = 'UTF-8';
		$mail->msgHTML($message);

		if ($file_path && file_exists($file_path)) $mail->addAttachment($file_path);

		// Intentar enviar el correo
		if (!$mail->send()) {
			// Si el correo no se pudo enviar, lanzamos una excepción
			throw new Exception('Error al enviar el correo: ' . $mail->ErrorInfo);
		}

		// Si todo va bien, retornar 1 para indicar éxito
		return 1;

	} catch (Exception $e){
		return 2;
	}
}
?>