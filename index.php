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
	<link rel="stylesheet" type="text/css" href="css/style_home.css">
	<link rel="stylesheet" type="text/css" href="css/slideshow.css">
	
<body>
	<main>
		<div class="content">
			<div class="f_products">
				<h3>FEATURED PRODUCTS</h3>

				<!-- Slideshow container -->
				<div class="slideshow-container">

				<!-- Full-width images with number and caption text -->
				<div class="mySlides">
					<div class="numbertext">1 / 3</div>
					<a href="#1"><img src="img/1.jpg" style="width:100%"></a>
					<div class="text">Caption Text</div>
				</div>

				<div class="mySlides">
					<div class="numbertext">2 / 3</div>
					<a href="#2"><img src="img/2.jpg" style="width:100%"></a>
					<div class="text">Caption Two</div>
				</div>

				<div class="mySlides">
					<div class="numbertext">3 / 3</div>
					<a href="#3"><img src="img/3.jpg" style="width:100%"></a>
					<div class="text">Caption Three</div>
				</div>

				<!-- Next and previous buttons -->
				<a class="prev" onclick="plusDivs(-1)">&#10094;</a>
				<a class="next" onclick="plusDivs(+1)">&#10095;</a>
				</div>
				<br>
			</div>

			<div class="m_popular">
				<h3>
					MOST POPULAR
				</h3>
				<div class="card" style="display:  inline-block; margin: 2px;">
					<img src="https://cdn.shopify.com/s/files/1/0377/2037/products/WhiteTanLeather.Front_1024x.jpg?v=1510683461" alt="Avatar" style="width:100%">
						
					<div class="container">
						<h4><b>Product</b></h4> 
						<p><span id='price'>PHP 0.00</span></p> 
					</div>
				</div>

				<div class="card" style="display:  inline-block; margin: 2px;">
					<img src="https://cdn.shopify.com/s/files/1/0377/2037/products/WhiteTanLeather.Front_1024x.jpg?v=1510683461" alt="Avatar" style="width:100%">
						
					<div class="container">
						<h4><b>Product</b></h4> 
						<p><span id='price'>PHP 0.00</span></p> 
					</div>
				</div>


				<div class="card" style="display:  inline-block; margin: 2px;">
					<img src="https://cdn.shopify.com/s/files/1/0377/2037/products/WhiteTanLeather.Front_1024x.jpg?v=1510683461" alt="Avatar" style="width:100%">
						
					<div class="container">
						<h4><b>Product</b></h4> 
						<p><span id='price'>PHP 0.00</span></p> 
					</div>
				</div>


				<div class="card" style="display:  inline-block; margin: 2px;">
					<img src="https://cdn.shopify.com/s/files/1/0377/2037/products/WhiteTanLeather.Front_1024x.jpg?v=1510683461" alt="Avatar" style="width:100%">
						
					<div class="container">
						<h4><b>Product</b></h4> 
						<p><span id='price'>PHP 0.00</span></p> 
					</div>
				</div>


				<div class="card" style="display:  inline-block; margin: 2px;">
					<img src="https://cdn.shopify.com/s/files/1/0377/2037/products/WhiteTanLeather.Front_1024x.jpg?v=1510683461" alt="Avatar" style="width:100%">
						
					<div class="container">
						<h4><b>Product</b></h4> 
						<p><span id='price'>PHP 0.00</span></p> 
					</div>
				</div>


				<div class="card" style="display:  inline-block; margin: 2px;">
					<img src="https://cdn.shopify.com/s/files/1/0377/2037/products/WhiteTanLeather.Front_1024x.jpg?v=1510683461" alt="Avatar" style="width:100%">
						
					<div class="container">
						<h4><b>Product</b></h4> 
						<p><span id='price'>PHP 0.00</span></p> 
					</div>
				</div>

			</div>

			<div class="flash_sales">

				<h3>
					FLASH SALES
				</h3>

				<div class="card" style="display:  inline-block; margin: 2px;">
					<img src="https://cdn.shopify.com/s/files/1/0377/2037/products/WhiteTanLeather.Front_1024x.jpg?v=1510683461" alt="Avatar" style="width:100%">
						
					<div class="container">
						<h4><b>Product</b></h4> 
						<p><span id='price'><strike>PHP 500.00</strike><br>PHP 250.00<br>50% off!</span></p> 
					</div>
				</div>


				<div class="card" style="display:  inline-block; margin: 2px;">
					<img src="https://cdn.shopify.com/s/files/1/0377/2037/products/WhiteTanLeather.Front_1024x.jpg?v=1510683461" alt="Avatar" style="width:100%">
						
					<div class="container">
						<h4><b>Product</b></h4> 
						<p><span id='price'><strike>PHP 500.00</strike><br>PHP 250.00<br>50% off!</span></p> 
					</div>
				</div>


				<div class="card" style="display:  inline-block; margin: 2px;">
					<img src="https://cdn.shopify.com/s/files/1/0377/2037/products/WhiteTanLeather.Front_1024x.jpg?v=1510683461" alt="Avatar" style="width:100%">
						
					<div class="container">
						<h4><b>Product</b></h4> 
						<p><span id='price'><strike>PHP 500.00</strike><br>PHP 250.00<br>50% off!</span></p> 
					</div>
				</div>


				<div class="card" style="display:  inline-block; margin: 2px;">
					<img src="https://cdn.shopify.com/s/files/1/0377/2037/products/WhiteTanLeather.Front_1024x.jpg?v=1510683461" alt="Avatar" style="width:100%">
						
					<div class="container">
						<h4><b>Product</b></h4> 
						<p><span id='price'><strike>PHP 500.00</strike><br>PHP 250.00<br>50% off!</span></p> 
					</div>
				</div>


				<div class="card" style="display:  inline-block; margin: 2px;">
					<img src="https://cdn.shopify.com/s/files/1/0377/2037/products/WhiteTanLeather.Front_1024x.jpg?v=1510683461" alt="Avatar" style="width:100%">
						
					<div class="container">
						<h4><b>Product</b></h4> 
						<p><span id='price'><strike>PHP 500.00</strike><br>PHP 250.00<br>50% off!</span></p> 
					</div>
				</div>


				<div class="card" style="display:  inline-block; margin: 2px;">
					<img src="https://cdn.shopify.com/s/files/1/0377/2037/products/WhiteTanLeather.Front_1024x.jpg?v=1510683461" alt="Avatar" style="width:100%">
						
					<div class="container">
						<h4><b>Product</b></h4> 
						<p><span id='price'><strike>PHP 500.00</strike><br>PHP 250.00<br>50% off!</span></p> 
					</div>
				</div>

			</div>

			<div class="categories">
				<h3>
					CATEGORIES
				</h3>

				<ul class="list-group" style="width: 31%; display: inline-block;">
					<li class="list-group-item d-flex justify-content-between align-items-center">
					Fantasy

					</li>

					<li class="list-group-item d-flex justify-content-between align-items-center">
					Action

					</li>

					<li class="list-group-item d-flex justify-content-between align-items-center">
					Harem
					</li>
				</ul>

				<ul class="list-group" style="width: 31%; display: inline-block;">
					<li class="list-group-item d-flex justify-content-between align-items-center">
					Ecchi

					</li>

					<li class="list-group-item d-flex justify-content-between align-items-center">
					Demons

					</li>

					<li class="list-group-item d-flex justify-content-between align-items-center">
					Shoujo

					</li>
				</ul>

				<ul class="list-group" style="width: 31%; display: inline-block;">
					<li class="list-group-item d-flex justify-content-between align-items-center">
					Shounen

					</li>

					<li class="list-group-item d-flex justify-content-between align-items-center">
					Josei

					</li>

					<li class="list-group-item d-flex justify-content-between align-items-center">
					Magic

					</li>
				</ul>

				<p id='more_categ'><a href="#">More Categories...</a></p>


			</div>

		</div>
	</main>
</body>

	<script type="text/javascript" src="js/slideshow.js"></script>
</head>
</html>

<?php 
	include_once("footer.php");
?>