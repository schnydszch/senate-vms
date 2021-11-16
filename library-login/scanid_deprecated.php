	<html>

	<head>
	  <title>Senate Legislative Library Visitor Monitoring System</title>
	  <meta name="description" content="Senate Legislative Library Visitor Monitoring System" />
	  <meta http-equiv="refresh" content="<?php echo $sec?>;URL='<?php echo $page?>'">
	  <link rel='shortcut icon' href="/kohaimages/senate/website_banner18th__0.png" type=image/png"/ >
	</head>

	<style>
	body{
	background-image: url("/kohaimages/senate/gate-entry-bg.jpg");
		background-size: 100% 100%;
	}
	#footer {
			width:100%;
			position:absolute;
			bottom:0;
			left:0;
			}
			
	/* unvisited link */
	a:link {
	  color: red;
	}

	/* visited link */
	a:visited {
	  color: 33FF4C;
	}

	/* mouse over link */
	a:hover {
	  color: b2965a;
	}

	/* selected link */
	a:active {
	  color: blue;
	}				
			
	</style>

	<body>
	<center>
	<div style="text-align: center;">
	<a href="index.php" style="text-decoration: none;">
	<img src="/kohaimages/senate/website_banner18th__0.png" alt="Senate Library Banner"/>
	</a>
	</div>

	<font size = +3> <font color = 'b2965a'><b>Senate Legislative Library Visitor Monitoring System</b></font>
	<hr color='#b2965a'>


	<?php
	//include_once "db.php"
	require_once("db.php");
            error_reporting(0);
	header( "refresh:60;url=index.php" );

	session_start();

