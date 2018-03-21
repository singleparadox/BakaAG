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

					        	<?php
					        		if (isset($_SESSION['acc_id'])) {
					        			echo '
                                            <li><a class="search-btn" id="search-btn">Search</span></a></li>
                                            <li><a class="login-button" id="cart_button" data-toggle="modal" data-target="#cartModal" style="cursor:pointer;" >Cart</span></a></li>
					        				<li>
					                			<a href="#"><img id="profile_logo" src="img/profile.png"></a>
					                				<ul class="sub-menu">
					                    				<li><a href="viewprofile.php">Profile</a></li>
                                                        <li><a href="wishlist.php">Wishlist</a></li>
					                    				<li><a href="#">Settings</a></li>
					                    				<li><a href="backend/logout.php">Logout</a></li>
					                				</ul>
					            			</li>';
					        		}
					        		else {
					        			echo '
                                            <li><a class="search-btn" id="search-btn">Search</span></a></li>
					        				<li><a class="login-button" id="cart_button" data-toggle="modal" data-target="#cartModal" style="cursor:pointer;" >Cart</span></a></li>
											<li class="nav-item login">
                      	<a class="login-button" id="login_button" data-toggle="modal" data-target="#loginModal" >Login</span></a>
											</li>
                                            ';
					        		} 
					        	?>
					        </ul>
					    </div>
					</div>
				</div>
			</div>
		</nav>



    <div class="search_container hidden" id="search_container">
        <div class="search" style="display: block; width: 1000px; margin: auto auto; margin-top: 10%; margin-bottom:15%;">
                <a class="close-search" id="close-search">X</a>
    			<h3>Search</h3><br>
    			<input id="search_input" onkeyup="showSearchHint(this.value);" autocomplete="off" class="form-control mr-sm-2" type="text" placeholder="Search" style="display:inline-block !important; width:70% !important; margin-left:5% !important;" >
                <div style="position:fixed !important;z-index: 300 !important; margin-left: 5% !important; width: 550px !important;" id='txtHint'></div>

                <br>
    			<a id="search_button" style="cursor:pointer; display:inline-block !important; margin-left:63.9%; margin-top:5px !important;" class="btn btn-primary my-2 my-sm-0" type="submit" >Search</a>
        </div>
    </div>

	</header>


	<!--Login Modal-->
	 <div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog cascading-modal" role="document">
            <!--Content-->
            <div class="modal-content">
                <!--Modal cascading tabs-->
                <div class="modal-c-tabs">
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs tabs-2 light-blue darken-3" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="tab" href="#panel7" role="tab"><i class="fa fa-user mr-1"></i> Login</a>
                        </li>
                    </ul>
                    <!-- Tab panels -->
                    <div class="tab-content">
                        <!--Panel 7-->
                        <div class="tab-pane fade in show active" id="panel7" role="tabpanel">
    						<form id="login" action="backend/validate.php" method="POST">
                            <!--Body-->
                            <div class="modal-body mb-1">
                                <div class="md-form form-sm">
                                    <i class="fa fa-envelope prefix"></i>
                                    <label for="username">Your Email</label>
                                    <input type="text" class="form-control" id="exampleInputEmail1 username" name="username" aria-describedby="emailHelp" placeholder="Enter Username" required>
                                    
                                </div>
    
                                <div class="md-form form-sm">
                                    <i class="fa fa-lock prefix"></i>
                                    <label for="password">Your Password</label>
                                    <input type="password" class="form-control" id="exampleInputPassword1" name="password" placeholder="Password" required>
                                    
                                </div>
                                <div class="text-center mt-2">
                                    <button type="submit" style="cursor:pointer;" class="btn btn-info">Log in <i class="fa fa-sign-in ml-1"></i></button>
                                </div>
                            </div>
                            </form>
                            <!--Footer-->
                            <div class="modal-footer display-footer">
                                <div class="options text-center text-md-right mt-1">
                                    <p>Not a member? <a href="register.php" class="blue-text">Sign Up</a></p>
                                    <p>Forgot <a href="#" class="blue-text">Password?</a></p>
                                </div>
                                <button style="cursor: pointer;" type="button" class="btn btn-outline-info waves-effect ml-auto" data-dismiss="modal">Close</button>
                            </div>
    
                        </div>
                    </div>
    
                </div>
            </div>
            <!--/.Content-->
        </div>
    </div>
  <!--Login Modal End-->

<!-- Modal: modalCart -->
<div class="modal fade" id="cartModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <!--Header-->
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel">Your cart</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <!--Body-->
            <div class="modal-body">
            	<div id="user-cart">
                <?php
                   $num = 0;
                    $sql = "SELECT * FROM product,inventory WHERE inventory.inv_id=product.inv_id";
                    $result = $conn->query($sql);
                    echo '
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Product name</th>
                                    <th>Price</th>
                                    <th>Remove</th>
                                </tr>
                            </thead>
                            <tbody>
                        ';
                    while($row = $result->fetch_assoc()){
                        if(in_array($row['prod_id'], $_SESSION['arry'])==true){
                            $a = $row['inv_price'] * ($row['inv_discount'] / 100);
                            $b = $row['inv_price'] - $a;
                            $num++;
                            echo '
                                <tr>
                                    <th scope="row">'.$num.'</th>
                                    <td>'.$row['prod_name'].'</td>
                                     <td>PHP '.$b.'</td>
                                     <td><a onclick="removefrcart('.$row['prod_id'].')" style="cursor:pointer;">Remove<i class="fa fa-remove"></i></a></td>
                                </tr>
                                ';
                        }
                    }
                    echo '
                        </tbody>
                       </table>
                        ';
                ?>
                </div>
            </div>
            <!--Footer-->
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-primary" id="cursor-pointer" data-dismiss="modal">Close</button>
                <a href="checkout.php"><button class="btn btn-primary" id="cursor-pointer">Checkout</button></a>
            </div>
        </div>
    </div>
</div>
<!-- Modal: modalCart -->

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