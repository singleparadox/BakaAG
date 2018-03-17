<?php
	$sql = "SELECT COUNT(*) as TOTALprod FROM product";
	$result = $conn->query($sql);
	$prod = $result->fetch_assoc();

	$sql = "SELECT COUNT(*) as TOTALuser FROM account";
	$result = $conn->query($sql);
	$user = $result->fetch_assoc();

	$sql = "SELECT COUNT(*) as TOTALsold FROM orders";
	$result = $conn->query($sql);
	$sold = $result->fetch_assoc();
?>
<script src="chartjs/Chart.bundle.min.js"></script>
<!--inner block start here-->
<div class="inner-block">
<!--market updates updates-->
	<div class="blank">
	<h1>Graphs and Reports</h1><hr>
	 <div class="market-updates">
			<a href="#" data-toggle="modal" data-target="#product-report-modal"><div class="col-md-4 market-update-gd">
				<div class="market-update-block clr-block-1">
					<div class="col-md-8 market-update-left">
						<h3><?php echo $prod['TOTALprod']?></h3>
						<h4>Number of Products</h4>
						<p>Click to see details</p>
					</div>
					<div class="col-md-4 market-update-right">
						<i class="fa fa-file-text-o"> </i>
					</div>
				  <div class="clearfix"> </div>
				</div>
			</div></a>
			<a href="#" data-toggle="modal" data-target="#user-report-modal"><div class="col-md-4 market-update-gd">
				<div class="market-update-block clr-block-2">
				 <div class="col-md-8 market-update-left">
					<h3><?php echo $user['TOTALuser']?></h3>
					<h4>Total User Accounts</h4>
					<p>Click to see details</p>
				  </div>
					<div class="col-md-4 market-update-right">
						<i class="fa fa-eye"> </i>
					</div>
				  <div class="clearfix"> </div>
				</div>
			</div></a>
			<a href="#" data-toggle="modal" data-target="#orders-report-modal"><div class="col-md-4 market-update-gd">
				<div class="market-update-block clr-block-3">
					<div class="col-md-8 market-update-left">
						<h3><?php echo $sold['TOTALsold']?></h3>
						<h4>Total Orders Placed</h4>
						<p>Click to see details</p>
					</div>
					<div class="col-md-4 market-update-right">
						<i class="fa fa-envelope-o"> </i>
					</div>
				  <div class="clearfix"> </div>
				</div>
			</div></a>
		   <div class="clearfix"> </div>
		</div><br>
		<div class="container-fluid">
			<div class="row">
			  <div class="col-md-6">
			  		<a href="#" data-toggle="modal" data-target="#report-sales-tabular">
			  		<div class="panel panel-default">
					  <div class="panel-heading">
					    <h3 class="panel-title">Sales</h3>
					  </div>
					  <div class="panel-body">
					    <canvas id="sales-report" width="400" height="200"></canvas>
						<script>
						var ctx = document.getElementById("sales-report").getContext('2d');
						var myChart = new Chart(ctx, {
						    type: 'line',
						    data: {
						        labels: [<?php
						        			$sql ="SELECT * FROM orders";
						        			$result = $conn->query($sql);
											while($row = $result->fetch_assoc()){
												echo '"'.$row['order_date'].'",';
											}
						        		?>],
						        datasets: [{
						            label: 'Order Income',
						            data: [<?php
						        			$sql ="SELECT * FROM orders";
						        			$result = $conn->query($sql);
											while($row = $result->fetch_assoc()){
												echo $row['order_total_amt'].",";
											}
						        		?>],
						            backgroundColor: [
						                'rgba(255, 99, 132, 0.2)',
						                'rgba(54, 162, 235, 0.2)',
						                'rgba(255, 206, 86, 0.2)',
						                'rgba(75, 192, 192, 0.2)',
						                'rgba(153, 102, 255, 0.2)',
						                'rgba(255, 159, 64, 0.2)'
						            ],
						            borderColor: [
						                'rgba(255,99,132,1)',
						                'rgba(54, 162, 235, 1)',
						                'rgba(255, 206, 86, 1)',
						                'rgba(75, 192, 192, 1)',
						                'rgba(153, 102, 255, 1)',
						                'rgba(255, 159, 64, 1)'
						            ],
						            borderWidth: 1,
						            fill:false
						        }]
						    },
						    options: {
						        scales: {
						            yAxes: [{
						                ticks: {
						                    beginAtZero:true
						                }
						            }]
						        }
						    }
						});
						</script>
					  </div>
					</div></a>
			  		<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="report-sales-tabular">
			  		<div class="modal-dialog" role="document">
					    <div class="modal-content">
					      <div class="modal-header">
					        <h5 class="modal-title" id="exampleModalLabel">Tabular Format</h5>
					        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
					          <span aria-hidden="true">&times;</span>
					        </button>
					      </div>
					      <div class="modal-body">
					  	  	<table class="table">
						    	<thead>
						    		<tr>
						    			<th>Date</th>
						    			<th>Income Generated</th>
						    		</tr>
						    	</thead>
						    	<?php
						    		$sql4="SELECT DISTINCT(account.acc_id) FROM orders,account WHERE orders.acc_id=account.acc_id";
						        	$result4 = $conn->query($sql4);
						        	$row4 = $result4->fetch_assoc();

						    		$sql="SELECT DISTINCT(orders.order_id) FROM orders,account WHERE orders.acc_id=account.acc_id";
						        	$result = $conn->query($sql);
									while($row = $result->fetch_assoc()){
						        		$sql2 = "SELECT * FROM orders WHERE order_id='".$row['order_id']."'";
						        		$result2 = $conn->query($sql2);
						        		$row2 = $result2->fetch_assoc();
										echo '
												<tr>
													<td>'.$row2['order_date'].'</td>
													<td>'.$row2['order_total_amt'].'</td>
												</tr>
											';
									}
						    	?>
						    </table>
					      </div>
					      <div class="modal-footer">
					        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					      </div>
					    </div>
					  </div>
					</div>
			  </div>
			  <a href="#" data-toggle="modal" data-target="#orders-report-table">
			  <div class="col-md-6">
			  	<div class="panel panel-default">
				<div class="panel-heading">
				<h3 class="panel-title">Most Orders Placed</h3>
				</div>
				<div class="panel-body">
			  	<canvas id="user-order-chart" width="400" height="200"></canvas>
				<script>
				var ctx = document.getElementById("user-order-chart").getContext('2d');
				var myChart = new Chart(ctx, {
				    type: 'bar',
				    data: {
				        labels: [<?php
				        			$sql="SELECT DISTINCT acc_fname FROM orders,account WHERE orders.acc_id=account.acc_id AND acc_type_id='1'";
				        			$result = $conn->query($sql);
									while($row = $result->fetch_assoc()){
										echo '"'.$row['acc_fname'].'",';
									}
				        		?>],
				        datasets: [{
				            label: '# of orders placed',
				            data: [<?php
				        			$sql="SELECT * FROM orders,account WHERE orders.acc_id=account.acc_id AND acc_type_id='1'";
				        			$result = $conn->query($sql);
									while($row = $result->fetch_assoc()){
										$sql3="SELECT DISTINCT order_id FROM orders,account WHERE orders.acc_id=account.acc_id AND account.acc_id='".$row['acc_id']."'";
				        				$result3 = $conn->query($sql3);
				        				$row3 = $result3->fetch_assoc();
										echo '"'.$row3['order_id'].'",';
									}
				        		?>],
				            backgroundColor: [
				                'rgba(75, 192, 192, 0.2)',
				                'rgba(153, 102, 255, 0.2)',
				                'rgba(255, 159, 64, 0.2)'
				            ],
				            borderColor: [
				                'rgba(75, 192, 192, 1)',
				                'rgba(153, 102, 255, 1)',
				                'rgba(255, 159, 64, 1)'
				            ],
				            borderWidth: 1
				        }]
				    },
				    options: {
				        scales: {
				            yAxes: [{
				                ticks: {
				                    beginAtZero:true
				                }
				            }]
				        }
				    }
				});
				</script>
				</div>
				</div>
			  </div>
			  </a>
			  <div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="orders-report-table">
			  <div class="modal-dialog" role="document">
			    <div class="modal-content">
			      <div class="modal-header">
			        <h5 class="modal-title" id="exampleModalLabel">Tabular Format</h5>
			        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
			          <span aria-hidden="true">&times;</span>
			        </button>
			      </div>
			      <div class="modal-body">
			  	  	<table class="table">
				    	<thead>
				    		<tr>
				    			<th>User</th>
				    			<th>Total Orders</th>
				    		</tr>
				    	</thead>
				    	<?php
				    		$sql="SELECT DISTINCT(account.acc_id) FROM orders,account WHERE orders.acc_id=account.acc_id AND acc_type_id='1'";
				        	$result = $conn->query($sql);
							while($row = $result->fetch_assoc()){
								$sql3="SELECT COUNT(order_id) AS totordss FROM orders,account WHERE orders.acc_id=account.acc_id AND account.acc_id='".$row['acc_id']."'";
				        		$result3 = $conn->query($sql3);
				        		$row3 = $result3->fetch_assoc();

				        		$sql2 = "SELECT * FROM account WHERE acc_id='".$row['acc_id']."'";
				        		$result2 = $conn->query($sql2);
				        		$row2 = $result2->fetch_assoc();
								echo '
										<tr>
											<td>'.$row2['acc_fname'].$row2['acc_lname'].'</td>
											<td>'.$row3['totordss'].'</td>
										</tr>
									';
							}
				    	?>
				    </table>
			      </div>
			      <div class="modal-footer">
			        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
			      </div>
			    </div>
			  </div>
			</div>
			</div>
		</div>
	</div>
