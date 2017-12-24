<?php
	$sql = "SELECT COUNT(*) as TOTALprod FROM product";
	$result = $conn->query($sql);
	$prod = $result->fetch_assoc();

	$sql = "SELECT COUNT(*) as TOTALuser FROM account";
	$result = $conn->query($sql);
	$user = $result->fetch_assoc();

	$sql = "SELECT SUM(inv_no_of_sold) as TOTALsold FROM inventory";
	$result = $conn->query($sql);
	$sold = $result->fetch_assoc();
?>
<!--inner block start here-->
<div class="inner-block">
<!--market updates updates-->
	<div class="blank">
	 <div class="market-updates">
			<div class="col-md-4 market-update-gd">
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
			</div>
			<div class="col-md-4 market-update-gd">
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
			</div>
			<div class="col-md-4 market-update-gd">
				<div class="market-update-block clr-block-3">
					<div class="col-md-8 market-update-left">
						<h3><?php echo $sold['TOTALsold']?></h3>
						<h4>Total Products Sold</h4>
						<p>Other hand, we denounce</p>
					</div>
					<div class="col-md-4 market-update-right">
						<i class="fa fa-envelope-o"> </i>
					</div>
				  <div class="clearfix"> </div>
				</div>
			</div>
		   <div class="clearfix"> </div>
		</div>
	</div>
</div>
			