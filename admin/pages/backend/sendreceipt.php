<?php
	session_start();
	include '../../../backend/connection.php';

	$id = $_GET['id'];
	$name = $_GET['name'];
	$address = $_GET['address'];
	$amt = $_GET['amt'];

	$sql = "INSERT INTO receipt SET receipt_amt_paid='".$amt."',receipt_custname='".$name."',receipt_compaddress='".$address."',order_id='".$id."'";
	$conn->query($sql);
	$sql = "UPDATE orders SET order_receive='Received' WHERE order_id='".$id."'";
	$conn->query($sql);
	if($_SESSION['acc_type_id']==7){
		include "../transaction.php";
	}
	elseif ($_SESSION['acc_type_id']==8) 
		include "../courier.php";
	else
?>