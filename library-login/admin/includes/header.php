<header class="header-desktop">
                <div class="section__content section__content--p30">
                    <div class="container-fluid">
                        <div class="header-wrap">
                            <form class="form-header" name="search" action="search-visitor.php" method="post">
                                <input class="au-input au-input--xl" type="text" name="searchdata" id="searchdata" placeholder="Search by Names, Mobile number, Office, &amp; Remarks" />
                                <button class="au-btn--submit" type="submit" name="search">
                                    <i class="zmdi zmdi-search"></i>
                                </button>
                            </form>
                            <div class="header-button">
                                <div class="noti-wrap">
                                 <?php
$adminid=$_SESSION['cvmsaid'];
$ret=mysqli_query($con,"select surname, cardnumber from borrowers where borrowernumber='$adminid'");
$row=mysqli_fetch_array($ret);
$name=$row['surname'];
$cardnumber=$row['cardnumber'];

$ret=mysqli_query($con,"select imagefile, mimetype from patronimage p LEFT JOIN borrowers b on (p.borrowernumber=b.borrowernumber) where b.borrowernumber='$adminid'");
$row=mysqli_fetch_array($ret);
$image = $row['imagefile'];
#printf ("%s (%s)\n", $row["imagefile"], $row["mimetype"]);





?>   
                                    
                                </div>
                                <div class="account-wrap">
                                    <div class="account-item clearfix js-item-menu">
                                        <div class="image">
										<?php
										if (isset($image)){
											echo '<img src="data:image/jpg/png/jpeg;base64,' . base64_encode( $image ) . '" height="45	" />';  
										}
																else{
						echo '<img src="../includes/images/profile-shadow.png" height="150"/>';  
						echo "<br/>";
						}
						
						?>
										
										
										
                                            <!--<img src="images/icon/avatar-01.jpg" alt="Senate of the Philippines" />-->
                                        </div>
                                        <div class="content">
                                            <a class="js-acc-btn" href="#"><?php echo $name; ?></a>
                                        </div>
                                        <div class="account-dropdown js-dropdown">
                                            <div class="info clearfix">
                                                <div class="image">
                                                    <a href="#">
													<?php
										if (isset($image)){
											echo '<img src="data:image/jpg/png/jpeg;base64,' . base64_encode( $image ) . '" height="45	" />';  
										}
																else{
						echo '<img src="../includes/images/profile-shadow.png" height="150"/>';  
						echo "<br/>";
						}
						
						?>
                                                        <!--<img src="images/icon/avatar-01.jpg" alt="John Doe" />-->
                                                    </a>
                                                </div>
                                                <div class="content">
                                                    <h5 class="name">
                                                        <a href="#"><?php echo $name; ?></a>
                                                    </h5>
                                                   
                                                </div>
                                            </div>
                                            <div class="account-dropdown__body">
                                             <!--   <div class="account-dropdown__item">
                                                    <a href="admin-profile.php">
                                                        <i class="zmdi zmdi-account"></i>Admin Profile</a>
                                                </div>-->
                                   <!--             <div class="account-dropdown__item">
                                                    <a href="change-password.php">
                                                        <i class="zmdi zmdi-settings"></i>Change Password</a>
                                                </div>-->
                                               
                                            </div>
                                            <div class="account-dropdown__footer">
                                                <a href="logout.php">
                                                    <i class="zmdi zmdi-power"></i>Logout</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </header>