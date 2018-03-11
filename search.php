<?php
include_once("backend/connection.php");
include_once("header.php");

if (empty($_GET['page'])) {
	$_GET['page'] = 1;
}

if (empty($_GET['filter']) || is_null($_GET['filter'])) {
	$_GET['filter'] = 1;
}

if (isset($_GET['q'])) {
	$q = $_GET['q'];

	if (empty($q)) {
		echo "<center><h1>PLEASE ENTER A QUERY...</h1></center>";
		exit;
	}

	//TO DO : add queries to database, increment user views, create algorithm for page rank

	$search_sql = "SELECT * FROM search WHERE search_query='".$q."'";
	$result = $conn->query($search_sql);

	$fetch = $result->fetch_assoc();

	if (mysqli_num_rows($result) > 0) {
		$updateUserSearches = "UPDATE search SET user_searches = user_searches+1 WHERE search_query='".$q."'";
		$conn->query($updateUserSearches);
	} else {
		if (strlen($q) > 3) {
			$insertToDatabase = "INSERT INTO search (search_query, user_searches) VALUES ('".$q."', 1)";
			$conn->query($insertToDatabase);
		}
	}

} else {
	echo "<center><h1>PLEASE ENTER A QUERY...</h1></center>";
	exit;
}

?>
<!DOCTYPE html>
<html>
<head>
	<title>BakaAG</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="css/style_search.css">
	<link rel="stylesheet" type="text/css" href="css/style_global.css">
	
<body>
	<main>
	<h1 style="color: white; margin-left: 5%; margin-top: 10px;">SEARCH RESULTS</h1>

	<small style="color: white !important; display: inline-block !important;">Filter: </small>			
	<?php
		echo '
		
			<a class="btn btn-secondary" id="filter" href="search.php?q='.$q.'&page='.$_GET['page'].'&filter=1" style="display: inline-block; cursor: pointer;">Popularity</a>
			<a class="btn btn-secondary" id="filter" href="search.php?q='.$q.'&page='.$_GET['page'].'&filter=2" style="display: inline-block; cursor: pointer;">Views</a>
			<a class="btn btn-secondary" id="filter" href="search.php?q='.$q.'&page='.$_GET['page'].'&filter=3" style="display: inline-block; cursor: pointer;">Name</a>

		<br>';

	?>


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
					$sql = "SELECT *, MATCH (prod_name)
    						AGAINST ('".$q."' IN NATURAL LANGUAGE MODE WITH QUERY EXPANSION) AS search_percent
    						FROM product,inventory WHERE product.inv_id=inventory.inv_id ORDER BY search_percent DESC, inv_rate DESC LIMIT ".$offset."18";
				} elseif ($_GET['filter'] == 2) { // Views
					$sql = "SELECT *, MATCH (prod_name)
    						AGAINST ('".$q."' IN NATURAL LANGUAGE MODE WITH QUERY EXPANSION) AS search_percent
    						FROM product,inventory WHERE product.inv_id=inventory.inv_id ORDER BY search_percent DESC, inv_views DESC LIMIT ".$offset."18";
				} elseif ($_GET['filter'] == 3) { // Name
					$sql = "SELECT *, MATCH (prod_name)
    						AGAINST ('".$q."' IN NATURAL LANGUAGE MODE WITH QUERY EXPANSION) AS search_percent
    						FROM product,inventory WHERE product.inv_id=inventory.inv_id ORDER BY search_percent DESC, prod_name DESC LIMIT ".$offset."18";
				} else {
					$sql = "SELECT *, MATCH (prod_name)
    						AGAINST ('".$q."' IN NATURAL LANGUAGE MODE WITH QUERY EXPANSION) AS search_percent
    						FROM product,inventory WHERE product.inv_id=inventory.inv_id ORDER BY search_percent DESC, inv_rate DESC LIMIT ".$offset."18";
				}

				$result = $conn->query($sql);

				while($row = $result->fetch_assoc()){
					if (!($row['search_percent'] == 0)) {
						echo '<a href="products.php?prod_id='.$row['prod_id'].'"><div class="card" style="display:  inline-block; margin: 2px;">
									<img src="'.$row['prod_picture_link'].'" alt="Avatar" style="width:100%">
										
									<div class="container">
										<h4><b>'.$row['prod_name'].'</b></h4> 
										<p><span id="price">PHP '.$row['inv_price'].'.00</span></p> 
									</div>
								</div></a>';
					}
				}
			?>
			<?php
				$get_num_page_sql = "SELECT COUNT(*) AS numPages, MATCH (prod_name)
    						AGAINST ('".$q."' IN NATURAL LANGUAGE MODE WITH QUERY EXPANSION) AS search_percent
    						FROM product,inventory WHERE product.inv_id=inventory.inv_id ORDER BY search_percent DESC, inv_rate DESC LIMIT ".$offset."18";
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
									<a class="page-link" href="search?q='.$q.'&page='.$page.'&filter='.$_GET['filter'].'">&laquo;</a>
								</li>
							';		
					}

					for ($i=1; $i <= $numPages; $i++) {
						$page = $_GET['page'];
						if ($i == $page) {
							echo '
								<li class="page-item active">
									<a class="page-link" href="search?q='.$q.'&page='.$i.'&filter='.$_GET['filter'].'">'.$i.'</a>
								</li>
							';
						} else {
							echo '
								<li class="page-item">
									<a class="page-link" href="search?q='.$q.'&page='.$i.'&filter='.$_GET['filter'].'">'.$i.'</a>
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
								<a class="page-link" href="search.php?q='.$q.'&page='.$page.'&filter='.$_GET['filter'].'">&raquo;</a>
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
		</main>

</body>


</head>
</html>

<?php 
	include_once("footer.php");
?>