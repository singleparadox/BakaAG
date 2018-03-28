<?php
	session_start();
	include_once("backend/connection.php");
	$oid = (string)$_GET['oid'];
	$uid = isset($_SESSION['acc_id']) ? $_SESSION['acc_id']: '';

	$sql_check = "SELECT * FROM orders WHERE order_id='".$oid."'";
	$result = $conn->query($sql_check);
	$fetch_check = $result->fetch_assoc();

	if (($uid != $fetch_check['acc_id']) OR ($result->num_rows < 1)) {
		header('HTTP/1.0 403 Forbidden');
		echo "<html>
				<head>
				<title>403 Forbidden</title>
				</head>
				<body>
				<h1>Forbidden</h1>
				<p>You don't have permission to access ".$_SERVER['REQUEST_URI']."
				on this server.</p>
				</head>
				</html>
				";
		exit;
	}

	$sql_data = "SELECT * FROM orders, order_mdofpymt,account WHERE orders.order_id='".$oid."' AND order_mdofpymt.order_mdpaymt_id=orders.order_mdpaymnt_id AND account.acc_id=orders.acc_id";

	$result = $conn->query($sql_data);
	$fetch = $result->fetch_assoc();

	$items = explode(";", $fetch['order_product_list']);
	$products = '';
	foreach ($items as $key) {
		$sql_get_prod_name = "SELECT prod_name FROM product WHERE prod_id=".(int)$key;
		$result_name = $conn->query($sql_get_prod_name);
		$fetch_prod_name = $result_name->fetch_assoc();
		if (!($key == '')) {
			$products .= '['.$fetch_prod_name['prod_name'].']';	
		}
	}
	 

?>

<head>
	<style type="text/css">
		@media print {
		/* style sheet for print goes here */
		.noprint {
		visibility: hidden;
		}
		}
		* {
			font-family: Courier;
		}
	</style>

</head>
<center>
<h3>Reciept for <?php echo $oid; ?></h3>

<div style="width:40%;">
	<table>
		<tr>
			<td>DATE:</td>
			<td><?php echo $fetch['order_date'] ?></td>
		</tr>

		<tr>
			<td>ORDER NUMBER:</td>
			<td><?php echo $oid; ?></td>
		</tr>

		<tr>
			<td>CUSTOMER FULL NAME:</td>
			<td><?php echo $fetch['acc_fname'].' '.$fetch['acc_lname']; ?></td>
		</tr>


		<tr>
			<td>ITEMS ORDERED:</td>
			<td><?php echo $products; ?></td>
		</tr>

		<tr>
			<td>PAYMENT METHOD:</td>
			<td><?php echo $fetch['order_mdpaymt_name']; ?></td>
		</tr>

		<tr>
			<td>RETAILER:</td>
			<td>BakaAG</td>
		</tr>

		<tr>
			<td>TOTAL</td>
			<td>₱ <?php echo number_format($fetch['order_total_amt'],2); ?></td>
		</tr>

	</table>
</div>


<button class="noprint" onClick="window.print();">Print this page</button>
</center>