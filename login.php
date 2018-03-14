<?php
include "backend/connection.php";
?>


<!DOCTYPE html>
<html>
	<head>
		<title>Login Page</title>
		<link rel="stylesheet" type="text/css" href="css/templogin.css">
		<link rel="stylesheet" type="text/css" href="css/style_global.css">
	</head>
	<body>
		<?php include "header-admin.php"; ?>
		<div class="container">
			<div class="title">
				<center><h3>LOGIN</h3></center>
			</div>			
			<form id="login" action="backend/validate-admin.php" method="POST">

				<label for="exampleInputEmail1">Username</label>
				<input type="text" class="form-control" id="exampleInputEmail1 username" name="username" aria-describedby="emailHelp" placeholder="Enter Username" required>

				<label for="exampleInputPassword1">Password</label>
				<input name="password" type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" required>
						


				<div id="error"><?php echo $error_msg; ?></div>
				<!-- There is a problem with button of type = submit -->
				<div id="invi_margin"></div>
				<center><button type="submit" style="cursor:pointer;" class="btn btn-secondary">Submit</button></center>
			</form>

			<div id="d_account"><p>Don't have an account? Register <a id="reg" href="register.php">here</a></p></div>
		</div>
		<?php include "footer.php"; ?>
	</body>
</html>