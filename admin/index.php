<?php
	session_start();
	include "../backend/connection.php";
	$acc_id = $_SESSION['acc_id'];
	if($acc_id==NULL){
		header("Location:../index.php");
	}
	$sqlacc = "SELECT * FROM account WHERE acc_id=$acc_id";
	$resultacc = $conn->query($sqlacc);
	$rowacc = $resultacc->fetch_assoc()
?><!DOCTYPE html>
<html>
<head>
	<title>BakaAG: Admin Panel</title>
	<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
	<link href="css/bootstrap.css" rel="stylesheet" type="text/css" media="all">
	<!-- Custom Theme files -->
	<link href="css/style.css" rel="stylesheet" type="text/css" media="all"/>
	<!--js-->
	<script src="js/jquery-2.1.1.min.js"></script> 
	<!--icons-css-->
	<link href="css/font-awesome.css" rel="stylesheet">
	<!--static chart-->
	<script src="js/Chart.min.js"></script>
</head>
<body>
<div class="page-container">	
   <div class="left-content">
	   <div class="mother-grid-inner">
				<!--header start here-->
				<div class="header-main">
					<div class="header-left">
							<div class="logo-name">
									 <a href="index.php"> <h1>BakaAG</h1> 
									<!--<img id="logo" src="" alt="Logo"/>--> 
								  </a> 								
							</div>
							<div class="clearfix"> </div>
						</div>
						<div class="header-right">
							<div class="profile_details_left">
								<div class="clearfix"> </div>
							</div>
							<!--notification menu end -->
							<div class="clearfix"> </div>				
						</div>
				     <div class="clearfix"> </div>	
				</div>
				<!--Header end-->
				<script>
					$(document).ready(function() {
						var navoffeset=$(".header-main").offset().top;
						$(window).scroll(function(){
							var scrollpos=$(window).scrollTop(); 
							if(scrollpos >=navoffeset){
								$(".header-main").addClass("fixed");
							}else{
								$(".header-main").removeClass("fixed");
							}
			 			});
					});
				</script>


<!-- - - Main Pages Start Here - - -->
	<div class="main-page" id="main-page">
		<?php
			if($_SESSION['acc_type_id']==2) 
				include "pages/dashboard.php";
			elseif($_SESSION['acc_type_id']==3)
				include "pages/warehouse.php";
			else

		?>
	</div>
<div class="copyrights">
				 <p>© Papina-Perez Corporation 2018 BakaAG. All Rights Reserved</p>
			</div>
		</div>
	</div>
<!-- - - Main Pages End - - -->


<!--slider menu-->
    <div class="sidebar-menu">	
		    <div class="menu">
		      <ul id="menu">
		        <li id="menu-home" ><a href="#"><i class="fa fa-"><img src="../img/maki.png" height="170px" width="170px"></i><span><?php echo $rowacc['acc_fname']." "; echo $rowacc['acc_lname']?></span></a></li>
		        <li><a href="#"><i class="fa fa-cogs"></i><span>Account Settings</span></a></li>
		        <li id="menu-home" ><a href="pages/backend/admin-logout.php"><i class="fa fa-home"></i><span>Logout</span></a></li>
		      </ul>
		    </div>
	 </div>
	<div class="clearfix"> </div>
</div>
<!--slide bar menu end here-->



<!--JavaScripts-->
<script src="js/jquery.nicescroll.js"></script>
<script src="js/scripts.js"></script>
<script src="js/bootstrap.js"> </script>
<script src="js/myjsfuncs.js"></script>
</body>
</html>