<?php
	session_start();
	include '../../../backend/connection.php';
	$id = $_GET['id'];
	$sql = "UPDATE orders SET order_approval_wh='Approved' WHERE orders.order_id='".$id."'";
	$conn->query($sql);

		include "../warehouse.php";
?>