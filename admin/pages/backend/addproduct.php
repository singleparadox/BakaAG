<?php
	include '../../../backend/connection.php';

	$newprodname = $_POST['new-prod-name'];
	$newproddesc = $_POST['new-prod-desc'];
	$newprodgenre = $_POST['new-prod-genre'];
	$newprodtype = $_POST['new-prod-type'];
	$newprodprice = $_POST['new-prod-price'];
	$newprodstock = $_POST['new-prod-stock'];
	$newproddate = $_POST['new-prod-date'];

	$newprodcodeid = rand(100000,9674997)
	
	$newprodpic = $_FILES['new-prod-pic']['tmp_name'];
	$newprodpicname = $newprodname."-".date("y-m-d")."-".rand(10000,90987);
	mkdir("../../../data/Products/".$newprodpicname);
	$newprodpath = "data/Products/".$newprodpicname."/".$newprodpicname;

	
	$sql = "SELECT prod_genre_id FROM product_genre WHERE prod_genre_name='".$newprodgenre."'";
	$result = $conn->query($sql);
	$result = $result->fetch_assoc();
	$newprodgenre = $result['prod_genre_id'];

	$sql = "SELECT prod_type_id FROM product_type WHERE prod_type_name='".$newprodtype."'";
	$result = $conn->query($sql);
	$result = $result->fetch_assoc();
	$newprodtype = $result['prod_type_id'];

	if(empty($_FILES['new-prod-pic']['tmp_name'])){
			$sql = "INSERT INTO inventory (inv_price, inv_stock) VALUES (".$newprodprice.", ".$newprodstock.")";
			$conn->query($sql);
			$sql = "INSERT INTO product SET prod_codeid = '".$newprodcodeid."', prod_name = '".$newprodname."', prod_desc = '".$newproddesc."', prod_genre_id = '".$newprodgenre."', prod_type_id = '".$newprodtype."', prod_dateadd = '".$newproddate."', inv_id = LAST_INSERT_ID()";
			$conn->query($sql);
	}
	else{
		move_uploaded_file($newprodpic,'../../../data/Products/'.$newprodpicname.'/'.$newprodpicname);
		$sql = "INSERT INTO inventory (inv_price, inv_stock) VALUES (".$newprodprice.", ".$newprodstock.")";
		$conn->query($sql);
		$sql = "INSERT INTO product SET prod_codeid = '".$newprodcodeid."', prod_name = '".$newprodname."', prod_desc = '".$newproddesc."', prod_picture_link = '".$newprodpath."', prod_genre_id = '".$newprodgenre."', prod_type_id = '".$newprodtype."', prod_dateadd = '".$newproddate."', inv_id = LAST_INSERT_ID()";
		$conn->query($sql);
	}
	header("Location:../../index.php")
?>