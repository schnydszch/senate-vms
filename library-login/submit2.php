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

		<div align="center">
		
		
		<?php
		//This is the php form to submit an ID not based on ID number
		//include_once "db.php"
		require_once("db.php");
		error_reporting(1);
		header( "refresh:30;url=index.php" );

		session_start();

		/*Added below to prevent undefined index in error message:
		https://stackoverflow.com/questions/14097897/how-to-fix-notice-undefined-index-in-php-form-action
		*/	
		
		/*	$basic_research = "";
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
		*/
		
		
		$basic_research = $_SESSION['basic_research'];
		$online_research = $_SESSION['online_research'];
		$borrowlibmat = $_SESSION['borrowlibmat'];
		$returnlibmat = $_SESSION['returnlibmat'];
		$readnews = $_SESSION['readnews'];
		$clearance = $_SESSION['clearance'];
		$others = $_SESSION['others'];
		$othersdescribed = $_SESSION['othersdescribed'];
		
		$id2 = $_SESSION['id2'];
		
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
		

		
		$link = mysqli_connect($hostname, $username, $passwd)
				or die("Could not connect");
				// select our database
				mysqli_select_db($link,$dbase) or die("cannot select DB");

		//Ito orig: $id = strtoupper($_GET['id']);
		/*if(isset($_POST['id'])){
		$id = $_POST['id'];
	}*/
		
		//$id = "";
		 

			// $link = mysqli_connect($hostname, $username, $passwd)
			//	or die("Could not connect");
			//	// select our database
			//	mysqli_select_db($link,$dbase) or die("cannot select DB");

				// get the image from the db
				
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
		$sound3 = "includes/mp3/recordsubmitted.mp3";
			
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
				//echo "$basicresearch";
			}
			else{
				echo "<br/>";
				echo '<img src="includes/images/profile-shadow.png" height="150" />';  
				echo "<br/>";
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

				echo "<p style='color:white;font-size:x-large;margin-bottom:0em;'>".$data1[0].", ".$data1[1]."</p>";
			//	echo "<BR>";
			//	echo "<font color= 'red' size = +2>".$data1[1]."</font>";
				
				echo "<p style='color:white;font-size:x-large;margin-bottom:0em;'>ID No. ".$data1[3]."</p>";
				
				date_default_timezone_set('Asia/Manila');
				$time=date('Y-m-d H:i:s');
				$time2=date('Y-m-d');
				echo "<p style='color:white;font-size:x-large;margin-bottom:0em;'> Time of entry: ".$time."</p>";
					
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
				echo "<p style='color:white;font-size:x-large;margin-bottom:0em;'>You entered: ".$id."</p>";
				echo "<p style='color:white;font-size:x-large;margin-bottom:0em;'>The ID number is: ".$id2."</p>";
				
				echo "<br>";
				
				date_default_timezone_set('Asia/Manila');
				$time=date('Y-m-d H:i:s');
				$time2=date('Y-m-d');
				echo "<p style='color:white;font-size:x-large;margin-bottom:0em;'> Time:".$time."</p>";
				
				echo "<p style='color:red;font-size:x-large;margin-bottom:0em;'>You're inputted ID does not matched any in the VMS database. However, this transaction has been recorded in VMS.</p>";
				echo "<p style='color:white;font-size:x-large;'>Please approach a library personnel.</p>";
				//echo $basic_research;
				//echo $sound2;
				
				/*We record invalid entries, ID numbers not in Koha database. Column isvalid is '0' in the insert query*/
		/*		$link2=mysqli_connect($hostname,$username,$passwd)
				or die ("Could not connect to second database");
				mysqli_select_db($link,$dbase) or die ("Error");
				$sql="insert into accessdenied (cardnumber,othernames,name,floor,isvalid,basicresearch,onlineresearch,borrowlibmat,returnlibmat,others) values ('$id','$id','','$floor','0','$basic_research','$online_research','$borrowlibmat','$returnlibmat','$others')";
				mysqli_query($link2,$sql);*/
				
				//$link1=mysqli_connect($hostname,$username,$passwd)
				//or die ("Could not connect to second database");	
				//mysqli_select_db($link1,$dbase) or die ("Error");
				/*$sql="insert into accessdenied (cardnumber,othernames,name,floor,isvalid,basicresearch,onlineresearch,borrowlibmat,returnlibmat,others) values ('$id','$id','','$floor','0','$basic_research','$online_research','$borrowlibmat','$returnlibmat','$others')";*/
				//$sql="insert into entry (cardnumber,othernames,name,floor,isvalid,basicresearch,onlineresearch,borrowlibmat,returnlibmat,readnews,clearance,others,others_described,surname_staff,staff_borrowerno) values ('$id','$id','$id','$floor','0','$basic_research','$online_research','$borrowlibmat','$returnlibmat','$readnews','$clearance','$others','$othersdescribed','$data8[1]','$data8[2]')";
				//mysqli_query($link1,$sql);
				//mysqli_close($link);
				
						}

			//echo "</center>";
			  
				//echo "<center>";
		//		$text1 = mysql_num_rows($data4);
		//		echo $text1;
				//if (strtotime($data4[0]) < strtotime($datetoday) && sizeof($data4) > 1)
		//	if (sizeof($data4) > 1 || strtotime($data4[0]) < strtotime($datetoday))
					//{ 
				//echo "<font color='red' size = +2> ID not validated. Your library card expired $data4[0]. Please proceed to the Circulation counter.</font> <br>";
				//}
				
				//else {
				//			}
					
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
		
		echo ("<p style='color:white;font-size:x-large;'>Thank You! Record Submitted.</p>");
		
		echo '<audio autoplay="true" style="display:none;">
			<source src="'.$sound3.'" type="audio/wav">
			</audio>';	
		
				

		unset($_SESSION['basic_research']);
		unset($_SESSION['online_research']);
		unset($_SESSION['borrowlibmat']);
		unset($_SESSION['returnlibmat']);
		unset($_SESSION['readnews']);
		unset($_SESSION['others']);
		unset($_SESSION['othersdescribed']);
		unset($_SESSION['fullname']);
		unset($_SESSION['email']);
		unset($_SESSION['office']);
		
		
			//exit;
		 

		?>
				
		<a href='index.php' style='font-size:x-large;'>Go Back</a>
		<br/>
		
		<a href='scanidvisitor.php' style="font-size:x-large;">Outside researchers or visitors, please click here</a>

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
		
		<p> <?php //echo '<pre>' . print_r($_SESSION, TRUE) . '</pre>'; ?> </p>
		
		<p> <?php //echo $id2; ?>


		</div>
		</div>
	</div>	

	</body>
</html>