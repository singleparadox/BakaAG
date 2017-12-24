<?php
	session_start();
	include "../backend/connection.php";
	$acc_id = $_SESSION['acc_id'];
	if($acc_id==NULL){
		header("Location:../templogin.php");
	}
	$sql = "SELECT * FROM account WHERE acc_id=$acc_id";
	$result = $conn->query($sql);
	$row = $result->fetch_assoc()
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
									 <a href="index.html"> <h1>BakaAG</h1> 
									<!--<img id="logo" src="" alt="Logo"/>--> 
								  </a> 								
							</div>
								<!--search-box-->
								<div class="search-box">
									<form>
										<input type="text" placeholder="Search..." required="">	
										<input type="submit" value="">					
									</form>
								</div>
								<!--//end-search-box-->
							<div class="clearfix"> </div>
						</div>
						<div class="header-right">
							<div class="profile_details_left">
								<!--notifications of menu start -->
								<ul class="nofitications-dropdown">
									<li class="dropdown head-dpdn">
										<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false"><i class="fa fa-bell"></i><span class="badge blue">3</span></a>
										<ul class="dropdown-menu">
											<li>
												<div class="notification_header">
													<h3>You have 3 new notification</h3>
												</div>
											</li>
											 <li><a href="#">
												<div class="user_img"><img src="images/p7.png" alt=""></div>
											   <div class="notification_desc">
												<p>Lorem ipsum dolor</p>
												<p><span>1 hour ago</span></p>
												</div>
											   <div class="clearfix"></div>	
											 </a></li>
											 <li>
												<div class="notification_bottom">
													<a href="#">See all notifications</a>
												</div> 
											</li>
										</ul>
									</li>		
								</ul>
								<div class="clearfix"> </div>
							</div>
							<!--notification menu end -->
							<!--Profile menu start-->
							<div class="profile_details">		
								<ul>
									<li class="dropdown profile_details_drop">
										<a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
											<div class="profile_img">	
												<span class="prfil-img"><img src="images/p1.png" alt=""> </span> 
												<div class="user-name">
													<p><?php echo $row['acc_fname']." "; echo $row['acc_lname']?></p>
													<span>Administrator</span>
												</div>
												<i class="fa fa-angle-down lnr"></i>
												<i class="fa fa-angle-up lnr"></i>
												<div class="clearfix"></div>	
											</div>	
										</a>
										<ul class="dropdown-menu drp-mnu">
											<li> <a href="#"><i class="fa fa-cog"></i> Settings</a> </li> 
											<li> <a href="#"><i class="fa fa-user"></i> Profile</a> </li> 
											<li> <a href="../backend/logout.php"><i class="fa fa-sign-out"></i> Logout</a> </li>
										</ul>
									</li>
								</ul>
							</div>
							<!--Profile menu end-->
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
		<?php include "pages/dashboard.php";?>
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
		      <ul id="menu" >
		        <li id="menu-home" ><a href="../index.php"><i class="fa fa-home"></i><span>Return to Store</span></a></li>
		        <li id="menu-home" ><a href="index.php"><i class="fa fa-tachometer"></i><span>Dashboard</span></a></li>
		        <li><a href="#Products" onclick="chPage()"><i class="fa fa-cogs"></i><span>Products</span><span class="fa fa-angle-right" style="float: right"></span></a>
		          <ul>
		            <li><a href="#">Anime</a></li>
		            <li><a href="#">Game</a></li>		            
		          </ul>
		        </li>
		        <li id="menu-home" ><a href="#"><i class="fa fa-user"></i><span>User Accounts</span></a></li>
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
<script src="js/pageswitcher.js"></script>
</body>
</html>