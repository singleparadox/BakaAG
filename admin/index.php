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
									 <a href="index.php"> <h1>BakaAG</h1> 
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
										<a href="#" class="dropdown-toggle" aria-expanded="false"  data-toggle="modal" data-target=".bs-example-modal-lg"><i class="fa fa-plus">Add a new product</i></a>
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

	<!--Add New Product-->
	<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
	  <div class="modal-dialog modal-lg" role="document">
	    <div class="modal-content">
	    	<form action="pages/backend/addproduct.php" method="POST" enctype="multipart/form-data">
	      <div class="modal-header">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title" id="myModalLabel">Add New Product</h4>
	      </div>
	      <div class="modal-body">
	      	<label for="new-prod-pic">Product Picture:</label>
				<input type="file" id="new-prod-pic" name="new-prod-pic" class="form-control-file" placeholder="Title" aria-describedby="basic-addon1">
	      	<label for="new-prod-name">Product Name:</label>
				<input type="text" id="new-prod-name" name="new-prod-name" class="form-control" placeholder="Title" aria-describedby="basic-addon1">
			<label for="new-prod-desc">Product Description:</label>
				<input type="textarea" id="new-prod-desc" name="new-prod-desc" class="form-control" placeholder="Enter Description" aria-describedby="basic-addon1">
			<label for="new-prod-genre">Product Genre:</label>
				<select class="form-control" id="new-prod-genre" name="new-prod-genre">
					<?php
						$sql = "SELECT * FROM product_genre ORDER BY prod_genre_name ASC";
						$result = $conn->query($sql);
						while($row = $result->fetch_assoc()){
							echo '<option>'.$row['prod_genre_name'].'</option>';
						}
					?>
				</select>
			<label for="new-prod-type">Product Type:</label>
				<select class="form-control" id="new-prod-type" name="new-prod-type">
					<?php
						$sql = "SELECT * FROM product_type";
						$result = $conn->query($sql);
						while($row = $result->fetch_assoc()){
							echo '<option>'.$row['prod_type_name'].'</option>';
						}
					?>
				</select>
			<label for="new-prod-price">Product Price:</label>
				<input type="number" id="new-prod-price" name="new-prod-price" class="form-control" placeholder="0" aria-describedby="basic-addon1" value="0">
			<label for="new-prod-sock">Product Stock:</label>
				<input type="number" id="new-prod-stock" name="new-prod-stock" class="form-control" placeholder="0" aria-describedby="basic-addon1" value="0">
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	        <button type="submit" class="btn btn-primary">Confirm</button>
	      </div>
	      </form>
	    </div>
	  </div>
	</div>
	<!--Add New Product End-->

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
<script src="js/myjsfuncs.js"></script>
</body>
</html>