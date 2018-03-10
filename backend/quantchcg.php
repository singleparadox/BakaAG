<?php
	session_start();
	include 'connection.php';

	$quant = $_GET['quant'];
	$prod_id_mult = $_GET['id'];
	$currttl = $_GET['currttl'];

	$totprice;
	$sql = "SELECT * FROM product,inventory WHERE inventory.inv_id=product.inv_id";
	$result = $conn->query($sql);
	$totprice = 0;
	while($row = $result->fetch_assoc()){
		    if(in_array($row['prod_id'], $_SESSION['arry'])==true){
		       if($row['prod_id']==$prod_id_mult)
		       		$totprice = $currttl + ($row['inv_price'] * $quant);
		       	else
		       		$totprice = $currttl + $row['inv_price'];
			}
	}
	echo $totprice;
?>