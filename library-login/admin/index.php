<?php
	session_start();
//	error_reporting(0);
/*	include('includes/dbconnection.php');	

	if(isset($_POST['login']))
	  {
		$adminuser=trim($_POST['username']);
		$password=trim($_POST['password']);
		$query=mysqli_query($con,"select borrowernumber from borrowers where userid='$adminuser' && Password='$password'");
		$ret=mysqli_fetch_array($query);
		if($ret>0){
		  $_SESSION['cvmsaid']=$ret['borrowernumber'];
		 header('location:dashboard.php');
		}
		else{
		$msg="Invalid Details.";
		}
	  }*/
require_once "config.php";

	  $msg = "";

date_default_timezone_set("Asia/Manila");
$time=date('Y-m-d H:i:s');

 $sql = "select b.firstname, b.surname from entry_staffloggedin AS esl LEFT JOIN borrowers AS b ON (esl.borrowernumber=b.borrowernumber) where esl.currently_loggedin = '1'";

 $stmt = mysqli_prepare($link, $sql);
mysqli_stmt_execute($stmt);
mysqli_stmt_store_result($stmt);

// Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
	
$sql = "select b.firstname, b.surname from entry_staffloggedin AS esl LEFT JOIN borrowers AS b ON (esl.borrowernumber=b.borrowernumber) where esl.currently_loggedin = '1'";
$stmt = mysqli_prepare($link, $sql);
if (mysqli_stmt_execute($stmt)){
mysqli_stmt_store_result($stmt);

if(mysqli_stmt_num_rows($stmt) == 1){                    
         // Bind result variables
            mysqli_stmt_bind_result($stmt, $firstname, $lastname);
			mysqli_stmt_fetch($stmt);
		//	echo "$firstname $lastname is currently logged in. Do you want to log out the particular user?";
			$msg = "$firstname $lastname is currently logged in. If you log in, the particular user will be logged out. Click <a href='reports.php'>here</a> if you want to go to the reports instead";
			
}
}
 
	
  //header("location: index.php");
  //exit;
}

