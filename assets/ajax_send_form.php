<?php
include('../phpmailer/PHPMailer.php');


$ld_cbox__mail_ajax = strip_tags($_GET['ld_cbox__mail_ajax']);

if($ld_cbox__mail_ajax == "mailmeta") {

	function sendMail($to, $subject, $text, $att){
		
		$css = '
		<html>
		<head>
		<style>
		.styled-table {
		border-collapse: collapse;
		margin: 25px 0;
		font-size: 0.9em;
		font-family: sans-serif;
		min-width: 400px;
		box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);
		}

		.styled-table thead tr {
			background-color: #009879;
			color: #ffffff;
			text-align: left;
		}


		.styled-table th,
		.styled-table td {
			padding: 12px 15px;
		}


		.styled-table tbody tr {
			border-bottom: 1px solid #dddddd;
		}

		.styled-table tbody tr:nth-of-type(even) {
			background-color: #f3f3f3;
		}

		.styled-table tbody tr:last-of-type {
			border-bottom: 2px solid #009879;
		}


		.styled-table tbody tr.active-row {
			font-weight: bold;
			color: #009879;
		}
		</style>
		</head>
		<body>
		';
		
		
		$text = $css.''.$text.'</body></html>';
		
		
		$mail = new PHPMailer;

		$mail->IsSMTP();                                      // Set mailer to use SMTP
		$mail->Host = 'poczta23190.e-kei.pl';                 // Specify main and backup server
		$mail->Port = 465;                                    // Set the SMTP port
		$mail->SMTPAuth = true;                               // Enable SMTP authentication
		$mail->Username = 'noreply@flotamenago.pl';           // SMTP username
		$mail->Password = 'Flota123#';                  	  // SMTP password
		$mail->SMTPSecure = 'ssl';                            // Enable encryption, 'ssl' also accepted

		$mail->From = 'noreply@flotamenago.pl';
		$mail->FromName = 'System';
		$mail->AddAddress($to);  							  // Add a recipient

		$mail->IsHTML(true);                                  // Set email format to HTML

		$mail->Subject = $subject;
		$mail->Body    = $text;
		$mail->AltBody = $text;
		$mail->CharSet = "UTF-8";
		
		if($att !== '')
			$mail->addAttachment("upload/".$att);

		if(!$mail->Send()) {
		echo 'Message could not be sent.';
		echo 'Mailer Error: ' . $mail->ErrorInfo;
		} 
	}




	$ld_mail__ajax = strip_tags($_GET['ld_mail__ajax']);
	$to  = $ld_mail__ajax; 

	$subject = "Formularz na stronie"; 

	$message = ' <p>Name: '. $_POST["u-name"] .'</p> </br> <p>Tel: '. $_POST["tel"] .'</p> </br> <p>KODP: '. $_POST["kodp"] .'</p> </br> <p>Date: '. $_POST["date"] .'</p> </br> <p>Nazwa produktu: '. $_GET['prodName'] .'</p> </br> <p>Cena: '. $_GET['cena'] .'</p> </br> <p>Dodatek: '. $_GET['dodat'] .'</p> </br> <p>Kominek: '. $_GET['kominek'] .'</p>';


	sendMail($to, $subject, $message, ""); 


}

$ld_cbox__tel_ajax = strip_tags($_GET['ld_cbox__tel_ajax']);

if($ld_cbox__tel_ajax == "telmeta") {


	function sendMailtell($to, $subject, $text){
		
		
		$mail = new PHPMailer;

		$mail->IsSMTP();                                      // Set mailer to use SMTP
		$mail->Host = 'poczta23190.e-kei.pl';                 // Specify main and backup server
		$mail->Port = 465;                                    // Set the SMTP port
		$mail->SMTPAuth = true;                               // Enable SMTP authentication
		$mail->Username = 'noreply@flotamenago.pl';           // SMTP username
		$mail->Password = 'Flota123#';                  	  // SMTP password
		$mail->SMTPSecure = 'ssl';                            // Enable encryption, 'ssl' also accepted

		$mail->From = 'noreply@flotamenago.pl';
		$mail->FromName = 'System';
		$mail->AddAddress($to);  							  // Add a recipient

		$mail->IsHTML(false);                                  // Set email format to HTML

		$mail->Subject = $subject;
		$mail->Body    = $text;
		//$mail->AltBody = $text;
		$mail->CharSet = "UTF-8";
		


		if(!$mail->Send()) {
		echo 'Message could not be sent.';
		echo 'Mailer Error: ' . $mail->ErrorInfo;
		} 
	}



		$ld_tel__ajax = strip_tags($_GET['ld_tel__ajax']);
		$ld_tel__user_ajax = strip_tags($_GET['ld_tel__user_ajax']);
		$ld_tel__api_ajax = strip_tags($_GET['ld_tel__api_ajax']);
		$ld_tel__sender_ajax = strip_tags($_GET['ld_tel__sender_ajax']);


		$to  = "sms.do@smsapi.pl"; 

		$subject = $ld_tel__user_ajax .'@' . $ld_tel__api_ajax; 

		$message = 'from='. $ld_tel__sender_ajax .'&to='. $ld_tel__ajax .'&message='.trim(strip_tags('Imie: '. $_POST["u-name"] .' Tel: '. $_POST["tel"] .' Kod pocztowy: '. $_POST["kodp"] .' Data dostawy: '. $_POST["date"].' Nazwa produktu: '. $_GET["prodName"].' Cena: '. $_GET['cena'].' Dodatek: '. $_GET['dodat'].' Kominek: '. $_GET['kominek']));

		sendMailtell($to, $subject, $message); 
}




// HTML
$cena = strip_tags($_GET['cena']);
?><p><big>Cena produktu z dostawą: <b><?php echo $cena; ?> PLN</b> </big></p><hr/><p><b>UWAGA! Jest to cena orientacyjna obliczana automatycznie.<br/>Jeśli jesteś zainteresowany naszym produktem - prosimy o kontakt telefoniczny.</b></p>
</p>
<?php
?>