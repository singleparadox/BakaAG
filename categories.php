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
	<link rel="stylesheet" type="text/css" href="css/style_categories.css">
	<link rel="stylesheet" type="text/css" href="css/style_global.css">
	
<body>
	<div id="invis-margin"></div>
	<main>

		<?php 
			$sql = "SELECT prod_genre_id, prod_genre_name, prod_genre_link FROM product_genre ORDER BY prod_genre_name ASC";
			$result = $conn->query($sql);

			while ($row = $result->fetch_assoc()) {
				$categ_id = $row['prod_genre_id'];
				$categ_name = $row['prod_genre_name'];
				$link = $row['prod_genre_link'];

				if (is_null($link)) {
					$link = "data/Category/default.svg";
				}

				echo "
					<div class='categ_container'>
						<a href='items.php?id=$categ_id'>
							<div id='image' style='background-image: url($link);'></div>
							<h4>$categ_name</h4>
						</a>
					</div>
				";
			}
		?>

		<div id="invis-margin"></div>

	</main>

	
</body>
</head>
</html>

<?php 
	include_once("footer.php");
?>