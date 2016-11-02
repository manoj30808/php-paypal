<?php
session_start();
include 'db_config.php';
include 'config.php';
include 'helper.php';

$error = formValidate($_REQUEST);
if(!empty($error)){
	$_SESSION['old']=$_REQUEST;
	$_SESSION['error']=$error;
	
	header("Location: paymentform.php");
}

$str = "1234567890";

$name            = $_REQUEST['name'];
$contact_person   = isset($contact_person[$_REQUEST['contact_person']])?$contact_person[$_REQUEST['contact_person']]:''; // Paypal transaction ID
$item_name         = $_REQUEST['item_name']; // Paypal received amount
$amounts      = $_REQUEST['amounts']; // Paypal received currency type
$service_tax1 	= $service_tax;

$email 	= $_REQUEST['email'];

$temp_service_tax = ($service_tax/100)*$amounts;
$amount_with_service_tax = $temp_service_tax + $amounts;

$amount 	= $amount_with_service_tax;
$total 	= $amount_with_service_tax;

$token = str_shuffle($str);

$created_date = date('Y-m-d H:i:s');

$insert = $db->query("INSERT INTO temp_payments(name,contact_person,item_name,amounts,service_tax1,service_tax,total,amount,email,token,created_date) VALUES('".$name."','".$contact_person."','".$item_name."','".$amounts."','".$service_tax1."','".$service_tax."','".$total."','".$amount."','".$email."','".$token."','".$created_date."')");

$_SESSION['token'] = $token;

?>

<!DOCTYPE html>
<html>
<head>
	<title>Redirecting</title>
</head>
<body>
	<h1 style="color:green;text-align:center"><strong>Please Do Not Refresh page... </strong></h1><br>
	<h1 style="color:green;text-align:center"><strong>Redirecting Page to Paypal Payment Gateway... </strong></h1>
	<?php
		echo "<form id='frmPayPal1' role='form' action=$paypal_url method='post' name='frmPayPal1'>";
		foreach ($_REQUEST as $key => $value) {
			echo "<input type=hidden name=$key value=$value>";
		}
		
		echo "<input type=hidden name=total value=$total>";
		echo "<input type=hidden name=amount value=$amount>";
		echo "<input type=hidden name=service_tax1 value=$service_tax>";
		echo "<input type=hidden name=service_tax value=$service_tax>";
		echo "<input type=hidden name=contact_person value=$contact_person>";
		echo "<input type=hidden name=custom value=$token>";
		echo "</form>"; 
	?>
	<script src="assets/js/jquery.min.js"></script>
	<script type="text/javascript">
		jQuery(document).ready(function($) {
			$("#frmPayPal1").submit();
	    });
	</script>
</body>
</html>