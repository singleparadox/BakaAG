<?php
include_once("backend/connection.php");
include_once("header.php");
$_GET['prod_id'];
$sql = "SELECT * FROM product,inventory WHERE product.inv_id=inventory.inv_id AND prod_id=".$_GET['prod_id'];
$result = $conn->query($sql);
$result = $result->fetch_assoc();

$addToViews = "UPDATE product,inventory SET inv_views = inv_views + 1 WHERE product.inv_id=inventory.inv_id AND prod_id=".$_GET['prod_id'];
$conn->query($addToViews);

$TTS_data = $result['prod_name'].". Price. ".$result['inv_price']." . Pesos";



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
  <? echo $result['prod_picture_link'];?>
<br><br>
<div class="container-fluid">
<div class="row container-center">
	<div class="col-lg-5">
	<div class="bs-component">
	<div class="card border-primary mb-3" style="max-width: 30rem;">
  <div class="card-header"><h4 style="display: inline-block !important;"><?php echo $result['prod_name']?></h4><input class="btn btn-link" style="display: inline-block !important; cursor: pointer;" onclick='responsiveVoice.speak(<?php echo "\"".$TTS_data."\""; ?>, "Japanese Female");' type='button' value='🔊' /></div>
  <div class="card-body text-primary">
    <h4 class="card-title"></h4>
    <p class="card-text"> 
    	<?php echo '<div style="width: 350px; height: 250px;  background-image: url(\''.$result['prod_picture_link'].'\'); background-size: cover; background-repeat: no-repeat; background-position:center center;" class="img-responsive"></div>';?>
    	<div class="row small-thumbnail">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <a href="#1"><div style="width: 60px; height: 60px;  background-image: url('img/1.jpg'); background-size: cover; background-repeat: no-repeat; background-position: 50% 50%;" class="img-responsive"></div></a>&nbsp;
        <a href="#2"><div style="width: 60px; height: 60px;  background-image: url('img/2.jpg'); background-size: cover; background-repeat: no-repeat; background-position: 50% 50%;" class="img-responsive"></div></a>&nbsp;
        <a href="#3"><div style="width: 60px; height: 60px;  background-image: url('img/3.jpg'); background-size: cover; background-repeat: no-repeat; background-position: 50% 50%;" class="img-responsive"></div></a>&nbsp;
        <a href="#4"><div style="width: 60px; height: 60px;  background-image: url('img/4.jpg'); background-size: cover; background-repeat: no-repeat; background-position: 50% 50%;" class="img-responsive"></div></a>&nbsp;
    	</div>
    </p>
    </div>
  </div>
</div>
</div>
		
	<div class="col-lg-7 data-container">
	<div class="bs-component">
	<div class="card border-primary mb-3" style="max-width: 65rem;">
  <div class="card-header">Product Details</div>
  <div class="card-body text-primary">
    <h4 class="card-title">PHP <?php echo $result['inv_price']?></h4>
    <p class="card-text">
      <button type="button" class="btn btn-primary" style="cursor: pointer;" onclick="addtocart(<?php echo $result['prod_id']?>)">Add to cart</button>
    	<span class="glyphicon glyphicon-shopping-heart"></span><button type="button" style="cursor: pointer;" class="btn btn-primary">Add to wishlist</button>
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

<script type="text/javascript" src="js/funcs.js"></script>
<script src='https://code.responsivevoice.org/responsivevoice.js'></script>
</body>
</html>
<?php 
	include_once("footer.php");
?>
