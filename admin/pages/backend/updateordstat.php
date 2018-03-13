<?php
	include '../../../backend/connection.php';
	$order_stat = $_GET['orderstat'];
	$order_id = $_GET['id'];
	$sql = "UPDATE orders SET order_status_id='".$order_stat."' WHERE order_id='".$order_id."'";
	$conn->query($sql);
?>