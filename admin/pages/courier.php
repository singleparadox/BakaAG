<div class="inner-block">
<!--market updates updates-->
	<div class="blank">
	<ul class="nav nav-tabs" role="tablist">
		<li role="presentation" class="active"><a href="#shipping-tab" aria-controls="products" role="tab" data-toggle="tab">Shipping</a></li>
		<li role="presentation"><a href="#delivered-tab" aria-controls="products" role="tab" data-toggle="tab">Delivered</a></li>
		<li role="presentation"><a href="#cancelled-tab" aria-controls="settings" role="tab" data-toggle="tab">Cancelled</a></li>
	</ul>
	<div class="tab-content">
		<div role="tabpanel" class="tab-pane active" id="shipping-tab">
			<table class="table">
				    <thead>
				    	<tr>
				    		<th>Order Number</th>
				    		<th>Date Ordered</th>
				    		<th>Total Amount</th>
				    		<th>Mark as Delivered</th>
				    		<th>Mark as Cancelled</th>
				    	</tr>
				    </thead>
				    <tbody>
				    	<?php
				    		$sql = "SELECT * FROM orders,order_status WHERE orders.order_status_id=order_status.order_status_id AND orders.order_status_id='2'";
				    		$result = $conn->query($sql);
	                		while($row = $result->fetch_assoc()){
	                			echo '
	                				<tr>
	                					<td>'.$row['order_id'].'</td>
	                					<td>'.$row['order_date'].'</td>
	                					<td>'.$row['order_total_amt'].'</td>
	                					<td><button class="btn btn-primary" onclick="cour_deliver('.$row['order_id'].')">Mark this order as delivered</button></td>
	                					<td><button class="btn btn-primary" onclick="cour_cancel('.$row['order_id'].')">Mark this order as cancelled</button></td>
	                				</tr>
	                				<input type="text" id="deliver-'.$row['order_id'].'" value="3" hidden>
	                				<input type="text" id="cancel-'.$row['order_id'].'" value="4" hidden>
	                				';
	                		}
				    	?>
				    </tbody>
			</table>
		</div>
		<div role="tabpanel" class="tab-pane" id="delivered-tab">
			<table class="table">
				    <thead>
				    	<tr>
				    		<th>Order Number</th>
				    		<th>Date Ordered</th>
				    		<th>Total Amount</th>
				    	</tr>
				    </thead>
				    <tbody>
				    	<?php
				    		$sql = "SELECT * FROM orders,order_status WHERE orders.order_status_id=order_status.order_status_id AND orders.order_status_id='3'";
				    		$result = $conn->query($sql);
	                		while($row = $result->fetch_assoc()){
	                			echo '
	                				<tr>
	                					<td>'.$row['order_id'].'</td>
	                					<td>'.$row['order_date'].'</td>
	                					<td>'.$row['order_total_amt'].'</td>
	                				</tr>
	                				';
	                		}
				    	?>
				    </tbody>
			</table>
		</div>
		<div role="tabpanel" class="tab-pane" id="cancelled-tab">
			<table class="table">
				    <thead>
				    	<tr>
				    		<th>Order Number</th>
				    		<th>Date Ordered</th>
				    		<th>Total Amount</th>
				    	</tr>
				    </thead>
				    <tbody>
				    	<?php
				    		$sql = "SELECT * FROM orders,order_status WHERE orders.order_status_id=order_status.order_status_id AND orders.order_status_id='4'";
				    		$result = $conn->query($sql);
	                		while($row = $result->fetch_assoc()){
	                			echo '
	                				<tr>
	                					<td>'.$row['order_id'].'</td>
	                					<td>'.$row['order_date'].'</td>
	                					<td>'.$row['order_total_amt'].'</td>
	                				</tr>
	                				';
	                		}
				    	?>
				    </tbody>
			</table>
		</div>
	</div>
</div>
</div>