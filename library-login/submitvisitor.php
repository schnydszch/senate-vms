<html>

	<head>
	<title>Senate Legislative Library Visitor Monitoring System</title>
	<meta charset="UTF-8">
	<meta name="description" content="Senate Legislative Library Visitor Monitoring System" />
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="author" content="Eugene Jose Espinoza">
	<!--<meta http-equiv="refresh" content="<?php /*echo $sec?>;URL='<?php echo $page*/?>'">-->
	<meta name="keywords" content="Senate Legislative Library Visitor Monitoring System">
	<link rel='shortcut icon' href="includes/images/website_banner18th.png" type="image/png"/>
	<link rel="stylesheet" href="includes/css/bootstrap.min.css">
	<!--<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>-->
	  
	<link rel="stylesheet" type="text/css" href="includes/main.css" media="screen"/>
	
	</head>


	<body>
	
	<div>
		<div class="container">
			<!--<div class="row" style="align:center;" >-->
			<div class="row justify-content-center align-items-center">
				<!--<div class="col-sm-12">-->
				<a href="index.php" style="text-decoration: none;">
				<img src="includes/images/website_banner18th.png" alt="Senate Library Banner"/>
				</a>
				<p style="font-size:x-large;font-weight:bold;color:b2965a;">
				<!--<p style="color:white;text-align:center;">-->
				<!--<font size = +2> <font color = 'b2965a'><b>-->Senate Legislative Library Visitor Monitoring System<!--</b></font>-->
				</p>
				<!--</div>-->
				<!--
				<div class="col-sm-4">
				<p style="font-size:medium;font-weight:bold;color:b2965a;">
				
				<Senate Legislative Library Visitor Monitoring System<!--</b></font>
				</p>
				</div>-->
			</div>
		</div>
		
		<hr color='#b2965a'>	

	<div align="center">
	
	
	<?php
	//include_once "db.php"
	require_once("db.php");
    error_reporting(1);
	header("refresh:30;url=index.php" );

	session_start();
	
	$floor = "Legislative Library";
	
	$basic_research = "";
	$online_research = "";
	$borrowlibmat = "";
	$returnlibmat = "";
	$readnews = "";
	$clearance = "";
	$others = "";
	$othersdescribed = "";
	$fullname = "";
	$email = "";
	$office = "";
	
	
	
	/*
	if(isset($_POST['formSubmit']))
	{
		*/
		
	/*	
    $basic_research = $_SESSION['basic_research'];
	$online_research = $_SESSION['online_research'];
	$borrowlibmat = $_SESSION['borrowlibmat'];
	$returnlibmat = $_SESSION['returnlibmat'];
	$readnews = $_SESSION['readnews'];
	$clearance = $_SESSION['clearance'];
	$others = $_SESSION['others'];
	$othersdescribed = $_SESSION['othersdescribed'];
	$currentlylogged = $_SESSION['currentlylogged'];
	$currentlyloggedborrowerno = $_SESSION['currentlyloggedborrowernumber'];*/
	

	if(isset($_SESSION['basic_research'])){
    $basic_research = $_SESSION['basic_research'];
	}
	if(isset($_SESSION['online_research'])){
    $online_research = $_SESSION['online_research'];
	}	
	if(isset($_SESSION['borrowlibmat'])){
    $borrowlibmat = $_SESSION['borrowlibmat'];
	}		
	if(isset($_SESSION['returnlibmat'])){
    $returnlibmat = $_SESSION['returnlibmat'];
	}	
	if(isset($_SESSION['readnews'])){
    $readnews = $_SESSION['readnews'];
	}	
	if(isset($_SESSION['others'])){
    $others = $_SESSION['others'];
	}	
	if(isset($_SESSION['othersdescribed'])){
    $othersdescribed = $_SESSION['othersdescribed'];
	}	
	if(isset($_SESSION['fullname'])){
    $fullname = $_SESSION['fullname'];
	}
	if(isset($_SESSION['email'])){
    $email = $_SESSION['email'];
	}
	if(isset($_SESSION['office'])){
    $office = $_SESSION['office'];
	}

	$link = mysqli_connect($hostname, $username, $passwd)
			or die("Could not connect");
			// select our database
			mysqli_select_db($link,$dbase) or die("cannot select DB");

		//Capture who is the currently logged-in staff
		$sql = "select bo.firstname, bo.surname, es.borrowernumber from entry_staffloggedin es LEFT JOIN borrowers bo ON (es.borrowernumber=bo.borrowernumber) where currently_loggedin='1' order by entry_staffloggedin_id DESC LIMIT 1";
		// the result of the query
		$result = mysqli_query($link,$sql) or die("Invalid query");
		$data8 = mysqli_fetch_row($result);


		
		$link1=mysqli_connect($hostname,$username,$passwd)
			or die ("Could not connect to second database");
		mysqli_select_db($link1,$dbase) or die ("Error");
		$sql = "INSERT INTO entry (name, floor, isvalid, isvisitor, office, email, basicresearch, onlineresearch, borrowlibmat, returnlibmat, readnews, clearance, others, others_described, surname_staff,staff_borrowerno) VALUES ('$fullname', 'Legislative Library', '1', '1', '$office', '$email', '$basic_research','$online_research','$borrowlibmat','$returnlibmat','$readnews','$clearance','$others', '$othersdescribed', '$data8[1]','$data8[2]')";	
			mysqli_query($link1,$sql);
		
		// Close connection
		mysqli_close($link);	
		
		
		//print_r($_SESSION);
		//echo "$online_research";
		//echo "$fullname";
		echo ("<p style='color:white;font-size:x-large;'>Thank You! Record Submitted.</p>");
		echo("<a href='index.php' style='font-size:x-large;'>Go Back</a>");
		
		$sound3 = "includes/mp3/recordsubmitted.mp3";
		echo '<audio autoplay="true" style="display:none;">
				<source src="'.$sound3.'" type="audio/wav">
				</audio>';
		
			//exit;	 

	?>
	
	<br/><br/>
		<legend style="color:blue;">Your details: </legend>
		<p style='color:white;font-size:x-large;margin-bottom:0em;'>Name: <?php echo $fullname; ?></p>
		<p style='color:white;font-size:x-large;margin-bottom:0em;'>Address/Office: <?php echo $office; ?></p>
		<p style='color:white;font-size:x-large;margin-bottom:0em;'>Email: <?php echo $email; ?></p>	
	
	<br/>
	
	<p style="background-color:powderblue;font-size:x-large;margin-bottom:0em;">Monitoring Staff: <?php echo $data8[0]; ?> <?php echo $data8[1]; ?></p>

	<!--<p style="color:white;">Data Privacy Notice:</p>
	<p style="color:white;">The Legislative Library Service (LLS) is committed to protecting the privacy of its data subjects, and ensuring the safety and security of personal data under its control and custody..</p>-->

	<div id="footer">
	<div style="text-align: center;">


	</div>
	</div>
	
	</div>

	</body>
</html>