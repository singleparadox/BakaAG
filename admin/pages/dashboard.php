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
						<p>Other hand, we denounce</p>
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
					<h4>User Accounts</h4>
					<p>Other hand, we denounce</p>
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
						<p>Other hand, we denounce</p>
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
					</div>
			  </div>
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
				        			$sql="SELECT DISTINCT COUNT(order_id) AS totORDERS FROM orders,account WHERE orders.acc_id=account.acc_id AND acc_type_id='1'";
				        			$result = $conn->query($sql);
									while($row = $result->fetch_assoc()){
										echo '"'.$row['totORDERS'].'",';
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
	     <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	      </div>
	    </form>
	</div>
</div>
</div>