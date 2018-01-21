<?php
include "backend/connection.php";

if(session_status() == PHP_SESSION_NONE)
	session_start();

//in case user goes here while he/she's still logged in...
if(isset($_SESSION['acc_id'])) {
	//redirect back to homepage
	header("Location: admin/index.php");
	exit;
}

$error_msg = "";

if(isset($_SESSION['error_msg'])) {
	$error_msg = '<label class="show_error" style="position:absolute;">'.$_SESSION['error_msg'].'</label>';
	unset($_SESSION['error_msg']);
}

session_unset();
session_destroy();

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