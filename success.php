<?php
session_start();

include 'config.php';
include 'db_config.php';

$session_token = $_SESSION['token'];
$token = $_REQUEST['cm'];

$tamp_payment = $db->query("SELECT * from temp_payments where token='".$token."'");
$row = $tamp_payment->fetch_array(MYSQLI_ASSOC);

if($tamp_payment->num_rows && $row['token']==$session_token){
	
	$item_no            = $_REQUEST['item_number'];
	$item_transaction   = $_REQUEST['tx']; // Paypal transaction ID
	$item_price         = $row['amount']; // Paypal received amount
	$item_currency      = $_REQUEST['cc']; // Paypal received currency type
	$payment_status 	= $_GET['st'];

	$created_date = date('Y-m-d H:i:s');
	
	$tamp_payment = $db->query("SELECT * from payments where txn_id='".$item_transaction."'");
	
	if(empty($tamp_payment->num_rows)){
		$insert = $db->query("INSERT INTO payments(item_number,txn_id,payment_gross,currency_code,payment_status,created_date) VALUES('".$item_no."','".$item_transaction."','".$item_price."','".$item_currency."','".$payment_status."','".$created_date."')");
		$last_insert_id = $db->insert_id;
		
		$to = $row['email'];
		$subject = "Payment Successful With Txn Id#$item_transaction";
		$txt = "Thanks For Payment of $item_currency $item_price.";
		$headers = "From: $mail_from" . "\r\n" .
		"CC: $mail_cc";

		mail($to,$subject,$txt,$headers);
	}
?>

 <html>
<body style="background-color:#EBEFF2">
<table align="center" border="0" height="100%" style="padding:220px">
<tr align="center">
<td colspan="3" style="font-size:30px"><b>Thank you for Shopping</b></td>
</tr>
<tr>
<td><b>Your transaction ID</b></td>
<td> : </td>
<td><?php echo $item_transaction; ?> </td>
</tr>
<tr>
<td><b>Amount</b></td>
<td>: </td>
<td><?php echo $item_price; ?> <?php $item_currency ?></td>
</tr>
</table>
</body>
</html>

<?php 

}else{ ?>

<html>
	<body style="background:snow">
		<h1 style="color:red;text-align:center"><strong>Token Mismatch Error... Something Is Wrong... </strong></h1><br>	
	</body>
</html>


<?php }


?>
