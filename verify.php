<?php
include('resources/dbconfig.php');
$msg = "";$success = "";
try
{
    if(isset($_POST['btnVerify']))
    {
        $emails = $_POST['email'];
        $code = $_POST['code'];
        if(empty($code))
        {
            $msg = "Please enter the verification code";
        }
        else
        {
            $sql = "Select Fullname from tblcustomer WHERE EmailAddress=:email AND Verification=:code";
            $stmt = $dbh->prepare($sql);
            $stmt->bindParam(':email',$emails);
            $stmt->bindParam(':code',$code);
            $stmt->execute();
            $count = $stmt->rowCount();
            $row   = $stmt->fetch(PDO::FETCH_ASSOC);
            if($count == 1 && !empty($row))
            {
                //update status
                $stmt = $dbh->prepare("update tblcustomer SET Status=1 WHERE EmailAddress=:email");
                $stmt->bindParam(':email',$emails);
                $stmt->execute();
                $success = "Your account was verified. Please login";
            }
            else
            {
                $msg = "Invalid Verification Code!";
            }
        }
    }
}
catch(Exception $e)
{
    echo $e->getMessage();
}
$dbh=null;
?>
<!DOCTYPE html>
<html>
	<head>
		<!-- Basic Page Info -->
		<meta charset="utf-8" />
		<title>Verify Account</title>

		<!-- Site favicon -->
		<link
			rel="apple-touch-icon"
			sizes="180x180"
			href="assets/img/logo.png"
		/>
		<link
			rel="icon"
			type="image/png"
			sizes="32x32"
			href="assets/img/logo.png"
		/>
		<link
			rel="icon"
			type="image/png"
			sizes="16x16"
			href="assets/img/logo.png"
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
		<link rel="stylesheet" type="text/css" href="pages/vendors/styles/core.css" />
		<link
			rel="stylesheet"
			type="text/css"
			href="pages/vendors/styles/icon-font.min.css"
		/>
		<link rel="stylesheet" type="text/css" href="pages/vendors/styles/style.css" />
	</head>
	<body class="login-page">
	    <?php
        $email = $_GET['verify_email'];
        ?>
		<div class="login-header box-shadow">
			<div
				class="container-fluid d-flex justify-content-between align-items-center"
			>
				<div class="brand-logo">
					<a href="/">
						<img src="assets/img/logo.png" alt="" width="50" />
					</a>
				</div>
				<div class="login-menu">
					<ul>
						<li><a href="sign-in.php">Sign In</a></li>
					</ul>
				</div>
			</div>
		</div>
		<div
			class="login-wrap d-flex align-items-center flex-wrap justify-content-center"
		>
			<div class="container">
				<div class="row align-items-center">
					<div class="col-md-6 col-lg-7">
						<img src="pages/vendors/images/login-page-img.png" alt="" />
					</div>
					<div class="col-md-6 col-lg-5">
						<div class="login-box bg-white box-shadow border-radius-10">
							<div class="login-title">
								<h2 class="text-center text-primary">Email Verification</h2>
							</div>
							<?php
                                if($msg!=null)
                                {
                                    ?>
                                    <div class="text-center bg-danger" style="padding:10px;">
                                        <p style="color:#ffffff;"><?php echo $msg; ?></p>
                                    </div>
                                    <br/>
                                    <?php
                                }
                            ?>
                            <?php
                                if($success!=null)
                                {
                                    ?>
                                    <div class="text-center bg-success" style="padding:10px;">
                                        <p style="color:#ffffff;"><?php echo $success; ?></p>
                                    </div>
                                    <br/>
                                    <?php
                                }
                            ?>
                            <div class="alert alert-success" role="alert">
                                To confirm your account, please enter the code has sent to your email.
                            </div>
							<form method="post" id="frmVerify">
								<div class="input-group custom">
									<input
										type="email"
										class="form-control form-control-lg"
										placeholder="Email Address"
										name="email"
										value="<?php echo $email ?>"
										id="email"
										required
									/>
									<div class="input-group-append custom">
										<span class="input-group-text"
											><i class="icon-copy dw dw-user1"></i
										></span>
									</div>
								</div>
								<div class="input-group custom">
									<input
										type="password"
										class="form-control form-control-lg"
										placeholder="**********"
										name="code"
										maxlength="6"
										minlength="6"
										required
									/>
									<div class="input-group-append custom">
										<span class="input-group-text"
											><i class="dw dw-padlock1"></i
										></span>
									</div>
								</div>
								<div class="row">
									<div class="col-sm-12">
										<div class="input-group mb-0">
											<input class="btn btn-primary btn-lg btn-block" type="submit" name="btnVerify" value="Verify">
										</div>
										<div
											class="font-16 weight-600 pt-10 pb-10 text-center"
											data-color="#707373">
										</div>
									</div>
								</div>
								<div class="form-group">
								    Already have an account?<a href="sign-in.php" class="btn btn-link">Sign In</a>
								</div>
							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- js -->
		<script src="pages/vendors/scripts/core.js"></script>
		<script src="pages/vendors/scripts/script.min.js"></script>
		<script src="pages/vendors/scripts/process.js"></script>
		<script src="pages/vendors/scripts/layout-settings.js"></script>
	</body>
</html>
