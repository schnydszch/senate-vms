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
	
	
		<?php
		//include_once "db.php"
		//require_once("db.php");
		error_reporting(1);
		header("refresh:120;url=index.php");	

		session_start();
		
		//$idofuser = $_SESSION['id'];
		
		//$idofuser = $_POST['id'];

		//$id = $_SESSION['id'];
		//echo("<p>You didn't select anything.</p>\n");
		//echo ("<p style='color:white;'>Your inputted ID number: $idofuser</p>");
		
		$_SESSION['id'] = $_GET['id'];
		
		if(isset($_GET['submit']))
	
			{			
			$aDoor = $_GET['check_list'];
			//$aId = $_POST['id'];
			
			if(empty($_GET['id'])&&empty($aDoor))
			{			
			echo("<div align='center'><p style='color:white;font-size:large'>You didn't provided any information.</p></div>");
			echo("<div align='center'><a href='javascript:history.go(-1)' style='font-size:large;'>Go Back</a></div>");			
			
			}		 		
			else 			
			{				
				if(empty($aDoor)) 
			/*	if(empty(IsChecked('check_list','Basic Research')) && empty(IsChecked('check_list','Online Research')) && empty(IsChecked('check_list','Borrow Library Materials')) && empty(IsChecked('check_list','Return Library Materials')) && empty(IsChecked('check_list','Read Newspapers and Magazines')) && empty(IsChecked('check_list','Clearance')) && isset($_POST['othersdescribed']))*/			
			
				{
				echo("<div align='center'><p style='color:white;font-size:x-large'>You didn't select any purpose/s of your visit.</p></div>");
				echo("<div align='center'><a href='javascript:history.go(-1)' style='font-size:x-large;'>Go Back</a></div>");
				}						
				else
				{
				
				?>
				
				<div align="center">	
	
				<?php 
					if(!empty($_GET['id'])&&!empty($aDoor))	
					//if(empty($_POST['id'])&&empty($aDoor))		
					{ 		
					$id = strtoupper($_GET['id']);
					// just so we know it is broken
					error_reporting(E_ALL);
					// some basic sanity checks
	 
					require_once("db.php");
	 
					//connect to the db
					$link = mysqli_connect($hostname, $username, $passwd)
					or die("Could not connect");
					// select our database
					mysqli_select_db($link,$dbase) or die("cannot select DB");

					// get the image from the db
		
					$datetoday = date("Y/m/d");
			
			
					$sql = "select surname,firstname,address, cardnumber, othernames from borrowers where othernames='$id' or cardnumber='$id'";
					// the result of the query
					$result = mysqli_query($link,$sql) or die("Invalid query");
					$data1=mysqli_fetch_row($result);
					
					if (mysqli_num_rows($result)==1) {
					$name_of_patron = "$data1[1]" . " " . "$data1[0]";
					}
		
					$sql="select imagefile, mimetype from patronimage p LEFT JOIN borrowers b on (p.borrowernumber=b.borrowernumber) where othernames='$id' or cardnumber='$id' ";
					$result=mysqli_query($link,$sql) or die("Invalid query");
					$data2=mysqli_fetch_row($result);
		
					//$sql="SELECT sort2 from borrowers where cardnumber='$id' and sort2 = '1'";
					//$result=mysqli_query($link,$sql);
					//$data3=mysqli_fetch_row($result);  
		
					//$sql="SELECT dateexpiry, firstname from borrowers where cardnumber='$data1[3]'";
					//$result=mysqli_query($link,$sql);
					//$data4=mysqli_fetch_row($result);
		
				if(isset($data1)) {
					$sql = "select toe from entry where cardnumber='$data1[3]' order by slno DESC LIMIT 1";					
					$result = mysqli_query($link,$sql) or die("Invalid query" );
					$data6=mysqli_fetch_row($result);
					//$data6=mysqli_fetch_array($result);
					
				}

					if(isset($data1)) {
					$sql = "select floor from entry where cardnumber='$data1[3]' order by slno DESC LIMIT 1";					
					$result = mysqli_query($link,$sql) or die("Invalid query" );
					$data7 = mysqli_fetch_row($result);
					}
					
					//Capture who is the currently logged-in staff
					$sql = "select bo.firstname, bo.surname, es.borrowernumber from entry_staffloggedin es LEFT JOIN borrowers bo ON (es.borrowernumber=bo.borrowernumber) where currently_loggedin='1' order by entry_staffloggedin_id DESC LIMIT 1";
					$result = mysqli_query($link,$sql) or die("Invalid query");
					$data8=mysqli_fetch_row($result);
		
					mysqli_close($link);
		
					//$sound1 = '<EMBED src="includes/mp3/id_not_in_vms.mp3" autostart=true loop=false volume=500 hidden=true><NOEMBED><BGSOUND src="tada.wav"></NOEMBED>';
					$sound1 = "includes/mp3/id_not_in_vms.mp3";
					$sound2 = "includes/mp3/unreturnednotice.mp3";
		
					$floor="Legislative Library";
		  
					if(isset($data1)&&isset($data6)) {
					//$timeentry = $data6[0];	
					//$currentTime = time($timeentry) + 3600;
					//echo$data6[0];
					//echo $currentTime;
					//$currentTime2 = time() + 3600;
					//$currentTime3 = ($data6[0]) + 3600;
		  
					$from_time = strtotime($data6[0]);
					$to_time = strtotime(date('Y-m-d H:i:s'));
					$minutesdiff = round(abs($to_time - $from_time) / 60,2);
					$minutesdiff_notrounded = round(abs($to_time - $from_time) / 60,0);
					}
		  
						//if (sizeof($data2) > 1) {
							if (isset($data2)) {
						
						echo '<img src="data:image/jpg/png/jpeg;base64,' . base64_encode( $data2[0] ) . '" height="150" />';  
						echo "<br/>";
						}
						else{
						echo '<img src="includes/images/profile-shadow.png" height="150"/>';  
						echo "<br/>";
						}				

						//if (sizeof($data1) > 1) {
							if(isset($data1)){

						echo "<p style='color:white;font-size:x-large;margin-bottom:0em;'>".$data1[0].", ".$data1[1]."</p>";
						
						//	echo "<BR>";
						//	echo "<font color= 'red' size = +2>".$data1[1]."</font>";
						//echo "<br>";
						echo "<p style='color:white;font-size:large;margin-bottom:0em;'> ID No.  ".$data1[3]."</p>";
						//echo "<br>";
						date_default_timezone_set('Asia/Manila');
						$time=date('Y-m-d H:i:s');
						$time2=date('Y-m-d');
						echo "<p style='color:white;font-size:large;margin-bottom:0em;'> Time of entry:".$time."</p>";				
						
						}
						else {
						echo "<p style='color:white;font-size:large;margin-bottom:0em;'>You entered: ".$id."</p>";
						//echo "<br>";
						date_default_timezone_set('Asia/Manila');
						$time=date('Y-m-d H:i:s');
						$time2=date('Y-m-d');
						echo "<p style='color:white;font-size:large;'>Time: ".$time."</p>";
			
						echo "<p style='color:red;font-size:x-large;'>You're inputted ID does not exist in the VMS database. Please approach a library personnel.</p>";
						echo("<a href='searchuser.php' style='color:#cdf7dd;font-size:x-large;' class='blink-green blink-one'>Click here to search for a user</a>");
						
						$_SESSION['id']=$id;						
						
						echo '<audio autoplay="true" style="display:none;">
								<source src="'.$sound1.'" type="audio/wav">
								</audio>';						
			
						}

						//echo "</center>";
		  
						//echo "<center>";
						//		$text1 = mysql_num_rows($data4);
						//		echo $text1;
						//if (strtotime($data4[0]) < strtotime($datetoday) && sizeof($data4) > 1)
						//	if (sizeof($data4) > 1 || strtotime($data4[0]) < strtotime($datetoday))
						
					
						//if (sizeof($data2) > 1)
							if (isset($data2))
						{ 
						//echo "<font color='red' size = +2> ID not validated. Your library card expired $data4[0]. Please proceed to the Circulation counter.</font> <br>";
						
						
						//code to know if user has overdue materials, curl to DLM						
						
					$user_agent       = "Mozilla/5.0 (X11; Linux i686; rv:24.0) Gecko/20140319 Firefox/24.0 Iceweasel/24.4.0";
					$site = '100';
					$loginref = "632603056";
					$dlmusername = 'eugene';
					$password = 'eugene';
					$loginUrl = 'http://111.125.73.190:8081/common/welcome.jsp';
					$id = $_GET['id'];
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
						
						
						
						}
						
						else {
						}					
						
						
				?>
									
					<form action="submit.php" method="post" onsubmit="return checkForm(this);">
					<input type="submit" name="formSubmit" value="Click This to Record Your Visit." />
					</form>
					<p class="blink blink-one" style="margin-bottom:0em;">This form will be automatically submitted after 15 seconds.</p>
									
				<?php
											

						}
					else {
					echo("<div align='center'><p style='color:white;font-size:x-large;'>You didn't scan your ID.</p></div>");
					echo("<div align='center' style='font-size:x-large'><a href='javascript:history.go(-1)'>Go Back</a></div>");
							
					}
									}
			}		
		}	
						
						
					//check if checkboxes were checked
					if(!empty($aDoor)&&!empty($_GET['id']))
					{
						$N = count($aDoor);									
									
						if ($N == 1)
						{
							echo("<p style='color:white;font-size:x-large;margin-bottom:0em;'>You selected: ");
								for($i=0; $i < $N; $i++)
								{
									//echo($aDoor[$i] . "</p>");
									echo($aDoor[$i]);
								}
									echo("</p>"); 
						}	
						else
						{
							
							echo("<p style='color:white;font-size:x-large;margin-bottom:0em;'>You selected $N activities: ");							
							
							$post_str = '';
							foreach($aDoor as $key=>$value){
							$post_str .= $value.", ";	
								
							}
							
							$post_str = substr($post_str,0,-2);
							//$post_str = substr_replace($post_str, ' and', strpos($post, ', '),1);
							
							$post_str = preg_replace("/,([^,]+)$/", " and $1", $post_str);
							
							echo $post_str;
							
							echo("</p>");
				
						}
							//echo("<a href='scanid.php'>Click here to proceed</a>");
							//echo("<a href='javascript:history.go(-1)'>Click here to go back to modify your purpose/s</a>");
							//echo("<br/><a href='scanidvisitor.php'>Outside researchers or visitors, please click here</a>");
				
					if(!empty($_GET['othersdescribed'])){
						$othersdescribed = $_GET['othersdescribed'];
					
						echo "<p style='color:white;font-size:x-large;'>You described your 'Others' activity as: \"";
						echo $othersdescribed;
						echo "\"</p>";					
					
					}
			
				?>
			
			<a href='javascript:history.go(-1)' style='font-size:x-large'>Click here to go back and modify your purpose/s of visit</a><br/>
			
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
			
			if(isset($_GET['othersdescribed'])){
				$_SESSION['othersdescribed'] =	$_GET['othersdescribed'];
				//$_SESSION['others'] = '1';
				
			}		

			
			$_SESSION['othersdescribed'] =	$_GET['othersdescribed'];
				
				//and so on
				
		
		
			function IsChecked($chkname,$value)
			{
				if(!empty($_GET[$chkname]))
				{
					foreach($_GET[$chkname] as $chkval)
					{
						if($chkval == $value)
						{
							return true;
						}
					}
				}
				return false;
			}		
			

		//echo $a;
		//print_r($_SESSION);
		
			//require_once "db.php";
	
	
	//require_once "/admin/config.php";

	/*Added below to prevent undefined index in error message:
https://stackoverflow.com/questions/14097897/how-to-fix-notice-undefined-index-in-php-form-action
*/
/*	if(isset($_POST['basic_research'])){
    $basic_research = $_POST['basic_research'];
}
	if(isset($_POST['online_research'])){
    $online_research = $_POST['online_research'];
}	
	if(isset($_POST['borrowlibmat'])){
    $borrowlibmat = $_POST['borrowlibmat'];
}	
	if(isset($_POST['returnlibmat'])){
    $returnlibmat = $_POST['returnlibmat'];
}		
	if(isset($_POST['readnews'])){
    $readnews = $_POST['readnews'];
}	
	if(isset($_POST['clearance'])){
    $others = $_POST['clearance'];
}	
	if(isset($_POST['others'])){
    $others = $_POST['others'];
}	
	if(isset($_POST['othersdescribed'])){
    $othersdescribed = $_POST['othersdescribed'];
	
}	
*/

	?>


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

	</div>

	<div id="footer">
	<div style="text-align: center;">
	<br>
	<!--<div style="text-align:center"><a target="_blank" href="http://www.onstrike.com.ph/" style="color:black; text-decoration:none">
	<img src="/kohaimages/FEUNRMF/os-logo.png" height="x" width="40px" align="middle"/> <font size = +1> <font color = '000000'><b>c2016-2018 OnStrike Library Solutions</b></font>
	</a>
	</div>-->
	</div>
	</div>

	</body>
	</html>