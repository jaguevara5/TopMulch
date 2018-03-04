<?php 

if($_SERVER["REQUEST_METHOD"] == "POST") {
	$name = trim(filter_input(INPUT_POST, "name", FILTER_SANITIZE_STRING));
	$email = trim(filter_input(INPUT_POST, "email", FILTER_SANITIZE_EMAIL));
	$message = trim(filter_input(INPUT_POST, "message", FILTER_SANITIZE_SPECIAL_CHARS));

	if ($name == "" || $email == "" || $message == "" ) {
		echo "Please fill in the required fields";
		exit;
	}
	if($_POST["address"] != "") {
		echo "Bad form input";
		exit;
	}
	
	require("inc/phpmailer/PHPMailerAutoload.php");

	
	$mail = new PHPMailer;
	
	if (!$mail->ValidateAddress($email)) {
		echo "Invalid Email Address";
		exit;
	}
	
	
	$email_body = "";
	$email_body .= "Name " . $name . "\n";
	$email_body .= "Email " . $email . "\n";
	$email_body .= "Message " . $message . "\n";


	//$mail->setFrom($email, $name);
	//$mail->addAddress('mrwebara@gmail.com', 'Alan Guevara');     // Add a recipient
	//$mail->addCC('j.alanguevara@gmail.com');
	//$mail->addBCC('bcc@example.com');


	//$mail->SMTPDebug = 3;                               // Enable verbose debug output

	$mail->isSMTP();                                      // Set mailer to use SMTP
	$mail->Host = 'ip-172-31-42-29.us-east-2.compute.internal';  // Specify main and backup SMTP servers
	$mail->SMTPAuth = false;                               // Enable SMTP authentication
	$mail->Username = 'email@texastopmulch.com';                 // SMTP username
	$mail->Password = 'JorgeCamp0s0!';                           // SMTP password
	$mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted
	$mail->Port = 587;                                    // TCP port to connect to

	$mail->setFrom('email@texastopmulch.com', 'Top Mulch Mailer');
	$mail->AddReplyTo('email@texastopmulch.com', 'Mailer');
	$mail->addAddress('top.mulch11@gmail.com', 'Top Mulch');     // Add a recipient
    // Optional name
	$mail->isHTML(false);                                  // Set email format to HTML

	$mail->Subject = 'Message from Top Mulch Website -> ' . $name;
	$mail->Body    = $email_body;

	if(!$mail->send()) {
		echo 'Message could not be sent.';
		echo 'Mailer Error: ' . $mail->ErrorInfo;
		exit;
	}

	header("location:contact.php?status=thanks");
}

