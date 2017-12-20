<?php

if(session_status() == PHP_SESSION_NONE)
	session_start();

require_once "connection.php";

$username = $_POST['username'];
$password = $_POST['password'];


$query = "SELECT acc_id FROM account WHERE acc_email='$username' AND acc_pass='$password';";
$result = $conn->query($query);

// close database connection
$conn->close();

if($result->num_rows < 1) {
	$_SESSION['error_msg'] = "Invalid username or password";
	header("Location: ../templogin.php");
	exit;
}
else if($result->num_rows > 0) {
	$row = $result->fetch_assoc();
	$_SESSION['acc_id'] = $row["acc_id"];
	$_SESSION['acc_type_id'] = $row["acc_type_id"];
	header("Location:../admin/index.php");
}

?>