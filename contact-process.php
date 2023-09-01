<?php

	$name = $_POST["name"];
	$email = $_POST["email"];
	$message = $_POST["message"];

$email_body = "";
$email_body = $email_body . "Name: " . $name . "\n";
$email_body = $email_body . "Email: ". $email . "\n";
$email_body = $email_body . "Message: ". $message . "\n";

// TODO: SEND EMAIL

$pageTitle = "Contacto MC";
$section = "contacto";
include("inc/header.php");

?>

	<div class = "section page">
		<div class = "wrapper">
			<h1>Contacto</h1>
			<p>Gracias por escribirnos, te contactaremos pronto</p>
		</div>
	</div>

<?php include(footer.php); ?>