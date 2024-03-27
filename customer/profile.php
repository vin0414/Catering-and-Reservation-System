<?php
    session_start();
    require_once("../resources/dbconfig.php");
    if(empty($_SESSION['sess_fullname']) || $_SESSION['sess_fullname'] == ''||$_SESSION['sess_role']!="Customer"){
    header("Location: https://zephaniah-catering.com/");
    die();
    }
    $successmsg = "";$errormsg="";
    if(isset($_POST['btnSave']))
    {
        $new = $_POST['new'];
        $retype = $_POST['retype'];
        $user = $_POST['user'];
        if($new!=$retype)
        {
            $errormsg = "Invalid! Password mismatched";
        }
        else
        {
            $stmt = $dbh->prepare("update tblcustomer SET Password=SHA1(:pass) WHERE customerID=:user");
            $stmt->bindParam(':pass',$new);
            $stmt->bindParam(':user',$user);
            $stmt->execute();
            $successmsg = "Successfully password changed";
        }
    }
    $success="";
    if(isset($_POST['btnUpdate']))
    {
        $customer = $_POST['customer'];
        $address =$_POST['address'];
        $phone = $_POST['phone'];
        $gender = $_POST['gender'];
        $stmt = $dbh->prepare("update tblcustomer SET Address=:address,Contact=:phone,Gender=:gender WHERE customerID=:user");
        $stmt->bindParam(':address',$address);
        $stmt->bindParam(':phone',$phone);
        $stmt->bindParam(':gender',$gender);
        $stmt->bindParam(':user',$customer);
        $stmt->execute();
        $success = "Great! Successfully updated";
    }
