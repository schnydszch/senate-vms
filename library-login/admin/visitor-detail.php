<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
include('includes/dbconnection.php');
if (strlen($_SESSION['cvmsaid']==0)) {
  header('location:logout.php');
  } else{
    //if(isset($_POST['submit']))
  
$adminid=$_SESSION['cvmsaid'];
$ret=mysqli_query($con,"select borrowernumber, surname from borrowers where borrowernumber='$adminid'");
$row=mysqli_fetch_array($ret);
$borrowernumber=$row['borrowernumber'];

$_SESSION['url'] = $_SERVER['HTTP_REFERER'];

//$fdate=$_SESSION['fdate'];
//$todate=$_SESSION['todate'];


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="au theme template">
    <meta name="author" content="Hau Nguyen">
    <meta name="keywords" content="au theme template">

    <!-- Title Page-->
    <title>Senate Legislative Library Services Visitor Monitoring System<?php print_r($_SESSION); ?></title>

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
	
	<script language="JavaScript" type="text/javascript">

function delete_id_reportsdetail(id)
{
     if(confirm('Are You Sure You Want to Remove This Record ?'))
     {
        window.location.href='delete.php?delete_id_reportsdetail='+id;
     }
	 else
	{
		/*window.history.back();
		document.referrer;*/
		window.history.go(0);
		
	}
}

function goBack() {
  window.history.back();
}

/*
function newwin() {              
 myWindow=window.open('lead_data.php?leadid=1','myWin','width=400,height=650')
}*/



	</script>
	
	
	

</head>

<body class="animsition">
    <div class="page-wrapper">
        <!-- HEADER MOBILE-->
        <?php include_once('includes/sidebar.php');?>
        <!-- END HEADER MOBILE-->

        <!-- MENU SIDEBAR-->
        
        <!-- END MENU SIDEBAR-->

        <!-- PAGE CONTAINER-->
        <div>
            <!-- HEADER DESKTOP-->
            <?php include_once('includes/header.php');?>
            <!-- HEADER DESKTOP-->

            <!-- MAIN CONTENT-->
            <div class="main-content">
			<!--<div align='center' style='font-size:x-large'><a href='javascript:history.go(-1)'>Go Back</a></div>-->
			<!--<div align="center">
			<button onclick="goBack()">Go Back</button>
			</div>-->
			<!--<div align='center' style='font-size:x-large'><a href='javascript:history.go(-1)'>Go Back</a></div>-->
			
			<!--<p style="font-size:16px; color:red" align="center"> <?php //echo $fdate;
    ?> </p>-->
			
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="row">
                          
                            <div class="col-lg-12">
                                <div class="card">
                                    <div class="card-header">
                                        <!--<strong>Visitor</strong>  Details  ||  <button onclick="goBack()" >Go Back</button>-->
										<strong>Visitor</strong>  Details  ||  <a class="blink-one" href="" onclick="goBack()" >Go Back</a>
                                    </div>
                                    <div class="card-body card-block">
                                        
                                            <p style="font-size:16px; color:red" align="center"> <?php //if($msg){
    //echo $msg;
  //}  ?> </p>

  <?php
  
$eid=$_GET['editid'];
$ret=mysqli_query($con,"select e.slno as entryid, b.surname as sur_name, b.firstname as first_name, e.name, b.cardnumber as idnumber, e.surname_staff as monitoring_staff, b.categorycode as Category, b.sort1 as sort_1, b.sort2 as sort_2, e.toe as Time_of_Entry, e.basicresearch, e.onlineresearch, e.borrowlibmat, e.returnlibmat, e.readnews, e.clearance, e.others, e.others_described, e.office, e.email, e.isvisitor, staff_borrowerno from entry e LEFT JOIN borrowers b ON (e.cardnumber=b.cardnumber) where slno='$eid'");
$cnt=1;
while ($row=mysqli_fetch_array($ret)) {

?>
<table border="1" class="table table-bordered mg-b-0">

	<tr>
		<th>Delete?</th>
				<?php
				if ($row['staff_borrowerno'] == $borrowernumber)
				{				
				
				?>				
					
				<td align="center"><a href="javascript:delete_id_reportsdetail(<?php echo $row['entryid']; ?>)"><img src="images/icon/b_drop.png" alt="Delete" /></a></td>
				
				
				<?php
				} else {
					
					?>
					
					
				<td align="center"><img src="images/icon/warning.png" alt="Warning" /></td>
					
				<?php
					
				}
				
				?>
	</tr>			




  <tr>
    <th>Name</th>
    <td><?php  echo $row['name'];?></td>
  </tr>
   <tr>
    <th>ID No.</th>
    <td><?php  echo $row['idnumber'];?></td>
  </tr>

  <tr>
    <th>Monitoring Staff</th>
    <td><?php  echo $row['monitoring_staff'];?></td>
  </tr>
  <tr>
    <th>Is Visitor?</th>
    <td><?php if ($row['isvisitor'] == "1") {
					  echo "Yes";					  
				  } else {
					  echo "No";
				  }		?></td>
  </tr>
  <tr>
    <th>Category</th>
    <td><?php  echo $row['Category'];?></td>
  </tr>
  <tr>
    <th>Sort1</th>
    <td><?php  echo $row['sort_1'];?></td>
  </tr>
  <tr>
    <th>Sort2</th>
    <td><?php  echo $row['sort_2'];?></td>
  </tr>
  <tr>
    <th>Time of Entry</th>
    <td><?php  echo $row['Time_of_Entry'];?></td>
  </tr>
  <tr>
  <th>Activities: </th>  
  <td>
	<?php
	$array = array();
	if ($row['basicresearch'] == "1") {
		//$basicresearch = "Basic Research";
		array_push($array,"Basic Research");
	}
	
	if ($row['onlineresearch'] == "1") {
		//$onlineresearch = "Online Research";
		array_push($array,"Online Research");
	}

	if ($row['borrowlibmat'] == "1") {
		//$borrowlibmat = "Borrow Library Materials";
		array_push($array,"Borrow Library Materials");
	}

	if ($row['returnlibmat'] == "1") {
		//$returnlibmat = "Return Library Materials";
		array_push($array,"Return Library Materials");
	}

	if ($row['readnews'] == "1") {
		//$readnews = "Read Newspaper";
		array_push($array,"Read Newspapers/Magazines");
	}

	if ($row['clearance'] == '1') {
		//$clearance = "Clearance";
		array_push($array,"Clearance");
	}

	if ($row['others'] == '1') {
		//$others = "Others";
		array_push($array,"Others");
	}
	
	//$post_str = "";
	//foreach($array as $key=>value) {
	//	$post_str .= $value.", ";		
	//}
	
	//echo ""
	
	//echo $post_str;
	$post_str = '';
	foreach($array as $value){
		$post_str .= $value.", ";
		
	}
	
	$post_str = substr($post_str,0,-2);
	$post_str = preg_replace("/,([^,]+)$/", " and $1", $post_str);
							
	//echo $array[0],$array[1];
	
	echo $post_str;
	
	?>
	</td>



  
  </tr>
  
  
  
<!--  <tr>
    <th>Basic Research</th>
    <td><?php // echo $row['basicresearch'];?></td>
  </tr>
    <tr>
    <th>Online Research</th>
    <td><?php // echo $row['onlineresearch'];?></td>
  </tr>
    <tr>
    <th>Borrow Materials</th>
    <td><?php // echo $row['borrowlibmat'];?></td>
  </tr>
    <tr>
    <th>Return Materials</th>
    <td><?php // echo $row['returnlibmat'];?></td>
  </tr>
    <tr>
    <th>Read Newspapers/Magazines</th>
    <td><?php  //echo $row['readnews'];?></td>
  </tr>
    <tr>
    <th>Clearance</th>
    <td><?php  //echo $row['clearance'];?></td>
  </tr>
    <tr>
    <th>Others</th>
    <td><?php  //echo $row['others'];?></td>
  </tr>-->
    <tr>
    <th>Others Described</th>
    <td><?php  echo $row['others_described'];?></td>
  </tr>
      <th>Office</th>
    <td><?php  echo $row['office'];?></td>
  </tr>
  
  
  
  
  
  

                <?php 
				
				  
	  	  	 /* if(isset($_GET['delete_id_reportsdetail']))
{
	$id = $_GET['delete_id'];
	$ret=mysqli_query($con,"DELETE FROM entry WHERE slno = '$id'");
	//header('Location: ' . $_SERVER['HTTP_REFERER']);
	header('location:reporttoday.php');
	//exit;
}*/
				
				
				
				

}?>
  

</table>                        
                                    </div>
                                   
                                </div>
                       
                        </div>
                            </div>
    
<?php include_once('includes/footer.php');?>
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
<?php }  ?>

