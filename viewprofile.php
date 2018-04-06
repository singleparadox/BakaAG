<?php
include_once("backend/connection.php");
include_once("header.php");

$sql ="SELECT* FROM account,account_details,account_billing,account_address WHERE account.acc_id='".$_SESSION['acc_id']."' AND account.acc_id=account_details.acc_id AND account.acc_id=account_billing.acc_id AND account.acc_id=account_address.acc_id";
$result = $conn->query($sql);
$row = $result->fetch_assoc();

if (isset($_GET['cancel'])) {
  $toCancel = $_GET['cancel'];
  $sql_order = "SELECT order_status_id AS id FROM orders WHERE order_id=".$toCancel;
  $result_order = $conn->query($sql_order);
  $fetch_order = $result_order->fetch_assoc();

  if ($fetch_order['id'] == 1) {
    $sql_cancel = "UPDATE orders SET order_status_id=4 WHERE order_id=".$toCancel;
    $conn->query($sql_cancel);
  }

}
?>
<!DOCTYPE html>
<html>
<head>
	<title>BakaAG</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="css/admin/css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="css/style_global.css">
  <link rel="stylesheet" type="text/css" href="css/style_viewprofile.css">
	<script type="text/javascript" src="js/jquery-3.2.1.min.js"></script>
</head>

<body>
<br><br>
<div class="container-fluid">
<div class="row container-center">
	<div class="col-lg-5">
	<div class="bs-component">
	<div class="card border-primary mb-3" style="max-width: 30rem;">
  <div class="card-header"><h4>Profile</h4></div>
  <div class="card-body text-primary">
    <h4 class="card-title"></h4>
    <p class="card-text">
      <ul class="nav nav-tabs">
        <li class="nav-item">
          <a class="nav-link active show" data-toggle="tab" href="#info">Basic Information</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-toggle="tab" href="#details">Details</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" data-toggle="tab" href="#billing">Billing</a>
        </li>
      </ul>

      <div id="myTabContent" class="tab-content">

        <div class="tab-pane fade active show" id="info">
          <div class="form-group row">
            <label for="acc_email" class="col-sm-4 col-form-label">Email</label>
            <div class="col-sm-10">
              <input type="text" readonly="" class="form-control-plaintext" id="acc_email" value="<?php echo $row['acc_email'];?>">
            </div>
          </div>
           <div class="form-group row">
            <label for="acc_fname" class="col-sm-4 col-form-label">First Name</label>
            <div class="col-sm-10">
              <input type="text" readonly="" class="form-control-plaintext" id="acc_fname" value="<?php echo $row['acc_fname'];?>">
            </div>
          </div>
            <div class="form-group row">
            <label for="acc_lname" class="col-sm-4 col-form-label">Last Name</label>
            <div class="col-sm-10">
              <input type="text" readonly="" class="form-control-plaintext" id="acc_lname" value="<?php echo $row['acc_lname'];?>">
            </div>
          </div>
        </div>

        <div class="tab-pane fade" id="details">
         <div class="form-group row">
            <label for="acc_Gender" class="col-sm-4 col-form-label">Gender</label>
            <div class="col-sm-10">
              <input type="text" readonly="" class="form-control-plaintext" id="acc_gender" value="<?php echo $row['acc_details_gender'];?>">
            </div>
          </div>
           <div class="form-group row">
            <label for="acc_bday" class="col-sm-4 col-form-label">Birthdate</label>
            <div class="col-sm-10">
              <input type="text" readonly="" class="form-control-plaintext" id="acc_bday" value="<?php echo $row['acc_details_bday'];?>">
            </div>
          </div>
            <div class="form-group row">
            <label for="acc_pnum" class="col-sm-4 col-form-label">Phone Number</label>
            <div class="col-sm-10">
              <input type="text" readonly="" class="form-control-plaintext" id="acc_pnum" value="<?php echo $row['acc_details_pnum'];?>">
            </div>
          </div>
        </div>

         <div class="tab-pane fade" id="billing">
         <div class="form-group row">
            <label for="acc_zip" class="col-sm-4 col-form-label">Zipcode</label>
            <div class="col-sm-10">
              <input type="text" readonly="" class="form-control-plaintext" id="acc_zip" value="<?php echo $row['address_zipcode'];?>">
            </div>
          </div>
         <div class="form-group row">
            <label for="acc_province" class="col-sm-4 col-form-label">Province</label>
            <div class="col-sm-10">
              <input type="text" readonly="" class="form-control-plaintext" id="acc_province" value="<?php echo $row['billing_province'];?>">
            </div>
          </div>
           <div class="form-group row">
            <label for="acc_country" class="col-sm-4 col-form-label">Country</label>
            <div class="col-sm-10">
              <input type="text" readonly="" class="form-control-plaintext" id="acc_country" value="<?php echo $row['billing_country'];?>">
            </div>
          </div>
            <div class="form-group row">
            <label for="acc_phonenum" class="col-sm-4 col-form-label">Phone Number</label>
            <div class="col-sm-10">
              <input type="text" readonly="" class="form-control-plaintext" id="acc_phonenum" value="<?php echo $row['billing_phonenum'];?>">
            </div>
          </div>
          <div class="form-group row">
            <label for="acc_compaddress" class="col-sm-4 col-form-label">Complete Address</label>
            <div class="col-sm-10">
              <input type="text" readonly="" class="form-control-plaintext" id="acc_compaddress" value="<?php echo $row['billing_compaddress'];?>">
            </div>
          </div>
        </div>

      </div>
    </p>
    </div>
  </div>
