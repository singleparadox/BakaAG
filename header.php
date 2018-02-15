<?php
if(session_status() == PHP_SESSION_NONE)
	session_start();

$error_msg = "";
if(isset($_SESSION['error_msg'])) {
	$error_msg = '<label class="show_error" style="position:absolute;">'.$_SESSION['error_msg'].'</label>';
	unset($_SESSION['error_msg']);
}
?>
<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="css/style_navbar.css">
</head>
<body>
	<header>
			<?php
				if(isset($_SESSION['acc_type_id'])) 
					if(($_SESSION['acc_type_id'])==2)
						echo '<div style="background-color: green"><center><a href="admin/index.php" class="btn btn-primary"> Go to Admin Panel</a></center></div>';
			?>
		<nav class="navbar navbar-expand-lg navbar-dark bg-primary">
			<a class="navbar-brand" href="index.php">Baka<span id="logo">AG</span></a>
				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
				</button>

				<div class="collapse navbar-collapse justify-content-end" id="navbarColor01" style="margin-right: 15px;">
					<div class="menu-wrap">
					    <div class="menu">
					        <ul class="clearfix">

					        	<?php
					        		if (isset($_SESSION['acc_id'])) { // Delete this and uncomment below to get back old code...
					        			echo '
					        				<li>
					                			<a href="#"><img id="profile_logo" src="img/profile.png"></a>
					                				<ul class="sub-menu">
					                    				<li><a href="#">Profile</a></li>
					                    				<li><a href="#">Settings</a></li>
					                    				<li><a href="backend/logout.php">Logout</a></li>
					                				</ul>
					            			</li>';
					        		}
					        		else {
					        			echo '
											<li class="nav-item login">
												<a class="" href="login.php">Login</span></a>
											</li>';
					        		} // Delete until this line

					        		/*if(isset($_SESSION['acc_id']))
					        			echo '
					        				<li>
					                			<a href="#"><img id="profile_logo" src="img/profile.png"></a>
					                				<ul class="sub-menu">
					                    				<li><a href="#">Profile</a></li>
					                    				<li><a href="#">Settings</a></li>
					                    				<li><a href="#">Logout</a></li>
					                				</ul>
					            			</li>';
					            	else
					            		echo '
					            			<li>
					                			<a href="#"><img id="profile_logo" src="img/profile.png"></a>
					                				<ul class="sub-menu">
					                					<form action="backend/validate.php" method="POST">
					                    						<li><label for="username">Email</label>
							<input placeholder="Enter Email" type="text" id="username" name="username" /></li>
					                    						<li><label for="username">Password</label>
							<input placeholder="Enter Password" type="password" id="password" name="password" /></li>
					                    						<li><button type="submit" style="cursor:pointer;" class="btn btn-secondary">Submit</button></li>
					                    				</form>
					                				</ul>
					            			</li>
					            			';*/
					        	?>
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