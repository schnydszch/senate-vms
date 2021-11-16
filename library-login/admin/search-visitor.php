<?php
session_start();
error_reporting(0);
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
    <title>VMS Visitors</title>

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
                                 <?php
if(isset($_POST['search']))
{ 

$sdata=$_POST['searchdata'];
  ?>
  <h4 align="center">Result against "<?php echo $sdata;?>" keyword </h4>
  <hr />   

                                    <table class="table table-borderless table-striped table-earning">
                                         <thead>
                                        <tr>
                                            <tr>
                <th>S.NO</th>            
                <th>Name</th>
				<th>Is Visitor?</th>		
				<th>Cardnumber</th>
				<th>Category</th>
				<th>Sort1</th>
				<th>Sort2</th>
				<th>Time of Entry</th>
				<th>Others Described</th>
				<th>Office</th>
				<th>Monitoring Staff</th>
				
                </tr>
                                        </tr>
                                        </thead>
                                      <?php
$ret=mysqli_query($con,"SELECT e.slno as entryid, b.surname as sur_name, b.firstname as first_name, e.name, b.cardnumber as idnumber, e.surname_staff as monitoring_staff, b.categorycode as Category, b.sort1 as sort_1, b.sort2 as sort_2, e.toe as Time_of_Entry, e.basicresearch, e.onlineresearch, e.borrowlibmat, e.returnlibmat, e.readnews, e.clearance, e.others, e.others_described, e.office, e.email, e.surname_staff, e.isvisitor from entry e LEFT JOIN borrowers b ON (e.cardnumber=b.cardnumber) where e.name like '%$sdata%'||e.cardnumber like '%$sdata%'||others_described LIKE '%$sdata%'||office LIKE '%$sdata%'");
$num=mysqli_num_rows($ret);
if($num>0){
$cnt=1;
while ($row=mysqli_fetch_array($ret)) {

?>

              
                <tr>
                  <td><?php echo $cnt;?></td>
                  <td><?php echo $row['name'];?></td>
				  <td><?php if ($row['isvisitor'] = 0) {
					  echo "No";					  
				  } else {
					  echo "Yes";
				  }				?></td>
				  <td><?php echo $row['idnumber'];?></td>
				  <td><?php echo $row['Category'];?></td>
                  <td><?php echo $row['sort1'];?></td>
				  <td><?php echo $row['sort2'];?></td>
				  <td><?php echo $row['Time_of_Entry'];?></td>
				  <td><?php echo $row['others_described'];?></td>
				  <td><?php echo $row['office'];?></td>
				  <td><?php echo $row['surname_staff'];?></td>
				  
				  <!-- <td><a href="visitor-detail.php?editid=<?php echo $row['ID'];?>"><i class="fa fa-edit fa-1x"></i></a></a></td>-->
                </tr>
                 <?php
                $cnt=$cnt+1;
} } else { ?>
  <tr>
    <td colspan="8"> No record found against this search</td>

  </tr>
   
<?php } }?>
                                    </table>
                                </div>
                            </div>
                          
                        </div>
                        
                        
                    </div>
                </div>
            </div>
        </div>

    </div>
<?php include_once('includes/footer.php');?>
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
