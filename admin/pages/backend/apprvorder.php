<?php
	session_start();
	include '../../../backend/connection.php';
	$id = $_GET['id'];
	$sql = "UPDATE orders SET order_approval='Approved' WHERE orders.order_id='".$id."'";
	$conn->query($sql);

	if($_SESSION['acc_type_id']==7){
		include "../transaction.php";
	}
	elseif ($_SESSION['acc_type_id']==8) 
		include "../courier.php";
	else
?>