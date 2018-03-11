<?php
	include_once("backend/connection.php");
	include_once("header.php");

	//This page is for the listing of items per or per not genre

	$id = $_GET['id'];


	if (empty($_GET['page'])) {
		$_GET['page'] = 1;
	}

	if (empty($_GET['filter']) || is_null($_GET['filter'])) {
		$_GET['filter'] = 1;
	}





	$sql = "SELECT prod_genre_id, prod_genre_name, prod_genre_link, prod_genre_desc FROM product_genre WHERE prod_genre_id="."'".$id."'"." ORDER BY prod_genre_name ASC";
	$result = $conn->query($sql);

	$fetch = $result->fetch_assoc();

	$categ_name = $fetch['prod_genre_name'];
	$link = $fetch['prod_genre_link'];
	$desc = "<p class='card-text'>".$fetch['prod_genre_desc']."</p>";
	$desc2 = $fetch['prod_genre_desc'];
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


		<a class="close_hidden" id="close_hidden">
			<div class="card border-primary mb-3 readmore_content" style="position: fixed; display: none; width: 500px !important;" id="read_hidden">
				<div class="card-header"><h4>DESCRIPTION</h4></div>

				<div class="card-body readmore_content_inner">
				<?php
					echo $desc;
				?>
				</div>

			</div>
		</a>

		<div class="categ_desc">
				<?php
					if (is_null($link)) {
						$link = "data/Category/default.svg";
					}

					if (strlen($desc2) > 250) {
						$read = "<a class='read_more' id='read_more'>Read More</a>";
					} else {
						$read = "";
					}

					$truncated = (strlen($desc2) > 20) ? substr($desc2, 0, 450) . '...' : $desc2;
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

			<div class="m_popular">

			<?php 
				echo "
					<h3>
						".$fetch['prod_genre_name']." PRODUCTS
					</h3>
				";

			?>

			<div>
			<span>
			<small style="color: white !important; display: inline-block !important;">Filter: </small>			
			<?php
				echo '
				
					<a class="btn btn-secondary" id="filter" href="items.php?id='.$id.'&page='.$_GET['page'].'&filter=1" style="display: inline-block; cursor: pointer;">Popularity</a>
					<a class="btn btn-secondary" id="filter" href="items.php?id='.$id.'&page='.$_GET['page'].'&filter=2" style="display: inline-block; cursor: pointer;">Views</a>
					<a class="btn btn-secondary" id="filter" href="items.php?id='.$id.'&page='.$_GET['page'].'&filter=3" style="display: inline-block; cursor: pointer;">Name</a>

				';

			?>
			</span>
			</div>


			<?php
				if (isset($_GET['page'])) {
					if ($_GET['page'] == 1) {
						$zero = 0;
						$offset = $zero.',';
					}
					else if ($_GET['page'] == 2) {
						$eighteen = 18;
						$offset = $eighteen.',';
					} else {
						$page = ($_GET['page'] * 18) - 18;
						$offset = $page.',';
					}
				} else {
					$offset = '';
				}

				if ($_GET['filter'] == 1) { // Popularity
					$sql = "SELECT * FROM product,inventory WHERE product.inv_id=inventory.inv_id AND product.prod_genre_id=".$id." ORDER BY inv_rate DESC LIMIT ".$offset."18";
				} elseif ($_GET['filter'] == 2) { // Views
					$sql = "SELECT * FROM product,inventory WHERE product.inv_id=inventory.inv_id AND product.prod_genre_id=".$id." ORDER BY inv_views DESC LIMIT ".$offset."18";
				} elseif ($_GET['filter'] == 3) { // Name
					$sql = "SELECT * FROM product,inventory WHERE product.inv_id=inventory.inv_id AND product.prod_genre_id=".$id." ORDER BY prod_name ASC LIMIT ".$offset."18";
				} else {
					$sql = "SELECT * FROM product,inventory WHERE product.inv_id=inventory.inv_id AND product.prod_genre_id=".$id." ORDER BY inv_views DESC LIMIT ".$offset."18";
				}

				$result = $conn->query($sql);

				while($row = $result->fetch_assoc()){
					echo '<a href="products.php?prod_id='.$row['prod_id'].'"><div class="card" style="display:  inline-block; margin: 2px;">
								<img src="'.$row['prod_picture_link'].'" alt="Avatar" style="width:100%">
									
								<div class="container">
									<h4><b>'.$row['prod_name'].'</b></h4> 
									<p><span id="price">PHP '.$row['inv_price'].'.00</span></p> 
								</div>
							</div></a>';
				}
			?>
			<?php
				$get_num_page_sql = "SELECT COUNT(prod_id) AS numPages FROM product WHERE prod_genre_id=".$id;
				$page_res = $conn->query($get_num_page_sql);

				if (isset($_GET['page'])) {
					$page = $_GET['page'];
					$fetch_page = $page_res->fetch_assoc();
					$numPages = ceil($fetch_page['numPages'] / 18);

					echo '
						<ul class="pagination pagination-sm">
						';		


					if ($page == 1) {
						echo '
								<li class="page-item disabled">
									<a class="page-link" href="#">&laquo;</a>
								</li>
							';		
					} else {
						$page = $_GET['page'] - 1;
						echo '
								<li class="page-item">
									<a class="page-link" href="items.php?id='.$id.'&page='.$page.'&filter='.$_GET['filter'].'">&laquo;</a>
								</li>
							';		
					}

					for ($i=1; $i <= $numPages; $i++) {
						$page = $_GET['page'];
						if ($i == $page) {
							echo '
								<li class="page-item active">
									<a class="page-link" href="items.php?id='.$id.'&page='.$i.'&filter='.$_GET['filter'].'">'.$i.'</a>
								</li>
							';
						} else {
							echo '
								<li class="page-item">
									<a class="page-link" href="items.php?id='.$id.'&page='.$i.'&filter='.$_GET['filter'].'">'.$i.'</a>
								</li>
							';	
						}
					}

					//$page = $_GET['page'];
					if ($page == $numPages) {
						echo '
							<li class="page-item disabled">
								<a class="page-link" href="#">&raquo;</a>
							</li>
						';
					} else {
						$page = $_GET['page'] + 1;
						echo '
							<li class="page-item">
								<a class="page-link" href="items.php?id='.$id.'&page='.$page.'&filter='.$_GET['filter'].'">&raquo;</a>
							</li>
						';
					}

					echo '
						</ul>
						';					




				} else {
					$fetch_page = $page_res->fetch_assoc();
					$numPages = ceil($fetch_page['numPages'] / 18);
			
					echo '
						<ul class="pagination pagination-sm">
							<li class="page-item disabled">
								<a class="page-link" href="#">&laquo;</a>
							</li>';
					for ($i=1; $i <= $numPages; $i++) { 
						if ($i == 1) {
							echo '
								<li class="page-item active">
									<a class="page-link" href="items.php?id='.$id.'&page='.$i.'&filter='.$_GET['filter'].'">1</a>
								</li>
							';
						} else {
							echo '
								<li class="page-item">
									<a class="page-link" href="items.php?id='.$id.'&page='.$i.'&filter='.$_GET['filter'].'">'.$i.'</a>
								</li>
							';
						}

					}
					
					echo '<li class="page-item">
								<a class="page-link" href="items.php?id='.$id.'&page=2&filter='.$_GET['filter'].'">&raquo;</a>
							</li>
						</ul>
						';

				}

			?>

			</div>


	</main>
	
</body>
</head>
</html>

<script type="text/javascript">
	var readmore = document.getElementById("read_more");
	var hidden_div = document.getElementById("read_hidden");
	var close = document.getElementById("close_hidden");

	readmore.onclick = function(e) {

		hidden_div.style.display = 'block';
	}

	close.onclick = function(e) {
		hidden_div.style.display = 'none';
	}


</script>

<?php 
	include_once("footer.php");
?>