<?php
	define("HOST", "localhost");
	define("DBUSER", "root");
	define("DBPASS", "");
	define("DB", "project-eshop");
	$con = mysqli_connect(HOST, DBUSER, DBPASS, DB);
		 if ($con->connect_errno) {
	         die("ERROR : -> ".$con->connect_error);
	     }


?>