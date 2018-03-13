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
  <link rel="stylesheet" type="text/css" href="css/style_wishlist.css">
    <link rel="stylesheet" type="text/css" href="css/style_global.css">
	<script type="text/javascript" src="js/jquery-3.2.1.min.js"></script>
</head>

<body>

  <div class="main-table">
    <center><strong><h1>WISHLIST</h1></strong></center>
    <table class="table table-hover">
      <thead>
        <tr>
          <th scope="col">Type</th>
          <th scope="col">Title</th>
          <th scope="col">Price</th>
          <th scope="col">Link</th>
          <th scope="col">Remove</th>
        </tr>
      </thead>

      <tbody>
      <?php
        
        if (isset($_SESSION['acc_id'])) {
          $uid = $_SESSION['acc_id'];

          $sql = "SELECT * FROM product,product_type,inventory,wishlist WHERE wishlist.acc_id=".$uid." AND wishlist.prod_id=product.prod_id AND inventory.inv_id=product.inv_id AND product.prod_type_id=product_type.prod_type_id ORDER BY product.prod_name ASC";
          $result = $conn->query($sql);
          $i = 0;
          while ($row = $result->fetch_assoc()) {
            echo '
              <tr id="wishlist-row-'.$i.'" class="table-light">
                <td>'.$row['prod_type_name'].'</td>
                <th scope="row">'.$row['prod_name'].'</th>
                <td>PHP '.number_format($row['inv_price'],2).'</td>
                <td><a target="_blank" style=" color:blue !important;" href="products.php?prod_id='.$row['prod_id'].'">LINK</a></td>
                <td><a style="cursor:pointer;  color:red !important;" onclick="remove_row('."'wishlist-row-".$i."'".')">X</a></td>
                <input id="acc_id" type="number" class="hidden" value="'.$_SESSION['acc_id'].'" >
                <input id="prod_id" type="number" class="hidden" value="'.$row['prod_id'].'" >
              </tr>
          ';
          $i++;
          }

        }



      ?>
      </tbody>
    </table>
    <?php


    ?>
  </div>

<script type="text/javascript" src="js/funcs.js"></script>
<script src='https://code.responsivevoice.org/responsivevoice.js'></script>
</body>
</html>
<?php 
	include_once("footer.php");
?>
