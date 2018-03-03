<?php
	include_once("backend/connection.php");
	include_once("header.php");

	//This page is for the listing of items per or per not genre

	$id = $_GET['id'];

	$sql = "SELECT prod_genre_id, prod_genre_name, prod_genre_link, prod_genre_desc FROM product_genre WHERE prod_genre_id="."'".$id."'"." ORDER BY prod_genre_name ASC";
	$result = $conn->query($sql);

	$fetch = $result->fetch_assoc();

	$categ_name = $fetch['prod_genre_name'];
	$link = $fetch['prod_genre_link'];
	$desc = $fetch['prod_genre_desc'];
?>

<!DOCTYPE html>
<html>
<head>
	<title>BakaAG</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="css/style_items.css">
	<link rel="stylesheet" type="text/css" href="css/style_global.css">
	
<body>
		
	</div>
	<main>
		<div class="readmore_content hidden" id="read_hidden">
			<a class="close_hidden" id="close_hidden">X</a>
			<h4>DESCRIPTION</h4>

			<div class="readmore_content_inner">
			<?php
				echo $desc;
			?>
			</div>

		</div>

		<div class="categ_desc">
				<?php
					if (is_null($link)) {
						$link = "data/Category/default.svg";
					}

					if (strlen($desc) > 250) {
						$read = "<a class='read_more' id='read_more'>Read More</a>";
					} else {
						$read = "";
					}

					$truncated = (strlen($desc) > 20) ? substr($desc, 0, 450) . '...' : $desc;
					echo "
							<div id='image' style='background-image: url($link);'></div>
							<h4>$categ_name</h4>
							<p>$truncated ".$read."</p>

					";

				?>

		</div>

		<div class="content">
			
			<div class="m_popular">
				<?php 
					$sql_check  = "SELECT * FROM product WHERE product.prod_genre_id=".$id;
					$res = $conn->query($sql_check);
					$fetch_test = $res->fetch_assoc();
					if (!is_null($fetch_test['prod_id']) || !empty($fetch_test['prod_id'])) {
						echo "
						<h3>
							MOST POPULAR
						</h3>
						";
					}
				?>


				<?php
					$sql = "SELECT * FROM product,inventory WHERE product.inv_id=inventory.inv_id AND product.prod_genre_id=".$id." ORDER BY inv_rate ASC LIMIT 6";
					$result = $conn->query($sql);
					while($row = $result->fetch_assoc()){
						echo '
								<a href="products.php?prod_id='.$row['prod_id'].'"><div class="card" style="display:  inline-block; margin: 2px;">
								<img src="'.$row['prod_picture_link'].'" alt="Avatar" style="width:100%">
									
								<div class="container">
									<h4><b>'.$row['prod_name'].'</b></h4> 
									<p><span id="price">PHP '.$row['inv_price'].'.00</span></p> 
								</div>
							</div></a>
						
							';
						}
				?>
				
			</div>

			<?php
				$sql = "SELECT * FROM product,inventory WHERE product.inv_id=inventory.inv_id AND product.prod_genre_id=".$id." ORDER BY inv_rate ASC LIMIT 10";
				$result = $conn->query($sql);

				while($row = $result->fetch_assoc()){
					echo "
						<a href='"."products.php?prod_id=".$row['prod_id']."'>
							<div class='products'>
							<img src='".$row['prod_picture_link']."' alt=Avatar >

							<h2>".$row['prod_name']."</h2>
							<h2><span id='price'>PHP ".$row['inv_price']."</span></h2> 

						</div></a>

					";
				}
			?>

			<h1 style="color: white;">PAGINAGTION GOES HERE</h1>

	</main>
	
</body>
</head>
</html>

<script type="text/javascript">
	var readmore = document.getElementById("read_more");
	var hidden_div = document.getElementById("read_hidden");
	var close = document.getElementById("close_hidden");

	readmore.onclick = function(e) {

		hidden_div.classList.remove("hidden");
	}

	close.onclick = function(e) {
		hidden_div.classList.add("hidden");
	}

</script>

<?php 
	include_once("footer.php");
?>