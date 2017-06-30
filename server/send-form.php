<?php
header('Content-Type: text/html; charset=UTF-8');
date_default_timezone_set("America/Mexico_City");
?>
<?php
	require 'phpmailer/PHPMailerAutoload.php';
	require 'phpmailer/class.phpmailer.php';
	require 'phpmailer/class.smtp.php';

	$name=$_POST['name'];
	$email=$_POST['email'];
	$phone=$_POST['phone'];
	$sucursal=$_POST['compañia'];
	$message=$_POST['message'];

	$template = file_get_contents('../mail.html');
	$template = str_replace('%name%', $name, $template);
	$template = str_replace('%email%', $email, $template);
	$template = str_replace('%phone%', $phone, $template);
	$template = str_replace('%sucursal%', $sucursal, $template);
	$template = str_replace('%message%', $message, $template);
	
	
		$mail = new PHPMailer;
		$mail->isSMTP();
		$mail->Host = 'smtp.gmail.com';
		$mail->SMTPAuth = true;
	
		$mail->Username = 'ventas@infriser.com';
		$mail->Password = 'Inser201700';
		$mail->Port = 587;
		$mail->SMTPSecure = 'tls';
		$mail->From = 'ventas@infriser.com';
		$mail->FromName = 'Infriser | Nuevo registro';
		$mail->addAddress('ventas@infriser.com'); 
		$mail->isHTML(true);
	    	$mail->CharSet = 'UTF-8';
		$mail->Subject = 'Nuevo registro'; 
		$mail->Body = $template;

	if(!$mail->Send()) {
		header('Location: ../failure.html');
		/*echo 'Mailer Error: ' . $mail->ErrorInfo;*/
	} else{
		header('Location: ../thankyou.html');
		$date = date("d-m-Y H:i:s");
		$sql = "INSERT INTO contacto_landing_ (`id`,`nombre`,`email`, `telefono`, `empresa`, `comentarios`, `created_at`) VALUES ('', '$name','$email','$phone', '$sucursal', '$message','$date');";
		$saveDB = mysqli_query($db, $sql);
	}
?>