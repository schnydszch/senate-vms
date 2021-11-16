<?php
// Initialize the session
session_start();
 
require_once "config.php"; 

$msg = "";

$sql = "select b.firstname, b.surname from entry_staffloggedin AS esl LEFT JOIN borrowers AS b ON (esl.borrowernumber=b.borrowernumber) where esl.currently_loggedin = '1'";
$stmt = mysqli_prepare($link, $sql);
mysqli_stmt_execute($stmt);
mysqli_stmt_store_result($stmt);
 
 
// Check if the user is logged in, if not then redirect him to login page
if(!isset($_SESSION["loggedin"]) || $_SESSION["loggedin"] !== true){
    header("location: index.php");
	
	//$borrowernumber = $_SESSION["borrowernumber"];
	
	//$sql = "SELECT borrowernumber FROM borrowers WHERE userid = ?";
	
	
	/* create a prepared statement */
//if ($stmt = $mysqli->prepare("SELECT borrowernumber FROM borrowers WHERE userid=?")) {

    /* bind parameters for markers */
    //$stmt->bind_param("s", '$_SESSION["username"]');

    /* execute query */
    //$stmt->execute();

    /* bind result variables */
    //$stmt->bind_result($borrowernumber);

    /* fetch value */
    //$stmt->fetch();

    //printf("$borrowernumber");

    /* close statement */
    //$stmt->close();
//}
	
	
	
	/*
	
	if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            // Set parameters
            $param_username = $username;
			
			
	
	$stmt = mysqli_prepare($link, $sql))
	mysqli_stmt_bind_param($stmt, "s", $param_username);
	$param_username = $borrowernumber;
	
	
	
	
		$link1=mysqli_connect($hostname,$username,$passwd)
		or die ("Could not connect to second database");
		mysqli_select_db($link,$dbase) or die ("Error");
		$sql="insert into entry_staffloggedin (borrowernumber, currently_loggedin) values (" . '$_SESSION["borrowernumber"]' . ",'1')";
		mysqli_query($link1,$sql);
		mysqli_close($link1);
	*/
	
	
    exit;
	
	
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        body{ font: 14px sans-serif; text-align: center; }
    </style>
</head>
<body>
    <div class="page-header">
        <h1>Hi, <b><?php echo htmlspecialchars($_SESSION["firstname"]); ?><?php echo htmlspecialchars($_SESSION["surname"]); ?><?php echo htmlspecialchars($_SESSION['cvmsaid']); ?></b>. Welcome to the administration panel of the Senate Legislative Library Services Visitor Monitoring System. This is where library monitors log in so that the entry of library users are logged in to the currently signed in staff.</h1>
		
    </div>
    <p>
        <!--<a href="reset-password.php" class="btn btn-warning">Reset Your Password</a>-->
		<a href="reports.php" class="btn btn-danger">Go To Reports (Under Construction)</a>
        <a href="logout.php" class="btn btn-danger">Sign Out of Your Account</a>
	</p>
	
	
	<div class="row">
                            <div class="col-lg-12">
                                <div class="table-responsive table--no-card m-b-30">
                                    
<h4 class="m-t-0 header-title">Reports Today</h4>
                                    <?php
//$fdate=$_POST['fromdate'];
//$tdate=$_POST['todate'];

?>
<hr />
  
                                    <table class="table table-borderless table-striped table-earning">
                                         <thead>
                                        <tr>
                                            <tr>
                  <th>Count No.</th>
				<th>Name</th>
              <th>ID No.</th>
				<th>Monitoring Staff</th>
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
				   <th>Is Visitor?</th>
                </tr>
                                        </tr>
                                        </thead>

<?php
$sql = "SELECT e.slno as entryid, b.surname as sur_name, b.firstname as first_name, e.name, b.cardnumber as idnumber, e.surname_staff as monitoring_staff, b.categorycode as Category, b.sort1 as sort_1, b.sort2 as sort_2, e.toe as Time_of_Entry, e.basicresearch, e.onlineresearch, e.borrowlibmat, e.returnlibmat, e.readnews, e.clearance, e.others, e.others_described, e.office, e.email, e.surname_staff, e.isvisitor from entry e LEFT JOIN borrowers b ON (e.cardnumber=b.cardnumber) WHERE date(e.toe)  = CURDATE()";
$result = $link->query($sql);
$cnt=1;
if ($result->num_rows > 0) {
// output data of each row
while($row = $result->fetch_assoc()) {
echo "<tr><td>" . $cnt . "</td><td>" . $row["name"] . "</td><td>" . $row["idnumber"] . "</td><td>" . $row["surname_staff"] . "</td><td>" . $row["Category"] . "</td><td>" . $row["sort_1"] . "</td><td>" . $row["sort_2"] . "</td><td>" . $row["Time_of_Entry"] . "</td><td>" . $row["basicresearch"] . "</td><td>" . $row["onlineresearch"] . "</td><td>" . $row["borrowlibmat"] . "</td><td>" . $row["returnlibmat"] . "</td><td>" . $row["readnews"] . "</td><td>" . $row["clearance"] . "</td><td>" . $row["others"] . "</td><td>" . $row["others_described"] . "</td><td>" . $row["office"] . "</td><td>" . $row["isvisitor"] . "</td></tr>";
$cnt=$cnt+1;
}
echo "</table>";
} else { echo "0 results"; }


               ?>                     
                                </div>
                            </div>
                          
                        </div>
						
						
	<div class="row">
    <div class="col-lg-12">
    <div class="table-responsive table--no-card m-b-30">
                                    
<h4 class="m-t-0 header-title">Reports Per Monitoring Personnel - Per Activity</h4>
                                    <?php
//$fdate=$_POST['fromdate'];
//$tdate=$_POST['todate'];

?>
<hr />
  
                                    <table class="table table-borderless table-striped table-earning">
                                         <thead>
                                        <tr>
                                            <tr>
                  <th>Count No.</th>
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
$sql = "SELECT e.surname_staff, sum(e.basicresearch) as 'Basic Research', sum(e.onlineresearch) as 'Online Research', sum(e.borrowlibmat) as 'Borrow Library Materials', sum(e.returnlibmat) as 'Returning Library Materials', sum(e.readnews) as 'Read Newspapers', sum(e.clearance) as 'Clearance', sum(e.others) as 'Others' from entry AS e where date(toe)  = CURDATE() GROUP BY e.surname_staff ";
$result = $link->query($sql);
$cnt=1;
if ($result->num_rows > 0) {
// output data of each row
while($row = $result->fetch_assoc()) {
echo "<tr><td>" . $cnt . "</td><td>" . $row["surname_staff"] . "</td><td>" . $row["Basic Research"] . "</td><td>" . $row["Online Research"] . "</td><td>" . $row["Borrow Library Materials"] . "</td><td>" . $row["Returning Library Materials"] . "</td><td>" . $row["Read Newspapers"] . "</td><td>" . $row["Clearance"] . "</td><td>" . $row["Others"] . "</td></tr>";
$cnt=$cnt+1;
}
echo "</table>";
} else { echo "0 results"; }


               ?>                     
                                </div>
                            </div>
                          
                        </div>	


	<div class="row">
    <div class="col-lg-12">
    <div class="table-responsive table--no-card m-b-30">
                                    
<h4 class="m-t-0 header-title">Reports Per Monitoring Personnel</h4>
                                    <?php
//$fdate=$_POST['fromdate'];
//$tdate=$_POST['todate'];

?>
<hr />
  
                                    <table class="table table-borderless table-striped table-earning">
                                         <thead>
                                        <tr>
                                            <tr>
                  <th>Count No.</th>
				<th>Staff</th>
              <th>ID No.</th>
                </tr>
                                        </tr>
                                        </thead>

<?php
$sql = "SELECT DISTINCT(e.surname_staff) as monitoring_staff, count(e.surname_staff) as count from entry as e WHERE date(e.toe) = CURDATE() GROUP BY e.surname_staff";
$result = $link->query($sql);
$cnt=1;
if ($result->num_rows > 0) {
// output data of each row
while($row = $result->fetch_assoc()) {
echo "<tr><td>" . $cnt . "</td><td>" . $row["monitoring_staff"] . "</td><td>" . $row["count"] . "</td></tr>";
$cnt=$cnt+1;
}
echo "</table>";
} else { echo "0 results"; }


               ?>                     
                                </div>
                            </div>
                          
                        </div>	
	
	<div class="row">
    <div class="col-lg-12">
    <div class="table-responsive table--no-card m-b-30">
                                    
<h4 class="m-t-0 header-title">Reports Per Monitoring Personnel</h4>
                                    <?php
//$fdate=$_POST['fromdate'];
//$tdate=$_POST['todate'];

?>
<hr />
  
                                    <table class="table table-borderless table-striped table-earning">
                                         <thead>
                                        <tr>
                                            <tr>
                  <th>Count No.</th>
				<th>Staff</th>
              <th>Total Time</th>
                </tr>
                                        </tr>
                                        </thead>

<?php
$sql = "SELECT DISTINCT(b.surname) as monitoring_staff, SEC_TO_TIME(SUM(TIME_TO_SEC(esl.timeloggedin))) as totalTime from entry_staffloggedin as esl LEFT JOIN borrowers AS b on (esl.borrowernumber=b.borrowernumber) WHERE esl.currently_loggedin = '0' and date(esl.login_timestamp) = CURDATE() GROUP BY esl.borrowernumber";
$result = $link->query($sql);
$cnt=1;
if ($result->num_rows > 0) {
// output data of each row
while($row = $result->fetch_assoc()) {
echo "<tr><td>" . $cnt . "</td><td>" . $row["monitoring_staff"] . "</td><td>" . $row["totalTime"] . "</td></tr>";
$cnt=$cnt+1;
}
echo "</table>";
} else { echo "0 results"; }
$link->close();

               ?>                     
                                </div>
                            </div>
                          
                        </div>	
	
	
	
</body>
</html>