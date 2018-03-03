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

		<div class="maki"></div>
		<div class="container">
			<h3 id="h3" style="color: black !important;">Sign Up</h3>

			<form action="backend/register.php" method="POST">
				<div class="form A">	
					<label for="exampleInputEmail1">Email address</label>
					<input type="email" name="email" class="form-control" id="email" aria-describedby="emailHelp" placeholder="Enter email" required>

					<label for="exampleInputPassword1">Password</label>
	      			<input type="password" name="password" class="form-control" id="pass" placeholder="Password" required>

	      			<label class="col-form-label" for="firstname">First Name</label>
					<input type="text" name="firstname" class="form-control" placeholder="First Name" id="firstname" required>

	      			<label class="col-form-label" for="lastname">Last Name</label>
					<input type="text" name="lastname" class="form-control" placeholder="Last Name" id="lastname" required>

					<label class="col-form-label birthday" for="birthday">Birthday</label>
					<input type="date" name="birthday" class="form-control" required>

					<label for="gender">Gender</label>
					<select class="form-control" id="gender" name="gender">
						<option value="unspecified">Unspecified</option>
						<option value="male">Male</option>
						<option value="female">Female</option>
					</select>


					<label class="col-form-label" for="p_number">Phone Number</label>
					<input type="number" name="p_number" class="form-control" placeholder="Phone Number" id="p_number" required>
				</div>

				<div class="form B">

					<label class="col-form-label" for="country">Country</label>	
					<input type="text" name="country" class="form-control" placeholder="Country" id="country" required>

					<label class="col-form-label" for="City">City</label>	
					<input type="text" name="city" class="form-control" placeholder="City" id="city" required>

					<label class="col-form-label" for="Province">Province</label>	
					<input type="text" name="province" class="form-control" placeholder="Province" id="province" required>

					<label class="col-form-label" for="ZIP">Zip Code</label>	
					<input type="number" name="ZIP" class="form-control" placeholder="ZIP Code e.g. 1234" id="ZIP" required>

					<label class="col-form-label" for="addr1">Address Line 1</label>	
					<input type="text" name="addr1" class="form-control" placeholder="Address Line 1" id="addr1" required>

					<label class="col-form-label" for="addr2">Address Line 2</label>	
					<input type="text" name="addr2" class="form-control" placeholder="Address Line 2 (Optional)" id="addr2">

					<em>I-It's not that we need you or anything, We just want you to join... B-baka!</em>

				</div>
				<hr>

				<span><input type="checkbox" name="terms" id="terms" required><small>I agree to the <a href="#">Terms and Conditions</a></small></span>

				<button type="submit" style="cursor:pointer;" class="btn btn-primary right">Submit</button>
			</form>

		</div>


		<?php include "footer.php"; ?>
	</body>
</html>