<?php
	include 'connection.php';
	session_start();
		
	$prod_id = $_GET['id'];
	if (($key = array_search($prod_id, $_SESSION['arry'])) !== false) {
    unset($_SESSION['arry'][$key]);
}
	
	$num = 0;
	$sql = "SELECT * FROM product,inventory WHERE inventory.inv_id=product.inv_id";
	$result = $conn->query($sql);
	echo '
		<table class="table table-hover">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Product name</th>
                    <th>Price</th>
                    <th>Remove</th>
                </tr>
            </thead>
            <tbody>
		';
	while($row = $result->fetch_assoc()){
		if(in_array($row['prod_id'], $_SESSION['arry'])==true){
			$num++;
			echo '
				<tr>
                    <th scope="row">'.$num.'</th>
                    <td>'.$row['prod_name'].'</td>
                     <td>'.$row['inv_price'].'$</td>
                     <td><a onclick="removefrcart('.$row['prod_id'].')"><i class="fa fa-remove"></i></a></td>
                </tr>
				';
		}
	}
	echo '
		</tbody>
       </table>
		';
?>