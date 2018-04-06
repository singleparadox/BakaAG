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
	<script src="https://www.paypalobjects.com/api/checkout.js"></script>
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
    	$price = 0;
    		if(!isset($_SESSION['acc_id'])){
    			echo "Must be logged in to continue";
    		}
    		else {
    			$sql_get_total = "SELECT cart.prod_quant AS quantity, inventory.inv_price AS price, inventory.inv_discount AS discount FROM cart,product,inventory WHERE cart.acc_id=".$_SESSION['acc_id']." AND product.prod_id=cart.prod_id AND product.inv_id=inventory.inv_id";
    			$result_get_total = $conn->query($sql_get_total);
    			if (($result_get_total->num_rows) > 0) {
    				
    				while ($row_price = $result_get_total->fetch_assoc()) {
    					if ($row_price['discount'] == 0) {
    						$dis = $row_price['price'];
    					} else {
    						$dc = 100;
    						$dis = $row_price['price'] - ($row_price['price'] * ((float)$row_price['discount'] / $dc));
    					}
    					$price = $price + ($row_price['quantity'] * $dis);
    					//echo ','.$row_price['price'] * $dis;
    				}
    			}


    			$sql = "SELECT * FROM product,inventory WHERE inventory.inv_id=product.inv_id";
		        $result = $conn->query($sql);
		        while($row = $result->fetch_assoc()){
		                    if(in_array($row['prod_id'], $_SESSION['arry'])==true){
		                    	$sql2 = "INSERT INTO cart SET acc_id='".$_SESSION['acc_id']."', prod_id='".$row['prod_id']."',prod_quant='1'";
		                    	$conn->query($sql2);
		                    }
		               	}
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
    					$sql = "SELECT * FROM cart,product,inventory WHERE inventory.inv_id=product.inv_id AND cart.prod_id=product.prod_id";
		                $result = $conn->query($sql);
		                $totprice = 0;
		                $_SESSION['prodlist']="";
		                while($row = $result->fetch_assoc()){
	                  			if($row['inv_discount']>0){
	                  				$a = $row['inv_price'] * ($row['inv_discount'] / 100);
	                            	$b = $row['inv_price'] - $a;
		                        	$totprice = $price;
	                  			}
	                  			else{
	                  				$b = $row['inv_price'];
		    						$totprice = $price;
	                  			}
		                        $_SESSION['prodlist'] = $_SESSION['prodlist'].$row['prod_id'].";";
		                        echo '
		                            <tr>
		                                <th scope="row">'.$row['prod_name'].'</th>';
		                        if (isset($_GET['finalize'])==1) {
		                        	echo '<td><input disabled id="prod-quant-'.$row['prod_id'].'" value='.$row['prod_quant'].' type="number" value="1" min="1" onchange="incrdecr('.$row['prod_id'].')"></td>';
		                        } else {
		                        	echo '<td><input id="prod-quant-'.$row['prod_id'].'" value='.$row['prod_quant'].' type="number" value="1" min="1" onchange="incrdecr('.$row['prod_id'].')"></td>';
		                        }

		                        echo    '<td>PHP '.number_format($b,2).'</td>
		                                </tr>
		                                ';
		                }
		        echo '
		        	<tr class="table-active">
				      <th scope="col">Total</th>
				      <th scope="col" id="total-price" name="total-price">PHP <input type="number" id="totprce" value="'.$totprice.'" disabled></th>
				    </tr>
				  </tbody>
		</table>
		        	';
		        	if (isset($_GET['finalize'])==1) {
		        		echo '<button class="btn btn-primary" id="cursor-pointer" data-toggle="modal" data-target="#card-modal">Choose payment method</button>&nbsp&nbsp&nbsp&nbsp&nbsp&nbsp<a id="cursor-pointer" style="color: blue;" class="link" href="checkout.php">Go back</a>';	
		        	} else {
		        		echo '<a class="btn btn-primary" id="cursor-pointer" href="checkout.php?finalize=1">Finalize</a>';
		        	}

		        	echo "";
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
        <h5 class="modal-title">Credit/Debit Card/Paypal</h5>
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
		    <button type="button" id="pay-card-chckout" class="btn btn-primary" onclick="payuscard2()">Pay</button>
		  </div>
		<div class="tab-pane fade" id="paypal-mode">
		  <br>
		  <center><!--<button type="button" id="pay-card-chckout" class="btn btn-primary">Login to Paypal</button>-->
		  		<div id="paypal-button"></div>
		  </center>
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
  <script>
    paypal.Button.render({
      env: 'sandbox', // Or 'sandbox',

      commit: true, // Show a 'Pay Now' button

      style: {
        color: 'gold',
        size: 'small'
      },

      client: {
          sandbox:    'AWxH2OyKquL8ZoAZOk-Yewxft6W4iKWHxPcz44N7FueX_u1yx_gwG37c3waUhJRmSP1Hgf7le_spio_J',
          production: 'xxxxxxxxx'
      },

      payment: function(data, actions) {
            return actions.payment.create({
                payment: {
                    transactions: [
                        {
                            amount: { total: <?php echo "'".$price."'"; ?>, currency: 'PHP' }
                        }
                    ]
                }
            });
      },
      onAuthorize: function(data, actions) {
            return actions.payment.execute().then(function(payment) {
            	console.log("Payment success!");
				var xhttp = new XMLHttpRequest();
				xhttp.onreadystatechange = function() {
				if (this.readyState == 4 && this.status == 200) {
					document.getElementById("card-modal-content").innerHTML = this.responseText;
					}
				};
				var totalprice = document.getElementById("totprce").value;

				document.getElementById("pay-card-chckout").style.visibility = "hidden";
				console.log(totalprice);
				xhttp.open("GET", "backend/paypal.php?totalprice="+totalprice, true);
				xhttp.send();
                // The payment is complete!
                // You can now show a confirmation message to the customer
            });
      },

      onCancel: function(data, actions) {
        /* 
         * Buyer cancelled the payment 
         */
      },

      onError: function(err) {
        		window.alert("Either the transaction has failed or your cart is Empty!\nPlease try to add items to your cart...");
      }
    }, '#paypal-button');
  </script>
<script src='https://code.responsivevoice.org/responsivevoice.js'></script>
</body>
</html>
<?php 
	include_once("footer.php");
?>
