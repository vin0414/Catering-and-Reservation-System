<?php
    session_start();
    include("resources/dbconfig.php");
    if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true)
    {
        header("location:pages/dashboard.php");
        exit;
    }
    $msg = "";
    if(isset($_POST['btnLogin']))
    {
        try
        {
            $username = trim($_POST['username']);
            $password = trim($_POST['password']);
            $stmt = $dbh->prepare("Select Fullname,Designation,userID from tblaccount WHERE Username=:username AND Password=SHA1(:password) AND Status=1");
            $stmt->bindParam(':username',$username);
            $stmt->bindParam(':password',$password);
            $stmt->execute();
            $count = $stmt->rowCount();
            $row   = $stmt->fetch(PDO::FETCH_ASSOC);
            if($count == 1 && !empty($row))
            {
                $_SESSION['sess_fullname'] = $row['Fullname'];
                $_SESSION['sess_Designation'] = $row['Designation'];
                $_SESSION['sess_id'] = $row['userID'];
                $_SESSION['sess_role']="Super-user";
                $_SESSION["loggedin"] = true;
				//save
				$act = "Logged In";
				$date = date('Y-m-d h:i:s a');
				$stmt = $dbh->prepare("insert into tblactivities(DateTime,userID,Activities)values(:datetime,:user,:activity)");
				$stmt->bindParam(':datetime',$date);
				$stmt->bindParam(':user',$row['userID']);
				$stmt->bindParam(':activity',$act);
				$stmt->execute();
                header("location:pages/dashboard.php");
            }
            else
            {
                $msg = "Invalid Username or Password";
            }
        }
        catch(Exception $e)
        {
            echo $e->getMessage();
        }
        $dbh=null;
    }
?>
<!DOCTYPE html>
<html>
	<head>
		<!-- Basic Page Info -->
		<meta charset="utf-8" />
		<title>Zephaniah's Event & Catering Services</title>

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
		<div class="login-header box-shadow">
			<div
				class="container-fluid d-flex justify-content-between align-items-center"
			>
				<div class="brand-logo">
					<a href="index.php">
						<img src="assets/img/logo.png" alt="" width="80"/>
					</a>
				</div>
				<div class="login-menu">
					<ul>
						<li><a href="index.php">Home</a></li>
					</ul>
				</div>
			</div>
		</div>
		<div
			class="login-wrap d-flex align-items-center flex-wrap justify-content-center"
		>
			<div class="container">
				<div class="row align-items-center">
					<div class="col-md-6 col-lg-6">
						<img src="assets/img/logo.png" alt="" />
					</div>
					<div class="col-md-6 col-lg-5">
						<div class="login-box bg-white box-shadow border-radius-10">
							<div class="login-title">
								<h2 class="text-center text-primary">Login</h2>
							</div>
							<?php if($msg!=null){ ?>
							<div class="alert alert-danger" role="alert">
							    Invalid Username or Password
							</div>
							<?php } ?>
							<form method="post">
								<div class="input-group custom">
									<input
										type="text"
										name="username"
										class="form-control form-control-lg"
										placeholder="Username"
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
										name="password"
										class="form-control form-control-lg"
										placeholder="**********"
										required
									/>
									<div class="input-group-append custom">
										<span class="input-group-text"
											><i class="dw dw-padlock1"></i
										></span>
									</div>
								</div>
								<div class="row pb-30">
									<div class="col-6">
										<div class="custom-control custom-checkbox">
											<input
												type="checkbox"
												class="custom-control-input"
												id="customCheck1"
											/>
											<label class="custom-control-label" for="customCheck1"
												>Remember</label
											>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-sm-12">
										<div class="input-group mb-0">
											<input class="btn btn-primary btn-lg btn-block" type="submit" name="btnLogin" value="Sign In">
										</div>
									</div>
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
