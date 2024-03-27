<?php
    session_start();
    include("resources/dbconfig.php");
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    require 'PHPMailer-master/src/Exception.php';
    require 'PHPMailer-master/src/PHPMailer.php';
    require 'PHPMailer-master/src/SMTP.php';
    $msg="";
    if(isset($_POST['btnRegister']))
    {
        try
        {
            $mail = new PHPMailer();
            $mail->IsSMTP();
            $mail->SMTPDebug  = 0;  
            $mail->SMTPAuth   = TRUE;
            $mail->SMTPSecure = "tls";
            $mail->Port       = 587;
            $mail->Host       = "smtp.gmail.com";
            $mail->Username   = "zephaniah.catering@gmail.com";
            $mail->Password   = "xzihodbxjvzdvfsn";
            
            
            $name = $_POST['fullname'];
            $contact = "";
            $gender = "";
            $email = $_POST['email'];
            $password = $_POST['password'];
            $confirm = $_POST['confirm'];
            $address = "N/A";
            $stat = 0;
            $code = random_int(100000, 999999);
            if($password!=$confirm)
            {
                $msg = "Password mismatched! Please try again";
            }
            else
            {
                $sql = "insert into tblcustomer(EmailAddress,Password,Fullname,Contact,Gender,Address,Status,Verification)
                values(:email,SHA1(:pass),:name,:contact,:gender,:address,:stat,:code)";
                $stmt=$dbh->prepare($sql);
                $stmt->bindParam(':email',$email);
                $stmt->bindParam(':pass',$password);
                $stmt->bindParam(':name',$name);
                $stmt->bindParam(':contact',$contact);
                $stmt->bindParam(':gender',$gender);
                $stmt->bindParam(':address',$address);
                $stmt->bindParam(':stat',$stat);
                $stmt->bindParam(':code',$code);
                $stmt->execute();
                
                //send email
                $mail->IsHTML(true);
                $mail->AddAddress($email, $name);
                $mail->SetFrom("zephaniah.catering@gmail.com", "Zephaniah's Event & Catering");
                $mail->AddCC("zephaniah.catering@gmail.com", "Zephaniah's Event & Catering");
                $mail->Subject = "Account Verification";
                $content = "Hi ".$name."!
                            Your verification code is ".$code.".<br/><br/>
                            
                            Enter this code in our website to activate your account.<br/><br/>
                        
                            If you have any questions, send us an email or contact us.<br/><br/>
                            
                            We’re glad you’re here!<br/><br/>
                            Zephaniah's Event & Catering Services";
                $mail->MsgHTML($content);
                $mail->Send();
                header("location:verify.php?verify_email=".$email);
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
		<title>Register</title>

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
		<link
			rel="stylesheet"
			type="text/css"
			href="pages/src/plugins/jquery-steps/jquery.steps.css"
		/>
		<link rel="stylesheet" type="text/css" href="pages/vendors/styles/style.css" />
	</head>

	<body class="login-page">
		<div class="login-header box-shadow">
			<div
				class="container-fluid d-flex justify-content-between align-items-center"
			>
				<div class="brand-logo">
					<a href="/">
						<img src="assets/img/logo.png" alt=""  width="50" />
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
			class="register-page-wrap d-flex align-items-center flex-wrap justify-content-center"
		>
			<div class="container">
				<div class="row align-items-center">
					<div class="col-md-6 col-lg-7">
						<img src="pages/vendors/images/register-page-img.png" alt="" />
					</div>
					<div class="col-md-6 col-lg-5">
						<div class="register-box bg-white box-shadow border-radius-10">
							<div class="card-box pd-20">
							    <center><img src="assets/img/logo.png" alt=""  width="50" /></center>
							    <div class="card-title text-center">Account Registration</div>
								<form class="row" method="post" id="frmRegister">
								    <div class="col-12">
								        <label>Complete Name</label>
								        <input type="text" class="form-control" name="fullname" required/>
								    </div>
								    <div class="col-12">
								        <label>Email Address</label>
								        <input type="email" class="form-control" name="email" required/>
								    </div>
								    <div class="col-12">
								        <label>Password</label>
								        <input type="password" class="form-control" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" name="password" required/>
								    </div>
								    <div class="col-12">
								        <label>Confirm Password</label>
								        <input type="password" class="form-control" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters" name="confirm" required/>
								    </div>
								    <div class="col-12">
								        <br/>
								        <input type="submit" class="btn btn-primary form-control" name="btnRegister" value="Register"/>
								    </div>
								    <div class="col-12">
    								    <br/>
    								    Already have an account?<a href="sign-in.php" class="btn-link">Sign In</a>
    								</div>
								</form>
							</div>
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
		<script src="pages/src/plugins/jquery-steps/jquery.steps.js"></script>
		<script src="pages/vendors/scripts/steps-setting.js"></script>
	</body>
</html>
