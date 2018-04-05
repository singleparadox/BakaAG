<?php
	include 'connection.php';
	session_start();	
	date_default_timezone_set('Asia/Singapore');	

	$totalprice = $_GET['totalprice'];
	$order_id = "ORDER-".$_SESSION['acc_id']."-".date("Ymdhis");

	$prods = explode(";", $_SESSION['prodlist']);
	$newprodlist  = "";
	foreach ($prods as $quants) {
		$sql = "SELECT * FROM cart WHERE prod_id = '".$quants."' AND acc_id='".$_SESSION['acc_id']."'";
		$result = $conn->query($sql);
		$row = $result->fetch_assoc();

		$quantity = $row['prod_quant'];
		$newprodlist = $newprodlist.$quants."-".$quantity.";";
	}
	$_SESSION['prodlist'] = $newprodlist;

	$sql = "INSERT INTO orders SET order_id='".$order_id."',acc_id=".$_SESSION['acc_id'].",order_total_amt='".$totalprice."',order_product_list='".$_SESSION['prodlist']."',order_status_id='1',order_mdpaymnt_id=3";
	$conn->query($sql);
	empty($_SESSION['arry']);
	$sql = "DELETE FROM cart WHERE acc_id='".$_SESSION['acc_id']."'";
	$conn->query($sql);

	echo '<div class="alert alert-dismissible alert-warning">
		  <h4 class="alert-heading">Success!</h4>
		  <p class="mb-0">Order was successfully placed</p>
		</div>';

?>