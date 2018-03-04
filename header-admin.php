<?php
if(session_status() == PHP_SESSION_NONE)
	session_start();

$error_msg = "";
if(isset($_SESSION['error_msg'])) {
	$error_msg = '<label class="show_error" style="position:absolute;">'.$_SESSION['error_msg'].'</label>';
	unset($_SESSION['error_msg']);
}
if(!isset($_SESSION['arry']))
    $_SESSION['arry']=1;
if(is_array($_SESSION['arry'])!=true){
   $_SESSION['arry'] = array();
}
?>
<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="css/bootstrap.css">
	<link rel="stylesheet" type="text/css" href="css/style_navbar.css">
	 <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.0/css/font-awesome.min.css">

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
					        </ul>
					    </div>
					</div>
				</div>
			</div>
		</nav>

		<?php
			//This code will check if the page is the homepage, if it is true, then
			//it will show the searchbox

			echo '<div class="search_container hidden" id="search_container"><div class="search" style="display: block; width: 1000px; margin: auto auto; margin-top: 10%; margin-bottom:15%;">
            <a class="close-search" id="close-search">X</a>
			<h3>Search</h3><br>
				<input class="form-control mr-sm-2" type="text" placeholder="Search" style="display:inline-block !important; width:70% !important; margin-left:5% !important;"><br>
				<button style="cursor:pointer; display:inline-block !important; margin-left:63.9%; margin-top:5px !important;" class="btn btn-secondary my-2 my-sm-0" type="submit">Search</button>
		</div></div>';
		?>
	</header>




 <!-- JQuery -->
    <script type="text/javascript" src="js/jquery-3.2.1.min.js"></script>
    <!-- Bootstrap tooltips -->
    <script type="text/javascript" src="js/popper.min.js"></script>
    <!-- Bootstrap core JavaScript -->
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
    <!-- MDB core JavaScript -->
    <script type="text/javascript" src="js/mdb.min.js"></script>
    <script type="text/javascript" src="js/funcs.js"></script>
</body>
</html>