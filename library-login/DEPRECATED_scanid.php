<?php
//	$page = $_SERVER['PHP_SELF'];
//	$sec = "60";
	header( "refresh:120;url=index.php" );
	
	session_start();
	$_SESSION['id'] = $_GET['id'];
	$idofuser = $_SESSION['id'];
		//$_SESSION['idofuser'] = $_GET['id'];
	
	
	//if(isset($_GET['id'])){
    //$idofuser = $_POST['id'];
	//}

	//$_SESSION['idofuser'] = $_GET['id'];

	
	require_once ("db.php");
	error_reporting(1);
	
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
	
}	*/

		$link = mysqli_connect($hostname, $username, $passwd)
			or die("Could not connect");
			
		mysqli_select_db($link,$dbase) or die("cannot select DB");
		//Capture who is the currently logged-in staff
		$sql = "select bo.firstname, bo.surname, es.borrowernumber from entry_staffloggedin es LEFT JOIN borrowers bo ON (es.borrowernumber=bo.borrowernumber) where currently_loggedin='1' order by entry_staffloggedin_id DESC LIMIT 1";
		// the result of the query
		$result = mysqli_query($link,$sql) or die("Invalid query");
		$data8=mysqli_fetch_row($result);	
		

	?>

	<html>

	<head>
	  <title>Senate Legislative Library Visitor Monitoring System</title>
	  <meta name="description" content="Senate Legislative Library Visitor Monitoring System" />
	  <!--<meta http-equiv="refresh" content="<?php /*echo $sec?>;URL='<?php echo $page*/?>'">-->
	  <link rel='shortcut icon' href="/kohaimages/senate/website_banner18th__0.png" type=image/png"/ >
	  <link rel="stylesheet" type="text/css" href="includes/main.css">
	</head>


	

	<body>
	<center>
	<div style="text-align: center;">
	<a href="/visitor-login" style="text-decoration: none;">
	<img src="/kohaimages/senate/website_banner18th__0.png" alt="Senate Library Banner"/>
	</a>
	</div>

	<font size = +3> <font color = 'b2965a'><b>Senate Legislative Library Visitor Monitoring System</b></font>
	<hr color='#b2965a'>	
	
	
	
		<?php
		
	//$id = "";
	//echo "$idofuser";
	$id = strtoupper($_GET['id']);
	if ($id == '') { }
		else {
		// just so we know it is broken
		error_reporting(E_ALL);
		// some basic sanity checks
	 
		// get the image from the db
			
		$datetoday = date("Y/m/d");
		
		$sql = "select surname,firstname,address, cardnumber, othernames from borrowers where othernames='$id' or cardnumber='$id'";
			// the result of the query
		$result = mysqli_query($link,$sql) or die("Invalid query");
		$data1=mysqli_fetch_row($result);
		$name_of_patron = "$data1[1]" . " " . "$data1[0]";
		
		$sql="select imagefile, mimetype from patronimage p LEFT JOIN borrowers b on (p.borrowernumber=b.borrowernumber) where othernames='$id' or cardnumber='$id' ";
		$result=mysqli_query($link,$sql) or die("Invalid query");
		$data2=mysqli_fetch_row($result);
		
		$sql="SELECT sort2 from borrowers where cardnumber='$id' and sort2 = '1'";
		$result=mysqli_query($link,$sql) or die("Invalid query");
		$data3=mysqli_fetch_row($result);  

	// get date of expiration
		
		$sql="SELECT dateexpiry, firstname from borrowers where cardnumber='$data1[3]'";
		$result=mysqli_query($link,$sql) or die("Invalid query");
		$data4=mysqli_fetch_row($result);
		
		// get the circ notes
		$sql="SELECT borrowernotes, firstname from borrowers where cardnumber='$id' and borrowernotes LIKE '%VALIDATE%'";
		$result=mysqli_query($link,$sql) or die("Invalid query");
		$data5=mysqli_fetch_row($result);
		
		$sql = "select toe from entry where cardnumber='$data1[3]' order by slno DESC LIMIT 1";
		// the result of the query
		$result = mysqli_query($link,$sql) or die("Invalid query" );
		$data6=mysqli_fetch_row($result);

		$sql = "select floor from entry where cardnumber='$data1[3]' order by slno DESC LIMIT 1";
		// the result of the query
		$result = mysqli_query($link,$sql) or die("Invalid query" );
		$data7 = mysqli_fetch_row($result);
		
		//mysqli_close($link);
		
		$sound1 = '<EMBED src="denied.mp3" autostart=true loop=false volume=500 hidden=true><NOEMBED><BGSOUND src="tada.wav"></NOEMBED>';
		$sound2 = '<EMBED src="denied.mp3" autostart=true loop=false volume=500 hidden=true><NOEMBED><BGSOUND src="tada.wav"></NOEMBED>';
		$sound3 = '<EMBED src="unreturnednotice.mp3" autostart=true loop=false volume=500 hidden=true><NOEMBED><BGSOUND src="tada.wav"></NOEMBED>';
		
		$floor="Legislative Library";
		  
		$currentTime = time($data6[0]) + 3600;
		$currentTime2 = time() + 3600;
		$currentTime3 = ($data6[0]) + 3600;
		  
		$from_time = strtotime($data6[0]);
		$to_time = strtotime(date('Y-m-d H:i:s'));
		$minutesdiff = round(abs($to_time - $from_time) / 60,2);
		$minutesdiff_notrounded = round(abs($to_time - $from_time) / 60,0);
		  
		if (sizeof($data2) > 1) {			
			echo '<img src="data:image/jpg/png/jpeg;base64,' . base64_encode( $data2[0] ) . '" height="150" />';  
			echo "<BR>";
		}
		else{			
			echo '<img src="/kohaimages/senate/profile-shadow.png" height="150" />';  
			echo "<BR>";
		}			
		
	//			}	elseif ((sizeof($data1) > 1) && $minutesdiff >= "10") {
		if (sizeof($data1) > 1) {

			echo "<font color= 'white' size = +2>".$data1[0]."</font>";
			echo "<font color= 'white' size = +2>, ".$data1[1]."</font>";
		//	echo "<BR>";
		//	echo "<font color= 'red' size = +2>".$data1[1]."</font>";
			echo "<br>";
			echo "<font color= 'white' size = +1> ID No.  ".$data1[3]."</font>";
			echo "<br>";
			$time=date('Y-m-d H:i:s');
			$time2=date('Y-m-d');
			echo "<font color= 'white' size = +1> Time of entry:".$time."</font> <br>";						
					
				}
		else {
			echo "<font color= 'white' size = +1>You entered: ".$id."</font>";
			echo "<br>";
			$time=date('Y-m-d H:i:s');
			$time2=date('Y-m-d');
				echo "<font color= 'white' size = +1> Time:".$time."</font> <br>";
			
			echo "<font color='red' size = +2> Your ID number does not match any in the database. But we can still proceed registering you into the  Visitor Monitoring System.</font> <br>";			
			//echo $basic_research;
			echo $sound2;
			
					}

		echo "</center>";
		  
			echo "<center>";
	//		$text1 = mysql_num_rows($data4);
	//		echo $text1;
			if (strtotime($data4[0]) < strtotime($datetoday) && sizeof($data4) > 1)
	//	if (sizeof($data4) > 1 || strtotime($data4[0]) < strtotime($datetoday))
				{ 
			echo "<font color='red' size = +2> ID not validated. Your library card expired $data4[0]. Please proceed to the Circulation counter.</font> <br>";
			}
			
			else {
						}
				?>
				
				
<form class="form-horizontal" action="action.php" method="post">
<fieldset>

<!-- Form Name -->
<legend style="color:white;">Please check your purpose in visiting the library? (You can check more than one)</legend>

<!-- Multiple Checkboxes (inline) -->
<div class="form-group">
  <!--<label class="col-md-4 control-label" for="checkboxes"></label>-->
  <div class="col-md-4">
    <label class="checkbox-inline" for="checkboxes-0" style="color:white;">
      <input type="checkbox" name="check_list[]" value="Basic Research">
      Basic Research
    </label>
    <label class="checkbox-inline" for="checkboxes-1" style="color:white;">
      <input type="checkbox" name="check_list[]" value="Online Research">
      Online Research
    </label>
    <label class="checkbox-inline" for="checkboxes-2" style="color:white;">
      <input type="checkbox" name="check_list[]" value="Borrow Library Materials">
      Borrow Library Materials
    </label>
    <label class="checkbox-inline" for="checkboxes-3" style="color:white;">
      <input type="checkbox" name="check_list[]" value="Return Library Materials">
      Return Library Materials
    </label>
    <label class="checkbox-inline" for="checkboxes-4" style="color:white;">
      <input type="checkbox" name="check_list[]" value="Read Newspapers and Magazines">
      Read Newspapers and Magazines
    </label>
    <label class="checkbox-inline" for="checkboxes-5" style="color:white;">
      <input type="checkbox" name="check_list[]" value="Clearance">
      Clearance
    </label>
    <label class="checkbox-inline" for="checkboxes-6" style="color:white;">
      <input type="checkbox" name="check_list[]" value="Others">
      Others
    </label>
	<br />
			<textarea name="othersdescribed" rows="2" cols="120" placeholder="You may indicate exact business transaction. Please make sure you checked on 'Others' field."></textarea>
  </div>
</div>

</fieldset>
<input type="submit" name="formSubmit" value="Submit" />
</form>

	
	<?php
$user_agent       = "Mozilla/5.0 (X11; Linux i686; rv:24.0) Gecko/20140319 Firefox/24.0 Iceweasel/24.4.0";
$site = '100';
$loginref = "632603056";
$username = 'eugene';
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
		curl_setopt($curl, CURLOPT_POSTFIELDS, 'site='.$site.'&userLoginName='.$username.'&LoginReference='.$loginref.'&userLoginPassword='.$password);
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
    echo "<div style='color:red; text-decoration:none'>You currently have overdue material/s! Please see a Circulation staff.</div>";
	echo $sound3;
} else {
	
}
        curl_close($curl);
		
	echo("<a href='index.php'>Go Back</a>");
		exit;

	}
	 

	?>


	<center>


	<br/>


	<p style="background-color:powderblue;">Monitoring Staff: <?php echo $data8[0]; ?> <?php echo $data8[1]; ?></p>

<p style="color:white;">Data Privacy Notice:</p>
<p style="color:white;">The Legislative Library Service (LLS) is committed to protecting the privacy of its data subjects, and ensuring the safety and security of personal data under its control and custody.</p>

	</center>

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