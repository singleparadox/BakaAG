<?php 
	include_once "connection.php";
	$uid = $_POST['uid'];


?>


<html>
<body>
	<table class="table table-hover">
		<thead>
			<tr>
			<th scope="col">Date</th>
			<th scope="col">Order ID</th>
			<th scope="col"></th>
			</tr>
		</thead>

	<?php 
		$sql_get_data = "SELECT * FROM orders WHERE acc_id=".$uid;
		$result = $conn->query($sql_get_data);

		while ($row = $result->fetch_assoc()) {
			if ($row['order_status_id'] != 3) {
				$link = $row['order_id']."&p=1";
			} else {
				$link = $row['order_id'];
			}

			echo '
			    <tr>
					<th scope="row">'.$row['order_date'].'</th>
					<td>'.$row['order_id'].'</td>
					<td><a style="color:blue; cursor:pointer;" target="_blank" href="reciept.php?oid='.$link.'">VIEW</a></td>
			    </tr>

			';
		}



	?>


	</table>

</body>
</html>