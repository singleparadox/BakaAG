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
	$error_msg = '<label class="show_error">'.$_SESSION['error_msg'].'</label>';
	unset($_SESSION['error_msg']);
}

session_unset();
session_destroy();

?>

<!DOCTYPE html>
<html>
	<head>
		<title>Administartor Login</title>
	</head>
	<body>
		<form id="login" action="backend/validate.php" method="POST">
			<label for="username">email</label>
			<input type="text"  id="username" name="username" />
			<label for="username">Password</label>
			<input type="password" id="password" name="password" />
			<hr>
			<div id="error"><?php echo $error_msg; ?></div>
			<!-- There is a problem with button of type = submit -->
			<button type="submit" id="submit">Log in</button>
		</form>
	</body>