<div class="panel panel-default">
				  <!-- Default panel contents -->
				  <div class="panel-heading">Transactions List</div>

				  <!-- Table -->
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
				    		$sql = "SELECT * FROM orders,order_status WHERE orders.order_status_id=order_status.order_status_id";
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
					                        <td><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#statchng-modal-'.$row['order_id'].'">'.$row['order_status_name'].'</button></td>
					                        <div id="statchng-modal-'.$row['order_id'].'" class="modal fade" role="dialog">
  											<div class="modal-dialog">
					                        <div class="modal-content">
										      <div class="modal-header">
										        <button type="button" class="close" data-dismiss="modal">&times;</button>
										        <h4 class="modal-title">Change Status</h4>
										      </div>
										      <div class="modal-body">
										        <div class="form-group">
												  <label for="sel-stat">Select list:</label>
												  <select class="form-control" id="sel-stat">
												    ';
												    $sql3 = "SELECT * FROM order_status";
												    $result3 = $conn->query($sql3);
	                								while($row3 = $result3->fetch_assoc()){
	                									echo '<option value="'.$row3['order_status_id'].'">'.$row3['order_status_name'].'</option>';
	                								}
												  echo'
												  </select>
												</div>
										      </div>
										      <div class="modal-footer">
										      	<button type="button" class="btn btn-primary" data-dismiss="modal" onclick="chcngordstat('.$row['order_id'].')">Update</button>
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