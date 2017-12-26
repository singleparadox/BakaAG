<?php
	include "../../../backend/connection.php";

	$id = $_GET['id'];
	$prod_name = $_GET['prod_name'];
	$prod_desc = $_GET['prod_desc'];
	$prod_genre = $_GET['prod_genre'];
	$prod_type = $_GET['prod_type'];
	$inv_id = $_GET['inv_id'];
	$prod_price = $_GET['prod_price'];
	$prod_stock = $_GET['prod_stock'];
	
	$sql = "SELECT prod_genre_id FROM product_genre WHERE prod_genre_name='".$prod_genre."'";
	$result = $conn->query($sql);
	$result = $result->fetch_assoc();
	$prod_genre = $result['prod_genre_id'];

	$sql = "SELECT prod_type_id FROM product_type WHERE prod_type_name='".$prod_type."'";
	$result = $conn->query($sql);
	$result = $result->fetch_assoc();
	$prod_type = $result['prod_type_id'];
	
	$sql = "UPDATE product SET prod_name='".$prod_name."',prod_desc='".$prod_desc."',prod_genre_id='".$prod_genre."',prod_type_id='".$prod_type."' WHERE prod_id='".$id."'";
	$conn->query($sql);

	$sql = "UPDATE inventory SET inv_price='".$prod_price."',inv_stock='".$prod_stock."' WHERE inv_id='".$inv_id."'";
	$conn->query($sql);

?>