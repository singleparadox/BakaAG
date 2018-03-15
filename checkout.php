<?php
include_once("backend/connection.php");
include_once("header.php");
?>
<!DOCTYPE html>
<html>
<head>
	<title>BakaAG</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="css/admin/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="css/style_global.css">
	<script type="text/javascript" src="js/jquery-3.2.1.min.js"></script>
	<link rel="stylesheet" type="text/css" href="css/inputstyle.css">
</head>

<body>
<div style="margin-top: 60px;" class="container-fluid">
<div  class="row container-center">
	<div class="col-lg-7 data-container">
	<div class="bs-component">
	<div class="card border-primary mb-3" style="max-width: 65rem;">
  <div class="card-header">Checkout</div>
  <div class="card-body text-primary">
    <h4 class="card-title"></h4>
    <p class="card-text">
    	<?php
    		if(!isset($_SESSION['acc_id'])){
    			echo "Must be logged in to continue";
    		}
    		else{
    			echo '
    				<table class="table table-hover">
					   <thead>
							    <tr class="table-active">
							      <th scope="col">Product</th>
							      <th scope="col">Quantity</th>
							      <th scope="col">Price</th>
							    </tr>
							  </thead>
							  <tbody>
    				';
    				$sql = "SELECT * FROM product,inventory WHERE inventory.inv_id=product.inv_id";
		                $result = $conn->query($sql);
		                $totprice = 0;
		                $totprod = 0;
		                $_SESSION['prodlist'] = "";
		                while($row = $result->fetch_assoc()){
		                    if(in_array($row['prod_id'], $_SESSION['arry'])==true){
	                            $a = $row['inv_price'] * ($row['inv_discount'] / 100);
	                            $b = $row['inv_price'] - $a;
		                        $totprice = $totprice + $b;
		                        $_SESSION['prodlist'] = $_SESSION['prodlist'].$row['prod_id'].";";
		                        echo '
		                            <tr>
		                                <th scope="row">'.$row['prod_name'].'</th>
		                                <td><input id="prod-quant-'.$row['prod_id'].'" type="number" value="1" min="1" onchange="incrdecr('.$row['prod_id'].')"></td>
		                                <td>PHP '.number_format($b,2).'</td>
		                                </tr>
		                                ';
		                    }
		                }
		        echo '
		        	<tr class="table-active">
				      <th scope="col">Total</th>
				      <th scope="col" id="total-price" name="total-price">PHP '.number_format($totprice,2).'</th>
				    </tr>
				  </tbody>
		</table>
		<a href="#"><button class="btn btn-primary" id="cursor-pointer" data-toggle="modal" data-target="#card-modal">Choose payment method</button></a>
		        	';
    		}
    	?>          
    </p>
    </div>
  </div>
</div>
</div>
	
</div>
</div>


<div class="modal" id="card-modal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Credit/Debit Card</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body" id="card-modal-content">
        <p>
        <ul class="nav nav-tabs">
		  <li class="nav-item">
		    <a class="nav-link active show" data-toggle="tab" href="#cod-mode">Cash On Delivery</a>
		  </li>
		  <li class="nav-item">
		    <a class="nav-link" data-toggle="tab" href="#card-mode">Debit/Credit</a>
		  </li>
		  <li class="nav-item">
		    <a class="nav-link" data-toggle="tab" href="#paypal-mode">Paypal</a>
		  </li>
		</ul>
		<div id="myTabContent" class="tab-content">
		  <div class="tab-pane fade active show" id="cod-mode">
		  		<?php
					$sql ="SELECT* FROM account,account_details,account_billing,account_address WHERE account.acc_id='".$_SESSION['acc_id']."' AND account.acc_id=account_details.acc_id AND account.acc_id=account_billing.acc_id AND account.acc_id=account_address.acc_id";
					$result = $conn->query($sql);
					$row = $result->fetch_assoc();
		  		?>
		  		Address
		  		<div class="form-group">
				  <fieldset disabled="">
				    <label class="control-label" for="province">Province</label>
				    <input class="form-control" id="province" type="text" placeholder="<?php echo $row['billing_province'];?>" disabled="">
				  </fieldset>
				</div>
				<div class="form-group">
				  <fieldset disabled="">
				    <label class="control-label" for="countr">Country</label>
				    <input class="form-control" id="countr" type="text" placeholder="<?php echo $row['billing_country'];?>" disabled="">
				  </fieldset>
				</div>
				<div class="form-group">
				  <fieldset disabled="">
				    <label class="control-label" for="city">City</label>
				    <input class="form-control" id="city" type="text" placeholder="<?php echo $row['billing_city'];?>" disabled="">
				  </fieldset>
				</div>
				<div class="form-group">
				  <fieldset disabled="">
				    <label class="control-label" for="pnum">Disabled input</label>
				    <input class="form-control" id="pnum" type="text" placeholder="<?php echo $row['billing_phonenum'];?>" disabled="">
				  </fieldset>
				</div>
				<div class="form-group">
				  <fieldset disabled="">
				    <label class="control-label" for="cadd">Disabled input</label>
				    <input class="form-control" id="cadd" type="text" placeholder="<?php echo $row['billing_compaddress'];?>" disabled="">
				  </fieldset>
				</div>
		    	 <br><center><button type="button" id="pay-card-chckout" class="btn btn-primary" onclick="payuscard()">Place Order</button></center>
		  </div>
		  <div class="tab-pane fade" id="card-mode">
		   <div class="form-group">
		      <label for="card-name">Name on Card</label>
		      <input type="text" class="form-control" id="card-name" aria-describedby="emailHelp" placeholder="Name">
		    </div>
        	 <div class="form-group">
		      <label for="card-number">Card Number</label><br>
		      <input type="text" class="" id="card-number" aria-describedby="emailHelp" placeholder="xxxx" maxlength="4" size="4">
		      -
		      <input type="text" class="" id="card-number" aria-describedby="emailHelp" placeholder="xxxx" maxlength="4" size="4">
		      -
		      <input type="text" class="" id="card-number" aria-describedby="emailHelp" placeholder="xxxx" maxlength="4" size="4">
		      -
		      <input type="text" class="" id="card-number" aria-describedby="emailHelp" placeholder="xxxx" maxlength="4" size="4">
		    </div>
		    <div class="form-group">
		      <label for="card-date">Card Expiration Date</label>
		      <input type="date" class="form-control" id="card-date" aria-describedby="emailHelp" placeholder="xx/xx/xx">
		    </div>
		    <div class="form-group">
		      <label for="card-cvv">Card CCV</label>
		      <input type="text" class="form-control" id="card-cvv" aria-describedby="emailHelp" placeholder="CVV" maxlength="3">
		    </div>
		    <button type="button" id="pay-card-chckout" class="btn btn-primary" onclick="payuscard()">Pay</button>
		  </div>
		<div class="tab-pane fade" id="paypal-mode">
		  <br>
		  <center><button type="button" id="pay-card-chckout" class="btn btn-primary">Login to Paypal</button></center>
		</div>
		</div>
        </p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>


<script type="text/javascript" src="js/funcs.js"></script>
<script src='https://code.responsivevoice.org/responsivevoice.js'></script>
</body>
</html>
<?php 
	include_once("footer.php");
?>
