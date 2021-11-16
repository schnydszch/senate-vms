<?php
session_start();
//error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['cvmsaid']==0)) {
  header('location:logout.php');
  } else{

  
$adminid=$_SESSION['cvmsaid'];
$ret=mysqli_query($con,"select borrowernumber, surname from borrowers where borrowernumber='$adminid'");
$row=mysqli_fetch_array($ret);
$borrowernumber=$row['borrowernumber'];


  ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags-->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="author" content="Eugene Jose T. Espinoza">
    <meta name="keywords" content="Senate Legislative Library Visitor Monitoring System">    

    <!-- Title Page-->
    <title>Senate Legislative Library Services Visitor Monitoring System</title>

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
	
		<script type="text/javascript">
function delete_id_bwreportsdetail(id)
{
	if(confirm('Are You Sure to Remove this Record ?'))
	{
		window.location.href='delete.php?delete_id_bwreportsdetail='+id;
	}
	else
	{
		/*window.history.back();
		document.referrer;*/
		window.history.go(0)
		
	}
}

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
        <div class="page-container">
            <!-- HEADER DESKTOP-->
            <?php include_once('includes/header.php');?>
            <!-- END HEADER DESKTOP-->

            <!-- MAIN CONTENT-->
            <div class="main-content">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="table-responsive table--no-card m-b-30">
                                    
<h4 class="m-t-0 header-title">Between Dates Reports (Report by Staff)</h4>
                                    <?php
$fdate=$_GET['fromdate'];
$tdate=$_GET['todate'];


foreach ($_GET['staff'] as $select)
{
$sql="SELECT borrowernumber, surname from borrowers WHERE borrowernumber = '$select'";
//$staff = $row[]
		$result=mysqli_query($con,$sql);
		$staff=mysqli_fetch_row($result);

echo "You have selected: ". $staff[1]; // Displaying Selected Value
}



?>
<h5 align="center" style="color:blue">List of Visitors from <?php echo $fdate?> to <?php echo $tdate?></h5>
<h4 align="center" style="color:blue">Total: <?php 
$ret=mysqli_query($con,"SELECT count(slno) as 'Count' from entry where staff_borrowerno='$select' AND date(toe) between '$fdate' and '$tdate'");
$count=mysqli_fetch_row($ret);
echo $count[0];	
?>
</h4>
<hr />
  
                                    <table class="table table-borderless table-striped table-earning">
                                         <thead>
                                        <tr>
                                            <tr>
				<th>View Details</th>
				<th>Delete</th>											
                <th>S.NO</th>            
                <th>Name</th>              
				<th>ID No.</th>
				<th>Monitoring Staff</th>
				<th>Is Visitor?</th>
				<th>Category</th>
				<th>Sort1</th>
				<th>Sort2</th>
                <th>Time of Entry</th>
				<th>Basic Research</th>
				<th>Online Research</th>
				<th>Borrow</th>
				<th>Return</th>
				<th>Read News</th>
				<th>Clearance</th>
				<th>Others</th>
				<th>Others Described</th>
				<th>Office</th>				
                </tr>
                </tr>
                </thead>
<?php 
$ret=mysqli_query($con,"SELECT e.slno as entryid, b.surname as sur_name, b.firstname as first_name, e.name, b.cardnumber as idnumber, e.surname_staff as monitoring_staff, b.categorycode as Category, b.sort1 as sort_1, b.sort2 as sort_2, e.toe as Time_of_Entry, e.basicresearch, e.onlineresearch, e.borrowlibmat, e.returnlibmat, e.readnews, e.clearance, e.others, e.others_described, e.office, e.email, e.isvisitor, e.staff_borrowerno from entry e LEFT JOIN borrowers b ON (e.cardnumber=b.cardnumber) where e.staff_borrowerno='$select' AND date(e.toe) between '$fdate' and '$tdate'");	  
  $cnt=1;
while ($row=mysqli_fetch_array($ret)) {
?>
                <tr>
								<td><a href="visitor-detail.php?editid=<?php echo $row['entryid'];?>" title="View Full Details"><i class="fa fa-edit fa-1x"></i></a></td>
				
				
				
				<!--<td align="center"><a href="javascript:delete_id(<?php echo $row['entryid']; ?>)"><img src="images/icon/b_drop.png" alt="Delete" /></a></td>			-->
				
			
				<?php
				if ($row['staff_borrowerno'] == $borrowernumber)
				{				
				
				?>				
					
				<td align="center"><a href="javascript:delete_id_bwreportsdetail(<?php echo $row['entryid']; ?>)"><img src="images/icon/b_drop.png" alt="Delete" /></a></td>
				
				
				<?php
				} else {
					
					?>
					
					
				<td align="center"><img src="images/icon/warning.png" alt="Warning" /></td>
					
				<?php
					
				}
				
				?>	
				
				
                <td><?php echo $cnt;?></td>
                <td><?php echo $row['name'];?></td>
                <td><?php echo $row['idnumber'];?></td>
                <td><?php echo $row['monitoring_staff'];?></td>
				<td><?php if ($row['isvisitor'] == "1") {
					  echo "Yes";					  
				  } else {
					  echo "No";
				  }		?></td>
				<!--<td><?php/* echo $row['isvisitor'];*/?></td>  -->
				<td><?php echo $row['Category'];?></td>
				<td><?php echo $row['sort_1'];?></td>
				<td><?php echo $row['sort_2'];?></td>
                <td><?php echo $row['Time_of_Entry'];?></td>
				<td><?php echo $row['basicresearch'];?></td>
                <td><?php echo $row['onlineresearch'];?></td>
                <td><?php echo $row['borrowlibmat'];?></td>
				<td><?php echo $row['returnlibmat'];?></td>
				<td><?php echo $row['readnews'];?></td>
				<td><?php echo $row['clearance'];?></td>
                <td><?php echo $row['others'];?></td>
				<td><?php echo $row['others_described'];?></td>
				<td><?php echo $row['office'];?></td>
                </tr>					
				
				
                <?php 
$cnt=$cnt+1;
}?>
                                    </table>
                                </div>
                            </div>
							
                          <div class="col-lg-12">
                                <div class="table-responsive table--no-card m-b-30">							
							<h5 align="center" style="color:blue">Reports Per Monitoring Personnel - Per Activity from <?php echo $fdate?> to <?php echo $tdate?></h5>
<hr />
  
                                    <table class="table table-borderless table-striped table-earning">
                                         <thead>
                                        <tr>
                                            <tr>
                           
				<th>Staff</th>
				<th>Basic Research</th>
				<th>Online Research</th>
				<th>Borrow Library Materials</th>
				<th>Return Library Materials</th>
				<th>Read Newspapers</th>
				<th>Clearance</th>
				<th>Others</th>
                </tr>
                </tr>
                </thead>
<?php
$ret=mysqli_query($con,"SELECT e.surname_staff, sum(e.basicresearch) as 'Basic Research', sum(e.onlineresearch) as 'Online Research', sum(e.borrowlibmat) as 'Borrow Library Materials', sum(e.returnlibmat) as 'Returning Library Materials', sum(e.readnews) as 'Read Newspapers', sum(e.clearance) as 'Clearance', sum(e.others) as 'Others' from entry AS e where e.staff_borrowerno='$select' AND date(toe) between '$fdate' and '$tdate' GROUP BY e.surname_staff ");
//$cnt=1;
while ($row=mysqli_fetch_array($ret)) {
?>
                <tr>
                
                <td><?php echo $row['surname_staff'];?></td>
                <td><?php echo $row['Basic Research'];?></td>
                <td><?php echo $row['Online Research'];?></td>
				<td><?php echo $row['Borrow Library Materials'];?></td>
				<td><?php echo $row['Returning Library Materials'];?></td>
				<td><?php echo $row['Read Newspapers'];?></td>
                <td><?php echo $row['Clearance'];?></td>
				<td><?php echo $row['Others'];?></td>
                </tr>
                <?php 
//$cnt=$cnt+1;
}?>
                                    </table>
                                </div>
                            </div>

                          <div class="col-lg-12">
                                <div class="table-responsive table--no-card m-b-30">							
							<h5 align="center" style="color:blue">Reports Per Monitoring Personnel <?php echo $fdate?> to <?php echo $tdate?></h5>
<hr />
  
                                    <table class="table table-borderless table-striped table-earning">
                                         <thead>
                                        <tr>
                                            <tr>
                           
				<th>Staff</th>
				<th>Total Time</th>
                </tr>
                </tr>
                </thead>
<?php
$ret=mysqli_query($con,"SELECT DISTINCT(b.surname) as monitoring_staff, SEC_TO_TIME(SUM(TIME_TO_SEC(esl.timeloggedin))) as totalTime from entry_staffloggedin as esl LEFT JOIN borrowers AS b on (esl.borrowernumber=b.borrowernumber) WHERE esl.currently_loggedin = '0' and date(esl.login_timestamp) between '$fdate' and '$tdate' AND esl.borrowernumber='$select' GROUP BY esl.borrowernumber");
//$cnt=1;
while ($row=mysqli_fetch_array($ret)) {
?>
                <tr>
                
                <td><?php echo $row['monitoring_staff'];?></td>
                <td><?php echo $row['totalTime'];?></td>

                </tr>
                <?php 
//$cnt=$cnt+1;
}?>
                                    </table>
                                </div>
                            </div>							
							
							
							
							
                          
                        </div>
                        
                        
          
<?php include_once('includes/footer.php');?>
          </div>
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
<?php }  ?>
