<?php
	$sql_get_total = "SELECT cart.prod_quant AS quantity, inventory.inv_price AS price, inventory.inv_discount AS discount FROM cart,product,inventory WHERE cart.acc_id=".$_SESSION['acc_id']." AND product.prod_id=cart.prod_id AND product.inv_id=inventory.inv_id";
	$result_get_total = $conn->query($sql_get_total);
	if (($result_get_total->num_rows) > 0) {
		$price = 0;
		while ($row_price = $result_get_total->fetch_assoc()) {
			if ($row_price['discount'] == 0) {
				$dis = $row_price['price'];
			} else {
				$dc = 100;
				$dis = $row_price['price'] - ($row_price['price'] * ((float)$row_price['discount'] / $dc));
			}
			$price = $price + ($row_price['quantity'] * $dis);
			//echo ','.$row_price['price'] * $dis;
		}
	return "'".$price."'";
?>