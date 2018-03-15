<?php
	include 'connection.php';
	session_start();	

	$totalprice = $_GET['totalprice'];

	$sql = "INSERT INTO orders SET acc_id='".$_SESSION['acc_id']."',order_total_amt='".$totalprice."',order_product_list='".$_SESSION['prodlist']."',order_status_id='1'";
	$conn->query($sql);
	empty($_SESSION['arry']);
	echo '<div class="alert alert-dismissible alert-warning">
		  <h4 class="alert-heading">Success!</h4>
		  <p class="mb-0">Order was successfully placed</p>
		</div>';
?>