</div>

<div class="modal fade bs-example-modal-lg category" tabindex="-1" role="dialog" aria-labelledby="user-report-modal" id="user-report-modal">
	<a class="btn link" id="edit-button">User Graph Report</a>
	  <div class="modal-dialog modal-lg" role="document">
	    <div class="modal-content" id="removeAdd">
	     <div class="modal-header" id="toBeremoved">
	      	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title" id="myModalLabel">User Graph Report</h4>
	     </div>
	     <div class="modal-body" id="toBeremoved">
	     	<ul class="nav nav-tabs" role="tablist">
			    <li role="presentation" class="active"><a href="#user-report-graph-tab" aria-controls="products" role="tab" data-toggle="tab">Graph</a></li>
			   	<li role="presentation"><a href="#user-report-table-tab" aria-controls="settings" role="tab" data-toggle="tab">Table</a></li>
			</ul>
			<div class="tab-content">
		    	<div role="tabpanel" class="tab-pane active" id="user-report-graph-tab">
	     			<canvas id="acc-chart" width="500" height="200"></canvas>
						<script>
			             	var ctx = document.getElementById("acc-chart").getContext('2d');
			                var myChart = new Chart(ctx, {
			                  type: 'pie',
			                  data: {
			                    labels: ["Accounts"],
			                    datasets: [{
			                      label: 'User Accounts',
			                      data: [<?php echo $prod['TOTALprod']?>],
			                      backgroundColor: "rgba(153,255,51,1)"
			                    }]
			                  }
			                });
						</script>
			    </div>
			    <div role="tabpanel" class="tab-pane active" id="user-report-table-tab">
			    	<table class="table">
				    	<thead>
				    		<tr>
				    			<th>User ID</th>
				    			<th>E-mail</th>
				    			<th>First Name</th>
				    			<th>Last Name</th>
				    			<th>Account Type</th>
				    		</tr>
				    	</thead>
				    	<?php
				    		$sql="SELECT * FROM account,account_type WHERE account.acc_type_id=account_type.acc_type_id";
				        	$result = $conn->query($sql);
							while($row = $result->fetch_assoc()){
								echo '
										<tr>
											<td>'.$row['acc_id'].'</td>
											<td>'.$row['acc_email'].'</td>
											<td>'.$row['acc_fname'].'</td>
											<td>'.$row['acc_lname'].'</td>
											<td>'.$row['acc_type_name'].'</td>
										</tr>
									';
							}
				    	?>
				    </table>
			    </div>
			</div>
		</div>
	     <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	      </div>
	    </form>
	</div>
