<?php
// Initialize the session
session_start();

require_once "../db.php";
//require_once "config.php"

date_default_timezone_set("Asia/Manila");
$time=date('Y-m-d H:i:s');

//		$currentTime = time($data6[0]) + 3600;
//		$currentTime2 = time() + 3600;
//		$currentTime3 = ($data6[0]) + 3600;
		  
//		$from_time = strtotime($data6[0]);
//		$to_time = strtotime(date('Y-m-d H:i:s'));
//		$minutesdiff = round(abs($to_time - $from_time) / 60,2);
//		$minutesdiff_notrounded = round(abs($to_time - $from_time) / 60,0);

$sql = "select b.firstname, b.surname from entry_staffloggedin AS esl LEFT JOIN borrowers AS b ON (esl.borrowernumber=b.borrowernumber) where esl.currently_loggedin = '1'";
$stmt = mysqli_prepare($link, $sql);
mysqli_stmt_execute($stmt);
mysqli_stmt_store_result($stmt);



	/*	$sql = "SELECT MAX(entry_staffloggedin_id) FROM entry_staffloggedin";
		$stmt = mysqli_prepare($link, $sql);
		mysqli_stmt_bind_param($stmt, "s");
		$stmt->execute();
		$stmt->close();*/
		
	$link = mysqli_connect($hostname, $username, $passwd)
     		or die("Could not connect");
     	// select our database
    mysqli_select_db($link,$dbase) or die("cannot select DB");		
		
	$sql = "SELECT login_timestamp from entry_staffloggedin WHERE currently_loggedin='1'";
	// the result of the query
	$result = mysqli_query($link,$sql) or die("Invalid query" );
	$fromtime=mysqli_fetch_row($result);
	$fromtime = strtotime($fromtime);

	$sql = "UPDATE entry_staffloggedin SET logout_timestamp = '$time' WHERE currently_loggedin='1'";
	// the result of the query
	mysqli_query($link,$sql);
	
	$sql = "SELECT logout_timestamp from entry_staffloggedin WHERE currently_loggedin='1'";
	// the result of the query
	$result = mysqli_query($link,$sql) or die("Invalid query" );
	$totime=mysqli_fetch_row($result);
	$totime = strtotime($totime);
	
	$minutesdiff = round(abs($totime - $fromtime) / 60,2);
		
	$sql = "UPDATE entry_staffloggedin SET timeloggedin = SEC_TO_TIME(TIMESTAMPDIFF(SECOND,login_timestamp,logout_timestamp)), currently_loggedin='0' WHERE currently_loggedin='1'";
		mysqli_query($link,$sql);		

		mysqli_close($link);
		
	
		
		
  //  $row = mysqli_fetch_row($result);
   // $highest_id = $row[0];
	
	//echo $highest_id;
	

	/*$sql="UPDATE entry_staffloggedin SET currently_loggedin='0' WHERE entry_staffloggedin_id='$highest_id'";
		$result = mysqli_query($link,$sql);
		mysqli_close($link1);
	*/

		 


 
// Unset all of the session variables
$_SESSION = array();
 
// Destroy the session.
session_destroy();
 
// Redirect to login page
header("location: index.php");
exit;
?>