?>
<!DOCTYPE html>
<html>
	<head>
		<!-- Basic Page Info -->
		<meta charset="utf-8" />
		<title>Profile</title>

		<!-- Site favicon -->
		<link
			rel="apple-touch-icon"
			sizes="180x180"
			href="../assets/img/logo.png"
		/>
		<link
			rel="icon"
			type="image/png"
			sizes="32x32"
			href="../assets/img/logo.png"
		/>
		<link
			rel="icon"
			type="image/png"
			sizes="16x16"
			href="../assets/img/logo.png"
		/>

		<!-- Mobile Specific Metas -->
		<meta
			name="viewport"
			content="width=device-width, initial-scale=1, maximum-scale=1"
		/>

		<!-- Google Font -->
		<link
			href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap"
			rel="stylesheet"
		/>
		<!-- CSS -->
		<link rel="stylesheet" type="text/css" href="vendors/styles/core.css" />
		<link
			rel="stylesheet"
			type="text/css"
			href="vendors/styles/icon-font.min.css"
		/>
		<link
			rel="stylesheet"
			type="text/css"
			href="src/plugins/datatables/css/dataTables.bootstrap4.min.css"
		/>
		<link
			rel="stylesheet"
			type="text/css"
			href="src/plugins/datatables/css/responsive.bootstrap4.min.css"
		/>
		<link rel="stylesheet" type="text/css" href="vendors/styles/style.css" />
		<style>
        /* Track */
            ::-webkit-scrollbar-track {
              background: #f1f1f1; 
            }

            /* Handle */
            ::-webkit-scrollbar-thumb {
              background: #888; 
            }

            /* Handle on hover */
            ::-webkit-scrollbar-thumb:hover {
              background: #555; 
            }
            ::-webkit-scrollbar {
                height: 4px;              /* height of horizontal scrollbar ← You're missing this */
                width: 4px;               /* width of vertical scrollbar */
                border: 1px solid #d5d5d5;
              }
            
        </style>
	</head>
	<body>
		<div class="header">
			<div class="header-left">
				<div class="menu-icon bi bi-list"></div>
			</div>
			<div class="header-right">
				<div class="user-info-dropdown">
					<div class="dropdown">
						<a
							class="dropdown-toggle"
							href="#"
							role="button"
							data-toggle="dropdown"
						>
							<span class="user-icon">
								<span class="micon bi bi-person"></span>
							</span>
							<span class="user-name"><?php echo $_SESSION['sess_fullname'] ?></span>
						</a>
						<div
							class="dropdown-menu dropdown-menu-right dropdown-menu-icon-list"
						>
							<a class="dropdown-item" href="profile.php"
								><i class="dw dw-user1"></i> Profile</a
							>
							<a class="dropdown-item" href="../logout.php"
								><i class="dw dw-logout"></i> Log Out</a
							>
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="right-sidebar">
			<div class="sidebar-title">
				<h3 class="weight-600 font-16 text-blue">
					Layout Settings
					<span class="btn-block font-weight-400 font-12"
						>User Interface Settings</span
					>
				</h3>
				<div class="close-sidebar" data-toggle="right-sidebar-close">
					<i class="icon-copy ion-close-round"></i>
				</div>
			</div>
			<div class="right-sidebar-body customscroll">
				<div class="right-sidebar-body-content">
					<h4 class="weight-600 font-18 pb-10">Header Background</h4>
					<div class="sidebar-btn-group pb-30 mb-10">
						<a
							href="javascript:void(0);"
							class="btn btn-outline-primary header-white active"
							>White</a
						>
						<a
							href="javascript:void(0);"
							class="btn btn-outline-primary header-dark"
							>Dark</a
						>
					</div>

					<h4 class="weight-600 font-18 pb-10">Sidebar Background</h4>
					<div class="sidebar-btn-group pb-30 mb-10">
						<a
							href="javascript:void(0);"
							class="btn btn-outline-primary sidebar-light"
							>White</a
						>
						<a
							href="javascript:void(0);"
							class="btn btn-outline-primary sidebar-dark active"
							>Dark</a
						>
					</div>

					<h4 class="weight-600 font-18 pb-10">Menu Dropdown Icon</h4>
					<div class="sidebar-radio-group pb-10 mb-10">
						<div class="custom-control custom-radio custom-control-inline">
							<input
								type="radio"
								id="sidebaricon-1"
								name="menu-dropdown-icon"
								class="custom-control-input"
								value="icon-style-1"
								checked=""
							/>
							<label class="custom-control-label" for="sidebaricon-1"
								><i class="fa fa-angle-down"></i
							></label>
						</div>
						<div class="custom-control custom-radio custom-control-inline">
							<input
								type="radio"
								id="sidebaricon-2"
								name="menu-dropdown-icon"
								class="custom-control-input"
								value="icon-style-2"
							/>
							<label class="custom-control-label" for="sidebaricon-2"
								><i class="ion-plus-round"></i
							></label>
						</div>
						<div class="custom-control custom-radio custom-control-inline">
							<input
								type="radio"
								id="sidebaricon-3"
								name="menu-dropdown-icon"
								class="custom-control-input"
								value="icon-style-3"
							/>
							<label class="custom-control-label" for="sidebaricon-3"
								><i class="fa fa-angle-double-right"></i
							></label>
						</div>
					</div>

					<h4 class="weight-600 font-18 pb-10">Menu List Icon</h4>
					<div class="sidebar-radio-group pb-30 mb-10">
						<div class="custom-control custom-radio custom-control-inline">
							<input
								type="radio"
								id="sidebariconlist-1"
								name="menu-list-icon"
								class="custom-control-input"
								value="icon-list-style-1"
								checked=""
							/>
							<label class="custom-control-label" for="sidebariconlist-1"
								><i class="ion-minus-round"></i
							></label>
						</div>
						<div class="custom-control custom-radio custom-control-inline">
							<input
								type="radio"
								id="sidebariconlist-2"
								name="menu-list-icon"
								class="custom-control-input"
								value="icon-list-style-2"
							/>
							<label class="custom-control-label" for="sidebariconlist-2"
								><i class="fa fa-circle-o" aria-hidden="true"></i
							></label>
						</div>
						<div class="custom-control custom-radio custom-control-inline">
							<input
								type="radio"
								id="sidebariconlist-3"
								name="menu-list-icon"
								class="custom-control-input"
								value="icon-list-style-3"
							/>
							<label class="custom-control-label" for="sidebariconlist-3"
								><i class="dw dw-check"></i
							></label>
						</div>
						<div class="custom-control custom-radio custom-control-inline">
							<input
								type="radio"
								id="sidebariconlist-4"
								name="menu-list-icon"
								class="custom-control-input"
								value="icon-list-style-4"
								checked=""
							/>
							<label class="custom-control-label" for="sidebariconlist-4"
								><i class="icon-copy dw dw-next-2"></i
							></label>
						</div>
						<div class="custom-control custom-radio custom-control-inline">
							<input
								type="radio"
								id="sidebariconlist-5"
								name="menu-list-icon"
								class="custom-control-input"
								value="icon-list-style-5"
							/>
							<label class="custom-control-label" for="sidebariconlist-5"
								><i class="dw dw-fast-forward-1"></i
							></label>
						</div>
						<div class="custom-control custom-radio custom-control-inline">
							<input
								type="radio"
								id="sidebariconlist-6"
								name="menu-list-icon"
								class="custom-control-input"
								value="icon-list-style-6"
							/>
							<label class="custom-control-label" for="sidebariconlist-6"
								><i class="dw dw-next"></i
							></label>
						</div>
					</div>

					<div class="reset-options pt-30 text-center">
						<button class="btn btn-danger" id="reset-settings">
							Reset Settings
						</button>
					</div>
				</div>
			</div>
		</div>

		<div class="left-side-bar">
			<div class="brand-logo">
				<a href="dashboard.php">
					<img src="../assets/img/logo.png" alt="" class="dark-logo" width="50" />
					<img
						src="../assets/img/logo.png"
						width="50"
						alt=""
						class="light-logo"
					/>
				</a>
				<div class="close-sidebar" data-toggle="left-sidebar-close">
					<i class="ion-close-round"></i>
				</div>
			</div>
			<div class="menu-block customscroll">
				<div class="sidebar-menu">
					<ul id="accordion-menu">
						<li class="dropdown">
							<a href="dashboard.php" class="dropdown-toggle no-arrow">
								<span class="micon bi bi-house"></span
								><span class="mtext">Dashboard</span>
							</a>
						</li>
						<li class="dropdown">
							<a href="../book.php" class="dropdown-toggle no-arrow">
								<span class="micon bi bi-calendar4-week"></span
								><span class="mtext">Add Booking</span>
							</a>
						</li>
						<li>
							<a href="reservation.php" class="dropdown-toggle no-arrow">
								<span class="micon bi bi-calendar"></span
								><span class="mtext">Reservations</span>
							</a>
						</li>
						<li>
							<a href="profile.php" class="dropdown-toggle no-arrow">
								<span class="micon bi bi-person"></span
								><span class="mtext">Profile</span>
							</a>
						</li>
					</ul>
				</div>
			</div>
		</div>
		<div class="mobile-menu-overlay"></div>

		<div class="main-container">
			<div class="xs-pd-20-10 pd-ltr-20">
			    <div class="row">
				    <div class="col-6 form-group">
				        <div class="card-box">
				            <div class="card-body">
				                <div class="card-title">Account</div>
				                <?php
				                try
				                {
				                    $user = $_SESSION['sess_id'];  
				                    $stmt = $dbh->prepare("Select * from tblcustomer WHERE customerID=:user");
				                    $stmt->bindParam(':user',$user);
				                    $stmt->execute();
				                    $data = $stmt->fetchAll();
				                    foreach($data as $row)
				                    {
				                        ?>
        				                <?php
        				                if($success!=null)
        				                {
        				                    ?>
        				                    <div class="alert alert-success" role="alert">
        				                        <?php echo $success ?>
        				                    </div>
        				                    <?php
        				                }
        				                ?>
				                        <form method="post" id="frmProfile" class="row">
				                            <input type="hidden" name="customer" value="<?php echo $_SESSION['sess_id'] ?>"/>
				                            <div class="col-12">
				                                <label>Complete Name</label>
				                                <input type="text" class="form-control" name="fullname" value="<?php echo $row['Fullname'] ?>" style="background-color:#ffffff;" readonly/>
				                            </div>
				                            <div class="col-12">
				                                <label>Address</label>
				                                <textarea class="form-control" style="height:150px;" name="address" required><?php echo $row['Address'] ?></textarea>
				                            </div>
				                            <div class="col-12">
				                                <label>Email Address</label>
				                                <input type="email" class="form-control" value="<?php echo $row['EmailAddress'] ?>" style="background-color:#ffffff;" readonly/>
				                            </div>
				                            <div class="col-12">
				                                <div class="row">
				                                    <div class="col-6">
				                                        <label>Contact No</label>
				                                        <input type="phone" class="form-control" maxlength="11" minlength="11" name="phone" value="<?php echo $row['Contact'] ?>" required/>
				                                    </div>
				                                    <div class="col-6">
				                                        <label>Gender</label>
				                                        <input type="text" class="form-control" name="gender" value="<?php echo $row['Gender'] ?>" required/>
				                                    </div>
				                                </div>
				                            </div>
				                            <div class="col-12">
				                                <br/>
				                                <input type="submit" class="form-control btn btn-primary" name="btnUpdate" value="Save Changes"/>
				                            </div>
				                        </form>
				                        <?php
				                    }
				                }
				                catch(Exception $e)
				                {
				                    echo $e->getMessage();
				                }
				                $dbh=null;
				                ?>
				            </div>
				        </div>    
				    </div>
				    <div class="col-4 form-group">
				        <div class="card-box">
				            <div class="card-body">
				                <div class="card-title">Change Password</div>
				                <?php
				                if($errormsg!=null)
				                {
				                    ?>
				                    <div class="alert alert-danger" role="alert">
				                        <?php echo $errormsg ?>
				                    </div>
				                    <?php
				                }
				                ?>
				                <?php
				                if($successmsg!=null)
				                {
				                    ?>
				                    <div class="alert alert-success" role="alert">
				                        <?php echo $successmsg ?>
				                    </div>
				                    <?php
				                }
				                ?>
				                <form method="POST" class="row" id="frmChange">
				                    <input type="hidden" name="action" value="change"/>
				                    <input type="hidden" name="user" value="<?php echo $_SESSION['sess_id'] ?>"/>
				                    <div class="col-12">
				                        <label>New Password</label>
				                        <input type="password" class="form-control" id="new" name="new" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required/>
				                    </div>
				                    <div class="col-12">
				                        <label>Retype Password</label>
				                        <input type="password" class="form-control" id="retype" name="retype" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" required/>
				                    </div>
				                    <div class="col-12">
				                        <br/>
				                        <input type="submit" class="form-control btn btn-primary" name="btnSave" value="Save Changes"/>
				                    </div>
				                </form>
				            </div>
				        </div>
				    </div>
				</div>   	
			</div>
		</div>
		<!-- js -->
		<script src="vendors/scripts/core.js"></script>
		<script src="vendors/scripts/script.min.js"></script>
		<script src="vendors/scripts/process.js"></script>
		<script src="vendors/scripts/layout-settings.js"></script>
		<script src="src/plugins/apexcharts/apexcharts.min.js"></script>
		<script src="src/plugins/datatables/js/jquery.dataTables.min.js"></script>
		<script src="src/plugins/datatables/js/dataTables.bootstrap4.min.js"></script>
		<script src="src/plugins/datatables/js/dataTables.responsive.min.js"></script>
		<script src="src/plugins/datatables/js/responsive.bootstrap4.min.js"></script>
		
	</body>
</html>