</div>
</div>

<div class="modal fade bs-example-modal-lg category" tabindex="-1" role="dialog" aria-labelledby="product-report-modal" id="product-report-modal">
	<a class="btn link" id="edit-button">Product Graph Report</a>
	  <div class="modal-dialog modal-lg" role="document">
	    <div class="modal-content" id="removeAdd">
	     <div class="modal-header" id="toBeremoved">
	      	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title" id="myModalLabel">Product Graph Report</h4>
	     </div>
	     <div class="modal-body" id="toBeremoved">
	     	<ul class="nav nav-tabs" role="tablist">
			    <li role="presentation" class="active"><a href="#product-report-graph-tab" aria-controls="products" role="tab" data-toggle="tab">Graph</a></li>
			   	<li role="presentation"><a href="#product-report-table-tab" aria-controls="settings" role="tab" data-toggle="tab">Table</a></li>
			</ul>
			<div class="tab-content">
		    	<div role="tabpanel" class="tab-pane active" id="product-report-graph-tab">
		    		<canvas id="myChart" width="500" height="200"></canvas>
					<script>
		             	var ctx = document.getElementById("myChart").getContext('2d');
		                var myChart = new Chart(ctx, {
		                  type: 'doughnut',
		                  data: {
		                    labels: ["Anime","Games"],
		                    datasets: [
		                      <?php
		                      		$sql = "SELECT COUNT(*) as TOTALanime FROM product WHERE prod_type_id='2'";
		                      		$result = $conn->query($sql);
									$TOTanime = $result->fetch_assoc();
									$sql = "SELECT COUNT(*) as TOTALgame FROM product WHERE prod_type_id='3'";
		                      		$result = $conn->query($sql);
									$TOTgame = $result->fetch_assoc();
		                      ?>{
		                      data: [<?php echo $TOTanime['TOTALanime']?>,<?php echo $TOTgame['TOTALgame']?>],
		                      backgroundColor: ["#2ecc71","rgba(255,153,0,1)"],
		                      label: "datasets	"
		                    }]
		                  }
		                });
					</script>
		    	</div>
		    	<div role="tabpanel" class="tab-pane active" id="product-report-table-tab">
			    	<table class="table">
				    	<thead>
				    		<tr>
				    			<th>Product Code</th>
				    			<th>Product Name</th>
				    			<th>Date Added</th>
				    			<th>Product Genre</th>
				    			<th>Product Type</th>
				    			<th>Total Sold</th>
				    		</tr>
				    	</thead>
				    	<?php
				    		$sql="SELECT * FROM product,inventory,product_genre,product_type WHERE inventory.inv_id=product.inv_id AND product_genre.prod_genre_id=product.prod_genre_id AND product_type.prod_type_id=product.prod_type_id";
				        	$result = $conn->query($sql);
							while($row = $result->fetch_assoc()){
								echo '
										<tr>
											<td>'.$row['prod_codeid'].'</td>
											<td>'.$row['prod_name'].'</td>
											<td>'.$row['prod_dateadd'].'</td>
											<td>'.$row['prod_genre_name'].'</td>
											<td>'.$row['prod_type_name'].'</td>
											<td>'.$row['inv_no_of_sold'].'</td>
										</tr>
									';
							}
				    	?>
				    </table>
			    </div>
		    </div>
	     </div>
	     <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	      </div>
	    </form>
	</div>
