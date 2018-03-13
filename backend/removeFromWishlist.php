<?php

	include_once "connection.php";

	$uid  = $_POST['uid'];
	$pid  = $_POST['pid'];

	$sql = 'DELETE FROM wishlist WHERE acc_id='.$uid.' AND prod_id='.$pid;

	$conn->query($sql);

	echo $uid.$pid;


?>