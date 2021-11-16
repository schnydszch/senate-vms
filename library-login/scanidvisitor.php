	<?php

		error_reporting(1);
		header( "refresh:120;url=index.php" );
		
		require_once("db.php");
		session_start();
		
		unset($_SESSION['basic_research']);
		unset($_SESSION['online_research']);
		unset($_SESSION['borrowlibmat']);
		unset($_SESSION['returnlibmat']);
		unset($_SESSION['readnews']);
		unset($_SESSION['clearance']);
		unset($_SESSION['others']);
		unset($_SESSION['othersdescribed']);
		unset($_SESSION['fullname']);
		unset($_SESSION['email']);
		unset($_SESSION['office']);
		
		
	//	include("admin/config.php");
		
		$msg = "";
		
		$link = mysqli_connect($hostname, $username, $passwd)
			or die("Could not connect");
			
		mysqli_select_db($link,$dbase) or die("cannot select DB");
		//Capture who is the currently logged-in staff
		$sql = "select bo.firstname, bo.surname, es.borrowernumber from entry_staffloggedin es LEFT JOIN borrowers bo ON (es.borrowernumber=bo.borrowernumber) where currently_loggedin='1' order by entry_staffloggedin_id DESC LIMIT 1";
		// the result of the query
		$result = mysqli_query($link,$sql) or die("Invalid query");
		$data8=mysqli_fetch_row($result);
		//$borrowernumber = $data8[0];
		
		$_SESSION['currentlylogged'] = $data8[1];
		$_SESSION['currentlyloggedborrowernumber'] = $data8[2];
		
		
		mysqli_close($link);
		
		
		if(isset($_POST['submit']))
		{
			
		
		$basic_research = $_SESSION['basic_research'];
		$online_research = $_SESSION['online_research'];
		$borrowlibmat = $_SESSION['borrowlibmat'];
		$returnlibmat = $_SESSION['returnlibmat'];
		$readnews = $_SESSION['readnews'];
		$clearance = $_SESSION['clearance'];
		$others = $_SESSION['others'];
		$othersdescribed = $_SESSION['othersdescribed'];
		$currentlylogged = $_SESSION['currentlylogged'];
		$currentlyloggedborrowerno = $_SESSION['currentlyloggedborrowernumber'];
		
	/*	
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
	}	*/

			
		// Escape user inputs for security
		$fullname = mysqli_real_escape_string($link, $_POST['fullname']);
		$email = mysqli_real_escape_string($link, $_POST['email']);
		$office = mysqli_real_escape_string($link, $_POST['address']);
	 
		// Attempt insert query execution
		$sql = "INSERT INTO entry (name, floor, isvalid, isvisitor, office, email, basicresearch, onlineresearch, borrowlibmat, returnlibmat, readnews, clearance, others, others_described, surname_staff,staff_borrowerno) VALUES ('$fullname', 'Legislative Library', '1', '1', '$office', '$email', '$basic_research','$online_research','$borrowlibmat','$returnlibmat','$readnews','$clearance','$others', '$othersdescribed', '$currentlylogged',$currentlyloggedborrowerno)";
		//if(mysqli_query($link, $sql)){
			//$msg = "Visitors Detail has been added.";
			//header("location: index.php");
		
		//} else{
		//$msg = "Something Went Wrong. Please try again";
		//}
	 
		// Close connection
		mysqli_close($link);
		}
	  
	 
		 ?>


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
																   
		<script type="text/javascript">

		function checkForm(form)
		{
		//
		// validate form fields
		//

		form.myButton.disabled = true;
		return true;
		}

		</script>                                          
		  
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

		<hr color='#b2965a' style="margin-bottom:0em;">

		
		<div align="center">
		 <!--<div class="section__content section__content--p30">
		 <div class="container-fluid">-->
			 <!--<div class="row">-->
			   
				<!--<div class="col-lg-12">
					 <div class="card">-->
			<div class="card-header">
			<p style="font-weight:bold;font-size:x-large;margin-bottom:0em;">Record Outside Visitors/Researchers</p>
			</div>
				<!--<div class="card-body card-block">-->
			<form action="verifyvisitor.php" method="post" enctype="multipart/form-data" class="form-horizontal">
			  
			<fieldset>

			<!-- Form Name -->
			<legend style="color:white;">Please check your purpose in visiting the library: (You can check more than one)</legend>

			<!-- Multiple Checkboxes (inline) -->
				<div class="form-group">
				<!--<label class="col-md-4 control-label" for="checkboxes"></label>-->
					<div class="col-md-12">
					<label class="checkbox-inline" style="color:white;font-size:large;">
					<input type="checkbox" name="check_list[]" value="Basic Research">
						Basic Research
					</input>
					</label>
					<label class="checkbox-inline" style="color:white;font-size:large;">
					<input type="checkbox" name="check_list[]" value="Online Research">
						Online Research
					</input>
					</label>
					<label class="checkbox-inline" style="color:white;font-size:large;">
					<input type="checkbox" name="check_list[]" value="Borrow Library Materials">
						Borrow Library Materials
					</input>	
					</label>
					<label class="checkbox-inline" style="color:white;font-size:large;">
					<input type="checkbox" name="check_list[]" value="Return Library Materials">
						Return Library Materials
					</input>	
					</label>
					<label class="checkbox-inline" style="color:white;font-size:large;">
					<input type="checkbox" name="check_list[]" value="Read Newspapers and Magazines">
						Read Newspapers and Magazines
					</input>	
					</label>
					<label class="checkbox-inline" style="color:white;font-size:large;">
					<input type="checkbox" name="check_list[]" value="Clearance">
						Clearance
					</input>	
					</label>
					<label class="checkbox-inline" style="color:white;font-size:large;">
					<input type="checkbox" name="check_list[]" value="Others" onclick="myFunction2()">
						Others
					</input>	
					</label>
					<!--<br />-->
			
					<!--<p id="demo">A Paragraph.</p>-->
		
					<!--<div id="myDIV">
					<textarea name="othersdescribed" rows="2" cols="70" placeholder="If you checked 'Others', you may indicate exact business transaction."></textarea>
					</div>-->
		
						<div>
						<textarea name="othersdescribed" rows="2" cols="70" placeholder="If you checked 'Others', you may indicate exact business transaction."></textarea>
						</div>
					</div>
				</div>

			</fieldset>
				  
			  
				<!--<div>-->
					<!--<p style="font-size:16px; color:red" align="center"> 
					<?php //if($msg){
						//echo $msg;
					//}  ?> 
					</p>-->
				 
					<div>
						<div style="text-align:center;">
						<label for="text-input" style="color:white;">Full Name: </label>
						<input type="text" id="fullname" name="fullname" placeholder="Input Full Name" required="" size="45">
						</div>
						<!--   <div class="col-12 col-md-9">
						<input type="text" id="fullname" name="fullname" placeholder="Full Name" class="form-control" required="" size="45">
						  
						</div>-->
					</div>
				
					<div align="center">
						<div class="col col-md-4">
						<label for="email" class="form-control-label" style="color:white;">Office/Address: </label>
						<textarea rows="2" cols="60" name="address" id="address" placeholder="Enter Visitor Office/Address..." class="form-control" required=""></textarea>
						</div>
						<!-- <div>
						<textarea rows="3" col="100" name="address" id="address" placeholder="Enter Visitor Office/Address..." class="form-control" required=""></textarea>
						</div>-->
					</div>
				  
					<br/>
				  
					<div>
						<div style="text-align:center;">
						<label for="email-input" style="color:white;">Email: </label>
						<input type="email" id="email" name="email" placeholder="Enter Email" size="45">
						</div>
						<!-- <div class="col-12 col-md-9">
						<input type="email" id="email" name="email" placeholder="Enter Email" class="form-control" size="45">
						  
						</div>-->
					</div>
				   
					<div>
					<!--<p style="text-align: center;">-->
					<!--<button type="submit" onclick="this.disabled=true;this.value='Sending, please wait...';this.form.submit()" id="submit" class="btn btn-primary btn-sm" value="Submit">Submit
					</button>-->
					<!--<button type="submit" onclick="this.disabled=true;this.value='Sending, please wait...';this.form.submit()" value="Submit">Submit</button>-->
					<button type="submit" name="submit" id="submit" class="btn btn-primary btn-sm" onsubmit="return checkForm(this);">Submit</button>
																																		   
					<!--</p>-->	  
			  
			  
					</div>
			</form>

		</div>				
				
		
		<div align="center">	

		<p style="background-color:powderblue;font-size:x-large;margin-bottom:0em;">Monitoring Staff: 
		<?php
		$staffname = "$data8[0]" . " " . "$data8[1]";
		if (empty($data8[0])) {
			echo "<p style='background-color:powderblue; color:red;'>There's no monitoring staff currently logged in.</p>";
			} else {
			echo $staffname;	
			}
		?>
		</p>
		

		<p style="color:white;margin-bottom:0em;">Data Privacy Notice:</p>
		<p style="color:white;">The Legislative Library Service (LLS) is committed to protecting the privacy of its data subjects, and ensuring the safety and security of personal data under its control and custody.</p>

		</div>

	</div>

	</body>
</html>