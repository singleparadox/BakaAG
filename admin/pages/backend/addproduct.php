<?php
	include '../../../backend/connection.php';

	$newprodname = $_POST['new-prod-name'];
	$newproddesc = $_POST['new-prod-desc'];
	$newprodgenre = $_POST['new-prod-genre'];
	$newprodtype = $_POST['new-prod-type'];
	$newprodprice = $_POST['new-prod-price'];
	$newprodstock = $_POST['new-prod-stock'];

	$sql = "SELECT prod_genre_id FROM product_genre WHERE prod_genre_name='".$newprodgenre."'";
	$result = $conn->query($sql);
	$result = $result->fetch_assoc();
	$newprodgenre = $result['prod_genre_id'];

	$sql = "SELECT prod_type_id FROM product_type WHERE prod_type_name='".$newprodtype."'";
	$result = $conn->query($sql);
	$result = $result->fetch_assoc();
	$newprodtype = $result['prod_type_id'];

	$sql = "INSERT INTO inventory (inv_price, inv_stock) VALUES (".$newprodprice.", ".$newprodstock.")";
	$conn->query($sql);
	$sql = "INSERT INTO product SET prod_name = '".$newprodname."', prod_desc = '".$newproddesc."', prod_genre_id = '".$newprodgenre."', prod_type_id = '".$newprodtype."', inv_id = LAST_INSERT_ID()";
	$conn->query($sql);
?>