</div>
</div>

<div class="modal fade bs-example-modal-lg category" tabindex="-1" role="dialog" aria-labelledby="orders-report-modal" id="orders-report-modal">
	<a class="btn link" id="edit-button">Orders Graph Report</a>
	  <div class="modal-dialog modal-lg" role="document">
	    <div class="modal-content" id="removeAdd">
	     <div class="modal-header" id="toBeremoved">
	      	<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title" id="myModalLabel">Orders Graph Report</h4>
	     </div>
	     <div class="modal-body" id="toBeremoved">
	     	<ul class="nav nav-tabs" role="tablist">
			    <li role="presentation" class="active"><a href="#order-report-graph-tab" aria-controls="products" role="tab" data-toggle="tab">Graph</a></li>
			   	<li role="presentation"><a href="#order-report-table-tab" aria-controls="settings" role="tab" data-toggle="tab">Table</a></li>
			</ul>
			<div class="tab-content">
		    	<div role="tabpanel" class="tab-pane active" id="order-report-graph-tab">
			      	<canvas id="order-chart" width="400" height="200"></canvas>
					<script>
					var ctx = document.getElementById("order-chart").getContext('2d');
					var myChart = new Chart(ctx, {
					    type: 'bar',
					    data: {
					        labels: [
					        		<?php
					        			$sql = "SELECT DISTINCT order_date FROM orders";
					        			$result = $conn->query($sql);
										while($row = $result->fetch_assoc()){
											echo '"';
											echo $row['order_date'];
											echo '",';
										}
					        		?>
					        		],
					        datasets: [{
					            label: 'Number of orders',
					            data: [<?php
					            		$sql = "SELECT order_date, COUNT(order_id) AS totalords FROM orders GROUP BY order_date";
					        			$result = $conn->query($sql);
										while($row = $result->fetch_assoc()){
											echo $row['totalords'];
											echo ',';
										}
					            		?>],
					            backgroundColor: [
					                'rgba(255, 99, 132, 0.2)',
					                'rgba(54, 162, 235, 0.2)',
					                'rgba(255, 206, 86, 0.2)',
					                'rgba(75, 192, 192, 0.2)',
					                'rgba(153, 102, 255, 0.2)',
					                'rgba(255, 159, 64, 0.2)'
					            ],
					            borderColor: [
					                'rgba(255,99,132,1)',
					                'rgba(54, 162, 235, 1)',
					                'rgba(255, 206, 86, 1)',
					                'rgba(75, 192, 192, 1)',
					                'rgba(153, 102, 255, 1)',
					                'rgba(255, 159, 64, 1)'
					            ],
					            borderWidth: 1
					        }]
					    },
					    options: {
					        scales: {
					            yAxes: [{
					                ticks: {
					                    beginAtZero:true
					                }
					            }]
					        }
					    }
					});
					</script>
		    	</div>
		    	<div role="tabpanel" class="tab-pane active" id="order-report-table-tab">
			    	<table class="table">
				    	<thead>
				    		<tr>
				    			<th>Order ID</th>
				    			<th>Placed By</th>
				    			<th>Placed On</th>
				    			<th>Total Amount</th>
				    			<th>Order Status</th>
				    		</tr>
				    	</thead>
				    	<?php
				    		$sql="SELECT * FROM orders,account,order_status WHERE orders.acc_id=account.acc_id AND orders.order_status_id=order_status.order_status_id";
				        	$result = $conn->query($sql);
							while($row = $result->fetch_assoc()){
								echo '
										<tr>
											<td>'.$row['order_id'].'</td>
											<td>'.$row['acc_fname'].$row['acc_lname'].'</td>
											<td>'.$row['order_date'].'</td>
											<td>'.$row['order_total_amt'].'</td>
											<td>'.$row['order_status_name'].'</td>
										</tr>
									';
							}
				    	?>
				    </table>
			    </div>
		    </div>
	     </div>
	     <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	      </div>
	    </form>
	</div>
</div>
</div>