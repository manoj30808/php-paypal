<?php
	//BASIC CONFIG VAR
	$paypal_id = 'PAYPAL EMAIL ID';
	$service_tax = 4;
	$paypal_url = 'https://www.sandbox.paypal.com/cgi-bin/webscr'; // Test Paypal API URL
	$contact_person = array('1'=>'Test','2'=>'Test1','3'=>'Test2');

	//RETURN FROM PAYMENT GATEWAY
	$local_cancel_return = 'http://localhost/payment/cancel.php';
	$local_return = 'http://localhost/payment/success.php';

	//RETURN FROM PAYMENT GATEWAY IN LIVE SERVER
	$live_cancel_return = 'http://DOMAIN.COM/cancel.php';
	$live_return = 'http://DOMAIN.COM/success.php';

	//CC MAIL ADRESS
	$mail_cc = 'EMAIL ID (ONCE PAYMENT CONPLETE AND YOU WANT TO SEND MAIL SO, HERE FROM WHICH MAIL YOU WANT TO SENT ALL THOSE MAIL)';
	$mail_from = 'EMAIL ID (ONCE PAYMENT CONPLETE AND YOU WANT TO SEND MAIL SO, HERE FROM WHICH MAIL YOU WANT TO SENT ALL THOSE MAIL)';
?>
