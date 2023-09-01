<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
	$name = trim($_POST["name"]);
	$email = trim($_POST["email"]);
	$message = trim($_POST["message"]);
	$reason = trim($_POST["reason"]);

	if ($name == "" OR $email == "" OR $message == "") {
		echo "Debes escribir un correo y un mensaje";
		exit;
	}

	foreach ($_POST as $value) {
		if (stripos($value,'Content-Type:') !== FALSE) {
			echo "Hay un problema con la info que ingresaste.";
			exit;
		}
	}

	if ($_POST["address"] != "") {
		echo "El formulario tiene un error";
		exit;
	}

	require 'inc/phpmailer/PHPMailerAutoload.php';
	$mail = new PHPMailer;
	if (!$mail -> ValidateAddress($email)) {
		echo "El e-mail no es válido";
		exit;
	}

	$mail->setFrom($email, $name);
	$mail->addAddress('aluna@microcomp.com.mx', 'Playeras MC');
	$mail->Subject = "Mensaje de playeras MC | $name";
	$mail->msgHTML($email_body);

	//send the message, check for errors
	if (!$mail->send()) {
	    echo "Hubo un problema enviando el mensaje: " . $mail->ErrorInfo;
	    exit;
}

	$email_body = "";
	$email_body = $email_body . "Name: " . $name . "<br>";
	$email_body = $email_body . "Email: ". $email . "<br>";
	$email_body = $email_body . "Message: ". $message . "<br>";
	$email_body = $email_body . "Reason: ". $reason . "<br>";

	header("Location: contact.php?status=thanks");
	exit;
}

$pageTitle = "Contacto MC";
$section = "contacto";
?>

<?php include('inc/header.php'); ?>

<div class="section page">
	<div class="wrapper">
		<h1>Contact</h1>

		<?php if (isset($_GET["status"]) AND $_GET["status"] == "thanks") { ?>

			<p>Gracias por el correo, te contactamos pronto!</p>

		<?php } else { ?>

			<p>Nos encanta saber de ti, llena el formulario por favor:</p>

			<form method="post" action="contact.php">

				<table>
					<tr>
						<th>
							<label for="name">Nombre</label>
						</th>
						<td>
							<input type="text" name="name" id="name">
						</td>
					</tr>
					<tr>
						<th>
							<label for="email">Email</label>
						</th>
						<td>
							<input type="text" name="email" id="email">
						</td>
					</tr>
					<tr>
						<th>
							<label for="Message">Mensaje</label>
						</th>
						<td>
							<textarea name="message" id="message"></textarea>
						</td>
					</tr>
					<tr style="display:none;">
						<th>
							<label for="email">Direccion</label>
						</th>
						<td>
							<input type="text" name="address" id="address">
							<p>Por favor dejar en blanco</p>
						</td>
					</tr>
					<tr>
						<th>
							<label for="reason">Razón</label>
						</th>
						<td>
							<select name="reason" id="reason">
								<option value="null">Por favor selecciona una:</option>
								<option value="question">Preguntas generales</option>
								<option value="complaint">Quejas</option>
								<option value="feedback">Comentarios</option>
							</select>
						</td>
				</table>

			<input type="submit" value="Send">

			</form>

	<?php } ?>	

	</div>
</div>

<?php include('inc/footer.php'); ?>