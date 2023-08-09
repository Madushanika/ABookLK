<?php
$email1_status = "";
if (isset($_POST['fullname']) ) {

//$fullname = 'madu';
	$fullname = $_POST['fullname'];
$address = $_POST['address']; //'2025 M Street, Northwest, Washington, DC, 20036.';
$email = $_POST['email'];
$selected_language =  $_POST['language'];


$translations = [
	'english' => [
		'order_summary' => "Order Summary,",
		'payment_completed' => "Your Payment is Completed,",
		'hello' => "Hello,",
		'order_id' => "Order ID, ",
		'order_date' => "Order Date, ",
		'product' => "Product, ",
		'quantity' => "Quantity,  ",
		'price' => "Price, ",
		'total' => "Total, ",
		'thank_you_for_shopping' => "Thank you for shopping with us..!",
		'order_cancel' => "Order Cancellation,",
		'cancel_message' => "Cancellation Request is Approved, ",
		'date' => "Date, ",

	],
	'german' => [
		'order_summary' => "Bestellübersicht,",
		'payment_completed' => "Ihre Zahlung ist abgeschlossen,",
		'hello' => "Hallo,",
		'order_id' => "Bestell-ID, ",
		'order_date' => "Bestelldatum, ",
		'product' => "Produkt, ",
		'quantity' => "Menge,  ",
		'price' => "Preis, ",
		'total' => "Gesamt, ",
		'thank_you_for_shopping' => "Vielen Dank für Ihren Einkauf bei uns...!",
		'order_cancel' => "Auftragsstornierung,",
		'cancel_message' => "Der Stornierungsantrag wurde genehmigt, ",
		'date' => "Datum, ",
	],
];


if (isset($translations[$selected_language])) {
	$translation = $translations[$selected_language];
} else {
    $translation = $translations['english']; // Default to English if the selected language is not found
}

// $selected_language = 'german'; // Example: Get selected language from form or user preference
// $translation = $translations[$selected_language];


$template_file = 'PlaceOrderM.html';
if (file_exists($template_file)) {
	$email_content = file_get_contents($template_file);
    // Replace placeholders with translated content
	$email_content = str_replace('{{hello}}', $translation['hello'], $email_content);
	$email_content = str_replace('{{fullname}}', $fullname, $email_content);
	$email_content = str_replace('{{address}}', $address, $email_content);
	$email_content = str_replace('{{order_summary}}', $translation['order_summary'], $email_content);
	$email_content = str_replace('{{payment_completed}}', $translation['payment_completed'], $email_content);
	$email_content = str_replace('{{order_id}}', $translation['order_id'], $email_content);
	$email_content = str_replace('{{order_date}}', $translation['order_date'], $email_content);
	$email_content = str_replace('{{product}}', $translation['product'], $email_content);
	$email_content = str_replace('{{quantity}}', $translation['quantity'], $email_content);
	$email_content = str_replace('{{price}}', $translation['price'], $email_content);
	$email_content = str_replace('{{total}}', $translation['total'], $email_content);
	$email_content = str_replace('{{thank_you_for_shopping}}', $translation['thank_you_for_shopping'], $email_content);
	$email_content = str_replace('{{date}}', $translation['date'], $email_content);

} else {
	die('Email template not found.');
}


$subject = 'Order Confirmation';
$headers = 'From: sender@example.com' . "\r\n";
$headers .= 'Content-type: text/html' . "\r\n";

if (isset($_POST['submit']) ) {

// Send email
	if (mail($email, $subject, $email_content, $headers)) {
		$email1_status = '<span class="success-message">Email sent successfully.</span>';
	} else {
		$email1_status = '<span class="success-message">Failed to send email.</span>';
	}

}elseif (isset($_POST['cancel'])) {

	$template_file1 = 'OrderCancelM.html';
	if (file_exists($template_file1)) {
		$email_content1 = file_get_contents($template_file1);

		$email_content1 = str_replace('{{hello}}', $translation['hello'], $email_content1);
		$email_content1 = str_replace('{{fullname}}', $fullname, $email_content1);
		$email_content1 = str_replace('{{order_id}}', $translation['order_id'], $email_content1);
		$email_content1 = str_replace('{{order_date}}', $translation['order_date'], $email_content1);
		$email_content1 = str_replace('{{order_cancel}}', $translation['order_cancel'], $email_content1);
		$email_content1 = str_replace('{{cancel_message}}', $translation['cancel_message'], $email_content1);
		$email_content1 = str_replace('{{thank_you_for_shopping}}', $translation['thank_you_for_shopping'], $email_content1);
		$email_content1 = str_replace('{{date}}', $translation['date'], $email_content1);
	}

	$subject1 = 'Order Cancellation';
	$headers1 = 'From: sender@example.com' . "\r\n";
	$headers1 .= 'Content-type: text/html' . "\r\n";

// Send email
	if (mail($email, $subject1, $email_content1, $headers1)) {
		$email1_status = '<span class="success-message">Cancel Email sent successfully.</span>';
	} else {
		$email1_status = '<span class="success-message">Failed to send Cancel email.</span>';
	}

} else {
	die('Cancel Email template not found.');
}

}


  // Clear 
    $email1_status = ''; // Set to an empty value
    $fullname = '';
    $address = '';
    $email = '';


    ?>


    <!DOCTYPE html>
    <html lang="en">
    <head>
    	<meta charset="utf-8">
    	<title> Checkout Your Order</title>
    	<link rel="stylesheet" type="text/css" href="css/style.css">
    </head>
    <body>
    	<div class="checkout-container">
    		<div class="form-col">
    			<form action="Main_Page.php" method="post">
				<!-- <div class="email-status">
					<?php echo $email1_status; ?>
				</div> -->
				<p class="input-group">
					<label for="fullname">Your Full Name *:</label>
					<input type="text" name="fullname" id="fullname" required>
				</p>

				<p class="input-group">
					<label for="email">Your Email *:</label>
					<input type="text" name="email" id="email" required>
				</p>

				<p class="input-group">
					<label for="address">Shipping Address:</label>
					<textarea id="address" name="address" rows="4" required></textarea>
				</p>

				<p class="input-group">
					<label for="language">Preferred Language:</label>
					<select id="languages" name="language">
						<option value="german">German</option>
						<option value="english">English</option>
					</select>
				</p>

				<div class="button-group">
					<button type="submit" name="submit">Proceed to Payment</button>
					<button type="cancel" name="cancel">Cancel</button>
				</div>
			</form>
		</div>

		<div class="summary-col">
			<div class="order-summary">
				<h2>Order Summary</h2>
			</br></br>
			<div class="order-item">
				<span>Product 01 :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span>
				<span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$20.00</span>
			</div>
			<div class="order-item">
				<span>Product 02 :&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </span>
				<span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$15.00</span>
			</div>
			<p>--------------------------------------</p>
			<div class="order-item">
				<strong>Total Price:&nbsp;&nbsp;&nbsp;&nbsp; </strong>
				<strong>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; $35.00</strong>
			</div>
			<p>--------------------------------------</p>
		</div>
	</div>
</div>
</body>
</html>