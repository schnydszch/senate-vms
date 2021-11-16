<?php
session_start();
//error_reporting(0);
include('includes/dbconnection.php');
if (strlen($_SESSION['cvmsaid']==0)) {
  header('location:logout.php');
  } else{



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
                                    
<h4 class="m-t-0 header-title">Between Dates Reports</h4>
                                    <?php
$fdate=$_POST['fromdate'];
$tdate=$_POST['todate'];

/*
foreach ($_POST['staff'] as $select)
{
echo "You have selected :" .$select; // Displaying Selected Value
}*/



?>

							
                          <div class="col-lg-12">
                                <div class="table-responsive table--no-card m-b-30">							
							<h5 align="center" style="color:blue">Reports Per Monitoring Personnel - Number of Entrants from <?php echo $fdate;?> to <?php echo $tdate;?></h5>
<hr />
  
                                    <table class="table table-borderless table-striped table-earning">
                                         <thead>
                                        <tr>
                                            <tr>
                <th>S.NO</th>            
				<th>Staff</th>
				<th>Count</th>
				</tr>
                </tr>
                </thead>
<?php
$ret=mysqli_query($con,"SELECT e.surname_staff, count(slno) as 'Count' from entry AS e where date(toe) between '$fdate' and '$tdate' GROUP BY e.surname_staff");
$cnt=1;
while ($row=mysqli_fetch_array($ret)) {
?>
                <tbody>
				<tr>
                <td><?php echo $cnt;?></td>
                <td><?php echo $row['surname_staff'];?></td>
                <td><?php echo $row['Count'];?></td>
                </tr>
				</tbody>
				<?php 
$cnt=$cnt+1;
}?>
				
				<tfoot>
				<tr>
				<td></td>
				<td class="right"><b>Total:</b></td>
				<td>
				
				<?php 
				$ret=mysqli_query($con,"SELECT count(slno) as 'Count' from entry AS e where date(e.toe) between '$fdate' and '$tdate'");
				$staff=mysqli_fetch_row($ret);
				echo $staff[0];				
				?>
				
				</td>
				</tr>
				</tfoot>
                
                                    </table>
                                </div>
                            </div>
							
							
							
							
		<div class="col-lg-12">
             <div class="table-responsive table--no-card m-b-30">							
							<h5 align="center" style="color:blue">Reports Per Monitoring Personnel - Transactions from <?php echo $fdate;?> to <?php echo $tdate;?></h5>
<hr />
  
                                    <table class="table table-borderless table-striped table-earning">
                                         <thead>
                                        <tr>
                                            <tr>
                <th>Transactions</th>            
				<th>Count</th>				
				</tr>
                </tr>
                </thead>

                <tbody>
				<tr>
                <td>Basic Research</td>
                <td><?php 				
				$ret=mysqli_query($con,"SELECT sum(e.basicresearch) as 'Basic Research' from entry AS e where date(e.toe) between '$fdate' and '$tdate'");
				$basicresearchcount=mysqli_fetch_row($ret);
				echo $basicresearchcount[0];				
				?></td>                
                </tr>
				
				<tr>
                <td>Online Research</td>
                <td><?php 				
				$ret=mysqli_query($con,"SELECT sum(e.onlineresearch) as 'Online Research' from entry AS e where date(e.toe) between '$fdate' and '$tdate'");
				$onlineresearchcount=mysqli_fetch_row($ret);
				echo $onlineresearchcount[0];				
				?></td>                
                </tr>
				
				<tr>
                <td>Borrow Library Materials</td>
                <td><?php 				
				$ret=mysqli_query($con,"SELECT sum(e.borrowlibmat) from entry AS e where date(e.toe) between '$fdate' and '$tdate'");
				$borrowlibmatcount=mysqli_fetch_row($ret);
				echo $borrowlibmatcount[0];				
				?></td>                
                </tr>
				
				<tr>
                <td>Return Library Materials</td>
                <td><?php 				
				$ret=mysqli_query($con,"SELECT sum(e.returnlibmat) from entry AS e where date(e.toe) between '$fdate' and '$tdate'");
				$returnlibmatcount=mysqli_fetch_row($ret);
				echo $returnlibmatcount[0];				
				?></td>                
                </tr>
				
				<tr>
                <td>Read Newspapers</td>
                <td><?php 				
				$ret=mysqli_query($con,"SELECT sum(e.readnews) from entry AS e where date(e.toe) between '$fdate' and '$tdate'");
				$readnewscount=mysqli_fetch_row($ret);
				echo $readnewscount[0];				
				?></td>                
                </tr>
				
				<tr>
                <td>Clearance</td>
                <td><?php 				
				$ret=mysqli_query($con,"SELECT sum(e.clearance) from entry AS e where date(e.toe) between '$fdate' and '$tdate'");
				$clearancecount=mysqli_fetch_row($ret);
				echo $clearancecount[0];				
				?></td>                
                </tr>
				
				<tr>
                <td>Others</td>
                <td><?php 				
				$ret=mysqli_query($con,"SELECT sum(e.others) from entry AS e where date(e.toe) between '$fdate' and '$tdate'");
				$otherscount=mysqli_fetch_row($ret);
				echo $otherscount[0];				
				?></td>                
                </tr>
				
				
				</tbody>
				
				
				<tfoot>
				<tr>
				<td class="right"><b>Grand Total (Transactions):</b></td>
				<td>
				<?php			
				//$ret=mysqli_query($con,"SELECT sum(e.basicresearch,e.onlineresearch,e.borrowlibmat,e.returnlibmat,e.readnews,e.clearance,e.others) from entry AS e where date(e.toe) between '$fdate' and '$tdate'");
				//$totaltransactioncount=mysqli_fetch_row($ret);
				$totaltransactioncount = $basicresearchcount[0] + $onlineresearchcount[0] + $borrowlibmatcount[0] + $returnlibmatcount[0] + $readnewscount[0] + $clearancecount[0] + $otherscount[0];
				echo $totaltransactioncount;				
				?>				
				</td>
				
				<td>
				
				<?php /*
				$ret=mysqli_query($con,"SELECT count(slno) as 'Count' from entry AS e");
				$staff=mysqli_fetch_row($ret);
				echo $staff[0];				*/
				?>
				
				</td>
				</tr>
				</tfoot>
                
                                    </table>
                                </div>
                            </div>
							
							
							
							
							
							
							
							
							
							
							
							
							
							
							
							
							
							
							

                          <div class="col-lg-12">
                                <div class="table-responsive table--no-card m-b-30">							
							<h5 align="center" style="color:blue">Reports Per Monitoring Personnel (Number of Hours) - <?php echo $fdate?> to <?php echo $tdate?></h5>
<hr />
  
                                    <table class="table table-borderless table-striped table-earning">
                                         <thead>
                                        <tr>
                                            <tr>
                <th>S.NO</th>            
				<th>Staff</th>
				<th>Total Time</th>
                </tr>
                </tr>
                </thead>
<?php
$ret=mysqli_query($con,"SELECT DISTINCT(b.surname) as monitoring_staff, SEC_TO_TIME(SUM(TIME_TO_SEC(esl.timeloggedin))) as totalTime from entry_staffloggedin as esl LEFT JOIN borrowers AS b on (esl.borrowernumber=b.borrowernumber) WHERE esl.currently_loggedin = '0' and date(esl.login_timestamp) between '$fdate' and '$tdate' GROUP BY esl.borrowernumber");
$cnt=1;
while ($row=mysqli_fetch_array($ret)) {
?>
                <tr>
                <td><?php echo $cnt;?></td>
                <td><?php echo $row['monitoring_staff'];?></td>
                <td><?php echo $row['totalTime'];?></td>

                </tr>
                <?php 
$cnt=$cnt+1;
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
