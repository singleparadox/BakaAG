<?php
include_once("backend/connection.php");
include_once("header.php");
$_GET['prod_id'];
$sql = "SELECT * FROM product,inventory WHERE product.inv_id=inventory.inv_id AND prod_id=".$_GET['prod_id'];
$result = $conn->query($sql);
$result = $result->fetch_assoc();
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
</head>

<body>
<br><br>
<div class="container-fluid">
<div class="row">
	<div class="col-lg-4">
	<div class="bs-component">
	<div class="card border-primary mb-3" style="max-width: 30rem;">
  <div class="card-header"><h4><?php echo $result['prod_name']?></h4></div>
  <div class="card-body text-primary">
    <h4 class="card-title"></h4>
    <p class="card-text">
    	<?php echo '<img src="'.$result['prod_picture_link'].'" height="300px" width="430px" class="img-responsive">';?>
    	<div class="row">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
    		<a href="#"><img src="img/1.jpg" height="90px" width="90px" class="img-responsive"></a>&nbsp;
    		<a href="#"><img src="img/2.jpg" height="90px" width="90px" class="img-responsive"></a>&nbsp;
    		<a href="#"><img src="img/3.jpg" height="90px" width="90px" class="img-responsive"></a>&nbsp;
    		<a href="#"><img src="img/4.jpg" height="90px" width="90px" class="img-responsive"></a>&nbsp;
    	</div>
    </p>
    </div>
  </div>
</div>
</div>
		
	<div class="col-lg-8">
	<div class="bs-component">
	<div class="card border-primary mb-3" style="max-width: 65rem;">
  <div class="card-header">Product Details</div>
  <div class="card-body text-primary">
    <h4 class="card-title">$<?php echo $result['inv_price']?></h4>
    <p class="card-text">
    	<button type="button" class="btn btn-primary" onclick="addtocart(<?php echo $result['prod_id']?>)">Add to cart</button>
    	<span class="glyphicon glyphicon-shopping-heart"></span><button type="button" class="btn btn-primary">Add to wishlist</button>
    	<table class="table table-hover">
  <thead>
    <tr>
      <th scope="col">Product Type</th>
      <th scope="col">Genre</th>
      <th scope="col">Stock</th>
      <th scope="col">Rating</th>
    </tr>
  </thead>
  <tbody>
    <tr class="table-active">
      <th scope="row"><?php
              $sql2 = "SELECT prod_type_name FROM product_type WHERE prod_type_id=".$result['prod_type_id'];
              $result2 = $conn->query($sql2);
              $result2 = $result2->fetch_assoc();
              echo $result2['prod_type_name'];
          ?></th>
      <td><?php
              $sql2 = "SELECT prod_genre_name FROM product_genre WHERE prod_genre_id=".$result['prod_genre_id'];
              $result2 = $conn->query($sql2);
              $result2 = $result2->fetch_assoc();
              echo $result2['prod_genre_name'];
          ?></td>
      <td><?php
              if($result['inv_stock']>0)
                echo "In stock";
              else
                echo "Out of stock";
          ?></td>
      <td><?php echo $result['inv_rate']?></td>
    </tr>
  </tbody>
</table>
<hr>
<h4>Product Description</h4>
<p><?php echo $result['prod_desc']?></p>

    </p>
    </div>
  </div>
</div>
</div>
	
</div>
</div>
</body>
</html>
<?php 
	include_once("footer.php");
?>
