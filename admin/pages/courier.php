<div class="inner-block">
<!--market updates updates-->
	<div class="blank">
	<ul class="nav nav-tabs" role="tablist">
		<li role="presentation" class="active"><a href="#shipping-tab" aria-controls="products" role="tab" data-toggle="tab">Approved Orders</a></li>
		<li role="presentation"><a href="#delivered-tab" aria-controls="products" role="tab" data-toggle="tab">Shipped</a></li>
	</ul>
	<div class="tab-content">
		<div role="tabpanel" class="tab-pane active" id="shipping-tab">
			<table class="table">
				    <thead>
				    	<tr>
				    		<th>Order Number</th>
				    		<th>Date Ordered</th>
				    		<th>Total Amount</th>
				    		<th>Ship the Order</th>
				    		<th>Return the Order</th>
				    	</tr>
				    </thead>
				    <tbody>
				    	<?php
				    		$sql = "SELECT * FROM orders,order_status WHERE orders.order_status_id=order_status.order_status_id AND orders.order_status_id='1' AND orders.order_approval='Approved'";
				    		$result = $conn->query($sql);
	                		while($row = $result->fetch_assoc()){
	                			echo '
	                				<tr>
	                					<td>'.$row['order_id'].'</td>
	                					<td>'.$row['order_date'].'</td>
	                					<td>'.$row['order_total_amt'].'</td>
	                					<td><button class="btn btn-primary" onclick="cour_shipped('.$row['order_id'].')">Send to shipping</button></td>
	                					<td><button class="btn btn-primary" onclick="cour_cancel('.$row['order_id'].')">Return to warehouse</button></td>
	                				</tr>
	                				<input type="text" id="deliver-'.$row['order_id'].'" value="2" hidden>
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
				    		<th>Receipt</th>
				    	</tr>
				    </thead>
				    <tbody>
				    	<?php
				    		$sql = "SELECT * FROM orders,order_status WHERE orders.order_status_id=order_status.order_status_id AND orders.order_status_id='2' AND orders.order_receive='Undelivered'";
				    		$result = $conn->query($sql);
	                		while($row = $result->fetch_assoc()){
	                			echo '
	                				<tr>
	                					<td>'.$row['order_id'].'</td>
	                					<td>'.$row['order_date'].'</td>
	                					<td>'.$row['order_total_amt'].'</td>
	                					<td><button class="btn btn-primary" data-toggle="modal" data-target="#receipt-input-'.$row['order_id'].'">Enter receipt details</button></td>
	                				</tr>
											<div class="modal" id="receipt-input-'.$row['order_id'].'">
					                          <div class="modal-dialog" role="document">
					                            <div class="modal-content">
					                              <div class="modal-header">
					                                <h5 class="modal-title">Order Number:'.$row['order_id'].'</h5>
					                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
					                                  <span aria-hidden="true">&times;</span>
					                                </button>
					                              </div>
					                              <div class="modal-body">';
					                        		echo '
					                        		<div class="form-group">
													    <label for="receipt-name">Receiver Name</label>
													    <input type="email" class="form-control" id="receipt-name" placeholder="Name">
													</div>
													<div class="form-group">
													    <label for="receipt-address">Receiver Address</label>
													    <input type="email" class="form-control" id="receipt-address" placeholder="Address">
													</div>
													<div class="form-group">
													    <label for="receipt-amt">Amount Paid</label>
													    <input type="number" class="form-control" id="receipt-amt" placeholder="Amount">
													</div>
					                        			';
					                              echo' </div>
					                              <div class="modal-footer">
					                              	<button type="button" class="btn btn-primary" data-dismiss="modal" onclick="send_trans('.$row['order_id'].')">Confirm</button>
					                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					                              </div>
					                            </div>
					                          </div>
					                        </div>
	                				';
	                		}
				    	?>
				    </tbody>
			</table>
		</div>
	</div>
</div>
</div>