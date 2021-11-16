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
		
		//document.querySelector("body > div > div:nth-child(3) > form")		

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
		//include_once "db.php"
		//require_once("db.php");
		error_reporting(1);
		header("refresh:120;url=index.php");
		
		
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
		

		session_start();
		
		$basic_research = $_SESSION['basic_research'];
		$online_research = $_SESSION['online_research'];
		$borrowlibmat = $_SESSION['borrowlibmat'];
		$returnlibmat = $_SESSION['returnlibmat'];
		$readnews = $_SESSION['readnews'];
		$clearance = $_SESSION['clearance'];
		$others = $_SESSION['others'];
		$othersdescribed = $_SESSION['othersdescribed'];
		$id2 = $_POST['id2'];
		
		$_SESSION['id2'] = $id2;
		
		
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
		
		//$idofuser = $_SESSION['id'];
		
		//$idofuser = $_POST['id'];

		//$id = $_SESSION['id'];
		//echo("<p>You didn't select anything.</p>\n");
		//echo ("<p style='color:white;'>Your inputted ID number: $idofuser</p>");
		
		$datetoday = date("Y/m/d");
		
		//$id = $_POST[]		
			
		$sql = "select surname,firstname,address, cardnumber, othernames from borrowers where othernames='$id2' or cardnumber='$id2'";
		// the result of the query
		$result = mysqli_query($link,$sql) or die("Invalid query");
		$data1=mysqli_fetch_array($result);
		$name_of_patron = "$data1[1]" . " " . "$data1[0]";
			
		$sql="select imagefile, mimetype from patronimage p LEFT JOIN borrowers b on (p.borrowernumber=b.borrowernumber) where othernames='$id2' or cardnumber='$id2' ";
		$result=mysqli_query($link,$sql) or die("Invalid query");
		$data2=mysqli_fetch_array($result);
			
		$sql="SELECT sort2 from borrowers where cardnumber='$id2' and sort2 = '1'";
		$result=mysqli_query($link,$sql);
		$data3=mysqli_fetch_array($result);
			
		//	$sql="SELECT enrolmentperioddate from categories c LEFT JOIN borrowers b on (c.categorycode=b.categorycode) where cardnumber='$id'";
		// 	$result=mysql_query($sql);
		//	$data3=mysql_fetch_row($result);
		// get date of expiration
			
		//$sql="SELECT dateexpiry, firstname from borrowers where cardnumber='$data1[3]'";
		//$result=mysqli_query($link,$sql);
		//$data4=mysqli_fetch_row($result);
			
		// get the circ notes
		//$sql="SELECT borrowernotes, firstname from borrowers where cardnumber='$id' and borrowernotes LIKE '%VALIDATE%'";
		//$result=mysqli_query($link,$sql);
		//$data5=mysqli_fetch_row($result);
			
		$sql = "select toe from entry where cardnumber='$data1[3]' order by slno DESC LIMIT 1";
		$result = mysqli_query($link,$sql) or die("Invalid query" );
		$data6=mysqli_fetch_row($result);

		$sql = "select floor from entry where cardnumber='$data1[3]' order by slno DESC LIMIT 1";
		$result = mysqli_query($link,$sql) or die("Invalid query" );
		$data7 = mysqli_fetch_row($result);
			
		//Capture who is the currently logged-in staff
		$sql = "select bo.firstname, bo.surname, es.borrowernumber from entry_staffloggedin es LEFT JOIN borrowers bo ON (es.borrowernumber=bo.borrowernumber) where currently_loggedin='1' order by entry_staffloggedin_id DESC LIMIT 1";
		$result = mysqli_query($link,$sql) or die("Invalid query");
		$data8 = mysqli_fetch_row($result);			
			
		mysqli_close($link);
			
		//$sound1 = '<EMBED src="denied.mp3" autostart=true loop=false volume=500 hidden=true><NOEMBED><BGSOUND src="tada.wav"></NOEMBED>';
		//$sound3 = "includes/mp3/recordsubmitted.mp3";
			
		$floor="Legislative Library";
			  
		$currentTime = time($data6[0]) + 3600;
		$currentTime2 = time() + 3600;
		$currentTime3 = ($data6[0]) + 3600;
			  
		$from_time = strtotime($data6[0]);
		$to_time = strtotime(date('Y-m-d H:i:s'));
		$minutesdiff = round(abs($to_time - $from_time) / 60,2);
		$minutesdiff_notrounded = round(abs($to_time - $from_time) / 60,0);
			  
		if (sizeof($data2) > 1) {
				echo "<br/>";
				echo '<img src="data:image/jpg/png/jpeg;base64,' . base64_encode( $data2[0] ) . '" height="150" />';  
				echo "<br/>";
				
			}
			else{
				echo "<br/>";
				echo '<img src="includes/images/profile-shadow.png" height="150" />';  
				echo "<br/>";
			}			
		
			if (sizeof($data1) > 1) {

				echo "<p style='color:white;font-size:x-large;margin-bottom:0em;'>".$data1[0].", ".$data1[1]."</p>";
			//	echo "<BR>";
			//	echo "<font color= 'red' size = +2>".$data1[1]."</font>";
				
				echo "<p style='color:white;font-size:x-large;margin-bottom:0em;'>ID No. ".$data1[3]."</p>";
				
				date_default_timezone_set('Asia/Manila');
				$time=date('Y-m-d H:i:s');
				$time2=date('Y-m-d');
				echo "<p style='color:white;font-size:x-large;margin-bottom:0em;'> Time of entry: ".$time."</p>";
					

						
					}
			else {
				echo "<p style='color:white;font-size:x-large;margin-bottom:0em;'>You entered: ".$id."</p>";
				echo "<p style='color:white;font-size:x-large;margin-bottom:0em;'>The ID number is: ".$id2."</p>";
				
				echo "<br>";
				
				date_default_timezone_set('Asia/Manila');
				$time=date('Y-m-d H:i:s');
				$time2=date('Y-m-d');
				echo "<p style='color:white;font-size:x-large;margin-bottom:0em;'> Time:".$time."</p>";
				
				echo "<p style='color:red;font-size:x-large;margin-bottom:0em;'>You're inputted ID does not matched any in the VMS database. However, this transaction has been recorded in VMS.</p>";
				echo "<p style='color:white;font-size:x-large;'>Please approach a library personnel.</p>";
				
						} 
						
		
						//code to know if user has overdue materials, curl to DLM

				$user_agent       = "Mozilla/5.0 (X11; Linux i686; rv:24.0) Gecko/20140319 Firefox/24.0 Iceweasel/24.4.0";
					$site = '100';
					$loginref = "632603056";
					$dlmusername = 'eugene';
					$password = 'eugene';
					$loginUrl = 'http://111.125.73.190:8081/common/welcome.jsp';
					$id = $_POST['id2'];
					$msg = "";

					$curl = curl_init(); 

					//      if (!$curl) {
					//        die("Couldn't initialize a cURL handle"); 
					//  }

					// Set the file URL to fetch through cURL
					curl_setopt($curl, CURLOPT_URL, $loginUrl);

					// Set a different user agent string (Googlebot)
					curl_setopt($curl, CURLOPT_USERAGENT, $user_agent); 

					// Follow redirects, if any
					curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true); 

					// Fail the cURL request if response code = 400 (like 404 errors) 
					curl_setopt($curl, CURLOPT_FAILONERROR, true); 

					// Return the actual result of the curl result instead of success code
					curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);

					// Do not check the SSL certificates
					curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false); 
					curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false); 
						
					// ENABLE HTTP POST
					curl_setopt($curl, CURLOPT_POST, 1);
				 
					//Set the post parameters
					curl_setopt($curl, CURLOPT_POSTFIELDS, 'site='.$site.'&userLoginName='.$dlmusername.'&LoginReference='.$loginref.'&userLoginPassword='.$password);
					CURL_SETOPT($curl,CURLOPT_COOKIEFILE,"cookie.txt"); 
					//Handle cookies for the login
					curl_setopt($curl, CURLOPT_COOKIEJAR, 'cookie.txt');
						
					// Wait for 10 seconds to connect, set 0 to wait indefinitely
					curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, 50);

					// Execute the cURL request for a maximum of 50 seconds
					curl_setopt($curl, CURLOPT_TIMEOUT, 50);

					//		curl_setopt ($ch, CURLOPT_REFERER, $loginUrl);
		
					// Fetch the URL and save the content in $html variable
					$html = curl_exec($curl); 
		
					$circstring = "http://111.125.73.190:8081/circulation/servlet/handlecheckoutform.do?continuation=true&unbarcodedBibID=&ButtonNameChangeTextbookClass=&searchLocalPatronsOnly=true&go.x=12&go.y=11&toHomeroomMode=false&confirmBulkQuantity=0&copyInCrumb=false&lastCheckoutWasABulkCheckout=false&unbarcoded=false&actionOnCopyList=&collectionType=0&searchString=" . $id . "&lostCopyID=&toTeacherMode=false&toClassMode=false&limitToActivePatronsValid=true&patronType=203&confirmBulkProposedDueDate=&limitToActivePatrons=on&checkoutViaISBNBibID=&stolenCopyID=&limitPatronSearchValue=19&foundViaISBN=false"; 


					curl_setopt($curl, CURLOPT_URL, $circstring);

					//echo file_put_contents("tmp/14356.html", $exec = curl_exec($curl));
					$result = curl_exec($curl);
						if (strpos($result, "<font color='#CC0000'>") !== false) {
						echo "<p style='color:red;text-decoration:none;font-size:x-large;'>You currently have overdue material/s! Please see a Circulation staff.</p>";
						
						echo '<audio autoplay="true" style="display:none;">
								<source src="'.$sound2.'" type="audio/wav">
								</audio>';
								
						} else {
	
						}
					curl_close($curl);	
						
						
						
	
		
		
		
		
		
		?>
		
		
		
					<form action="submit2.php" method="post" onsubmit="return checkForm(this);">
					<input type="submit" name="formSubmit" value="Click This to Record Your Visit." />
					</form>
					<p class="blink blink-one" style="margin-bottom:0em;">This form will be automatically submitted after 15 seconds.</p>
					
					
					<p style='color:white;font-size:x-large;'>You selected the following activitity/ies: <?php echo $post_str;?></p>
					
					<a href='javascript:history.go(-1)' style='font-size:x-large'>Go back and change the person</a><br/>
					
					<a href='javascript:history.go(-3)' style='font-size:x-large'>Go back and change purpose/s of visit</a><br/>
					
					
		
		
		
		
		
		
		</div>


	<div align="center">	
	<a href='scanidvisitor.php' style='font-size:x-large;'>Outside researchers or visitors, please click here</a>

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
	
	<p><? echo $id2; ?></p>
	<p><? print_r($_SESSION, TRUE) ?></p>

	</div>

	<div id="footer">
	<div style="text-align: center;">
	<br>
	<!--<div style="text-align:center"><a target="_blank" href="http://www.onstrike.com.ph/" style="color:black; text-decoration:none">
	<img src="/kohaimages/FEUNRMF/os-logo.png" height="x" width="40px" align="middle"/> <font size = +1> <font color = '000000'><b>c2016-2018 OnStrike Library Solutions</b></font>
	</a>
	</div>-->
	<p><? echo $id2; ?></p>
	</div>
	</div>

	</body>
	</html>