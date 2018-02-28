<?php  
	include '../../../backend/connection.php';

	$newcategname = $_POST['new-categ-name'];
	$newcategdesc = $_POST['new-categ-desc'];

	$newcategpic = $_FILES['new-categ-pic']['tmp_name'];
	$newcategpicname = $newcategname."-".date("y-m-d")."-".rand(10000,90987);
	mkdir("../../../data/Category/".$newcategpicname);
	$newcategpath = "data/Category/".$newcategpicname."/".$newcategpicname;

	if(empty($_FILES['new-categ-pic']['tmp_name'])){
			$sql = "INSERT INTO product_genre SET prod_genre_name = '".$newcategname."', prod_genre_desc = '".$newgenredesc."'";
			$conn->query($sql);
	}
	else{
		move_uploaded_file($newcategpic,'../../../data/Category/'.$newcategpicname.'/'.$newcategpicname);
		$sql = "INSERT INTO product_genre SET prod_genre_name = '".$newcategname."', prod_genre_desc = '".$newcategdesc."', prod_genre_link = '".$newcategpath."'";
		$conn->query($sql);
	}
	header("Location:../../index.php");
?>