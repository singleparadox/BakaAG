<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="css/style_navbar.css">
</head>
<body>
	<header>
		<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
			<a class="navbar-brand" href="index.php">Baka<span id="logo">AG</span></a>
				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
				</button>

				<div class="collapse navbar-collapse justify-content-end" id="navbarColor01" style="margin-right: 15px;">
					<div class="menu-wrap">
					    <div class="menu">
					        <ul class="clearfix">

					            <li>
					                <a href="#"><img id="profile_logo" src="img/profile.png"></a>

					                <ul class="sub-menu">
					                    <li><a href="#">Profile</a></li>
					                    <li><a href="#">Settings</a></li>
					                    <li><a href="#">Logout</a></li>
					                </ul>
					            </li>
					        </ul>
					    </div>
					</div>
				</div>
			</div>
		</nav>

		<?php
			//This code will check if the page is the homepage, if it is true, then
			//it will show the searchbox

			$search = '<div class="search_container"><div class="search" style="display: block; width: 1000px; margin: auto auto; margin-top: 10%; margin-bottom:15%;">
			<h3>Search</h3><br>
			<form class="form-inline my-2 my-lg-0">
				<input class="form-control mr-sm-2" type="text" placeholder="Search" style="width: 80%;">
				<button style="cursor:pointer;" class="btn btn-secondary my-2 my-sm-0" type="submit">Search</button>
			</form>
		</div></div>';
			if (basename($_SERVER['PHP_SELF']) == "index.php") {
				echo $search;
			} 
		?>
	</header>

</body>
</html>