/*Added below to prevent undefined index in error message:
https://stackoverflow.com/questions/14097897/how-to-fix-notice-undefined-index-in-php-form-action
*/	
$id = "";
$basic_research = "";
$online_research = "";
$borrowlibmat = "";
$returnlibmat = "";
$readnews = "";
$clearance = "";
$others = "";
$othersdescribed = "";

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
	if(isset($_SESSION['clearance'])){
    $clearance = $_SESSION['clearance'];
}	
	if(isset($_SESSION['others'])){
    $others = $_SESSION['others'];
}	
	if(isset($_SESSION['othersdescribed'])){
    $othersdescribed = $_SESSION['othersdescribed'];
}	
	
	/*$basic_research = $_SESSION['basic_research'];
	$online_research = $_SESSION['online_research'];
	$borrowlibmat = $_SESSION['borrowlibmat'];
	$returnlibmat = $_SESSION['returnlibmat'];
	$readnews = $_SESSION['readnews'];
	$others = $_SESSION['others'];*/

		 $link = mysqli_connect($hostname, $username, $passwd)
			or die("Could not connect");
			// select our database
			mysqli_select_db($link,$dbase) or die("cannot select DB");

		//Capture who is the currently logged-in staff
		$sql = "select bo.firstname, bo.surname, es.borrowernumber from entry_staffloggedin es LEFT JOIN borrowers bo ON (es.borrowernumber=bo.borrowernumber) where currently_loggedin='1' order by entry_staffloggedin_id DESC LIMIT 1";
		// the result of the query
		$result = mysqli_query($link,$sql) or die("Invalid query");
		$data8 = mysqli_fetch_row($result);



	//Ito orig: $id = strtoupper($_GET['id']);
	/*if(isset($_POST['id'])){
    $id = $_POST['id'];
}*/
	
	//$id = "";
	$id = strtoupper($_GET['id']);
	if ($id == '') { echo "<center> <font color = 'white'><blink>PLEASE ENTER YOUR ID NUMBER </blink></font></center><br>";}
		else {
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
		$name_of_patron = "$data1[1]" . " " . "$data1[0]";
		
		$sql="select imagefile, mimetype from patronimage p LEFT JOIN borrowers b on (p.borrowernumber=b.borrowernumber) where othernames='$id' or cardnumber='$id' ";
		$result=mysqli_query($link,$sql) or die("Invalid query");
		$data2=mysqli_fetch_row($result);
		
		$sql="SELECT sort2 from borrowers where cardnumber='$id' and sort2 = '1'";
		$result=mysqli_query($link,$sql);
		$data3=mysqli_fetch_row($result);  
	//	$sql="SELECT enrolmentperioddate from categories c LEFT JOIN borrowers b on (c.categorycode=b.categorycode) where cardnumber='$id'";
	// 	$result=mysql_query($sql);
	//	$data3=mysql_fetch_row($result);
	// get date of expiration
		
		$sql="SELECT dateexpiry, firstname from borrowers where cardnumber='$data1[3]'";
		$result=mysqli_query($link,$sql);
		$data4=mysqli_fetch_row($result);
		
		// get the circ notes
		$sql="SELECT borrowernotes, firstname from borrowers where cardnumber='$id' and borrowernotes LIKE '%VALIDATE%'";
		$result=mysqli_query($link,$sql);
		$data5=mysqli_fetch_row($result);
		
		$sql = "select toe from entry where cardnumber='$data1[3]' order by slno DESC LIMIT 1";
		// the result of the query
		$result = mysqli_query($link,$sql) or die("Invalid query" );
		$data6=mysqli_fetch_row($result);

		$sql = "select floor from entry where cardnumber='$data1[3]' order by slno DESC LIMIT 1";
		// the result of the query
		$result = mysqli_query($link,$sql) or die("Invalid query" );
		$data7 = mysqli_fetch_row($result);
		
		mysqli_close($link);
		
		$sound1 = '<EMBED src="http://pilc.org.ph/kohaimages/denied.mp3" autostart=true loop=false volume=500 hidden=true><NOEMBED><BGSOUND src="tada.wav"></NOEMBED>';
		$sound2 = '<EMBED src="http://pilc.org.ph/kohaimages/denied.mp3" autostart=true loop=false volume=500 hidden=true><NOEMBED><BGSOUND src="tada.wav"></NOEMBED>';
		
		$floor="Legislative Library";
		  
		$currentTime = time($data6[0]) + 3600;
		$currentTime2 = time() + 3600;
		$currentTime3 = ($data6[0]) + 3600;
		  
		$from_time = strtotime($data6[0]);
		$to_time = strtotime(date('Y-m-d H:i:s'));
		$minutesdiff = round(abs($to_time - $from_time) / 60,2);
		$minutesdiff_notrounded = round(abs($to_time - $from_time) / 60,0);
		  
		if (sizeof($data2) > 1) {
			echo "<BR>";
			echo '<img src="data:image/jpg/png/jpeg;base64,' . base64_encode( $data2[0] ) . '" height="150" />';  
			echo "<BR>";
		}
		else{
			echo "<BR>";
			echo '<img src="/kohaimages/senate/profile-shadow.png" height="150" />';  
			echo "<BR>";
		}
		
		
	//		if ($minutesdiff <= "10" && $data7[0]="Computer Section") {
	//			echo "<font color= 'white' size = +2>".$data1[0]."</font>";
	//                echo "<font color= 'white' size = +2>, ".$data1[1]."</font>";
	//				echo "<br>";
	//				echo "<font color= 'white' size = +1> ID No.  ".$data1[3]."</font>";
	//		echo "<br>";
	//		$time=date('Y-m-d H:i:s');
	//		$time2=date('Y-m-d');
	  //  		echo "<font color= 'white' size = +1> Time:".$time."</font><br>";
	//			echo "<font color='maroon' size = +1.75>You have already logged-in in the last ".$minutesdiff_notrounded." minute/s. This will be recorded as invalid entry, please refrain from doing this again.</font>";	

	/*We record students swiping their cards multiple times. Column isvalid is '0' in the insert query, so that we can easily distinguished valid entries from invalid entries*/
	//		mysqli_select_db($link,$dbase) or die ("Error");
	//		$sql="insert into entry (cardnumber,othernames,name,floor,isvalid) values ('$data1[3]','$data1[4]','$data1[0]','$floor','0')";
	//		mysqli_query($link,$sql);
	//		mysqli_close($link1);

				
		
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
				
			/*We record valid entries, ID numbers not in Koha database. Column isvalid is '1' in the insert query*/			
			$link1=mysqli_connect($hostname,$username,$passwd)
			or die ("Could not connect to second database");
			mysqli_select_db($link1,$dbase) or die ("Error");
			$sql="insert into entry (cardnumber,othernames,name,floor,isvalid,isvisitor,borrowernumber,basicresearch,onlineresearch,borrowlibmat,returnlibmat,readnews,clearance,others,others_described,surname_staff, staff_borrowerno) values ('$data1[3]','$data1[4]','$name_of_patron','$floor','1','0','$data8[2]','$basic_research','$online_research','$borrowlibmat','$returnlibmat','$readnews','$clearance','$others', '$othersdescribed', '$data8[1]','$data8[2]')";
			mysqli_query($link1,$sql);
			//mysqli_close($link);
			//$staff_firstname = $data8[0];
			//$staff_lastname = $data8[0];
					
				}
		else {
			echo "<font color= 'white' size = +1>You entered: ".$id."</font>";
			echo "<br>";
			$time=date('Y-m-d H:i:s');
			$time2=date('Y-m-d');
				echo "<font color= 'white' size = +1> Time:".$time."</font> <br>";
			
			echo "<font color='red' size = +2> Access Denied...</font> <br>";
			echo "<p style='color:white;'>Please approach a library personnel.</p><br/>";
			echo $basic_research;
			echo $sound2;
			
			/*We record invalid entries, ID numbers not in Koha database. Column isvalid is '0' in the insert query*/
	/*		$link2=mysqli_connect($hostname,$username,$passwd)
			or die ("Could not connect to second database");
			mysqli_select_db($link,$dbase) or die ("Error");
			$sql="insert into accessdenied (cardnumber,othernames,name,floor,isvalid,basicresearch,onlineresearch,borrowlibmat,returnlibmat,others) values ('$id','$id','','$floor','0','$basic_research','$online_research','$borrowlibmat','$returnlibmat','$others')";
			mysqli_query($link2,$sql);*/
			
			$link1=mysqli_connect($hostname,$username,$passwd)
			or die ("Could not connect to second database");	
			mysqli_select_db($link1,$dbase) or die ("Error");
			/*$sql="insert into accessdenied (cardnumber,othernames,name,floor,isvalid,basicresearch,onlineresearch,borrowlibmat,returnlibmat,others) values ('$id','$id','','$floor','0','$basic_research','$online_research','$borrowlibmat','$returnlibmat','$others')";*/
			$sql="insert into entry (cardnumber,othernames,name,floor,isvalid,basicresearch,onlineresearch,borrowlibmat,returnlibmat,readnews,clearance,others,others_described,surname_staff,staff_borrowerno) values ('$id','$id','$id','$floor','0','$basic_research','$online_research','$borrowlibmat','$returnlibmat','$readnews','$clearance','$others','$othersdescribed','$data8[1]','$data8[2]')";
			mysqli_query($link1,$sql);
			//mysqli_close($link);
			
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
				
	/*
	$test = mysql_num_rows($data5);
		echo $test;
		if (mysql_num_rows($data5)==0)	{ 
			}
			else {
			 echo "<font color='black' size = +2> You were manually validated by the library staffs. </font> <br> <br>";
			 echo "</center>";
			}
				
		echo $data5[0];
		if (sizeof($data5) < 1) {

		print $data5[0];
		if (empty($data5)) {
		
		if (empty($data5) && sizeof($data1) > 1) {
		 echo "<font color='red' size = +2> You were not manually validated by the library staffs. Please proceed to the Circulation counter to validate your card.</font> <br> <br>";
		}
		
		else {
		 
		}
		
		
		if (sizeof($data5) < 1) {	
		}
		elseif (sizeof($data5) > 1){
			echo "<font color='black' size = +2> You were manually validated by the library staffs. </font> <br> <br>";
			
		}
		else {
			 echo "<font color='red' size = +2> You were not manually validated by the library staffs. </font> <br> <br>";
			  
		}
		 echo "</center>";
			
		
		 if (count($data5) > 1) {*/
	//	if (preg_match('/*VALIDATE*/', $data5[0])) { 
	/*		  echo "<font color='black' size = +2> You were manually validated by the library staffs. </font> <br> <br>";
			 echo "<font color='red' size = +2> You were not manually validated by the library staffs. </font> <br> <br>";
			 
			 echo "</center>";
			 
		 }
		 
		 elseif (empty($data5){
			 
		 }
			 
		 else{
					echo "<font color='red' size = +2> You were not manually validated by the library staffs. </font> <br> <br>";

			 
		 }
		 
	*/
	
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
    echo "<p style='color:red; text-decoration:none'>You currently have overdue material/s! Please see a Circulation staff.</p>";
} else {
	
}
        curl_close($curl);
		
	



	unset($_SESSION['basic_research']);
	unset($_SESSION['online_research']);
	unset($_SESSION['borrowlibmat']);
	unset($_SESSION['returnlibmat']);
	unset($_SESSION['others']);

	echo("<a href='index.php'>Go Back</a>");
		exit;

	}
	 

	?>
	<center>



	<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="GET">
	<input type = 'text', name = 'id' autofocus="autofocus"> 
	<script>
	  if (!("autofocus" in document.createElement("input"))) {
		document.getElementById("my-input").focus();
	  }
	</script>


	<button type="submit" value="Submit" onclick="this.disabled=true;this.value='Sending, please wait...';this.form.submit();">Submit</button>


	</form>
	</center>
	<br/>
	
	<a href='scanidvisitor.php'>Outside researchers or visitors, please click here</a>

	<p style="background-color:powderblue;">Monitoring Staff: <?php echo $data8[0]; ?> <?php echo $data8[1]; ?></p>

	<p style="color:white;">Data Privacy Notice:</p>
	<p style="color:white;">The Legislative Library Service (LLS) is committed to protecting the privacy of its data subjects, and ensuring the safety and security of personal data under its control and custody..</p>

	<div id="footer">
	<div style="text-align: center;">


	</div>
	</div>

	</body>
	</html>