</div>
</div>
		
	<div class="col-lg-7 data-container">
	<div class="bs-component">
	<div class="card border-primary mb-3" style="max-width: 65rem;">
  <div class="card-header">Transactions <a class="btn btn-link" onclick="reciepts();" id="reciepts">View Reciepts</a>
    <?php 
      echo '<input id="acc_id" type="number" class="hidden" value="'.$_SESSION['acc_id'].'" >';
    ?>
  </div>
  <div class="card-body text-primary" id="main-body">
    <h4 class="card-title"></h4>
    <p class="card-text">
        <table class="table table-hover" style="">
          <thead>
            <tr class="table-primary">
              <th scope="col">Order Number</th>
              <th scope="col">Status</th>
              <th scope="col">Date</th>
              <th scope="col">Total Amount</th>
              <th scope="col">Products</th>
            </tr>
          </thead>
          <tbody>
            <?php
                $sql = "SELECT * FROM orders,order_status WHERE acc_id='".$_SESSION['acc_id']."' AND orders.order_status_id=order_status.order_status_id";
                $result = $conn->query($sql);
                while($row = $result->fetch_assoc()){ 
                  if ($row['order_status_id'] == 1) {
                    $stat = $row['order_status_name'].'<br>'.'<center><a id="cancel" onclick="cancel('.$row['order_id'].')" style="cursor:pointer; color:blue;" class="link">Cancel</a></center>';
                  } else {
                    $stat = $row['order_status_name'];
                  }

                  echo '
                      <tr>
                        <th scope="row" style="font-size:10px;">'.$row['order_id'].'</th>
                        <td style="font-size:10px;">'.$stat.'</td>
                        <td style="font-size:10px;">'.$row['order_date'].'</td>
                        <td style="font-size:10px;">'.$row['order_total_amt'].'</td>
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
                                  $prodid = explode("-", $prdct);
                                  $prodid = $prodid[0];
                                  $sql2 = "SELECT * FROM product,product_genre,product_type WHERE product.prod_id='".$prodid."' AND product.prod_genre_id=product_genre.prod_genre_id AND product.prod_type_id=product_type.prod_type_id";
                                  $result2 = $conn->query($sql2);
                                  $row2 = $result2->fetch_assoc();
                                  echo '
                                      <p class="text-primary">'.$numb.': <a href="products.php?prod_id='.$prdct.'">'.$row2['prod_name'].'</a> &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$row2['prod_genre_name'].'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;'.$row2['prod_type_name'].'</p>
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
                      </tr>
                      ';
                }
            ?>
          </tbody>
        </table> 
    </p>
    </div>
  </div>
</div>
</div>
	
</div>
</div>

<script type="text/javascript" src="js/funcs.js"></script>

<script type="text/javascript">
  function cancel(val) {
    if (window.confirm("Do you really want to cancel the order?")) { 
      window.open("viewprofile.php"+"?cancel="+val, "_self");
    }
  }

</script>
</body>
</html>
<?php 
	include_once("footer.php");
?>
