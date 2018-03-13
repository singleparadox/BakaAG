<?php
	include_once "connection.php";

	$uid  = $_POST['uid'];
	$pid  = $_POST['pid'];


	$sql = "INSERT INTO wishlist (acc_id, prod_id) VALUES ($uid,$pid)";
	$sql_check = "SELECT * FROM wishlist WHERE acc_id='".$uid."' AND prod_id='".$pid."'";

	$result_check = $conn->query($sql_check);
	if (mysqli_num_rows($result_check) > 0) {
		echo 0;
	} else {
		$result = $conn->query($sql);
		echo 1;
	}
?>