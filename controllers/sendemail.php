<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../vendor/phpmailer/phpmailer/src/Exception.php';
require '../vendor/phpmailer/phpmailer/src/PHPMailer.php';
require '../vendor/phpmailer/phpmailer/src/SMTP.php';

function sendemail($mail_ema, $mail_upa, $nommail, $mail_sfe, $mail_name, $file_path, $txt_mess, $mail_asun, $fir_mail, $template, $link_mail1, $link_mail2){

    $mail = new PHPMailer(true);
	$mail->isSMTP();
	$mail->Host = 'smtp.gmail.com';
	$mail->SMTPAuth = true;
	$mail->Username = $mail_ema;
	$mail->Password = $mail_upa;
	$mail->SMTPSecure = 'tls';
	$mail->Port = 587;


    // Remitente y destinatarios
	$mail->setFrom($mail_ema, $nommail);
	$mail->addAddress($mail_sfe);
    
    // Cuerpo del correo
	$message = file_get_contents($template);
	$message = str_replace('{{first_name}}', $mail_name, $message);
	$message = str_replace('{{message}}', $txt_mess, $message);
	$message = str_replace('{{fir}}', $fir_mail, $message);
	$mail->addEmbeddedImage('../img/firma.jpg', 'firma_cid');
	
	if($link_mail1 && $link_mail2){
		$message = str_replace('{{link1}}', $link_mail1, $message);
		$message = str_replace('{{link2}}', $link_mail2, $message);
	}

	$mail->isHTML(true);
	$mail->Subject = $mail_asun;

	$mail->CharSet = 'UTF-8';
	$mail->msgHTML($message);

	if ($file_path) {
        $mail->addAttachment($file_path);
    }

	if(!$mail->send()) {
		echo '<p style="color:red">No se pudo enviar el mensaje..';
		echo 'Error de correo: ' . $mail->ErrorInfo;
		echo "</p>";
	} else {
		echo '<p style="color:green">Tu mensaje ha sido enviado!</p>';
	}
}
?>