<html>

	<head>
	<title>Senate Legislative Library Visitor Monitoring System</title>
	<meta charset="UTF-8">
	<meta name="description" content="Senate Legislative Library Visitor Monitoring System" />
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="author" content="Eugene Jose Espinoza">
	<!--<meta http-equiv="refresh" content="<?php /*echo $sec?>;URL='<?php echo $page*/?>'">-->
	<meta name="keywords" content="Senate Legislative Library Visitor Monitoring System">
	<link rel='shortcut icon' href="includes/website_banner18th.png" type="image/png"/>
	<link rel="stylesheet" href="includes/css/bootstrap.min.css">
	<!--<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>-->
	  
	<link rel="stylesheet" type="text/css" href="includes/main.css" media="screen"/>	  
	  
	<!--<script>
		/*function myFunction() {
		var x = document.getElementById("myDIV");
		if (x.style.display === "none") {
		x.style.display = "block";
		} else {
		x.style.display = "none";
			}
		}

		function myFunction2() {
		document.getElementById("demo").innerHTML = "<textarea cols = '50' rows = '20' name='text' id='text_id' class='form-control' style='resize:vertical' ></textarea>";
		}*/

	</script>  	-->  
	  
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
	
	
	<!--
	<div>
	<div>
	<a href="/visitor-login" style="text-decoration: none;">
	<img src="/kohaimages/senate/website_banner18th__0.png" alt="Senate Library Banner"/>
	</a>
	</div>
	<div style="text-align: center;">
	<font size = +3> <font color = 'b2965a'><b>Senate Legislative Library Visitor Monitoring System</b></font>
	<hr color='#b2965a'>
	</div>
	</div>
	-->
	<hr color='#b2965a'>
	
	
	
		<?php

	error_reporting(1);
	header( "refresh:120;url=index.php" );
	
	session_start();
	
	
	$array = array();
	if (isset($_SESSION['basic_research'])) {
		//$basicresearch = "Basic Research";
		array_push($array,"Basic Research");
	}
	
	if (isset($_SESSION['online_research'])) {
		//$onlineresearch = "Online Research";
		array_push($array,"Online Research");
	}

	if (isset($_SESSION['borrowlibmat'])) {
		//$borrowlibmat = "Borrow Library Materials";
		array_push($array,"Borrow Library Materials");
	}

	if (isset($_SESSION['returnlibmat'])) {
		//$returnlibmat = "Return Library Materials";
		array_push($array,"Return Library Materials");
	}

	if (isset($_SESSION['readnews'])) {
		//$readnews = "Read Newspaper";
		array_push($array,"Read Newspapers/Magazines");
	}

	if (isset($_SESSION['clearance'])) {
		//$clearance = "Clearance";
		array_push($array,"Clearance");
	}

	if (isset($_SESSION['others'])) {
		//$others = "Others";
		array_push($array,"Others");
	}
	
		$post_str = '';
	foreach($array as $value){
		$post_str .= $value.", ";
		
	}
	
	$post_str = substr($post_str,0,-2);
	$post_str = preg_replace("/,([^,]+)$/", " and $1", $post_str);
							
	//echo $array[0],$array[1];
	
	//echo $post_str;

	$N = $_SESSION['basic_research'] + $_SESSION['online_research'] + $_SESSION['borrowlibmat'] + $_SESSION['returnlibmat'] + $_SESSION['readnews'] + $_SESSION['clearance'] + $_SESSION['others'];
		
	
		//$basic_research = $_SESSION['basic_research'];
		//$online_research = $_SESSION['online_research'];
		//$borrowlibmat = $_SESSION['borrowlibmat'];
		//$returnlibmat = $_SESSION['returnlibmat'];
		//$readnews = $_SESSION['readnews'];
		//$clearance = $_SESSION['clearance'];
		//$others = $_SESSION['others'];
		//$othersdescribed = $_SESSION['othersdescribed'];
	
	
	
	require_once("db.php");
	
	$link = mysqli_connect($hostname, $username, $passwd)
		or die("Could not connect");
		
	$idscanned = $_SESSION['id'];
		
	mysqli_select_db($link,$dbase) or die("cannot select DB");
	//Capture who is the currently logged-in staff
	$sql = "select bo.firstname, bo.surname, es.borrowernumber from entry_staffloggedin es LEFT JOIN borrowers bo ON (es.borrowernumber=bo.borrowernumber) where currently_loggedin='1' order by entry_staffloggedin_id DESC LIMIT 1";
    // the result of the query
    $result = mysqli_query($link,$sql) or die("Invalid query");
	$data8=mysqli_fetch_row($result);
	//$borrowernumber = $data8[0];
	
	//$sql = "SELECT cardnumber FROM `borrowers` WHERE surname LIKE "%$idscanned%"||firstname LIKE "%$idscanned%"||cardnumber LIKE "%$idscanned%"";
    // the result of the query
    //$result = mysqli_query($link,$sql) or die("Invalid query");
	//$data8=mysqli_fetch_array($result);
	//$borrowernumber = $data8[0];
	
	
	$_SESSION['currentlylogged'] = $data8[1];
	$_SESSION['currentlyloggedborrowernumber'] = $data8[2];
	
	
	//mysqli_close($link);
	
	
	?>	
	
	
		<div align="center">
		
		
		<?php
		
		echo "<p style='color:white;font-size:x-large;'>You entered: ".$idscanned."</p>";
		echo "<p style='color:white;font-size:x-large;'>Please find below similar employees based from submitted ID number. Click \"Choose\" button beside the name."."</p>";
		
		?>
					<table border="3">
			<thead>
			<tr>
			<tr>
			
			<th style='color:white;font-size:x-large;'>Name</th>
			<th style='color:white;font-size:x-large;'>Card Number</th>
			<th style='color:white;font-size:x-large;'>Office</th>
			<th style='color:white;font-size:x-large;'>Choose</th>
			
			</tr>
			</tr>
			</thead>
			
			<?php
		

		
	//echo "$idscanned";
		
		$ret=mysqli_query($link,"SELECT cardnumber,firstname,surname,cardnumber,sort1,sort2 FROM `borrowers` WHERE surname LIKE '%$idscanned%'||firstname LIKE '%$idscanned%'||cardnumber LIKE '%$idscanned%'");
		$num=mysqli_num_rows($ret);
		if($num>0){
		$cnt=1;
		while ($row=mysqli_fetch_array($ret)) {
			?>
			
			

			<tr>
			
			<td><p style='color:white;font-size:x-large;'><?php echo $row['firstname']." ".$row['surname'] ?></td>
			<td><p style='color:white;font-size:x-large;'><?php echo $row['cardnumber'] ?></td>
			<td><p style='color:white;font-size:x-large;'><?php echo $row['sort1']." ".$row['sort2'] ?></td>
			<td>
			<form id="myForm" action="action2.php" method="post">
			<input type="hidden" name="id2" value="<?php echo $row['cardnumber']; ?>" /><input type="submit" name="formSubmit" value="Choose"/ ></td>
			</form>
			</tr>
			
		                <?php 
$cnt=$cnt+1;
}?>	
			
			
			</table>
						
			
			
			
			<!--<tr>
			<form id="myForm" action="submit2.php" method="post">
			<input type="hidden" name="id2" value="<?php //echo $row['cardnumber']; ?>" />
			<a href="#" onClick="document.getElementById('myForm').submit();">
			<?php// echo $row['firstname']." ".$row['surname'] ?></a><br/>			<p><?php //echo $row['firstname']." ".$row['surname'] ?></p>"
			
			</form>-->
			

		<?php
		
		}
		else
		{
			echo "<p style='color:red;font-size:x-large;'>This does not exist.</p>"; 
		}
		
				//if ($N = 1){
			echo "<p style='color:white;font-size:x-large;'>You selected the following activitity/ies: ".$post_str."</p>";
			
		//}
		//else {
			//echo "<p style='color:white;font-size:x-large;'>You selected the following activitities: ".$post_str."</p>";
		//}
		
		?>
		
		
		
		
		</div>
	
	<div align="center">	
	
	<!--<a href='javascript:history.go(-1)' style='font-size:x-large'>Go back and change the person</a><br/>
	
	<a href='javascript:history.go(-1)' style='font-size:x-large'>Go back to edit your purpose/s of visit</a><br/>-->
	
	<a href='javascript:history.go(-2)' style='font-size:x-large'>Go back</a><br/>
	
	<p style='color:red;font-size:x-large;'>
	
	<a href='scanidvisitor.php' style="font-size:x-large;">Outside researchers or visitors, please click here</a>

	<br/>

	<p style="background-color:powderblue;font-size:large;">Monitoring Staff: 
	<?php
	$staffname = "$data8[0]" . " " . "$data8[1]";
	if (empty($data8[0])) {
		echo "<p style='background-color:powderblue; color:red;'>There's no monitoring staff currently logged in.</p>";
		} else {
		echo $staffname;	
		}
	?>
	</p>
	

	<p style="color:white;">Data Privacy Notice:</p>
	<p style="color:white;">The Legislative Library Service (LLS) is committed to protecting the privacy of its data subjects, and ensuring the safety and security of personal data under its control and custody.</p>
	<p><?php //echo $N ?></p>
<!--	<p> <?php //echo '<pre>' . print_r($_SESSION, TRUE) . '</pre>'; ?> </p>-->

	</div>

	
	
	</div>

	</body>
</html>
