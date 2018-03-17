<?php
	include '../../../backend/connection.php';
	$newaccess = $_GET['newaccess'];
	$id = $_GET['id'];

	$sql = "UPDATE account SET acc_type_id='".$newaccess."' WHERE acc_id='".$id."'";
	$conn->query($sql);

	include "../accmgmt.php"
?>