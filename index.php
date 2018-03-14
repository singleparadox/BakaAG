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
	<link rel="stylesheet" type="text/css" href="css/style_global.css">
	
<body>
	<main>
		<div class="content">
			<div class="f_products">
				<h3 style="margin-left: 30px;">FEATURED PRODUCTS</h3>
				
				<!-- Slideshow container -->
				<div class="slideshow-container">

				<!-- Full-width images with number and caption text -->
				<div class="mySlides">
					<div class="numbertext">1 / 3</div>
					<a href="#1"><img src="img/1.jpg" style="width:100%"></a>
					<div class="text">Anime</div>
				</div>

				<div class="mySlides">
					<div class="numbertext">2 / 3</div>
					<a href="#2"><img src="img/2.jpg" style="width:100%"></a>
					<div class="text">Charlotte Merchs</div>
				</div>

				<div class="mySlides">
					<div class="numbertext">3 / 3</div>
					<a href="#3"><img src="img/3.jpg" style="width:100%"></a>
					<div class="text">Strawberry</div>
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

				<?php
					$sql = "SELECT * FROM product,inventory WHERE product.inv_id=inventory.inv_id ORDER BY inv_views DESC LIMIT 6";
					$result = $conn->query($sql);
					while($row = $result->fetch_assoc()){
						$a = $row['inv_price'] * ($row['inv_discount'] / 100);
						$b = $row['inv_price'] - $a;

						$price = number_format($b, 2);
						echo '
								<a href="products.php?prod_id='.$row['prod_id'].'"><div class="card" style="display:  inline-block; margin: 2px;">
								<img src="'.$row['prod_picture_link'].'" alt="Avatar" style="width:100%">
									
								<div class="container">
									<h4><b>'.$row['prod_name'].'</b></h4> 
									<p><span id="price">PHP '.$price.'</span></p> 
								</div>
							</div></a>
						
							';
						}
				?>
				
			</div>

			<div class="flash_sales">

				<h3>
					FLASH SALES
				</h3>
				<?php
					$sql = "SELECT * FROM product,inventory WHERE product.inv_id=inventory.inv_id AND inv_discount>'0' ORDER BY inv_rate ASC LIMIT 6";
					$result = $conn->query($sql);
					while($row = $result->fetch_assoc()){
						$discount = $row['inv_discount'] / 100;
						$discount = $row['inv_price'] * $discount;
						$saleprice = $row['inv_price'] - $discount;

						$saleprice_ = number_format($saleprice,2);
						$inv_price = number_format(($row['inv_price']),2);

						echo '
								<a href="products.php?prod_id='.$row['prod_id'].'"><div class="card" style="display:  inline-block; margin: 2px;">
								<img src="'.$row['prod_picture_link'].'" alt="Avatar" style="width:100%">
									
								<div class="container">
									<h4><b>'.$row['prod_name'].'</b></h4> 
									<p><p><span id="price"><strike>PHP '.$inv_price.'</strike><br>PHP '.$saleprice_.'<br>'.$row['inv_discount'].'% off!</span></p></p> 
								</div>
							</div></a>
						
							';
						}
				?>

			</div>

			<div class="categories">
				<h3>
					CATEGORIES
				</h3>

				<ul class="list-group" style="width: 31%; display: inline-block;">
					<?php
						$category_sql = "SELECT * FROM product_genre ORDER BY prod_genre_name ASC LIMIT 3";
						$category_result = $conn->query($category_sql);

						while ($categ_row = $category_result->fetch_assoc()) {
							$id = $categ_row['prod_genre_id'];
							$categ_1 = $categ_row['prod_genre_name'];
							if (!is_null($categ_1)) {
								echo "<a href='items.php?id=$id'><li class='list-group-item d-flex justify-content-between align-items-center'>$categ_1</li></a>";
							}
							else {
								echo "<li class='list-group-item d-flex justify-content-between align-items-center'>Empty</li>";
							}
						}
					?>

					<!--<li class="list-group-item d-flex justify-content-between align-items-center">Fantasy</li>

					<li class="list-group-item d-flex justify-content-between align-items-center">
					Action

					</li>

					<li class="list-group-item d-flex justify-content-between align-items-center">
					Harem
					</li>-->
				</ul>

				<ul class="list-group" style="width: 31%; display: inline-block;">
					<?php
						$category_sql = "SELECT * FROM product_genre ORDER BY prod_genre_name ASC LIMIT 3,3";
						$category_result = $conn->query($category_sql);

						while ($categ_row = $category_result->fetch_assoc()) {
							$id = $categ_row['prod_genre_id'];
							$categ_1 = $categ_row['prod_genre_name'];
							if (!is_null($categ_1)) {
								echo "<a href='items.php?id=$id'><li class='list-group-item d-flex justify-content-between align-items-center'>$categ_1</li></a>";
							}
							else {
								echo "<li class='list-group-item d-flex justify-content-between align-items-center'>Empty</li>";
							}
						}
					?>
				</ul>

				<ul class="list-group" style="width: 31%; display: inline-block;">
					<?php
						$category_sql = "SELECT * FROM product_genre ORDER BY prod_genre_name ASC LIMIT 6,3";
						$category_result = $conn->query($category_sql);

						while ($categ_row = $category_result->fetch_assoc()) {
							$id = $categ_row['prod_genre_id'];
							$categ_1 = $categ_row['prod_genre_name'];
							if (!is_null($categ_1)) {
								echo "<a href='items.php?id=$id'><li class='list-group-item d-flex justify-content-between align-items-center'>$categ_1</li></a>";
							}
							else {
								echo "<li class='list-group-item d-flex justify-content-between align-items-center'>Empty</li>";
							}
						}
					?>
				</ul>

				<p id='more_categ'><a href="categories.php">More Categories...</a></p>


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