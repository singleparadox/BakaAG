<?php
	include_once "connection.php";


	$uid = $_POST['uid'];
	$pid = $_POST['pid'];
	$rating = (int)$_POST['rating'];

	

	$sql_check = "SELECT * FROM rating WHERE inv_id=".$pid." AND acc_id=".$uid;
	$result_check = $conn->query($sql_check);

	if (mysqli_num_rows($result_check) > 0) {
		$sql_update = "UPDATE rating SET rate_num=".$rating." WHERE inv_id=".$pid." AND acc_id=".$uid;
		$conn->query($sql_update);
		echo 0; //User has already voted
	} else {
		$sql_insert = "INSERT INTO rating (inv_id, acc_id, rate_num) VALUES (".$pid.", ".$uid.", ".$rating.")";
		$conn->query($sql_insert);

		echo 1; // User has successfully voted
	}

?>