?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<title>Top Mulch Garden Center Alvin TX | Contact</title>
		<meta name="description" content="Supplying mulch, sand and gravel, Top Mulch offers competitive prices in the Houston and Alvin area. Delivery available. " >
		<meta name="keywords" content="Top, mulch, sand, gravel, houston, alvin, texas, tx" >
		<meta name="viewport" content="width=device-width, initial-scale=1.0"> 
		
		<link href='https://fonts.googleapis.com/css?family=Fjalla+One' rel='stylesheet' type='text/css'>
		<link href='https://fonts.googleapis.com/css?family=Roboto:400,300|Open+Sans' rel='stylesheet' type='text/css'>
		<link href='https://fonts.googleapis.com/css?family=Oswald:400,300,700' rel='stylesheet' type='text/css'>
		<link href='https://fonts.googleapis.com/css?family=Open+Sans:400,300,600' rel='stylesheet' type='text/css'>
        <link rel="stylesheet" href="css/normalize.css">
        <link rel="stylesheet" href="css/style.css">
		<link rel="shortcut icon" href="http://texastopmulch.com/favicon.ico?v=3" />
	</head>
	<body>
		<div class="info-banner">
			<ul class="info">
				<li><a href="tel:1-713-907-0239"><img class="phone" src="img/phone.png" /> <span class="info-span">(713) 907-0239</span></a></li>
				<li><a href="http://maps.google.com/maps?q=5210+Quail+West,+Alvin,+TX+77511"><img class="phone" src="img/location.png" />
					<span  class="info-span">5210 Quail West, Alvin, TX 77511</span></a></li>
				<li><a href="mailto:top.mulch11@gmail.com"><img class="phone" src="img/mail.png" /><span style="padding-left: 5px;" class="info-span">top.mulch11@gmail.com</span></a></li>
			</ul>
		</div>
		<header class="clearfix">
			<a href="index.html" class="logo"><img src="img/tmlogo.png" alt="Top Mulch Logo" /></a>
			<nav>
				<ul>
					<li><a href="index.html" >HOME</a></li><li>
					<a href="products.html">PRODUCTS</a></li><li>
					<a href="price.html">PRICE</a></li><li>
					<a class="selected" href="contact.php">CONTACT</a></li>
					</ul>
				</nav>
		</header>
		<div class="img-header">
				<img class="back-img" src="img/flower_5.jpg" alt="Top Mulch header image" />
				<h2>Mulch, Soil and Sand supplier<br />Competitive pricing<br />Delivery available</h2>
		</div>
		<div class="container clearfix">
			<?php if (isset($_GET["status"]) && $_GET["status"] == "thanks") {
				echo "<h1 style='text-align:center;'>Thank you</h1>
				<p style='text-align:center;'>Thanks for your email. We will be contacting you shortly.<p/>";
			} else {
			?>
            <h1>Contact Us</h1>
			<div class="col1-contact">
            <ul class="contact-info">
				<li><h3>Top Mulch Garden Center</h3></li>
				<li><img class="phone" src="img/phone-footer.png" /> (713) 907-0239</li>
				<li><img class="phone" src="img/location-footer.png" /><a href="http://maps.google.com/maps?q=5210+Quail+West,+Alvin,+TX+77511">
				5210 Quail West, Alvin, TX 77511</a></li>
				<li><img class="phone" src="img/mail-contact.png" /><a href="mailto:top.mulch11@gmail.com"> top.mulch11@gmail.com</a></li>
			</ul>
			<ul class="contact-info">
					<li><h3>Business Hours:</h3></li>
					<li><strong>Mon-Fri:</strong> 7:00 am to 7:00 pm</li>
					<li><strong>Sat:</strong> 7:00 am to 5:00 pm</li>
			</ul>
			</div>
			<div class="col2-contact">
				<form method="post" action="contact.php">
					<table>
						<tr>
							<th><label form="name">Name</label></th>
							<td><input type="text" id="name" name="name" /></td>
						</tr>
						<tr>
							<th><label for="email">Email</label></th>
							<td><input type="text" id="email" name="email" /></td>
						</tr>
						<tr>
							<th><label for="message">Message</label></th>
							<td><textarea name="message" id="message"></textarea></td>
						</tr>
						<tr style="display:none">
							<th><label for="address">Address</label></th>
							<td><input type="text" name="address" id="address" />
							<p>Please leave this field blank</p></td>
						</tr>
					</table>
					<input type="submit" value="Send" />
					
				</form>
			</div> <?php } ?>
        </div>
        <footer class="main-footer">
			<ul class="footer-info">
				<li><img class="phone" src="img/phone-footer.png" /><a href="tel:1-713-907-0239">(713) 907-0239</a></li>
				<li><img class="phone" src="img/location-footer.png" /><a href="http://maps.google.com/maps?q=5210+Quail+West,+Alvin,+TX+77511">
				5210 Quail West, Alvin, TX 77511</a></li>
				<li><img class="phone" src="img/mail-footer.png" /><a href="mailto:top.mulch11@gmail.com"> top.mulch11@gmail.com</a></li>
			</ul>
			<div class="footer-nav">
				<ul>
					<li><a href="index.html" >Home</a></li>
					<li><a href="products.html">Products</a></li>
					<li><a href="price.html">Price</a></li>
					<li><a href="contact.php">Contact</a></li>
				</ul>
				<p class="copy-r">2016 Top Mulch Garden Center</p>
			</div>
        </footer>
		
	</body>
</html>