// Define variables and initialize with empty values
$username = $password = "";
$username_err = $password_err = "";
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Check if username is empty
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter username.";
    } else{
        $username = trim($_POST["username"]);
    }
    // Check if password is empty
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter your password.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validate credentials
    if(empty($username_err) && empty($password_err)){
        // Prepare a select statement
        $sql = "SELECT firstname, surname, userid, password, borrowernumber FROM borrowers WHERE userid = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            // Set parameters
            $param_username = $username;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Store result
                mysqli_stmt_store_result($stmt);
                
                // Check if username exists, if yes then verify password
                if(mysqli_stmt_num_rows($stmt) == 1){                    
                    // Bind result variables
                    mysqli_stmt_bind_result($stmt, $firstname, $lastname, $username, $hashed_password, $borrowernumber);
                    if(mysqli_stmt_fetch($stmt)){
						
						
                        if(password_verify($password, $hashed_password)){
                            // Password is correct, so start a new session
                           // session_start();
                            
                            // Store data in session variables
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["username"] = $username;
							$_SESSION["borrowernumber"] = $borrowernumber;
							$_SESSION["firstname"] = $firstname;
							$_SESSION["surname"] = $surname;


						//$stmt = mysqli_prepare($link, $sql)
						//mysqli_stmt_bind_param($stmt, "s", $param_username);

	
	
	
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
	
							
							
		$sql = "UPDATE entry_staffloggedin SET currently_loggedin='0' WHERE currently_loggedin='1'";
		$stmt = mysqli_prepare($link, $sql);
		$stmt->execute();
		$stmt->close();					

		$sql = "INSERT into entry_staffloggedin (borrowernumber, login_timestamp, currently_loggedin) values (?,?,'1')";
		$stmt = mysqli_prepare($link, $sql);
		mysqli_stmt_bind_param($stmt, "ss", $_SESSION["borrowernumber"],$time);
		
    /* execute query */
    $stmt->execute();

    /* bind result variables */
    //$stmt->bind_result($borrowernumber);

    /* fetch value */
    //$stmt->fetch();

    //printf("$borrowernumber");

    /* close statement */
    $stmt->close();
	

							$_SESSION['cvmsaid']=$_SESSION["borrowernumber"];
                            // Redirect user to welcome page
                            header("location: dashboard.php");
                        } else{
                            // Display an error message if password is not valid
                            $password_err = "The password you entered was not valid.";
                        }
                    }
					
										
                } else{
                    // Display an error message if username doesn't exist
                    $username_err = "No account found with that username.";
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
        
        // Close statement
        mysqli_stmt_close($stmt);
    }
    
    // Close connection
    mysqli_close($link);
}
	  
	  
	  
	  
	  ?>


	<!DOCTYPE html>
	<html lang="en">

	<head>
		<!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="author" content="Eugene Jose T. Espinoza">
    <meta name="keywords" content="Senate Legislative Library Visitor Monitoring System">

		<!-- Title Page-->
		<title>Senate Legislative Library Services Visitor Monitoring System Login</title>

		<!-- Fontfaces CSS-->
		<link href="css/font-face.css" rel="stylesheet" media="all">
		<link href="vendor/font-awesome-4.7/css/font-awesome.min.css" rel="stylesheet" media="all">
		<link href="vendor/font-awesome-5/css/fontawesome-all.min.css" rel="stylesheet" media="all">
		<link href="vendor/mdi-font/css/material-design-iconic-font.min.css" rel="stylesheet" media="all">

		<!-- Bootstrap CSS-->
		<link href="vendor/bootstrap-4.1/bootstrap.min.css" rel="stylesheet" media="all">

		<!-- Vendor CSS-->
		<link href="vendor/animsition/animsition.min.css" rel="stylesheet" media="all">
		<link href="vendor/bootstrap-progressbar/bootstrap-progressbar-3.3.4.min.css" rel="stylesheet" media="all">
		<link href="vendor/wow/animate.css" rel="stylesheet" media="all">
		<link href="vendor/css-hamburgers/hamburgers.min.css" rel="stylesheet" media="all">
		<link href="vendor/slick/slick.css" rel="stylesheet" media="all">
		<link href="vendor/select2/select2.min.css" rel="stylesheet" media="all">
		<link href="vendor/perfect-scrollbar/perfect-scrollbar.css" rel="stylesheet" media="all">

		<!-- Main CSS-->
		<link href="css/theme.css" rel="stylesheet" media="all">

	</head>

	<body class="animsition">
		<div class="page-wrapper">
			<div class="page-content--bge5">
				<div class="container">
					<div class="login-wrap">
						<div class="login-content">						              
							<div class="login-logo">
								<a href="#" style="font-size:24px;">
								   Visitor Monitoring System (VMS)
								</a>
								<p>Please fill in your credentials to login.</p>
							</div>
							 <p style="font-size:16px; color:red" align="center"> <?php if($msg){
		echo $msg;
	  }  ?> </p>
							<div class="login-form">
								<form action="" method="post" name="login">
									<div class="form-group">
										<label>User Name</label>
										<input class="au-input au-input--full" type="text" name="username" placeholder="User Name" required="true">
									</div>
									<div class="form-group">
										<label>Password</label>
										<input class="au-input au-input--full" type="password" name="password" placeholder="Password">
									</div>
									<div class="login-checkbox">
										<label>
											<a href="forgot-password.php">Forgotten Password?</a>
										</label>
									</div>
									<button class="au-btn au-btn--block au-btn--green m-b-20" type="submit" name="login">sign in</button>
									<div class="social-login-content">
										
									</div>
								</form>
								
							</div>
						</div>
					</div>
				</div>
			</div>

		</div>

		<!-- Jquery JS-->
		<script src="vendor/jquery-3.2.1.min.js"></script>
		<!-- Bootstrap JS-->
		<script src="vendor/bootstrap-4.1/popper.min.js"></script>
		<script src="vendor/bootstrap-4.1/bootstrap.min.js"></script>
		<!-- Vendor JS       -->
		<script src="vendor/slick/slick.min.js">
		</script>
		<script src="vendor/wow/wow.min.js"></script>
		<script src="vendor/animsition/animsition.min.js"></script>
		<script src="vendor/bootstrap-progressbar/bootstrap-progressbar.min.js">
		</script>
		<script src="vendor/counter-up/jquery.waypoints.min.js"></script>
		<script src="vendor/counter-up/jquery.counterup.min.js">
		</script>
		<script src="vendor/circle-progress/circle-progress.min.js"></script>
		<script src="vendor/perfect-scrollbar/perfect-scrollbar.js"></script>
		<script src="vendor/chartjs/Chart.bundle.min.js"></script>
		<script src="vendor/select2/select2.min.js">
		</script>

		<!-- Main JS-->
		<script src="js/main.js"></script>

	</body>

	</html>
	<!-- end document-->