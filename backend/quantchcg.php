<?php
	session_start();
	include 'connection.php';

	$quant = $_GET['quant'];
	$prod_id = $_GET['id'];

	$sql = "UPDATE cart SET prod_quant='".$quant."' WHERE prod_id='".$prod_id."' AND acc_id='".$_SESSION['acc_id']."'";
	$conn->query($sql);

	$sql = "SELECT * FROM cart,product,inventory WHERE inventory.inv_id=product.inv_id AND cart.prod_id=product.prod_id AND cart.acc_id='".$_SESSION['acc_id']."'";
	$result = $conn->query($sql);
	$totprice = 0;
	$a = 0;
	$b = 0;
	while($row = $result->fetch_assoc()){
		if($row['inv_discount']>0){
	        $a = $row['inv_price'] * ($row['inv_discount'] / 100);
	        $b = $row['inv_price'] - $a;
	        $b = $b*$row['prod_quant'];
		    $totprice = $totprice + $b;
	        }
	    else{
	    	$b = $row['inv_price']*$row['prod_quant'];
		    $totprice = $totprice + $b;
	    }
	}
	echo $totprice;
?>