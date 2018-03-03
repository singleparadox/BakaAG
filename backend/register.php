<?php
	include 'connection.php';

	$accemail = $_POST['email'];
	$accpass = $_POST['password'];
	$accfname = $_POST['firstname'];
	$acclname = $_POST['lastname'];

	$sql = "INSERT INTO account SET acc_email = '".$accemail."', acc_pass = '".$accpass."', acc_fname = '".$accfname."', acc_lname = '".$acclname."', acc_type_id = '1'";
	$conn->query($sql);


	$sql = "SELECT acc_id FROM account WHERE acc_email = '".$accemail."'";
	$result = $conn->query($sql);
	$result = $result->fetch_assoc();
	$accid = $result['acc_id'];


	$accdetailsgender = $_POST['gender'];
	$accdetailsbday = $_POST['birthday'];
	$accdetailspnum = $_POST['p_number'];

	$sql = "INSERT INTO account_details SET acc_id = '".$accid."', acc_details_gender = '".$accdetailsgender."', acc_details_bday = '".$accdetailsbday."', acc_details_pnum = '".$accdetailspnum."'";
	$conn->query($sql);

	$addressprovince = $_POST['province'];
	$addresscountry = $_POST['country'];
	$addresscity = $_POST['city'];
	$addresszipcode = $_POST['ZIP'];
	$addressline1 = $_POST['addr1'];
	$addressline2 = $_POST['addr2'];

	//$sql = "INSERT INTO account_address SET acc_id = '".$accid."', address_province = '".$addressprovince"', address_country = '".$addresscountry"', address_city = '".$addresscity"', address_zipcode = '".$addresszipcode"', address_line1 = '".$addressline1"', address_line2 = '".$addressline2"' ";
	$sql = "INSERT INTO account_address SET acc_id = '".$accid."', address_province = '".$addressprovince."', address_country = '".$addresscountry."', address_city = '".$addresscity."', address_zipcode = '".$addresszipcode."', address_line1 = '".$addressline1."', address_line2 = '".$addressline2."'";
	$conn->query($sql);


	header("Location:../index.php");
?>