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
		$sql_get_data = "SELECT * FROM orders WHERE acc_id=".$uid." AND order_status_id=3";
		$result = $conn->query($sql_get_data);

		while ($row = $result->fetch_assoc()) {
			echo '
			    <tr>
					<th scope="row">'.$row['order_date'].'</th>
					<td>'.$row['order_id'].'</td>
					<td><a style="color:blue; cursor:pointer;" target="_blank" href="reciept.php?oid='.$row['order_id'].'">VIEW</a></td>
			    </tr>

			';
		}



	?>


	</table>

</body>
</html>