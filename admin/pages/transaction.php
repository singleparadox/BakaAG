
<div class="inner-block">
<!--market updates updates-->
	<div class="blank">
		<ul class="nav nav-tabs" role="tablist">
		<li role="presentation" class="active"><a href="#for-approval-tab" aria-controls="products" role="tab" data-toggle="tab">For Approval</a></li>
		<li role="presentation"><a href="#approved-tab" aria-controls="settings" role="tab" data-toggle="tab">Approved Orders</a></li>
	</ul>
	<div class="tab-content">
		<div role="tabpanel" class="tab-pane active" id="for-approval-tab">
			<table class="table">
				    <thead>
				    	<tr>
				    		<th>Order Number</th>
				    		<th>Date Ordered</th>
				    		<th>Products</th>
				    		<th>Total Amount</th>
				    		<th>Status</th>
				    	</tr>
				    </thead>
				    	<?php
				    		$sql = "SELECT * FROM orders,order_status,account,order_mdofpymt WHERE orders.order_status_id=order_status.order_status_id AND orders.acc_id=account.acc_id AND orders.order_mdpaymnt_id=order_mdofpymt.order_mdpaymt_id AND order_status.order_status_id='1'";
	                		$result = $conn->query($sql);
	                		while($row = $result->fetch_assoc()){
	                			echo '
	                				<tr>
                        				<td>'.$row['order_id'].'</td>
                        				<td>'.$row['order_date'].'</td>
                        				<td><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#prodlist-modal-'.$row['order_id'].'">View products</button></td>
					                        <div class="modal" id="prodlist-modal-'.$row['order_id'].'">
					                          <div class="modal-dialog" role="document">
					                            <div class="modal-content">
					                              <div class="modal-header">
					                                <h5 class="modal-title">Order Number:'.$row['order_id'].'</h5>
					                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
					                                  <span aria-hidden="true">&times;</span>
					                                </button>
					                              </div>
					                              <div class="modal-body">';
					                        		$prods = explode(";", $row['order_product_list']);
					                                $numb = 1;
					                                echo '<p class="text-primary">Product Name&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Genre&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Type</p>';
					                                foreach ($prods as $prdct) {
					                                  $sql2 = "SELECT * FROM product,product_genre,product_type WHERE product.prod_id='".$prdct."' AND product.prod_genre_id=product_genre.prod_genre_id AND product.prod_type_id=product_type.prod_type_id";
					                                  $result2 = $conn->query($sql2);
					                                  $row2 = $result2->fetch_assoc();
					                                  echo '
					                                      <p class="text-primary">'.$numb.': '.$row2['prod_name'].'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$row2['prod_genre_name'].'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$row2['prod_type_name'].'</p>
					                                      ';
					                                  $numb++;
					                                }
					                              echo' </div>
					                              <div class="modal-footer">
					                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					                              </div>
					                            </div>
					                          </div>
					                        </div>
					                        <td>'.$row['order_total_amt'].'</td>
					                        <td><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#statchng-modal-'.$row['order_id'].'">Review & Send to Courier</button></td>
					                        <div id="statchng-modal-'.$row['order_id'].'" class="modal fade" role="dialog">
  											<div class="modal-dialog">
					                        <div class="modal-content">
										      <div class="modal-header">
										        <button type="button" class="close" data-dismiss="modal">&times;</button>
										        <h4 class="modal-title">Change Status</h4>
										      </div>
										      <div class="modal-body">
										        <div class="container-fluid">
										        	<div class="col-md-4">
										        		<label for="order-number">Order Number</label>
    													<h3 id="order-number">'.$row['order_id'].'</h3>
										        	</div>
										        	<div class="col-md-4">
										        		<label for="order-account">Account Name</label>
    													<h3 id="order-number">'.$row['acc_fname'].''.$row['acc_lname'].'</h3>
										        	</div>
										        	<div class="col-md-4">
										        		<label for="order-date">Order Date</label>
    													<h3 id="order-number">'.$row['order_date'].'</h3>
										        	</div>
										        </div><br>
										        <div class="container-fluid">
										        	<div class="col-md-6">
										        		<label for="order-amount">Order Amount</label>
    													<h3 id="order-number">'.$row['order_total_amt'].'</h3>
										        	</div>
										        	<div class="col-md-6">
										        		<label for="order-account">Mode of Payment</label>
    													<h3 id="order-number">'.$row['order_mdpaymt_name'].'</h3>
										        	</div>
										        </div>
										        <div class="container">
										        	<button type="button" class="btn btn-default" data-dismiss="modal" onclick="chcngordstat('.$row['order_id'].')">Approve and Send to Courrier</button>
										        <input type="text" id="sel-stat-'.$row['order_id'].'" value="2" hidden>
										        </div>
										      </div>
										      <div class="modal-footer">
										        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
										      </div>
										    </div>

										  </div>
										</div>
					                      </tr>
					                      ';
	                		}
				    	?>
				  </table>
		</div>
		<div role="tabpanel" class="tab-pane" id="approved-tab">
			<table class="table">
				    <thead>
				    	<tr>
				    		<th>Order Number</th>
				    		<th>Date Ordered</th>
				    		<th>Products</th>
				    		<th>Total Amount</th>
				    		<th>Status</th>
				    	</tr>
				    </thead>
				    <?php
				    		$sql = "SELECT * FROM orders,order_status,account,order_mdofpymt WHERE orders.order_status_id=order_status.order_status_id AND orders.acc_id=account.acc_id AND orders.order_mdpaymnt_id=order_mdofpymt.order_mdpaymt_id AND order_status.order_status_id!='1'";
	                		$result = $conn->query($sql);
	                		while($row = $result->fetch_assoc()){
	                			echo '
	                				<tr>
                        				<td>'.$row['order_id'].'</td>
                        				<td>'.$row['order_date'].'</td>
                        				<td><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#prodlist-modal-'.$row['order_id'].'">View products</button></td>
					                        <div class="modal" id="prodlist-modal-'.$row['order_id'].'">
					                          <div class="modal-dialog" role="document">
					                            <div class="modal-content">
					                              <div class="modal-header">
					                                <h5 class="modal-title">Order Number:'.$row['order_id'].'</h5>
					                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
					                                  <span aria-hidden="true">&times;</span>
					                                </button>
					                              </div>
					                              <div class="modal-body">';
					                        		$prods = explode(";", $row['order_product_list']);
					                                $numb = 1;
					                                echo '<p class="text-primary">Product Name&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Genre&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Type</p>';
					                                foreach ($prods as $prdct) {
					                                  $sql2 = "SELECT * FROM product,product_genre,product_type WHERE product.prod_id='".$prdct."' AND product.prod_genre_id=product_genre.prod_genre_id AND product.prod_type_id=product_type.prod_type_id";
					                                  $result2 = $conn->query($sql2);
					                                  $row2 = $result2->fetch_assoc();
					                                  echo '
					                                      <p class="text-primary">'.$numb.': '.$row2['prod_name'].'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$row2['prod_genre_name'].'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$row2['prod_type_name'].'</p>
					                                      ';
					                                  $numb++;
					                                }
					                              echo' </div>
					                              <div class="modal-footer">
					                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					                              </div>
					                            </div>
					                          </div>
					                        </div>
					                        <td>'.$row['order_total_amt'].'</td>
					                        <td>'.$row['order_status_name'].'</td>
										  </div>
										</div>
					                      </tr>
					                      ';
	                		}
				    	?>
			</table>
		</div>
	</div>
	</div>
</div>