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
		  
		<script>
		setTimeout(function() {
		/*document.querySelector('[name="formSubmit"]').submit();*/
		document.querySelector("body > div > div:nth-child(3) > form > input[type=submit]").click();
		}, 15000);		
		
		//document.querySelector("body > center > font > center > form > input[type=submit]"
		
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
		
		<hr color='#b2965a'>

		<div align="center">

		<?php
		error_reporting(1);
		//include_once "db.php"
		require_once("db.php");
		
		//connect to the db
		$link = mysqli_connect($hostname, $username, $passwd)
				or die("Could not connect");
				// select our database
				mysqli_select_db($link,$dbase) or die("cannot select DB");
		
				//Capture who is the currently logged-in staff
				$sql = "select bo.firstname, bo.surname, es.borrowernumber from entry_staffloggedin es LEFT JOIN borrowers bo ON (es.borrowernumber=bo.borrowernumber) where currently_loggedin='1' order by entry_staffloggedin_id DESC LIMIT 1";
				$result = mysqli_query($link,$sql) or die("Invalid query");
				$data8=mysqli_fetch_row($result);
		
		//include("admin/config.php");		
		header( "refresh:60;url=index.php" );
		
		
		$floor = "Legislative Library";

		session_start();
		
			if(isset($_POST['submit'])) 
			{
				$aDoor = $_POST['check_list'];
				
				$fullname = $_POST['fullname'];
				$email = $_POST['email'];
				$office = $_POST['address'];		
				
				
				
				if(empty($aDoor)) 
			/*	if(empty(IsChecked('check_list','Basic Research')) && empty(IsChecked('check_list','Online Research')) && empty(IsChecked('check_list','Borrow Library Materials')) && empty(IsChecked('check_list','Return Library Materials')) && empty(IsChecked('check_list','Read Newspapers and Magazines')) && empty(IsChecked('check_list','Clearance')) && isset($_POST['othersdescribed']))*/			
				
				{
					echo("<p style='color:red;font-size:xx-large;'>You didn't select any purpose of visit.</p>\n");
					echo("<a href='javascript:history.go(-1)' style='font-size:xx-large;'>Please click here to go back and add purpose/s</a>");
					
					$sound4 = "includes/mp3/visitorpurposeerror.mp3";
					
					echo '<audio autoplay="true" style="display:none;">
							<source src="'.$sound4.'" type="audio/wav">
						</audio>';
					
					
					
				} 
				else 
				{
					$N = count($aDoor);

					echo("<p style='color:white;font-size:x-large;'>You selected $N activity/ies: <br/>");
					for($i=0; $i < $N; $i++)
					{
						//echo($aDoor[$i] . "</p>");
						echo("<li style='color:white;font-size:large;'>".$aDoor[$i]."</li>");
					}
					echo("</p>");
					//echo("<a href='scanid.php'>Click here to proceed</a>");
					echo("<a href='javascript:history.go(-1)' style='font-size:x-large;'>Please click here to modify information provided</a>");
					
					?>
					
		<form action="submitvisitor.php" method="post" onsubmit="return checkForm(this);">
		<input type="submit" name="formSubmit" value="Click This to Record the Visit" />
		</form>	
					
		<p class="blink blink-one">This form will be automatically submitted after 15 seconds.</p>
					
					
		<?php					
					
					
				}
				
				//Checking whether a particular check box is selected
				//See the IsChecked() function below
				
				if(IsChecked('check_list','Basic Research'))
				{
				   // echo ' Basic Research is checked. ';
					//$a = 1;
					$_SESSION['basic_research'] = '1';
					}
				if(IsChecked('check_list','Online Research'))
				{
					$_SESSION['online_research'] = '1';
					}
				if(IsChecked('check_list','Borrow Library Materials'))
				{
					$_SESSION['borrowlibmat'] = '1';
					}
				if(IsChecked('check_list','Return Library Materials'))
				{
					$_SESSION['returnlibmat'] = '1';
					}
				if(IsChecked('check_list','Read Newspapers and Magazines'))
				{
					$_SESSION['readnews'] = '1';
					}
				if(IsChecked('check_list','Clearance'))
				{
					$_SESSION['clearance'] = '1';
					}	
				if(IsChecked('check_list','Others'))
				{
					$_SESSION['others'] = '1';						
					}
				
				if(isset($_POST['othersdescribed'])){
					$_SESSION['othersdescribed'] =	$_POST['othersdescribed'];
					//$_SESSION['others'] = '1';
					
				}		

				
				$_SESSION['othersdescribed'] =	$_POST['othersdescribed'];
				
				
				$_SESSION['fullname'] =	$fullname;
				$_SESSION['email'] =	$email;
				$_SESSION['office'] =	$office;				
				

			// Escape user inputs for security
			//$fullname = mysqli_real_escape_string($link, $_POST['fullname']);

			
			//$fullname = mysqli_real_escape_string($_POST['fullname']);
			//$email = mysqli_real_escape_string($link, $_POST['email']);
			//$office = mysqli_real_escape_string($link, $_POST['address']);		
					
					
			}
			
			function IsChecked($chkname,$value)
			{
				if(!empty($_POST[$chkname]))
				{
					foreach($_POST[$chkname] as $chkval)
					{
						if($chkval == $value)
						{
							return true;
						}
					}
				}
				return false;
			}		
		
		
		?>

		<br/>
		<p style='color:white;font-size:xx-large;margin-bottom:0em;'>Your details:</p>
		<p style='color:white;font-size:x-large;margin-bottom:0em;'><strong>Name: </strong><?php echo $fullname; ?></p>
		<p style='color:white;font-size:x-large;margin-bottom:0em;'><strong>Address/Office: </strong><?php echo $office; ?></p>
		<p style='color:white;font-size:x-large;margin-bottom:0em;'><strong>Email: </strong><?php echo $email; ?></p>	
		
		
		<p style="background-color:powderblue;font-size:large;margin-bottom:0em;">Monitoring Staff: <?php echo $data8[0]; ?> <?php echo $data8[1]; ?></p>
<!--
		<p style="color:white;">Data Privacy Notice:</p>
		<p style="color:white;">The Legislative Library Service (LLS) is committed to protecting the privacy of its data subjects, and ensuring the safety and security of personal data under its control and custody..</p>-->
		
		
		
		
		<div id="footer">
		<div style="text-align: center;">


		</div>
		</div>
		
	</div>

	</body>
</html>