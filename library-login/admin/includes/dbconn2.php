<?php
	$servername = "localhost";
	$username = "koha_senate-library2";
	$password = "gLqzimPaT5Iy4Fv4";
	$db = "koha_senate-library2";
	$koha = "koha_senate-library2";
	$conn = mysqli_connect($servername, $username, $password, $db);
	if (!$conn) {
	    die("Connection failed: " . mysqli_connect_error());
	}

	$koha = mysqli_connect($servername, $username, $password, $koha);
	if (!$koha) {
	    die("Connection failed: " . mysqli_connect_error());
	}

	function sanitize($conn, $str){
		return mysqli_real_escape_string($conn, $str);
	}

	date_default_timezone_set("Asia/Kolkata");
?>