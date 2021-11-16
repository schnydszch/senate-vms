<?php
// Initialize the session
session_start();
// Include config file
require_once "config.php";

$msg = "";

date_default_timezone_set("Asia/Manila");
$time=date('Y-m-d H:i:s');

//$date = new DateTime();
//$timeZone = $date->getTimezone();


$sql = "select b.firstname, b.surname from entry_staffloggedin AS esl LEFT JOIN borrowers AS b ON (esl.borrowernumber=b.borrowernumber) where esl.currently_loggedin = '1'";
$stmt = mysqli_prepare($link, $sql);
mysqli_stmt_execute($stmt);
mysqli_stmt_store_result($stmt);

// Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
	
$sql = "select b.firstname, b.surname from entry_staffloggedin AS esl LEFT JOIN borrowers AS b ON (esl.borrowernumber=b.borrowernumber) where esl.currently_loggedin = '1'";
$stmt = mysqli_prepare($link, $sql);
if (mysqli_stmt_execute($stmt)){
mysqli_stmt_store_result($stmt);

if(mysqli_stmt_num_rows($stmt) == 1){                    
         // Bind result variables
            mysqli_stmt_bind_result($stmt, $firstname, $lastname);
			mysqli_stmt_fetch($stmt);
		//	echo "$firstname $lastname is currently logged in. Do you want to log out the particular user?";
			$msg = "$firstname $lastname is currently logged in. If you log in, the particular user will be logged out. Click <a href='reports.php'>here</a> if you want to go to the reports instead";
			
}
}
 
	
  //header("location: index.php");
  //exit;
}

// Define variables and initialize with empty values
$username = $password = "";
$username_err = $password_err = "";
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Check if username is empty
    if(empty(trim($_POST["username"]))){
        $username_err = "Please enter username.";
    } else{
        $username = trim($_POST["username"]);
    }
    // Check if password is empty
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter your password.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validate credentials
    if(empty($username_err) && empty($password_err)){
        // Prepare a select statement
        $sql = "SELECT firstname, surname, userid, password, borrowernumber FROM borrowers WHERE userid = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            // Set parameters
            $param_username = $username;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Store result
                mysqli_stmt_store_result($stmt);
                
                // Check if username exists, if yes then verify password
                if(mysqli_stmt_num_rows($stmt) == 1){                    
                    // Bind result variables
                    mysqli_stmt_bind_result($stmt, $firstname, $lastname, $username, $hashed_password, $borrowernumber);
                    if(mysqli_stmt_fetch($stmt)){
						
						
                        if(password_verify($password, $hashed_password)){
                            // Password is correct, so start a new session
                           // session_start();
                            
                            // Store data in session variables
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["username"] = $username;
							$_SESSION["borrowernumber"] = $borrowernumber;
							$_SESSION["firstname"] = $firstname;
							$_SESSION["surname"] = $surname;


						//$stmt = mysqli_prepare($link, $sql)
						//mysqli_stmt_bind_param($stmt, "s", $param_username);						
							
		$sql = "UPDATE entry_staffloggedin SET currently_loggedin='0' WHERE currently_loggedin='1'";
		$stmt = mysqli_prepare($link, $sql);
		$stmt->execute();
		$stmt->close();					

					

						$sql = "INSERT into entry_staffloggedin (borrowernumber, login_timestamp, currently_loggedin) values (?,?,'1')";
						$stmt = mysqli_prepare($link, $sql);
						mysqli_stmt_bind_param($stmt, "ss", $_SESSION["borrowernumber"],$time);
						echo "$time";

    /* execute query */
    $stmt->execute();

    /* bind result variables */
    //$stmt->bind_result($borrowernumber);

    /* fetch value */
    //$stmt->fetch();

    //printf("$borrowernumber");

    /* close statement */
    $stmt->close();
	

								
                            // Redirect user to welcome page
                            header("location: welcome.php");
                        } else{
                            // Display an error message if password is not valid
                            $password_err = "The password you entered was not valid.";
                        }
                    }
					
										
                } else{
                    // Display an error message if username doesn't exist
                    $username_err = "No account found with that username.";
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
        
        // Close statement
        mysqli_stmt_close($stmt);
    }
    
    // Close connection
    mysqli_close($link);
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        body{ font: 14px sans-serif; }
        .wrapper{ width: 350px; padding: 20px; }
    </style>
</head>
<body>
    <p style="font-size:16px; color:red" align="center"> <?php if($msg){
    echo $msg;
  }  ?> </p>


    <div class="wrapper">
        <h2>Login</h2>
        <p>Please fill in your credentials to login.</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                <label>Username</label>
                <input type="text" name="username" class="form-control" value="<?php echo $username; ?>">
                <span class="help-block"><?php echo $username_err; ?></span>
            </div>    
            <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                <label>Password</label>
                <input type="password" name="password" class="form-control">
                <span class="help-block"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Login">
            </div>
            <!--<p>Don't have an account? <a href="register.php">Sign up now</a>.</p>-->
        </form>
    </div> 
	
	
</body>
</html>