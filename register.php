<?php
include "backend/connection.php";
?>


<!DOCTYPE html>
<html>
	<head>
		<title>Sign Up</title>
		<link rel="stylesheet" type="text/css" href="css/style_register.css">
	</head>

	<body>
		<?php include "header.php";?>

		<div class="container">
			<h3 id="h3" style="color: black !important;">Sign Up</h3>

			<form>
				<label for="exampleInputEmail1">Email address</label>
				<input type="email" name="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Enter email" required>

				<label for="exampleInputPassword1">Password</label>
      			<input type="password" name="password" class="form-control" id="pass" placeholder="Password" required>

      			<label class="col-form-label" for="firstname">First Name</label>
				<input type="text" name="firstname" class="form-control" placeholder="First Name" id="firstname" required>

      			<label class="col-form-label" for="lastname">Last Name</label>
				<input type="lastname" name="firstname" class="form-control" placeholder="Last Name" id="firstname" required>

				<hr>

				<span><input type="checkbox" name="terms" id="terms" required><small>I agree to the <a href="#">Terms and Conditions</a></small></span>

				<button type="submit" style="cursor:pointer;" class="btn btn-primary right">Submit</button>
			</form>

		</div>
				<div class="maki"></div>


		<?php include "footer.php"; ?>
	</body>
</html>