<?php
include "backend/connection.php";
?>


<!DOCTYPE html>
<html>
	<head>
		<title>Administartor Login</title>
		<link rel="stylesheet" type="text/css" href="css/templogin.css">
		<link rel="stylesheet" type="text/css" href="css/style_global.css">
	</head>
	<body>
		<?php include "header.php"; ?>
		<div class="container">
			<div class="title">
				<center><h3>LOGIN</h3></center>
			</div>			
			<form id="login" action="backend/validate.php" method="POST">
				<table>
					<tr>
						<td>
							<label for="username">Email</label>
							<input placeholder="Enter Email" type="text" id="username" name="username" />
						</td>
					</tr>
					<tr>
						<td>
							<label for="username">Password</label>
							<input placeholder="Enter Password" type="password" id="password" name="password" />
						</td>
					</tr>
				</table>


				<div id="error"><?php echo $error_msg; ?></div>
				<!-- There is a problem with button of type = submit -->
				<div id="invi_margin"></div>
				<center><button type="submit" style="cursor:pointer;" class="btn btn-secondary">Submit</button></center>
			</form>

		</div>
		<?php include "footer.php"; ?>
	</body>