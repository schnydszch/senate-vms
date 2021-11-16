<?php


require('includes/dbconnection.php');
session_start();

//if (false !== stripos($_SERVER['HTTP_REFERER'], "bw-dates-reports-details.php")){
	if(isset($_GET['delete_id'])){
		$id = $_GET['delete_id'];
		
		$ret=mysqli_query($con, "INSERT INTO entry_deleted (time_deleted, slno, cardnumber, name, toe, othernames, floor, isvalid, borrowernumber, basicresearch, onlineresearch, borrowlibmat, returnlibmat, readnews, clearance, others, others_described, isvisitor, office, email, surname_staff, staff_borrowerno) SELECT CURRENT_TIMESTAMP, slno, cardnumber, name, toe, othernames, floor, isvalid, borrowernumber, basicresearch, onlineresearch, borrowlibmat, returnlibmat, readnews, clearance, others, others_described, isvisitor, office, email, surname_staff, staff_borrowerno FROM entry WHERE slno = '$id'");
		
		$ret=mysqli_query($con,"DELETE FROM entry WHERE slno = '$id'");
		header('location:reporttoday.php');
		//header('Location: ' . $_SERVER['HTTP_REFERER']);
		//header("location:javascript://history.go(-2)");
		
		/*$sql = "DELETE FROM entry WHERE slno = '$id'";
		/*if (mysqli_query($conn, $sql)) {
			header('location:reporttoday.php');
		} else {
		    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
		}*/
		//header('location:reporttoday.php');
	}
//}

if(isset($_GET['delete_id_bwreportsdetail'])){
		$id = $_GET['delete_id_bwreportsdetail'];
		
		//$_SESSION['url'] = $_SERVER['HTTP_REFERER'];
		
		$ret=mysqli_query($con, "INSERT INTO entry_deleted (time_deleted, slno, cardnumber, name, toe, othernames, floor, isvalid, borrowernumber, basicresearch, onlineresearch, borrowlibmat, returnlibmat, readnews, clearance, others, others_described, isvisitor, office, email, surname_staff, staff_borrowerno) SELECT CURRENT_TIMESTAMP, slno, cardnumber, name, toe, othernames, floor, isvalid, borrowernumber, basicresearch, onlineresearch, borrowlibmat, returnlibmat, readnews, clearance, others, others_described, isvisitor, office, email, surname_staff, staff_borrowerno FROM entry WHERE slno = '$id'");
		
		$ret=mysqli_query($con,"DELETE FROM entry WHERE slno = '$id'");
		//header('location:reporttoday.php');
		header('Location: ' . $_SERVER['HTTP_REFERER']);
		//header("location:javascript://history.go(-1)");
		//header('location: '.$_SESSION['url']);
		
		/*$sql = "DELETE FROM entry WHERE slno = '$id'";
		/*if (mysqli_query($conn, $sql)) {
			header('location:reporttoday.php');
		} else {
		    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
		}*/
		//header('location:reporttoday.php');
	}
	

if(isset($_GET['delete_id_reportsdetail'])){
		$id = $_GET['delete_id_reportsdetail'];
		
		//$_SESSION['url'] = $_SERVER['HTTP_REFERER'];
		
		$ret=mysqli_query($con, "INSERT INTO entry_deleted (time_deleted, slno, cardnumber, name, toe, othernames, floor, isvalid, borrowernumber, basicresearch, onlineresearch, borrowlibmat, returnlibmat, readnews, clearance, others, others_described, isvisitor, office, email, surname_staff, staff_borrowerno) SELECT CURRENT_TIMESTAMP, slno, cardnumber, name, toe, othernames, floor, isvalid, borrowernumber, basicresearch, onlineresearch, borrowlibmat, returnlibmat, readnews, clearance, others, others_described, isvisitor, office, email, surname_staff, staff_borrowerno FROM entry WHERE slno = '$id'");
		
		$ret=mysqli_query($con,"DELETE FROM entry WHERE slno = '$id'");
		//header('location:reporttoday.php');
		//header('Location: ' . $_SERVER['HTTP_REFERER']);
		//header("location:javascript://history.go(-1)");
		header('location: '.$_SESSION['url']);
		
		/*$sql = "DELETE FROM entry WHERE slno = '$id'";
		/*if (mysqli_query($conn, $sql)) {
			header('location:reporttoday.php');
		} else {
		    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
		}*/
		//header('location:reporttoday.php');
	}	





?>