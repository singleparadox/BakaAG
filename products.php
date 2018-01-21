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
</head>

<body>
<br><br>
<div class="container-fluid">
<div class="row">
	<div class="col-lg-4">
	<div class="bs-component">
	<div class="card border-primary mb-3" style="max-width: 30rem;">
  <div class="card-header">Product Title</div>
  <div class="card-body text-primary">
    <h4 class="card-title"></h4>
    <p class="card-text">
    	<img src="img/2.jpg" height="300px" width="430px" class="img-responsive">
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
    <h4 class="card-title">$1000</h4>
    <p class="card-text">
    	<button type="button" class="btn btn-primary">Add to cart</button>
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
      <th scope="row">Anime</th>
      <td>Mystery</td>
      <td>In stock</td>
      <td>5.0</td>
    </tr>
  </tbody>
</table>
<hr>
<h4>Product Description</h4>
<p>Veeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeerrrrrrrrrrrrrrrrrrrryyyyyyyyyyyyyyyyyyyyyy looooooooooooooooooooonnnnnnnnnngggggggggg description.</p>

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
