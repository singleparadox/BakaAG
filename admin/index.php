<?php
	session_start();
	include "../backend/connection.php";
	$acc_id = $_SESSION['acc_id'];
	if($acc_id==NULL){
		header("Location:../index.php");
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
										<a href="#" class="dropdown-toggle" aria-expanded="false"  data-toggle="modal" data-target=".product_modal"><i class="fa fa-plus">Add a new product</i></a>
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
	<div class="modal fade bs-example-modal-lg product_modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
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
			<div class="form-row">
			<div class="form-group col-md-3">
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
			</div>
			<div class="form-group col-md-3">
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
			</div>
			<div class="form-group col-md-3">
			<label for="new-prod-price">Product Price:</label>
				<input type="number" id="new-prod-price" name="new-prod-price" class="form-control" placeholder="0" aria-describedby="basic-addon1" value="0">
			</div>
			<div class="form-group col-md-3">
			<label for="new-prod-sock">Product Stock:</label>
				<input type="number" id="new-prod-stock" name="new-prod-stock" class="form-control" placeholder="0" aria-describedby="basic-addon1" value="0">
			</div>
		  </div>
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

	<!--Add New Category-->
	<div class="modal fade bs-example-modal-lg category" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
		<a class="btn link" id="edit-button">EDIT MODE</a>
	  <div class="modal-dialog modal-lg" role="document">
	    <div class="modal-content" id="removeAdd">
	    	<form action="pages/backend/addcategory.php" method="POST" enctype="multipart/form-data" id="toBeremoved">
	      <div class="modal-header" id="toBeremoved">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title" id="myModalLabel">Add New Category</h4>
	      </div>
	      <div class="modal-body" id="toBeremoved">
	      	<label for="new-categ-pic">Category Picture:</label>
				<input type="file" id="new-categ-pic" name="new-categ-pic" class="form-control-file" aria-describedby="basic-addon1">
	      	<label for="new-categ-name">Category Name:</label>
				<input type="text" id="new-categ-name" name="new-categ-name" class="form-control" placeholder="Title" aria-describedby="basic-addon1">
			<label for="new-categ-desc">Category Description:</label>
				<input type="textarea" id="new-categ-desc" name="new-categ-desc" class="form-control" placeholder="Enter Description" aria-describedby="basic-addon1">
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	        <button type="submit" class="btn btn-primary">Confirm</button>
	      </div>
	      </form>
	  	</div>

	      <!--EDIT (UNDER CONSTRUCTION)-->
	      <div class="modal-content"  id="edit-content" style="display: none;">
	    	<form action="pages/backend/updatecategory.php" method="POST" enctype="multipart/form-data">
	      <div class="modal-header" id="">
	        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
	        <h4 class="modal-title" id="myModalLabel">Edit Category</h4>
	      </div>
	      <div class="modal-body" id="">
	      	<label for="new-categ-pic">Edit Category Picture:</label>
	      	<input type="file" id="new-categ-pic" name="new-categ-pic" class="form-control-file" aria-describedby="basic-addon1">
	      	<label for="new-categ-name"> Edit Category Name:</label><br>
			<select type="text" id="new-categ-name" name="new-categ-name" onchange="changeInputData(this)" class="form-control" placeholder="Title" aria-describedby="basic-addon1" style="display:inline-block;width: 30%">
				<option value="none">Select Category</option>
				<?php
					$sql = "SELECT prod_genre_id AS id, prod_genre_name AS genre FROM product_genre ORDER BY prod_genre_name ASC";
					$res = $conn->query($sql);

					while ($row = $res->fetch_assoc()) {
						echo "<option value='".$row['id']."'>".$row['genre']."</option>";
					}
				?>
			</select>

			<input type="text" id="new-categ-new-name" name="new-categ-new-name" class="form-control" placeholder="New Name" aria-describedby="basic-addon1" style="display: inline-block; width: 69.49%;">


			<label for="new-categ-desc">Edit Category Description:</label>
				<input type="textarea" id="new-categ-desc" name="new-categ-desc" class="form-control" placeholder="Enter Description" aria-describedby="basic-addon1">
	      </div>
	      <div class="modal-footer">
	        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
	        <button type="submit" class="btn btn-primary">Confirm</button>
	      </div>
	      </form>

	      </div>
	      <script type="text/javascript">
			var a = document.getElementById('edit-button');
			var edit = document.getElementById("edit-content");
			var myElement = document.getElementById('removeAdd');

			var currName = document.getElementById('new-categ-name');
			var editInput = document.getElementById('new-categ-new-name');

			function changeInputData (e) {
				document.getElementById('new-categ-new-name').value = e.options[e.selectedIndex].text;
			}


			a.onclick = function(e) {
				if (this.innerHTML == "GO BACK") {
					this.innerHTML = "EDIT MODE";
					edit.style.display = "none";
					myElement.style.display = "block";
				}

				else {
					this.innerHTML = "GO BACK";
					myElement.style.display = "none";
					edit.style.display = "block";
				}
				
				
				//myElement.style.visibility = "hidden";

			};
	      </script>
	    </div>
	  </div>
	</div>
	<!--Add New Category End-->

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
					<li>
						<a href="#"  data-toggle="modal" data-target=".category">Add Category</a>
					</li>		            
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