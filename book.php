<?php 
    session_start();
    require_once("resources/dbconfig.php");
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    require 'PHPMailer-master/src/Exception.php';
    require 'PHPMailer-master/src/PHPMailer.php';
    require 'PHPMailer-master/src/SMTP.php';
?>
<!DOCTYPE html>
<html>
	<head>
	    <!-- Basic Page Info -->
		<meta charset="utf-8" />
		<title>Zephaniah's Catering</title>

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
			href="pages/src/plugins/datatables/css/dataTables.bootstrap4.min.css"
		/>
		<link
			rel="stylesheet"
			type="text/css"
			href="pages/src/plugins/datatables/css/responsive.bootstrap4.min.css"
		/>
		<link rel="stylesheet" type="text/css" href="pages/vendors/styles/style.css" />
		<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<?php
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
        
        if(isset($_POST['btnSave']))
        {
            //info
            $user = 0;
            $datecreated = date('Y-m-d');
            $codes;
            $stmt = $dbh->prepare("select COUNT(*)+1 as total from tbltransaction");
            $stmt->execute();
            $count = $stmt->rowCount();
            $row   = $stmt->fetch(PDO::FETCH_ASSOC);
            if($count == 1 && !empty($row))
            {
                $codes = str_pad($row['total'], 8, '0', STR_PAD_LEFT);
                $stmt = $dbh->prepare('insert into tbltransaction(Code)values(:code)');
                $stmt->bindParam(':code',$codes);
                $stmt->execute();
            }
            $client_name = $_POST['client_name'];
            $phone = $_POST['phone'];
            $email = $_POST['email'];
            $address = $_POST['address'];
            $date_event = $_POST['date_event'];
            $time_event = $_POST['time_event'];
            $event_name = $_POST['event_name'];
            $location = $_POST['event_location'];
            $province = $_POST['province'];
            $city = $_POST['city'];
            $type_event = $_POST['type_event'];
            $guest = $_POST['guest'];
			$package = $_POST['package'];
            $theme = $_POST['event_theme'];
            $status = 0;
            //cake
            $name=$_FILES['file']['name'];
            $size=$_FILES['file']['size'];
            $type=$_FILES['file']['type'];
            $temp=$_FILES['file']['tmp_name'];
            $filename = $name;
            //menu
            $appetizer = $_POST['appetizer'];
            $beef = $_POST['beef'];
            $pork = $_POST['pork'];
            $chicken = $_POST['chicken'];
            $vege = $_POST['vegetable'];
            $pasta = $_POST['pasta'];
            $dessert = $_POST['dessert'];
            $drinks = $_POST['drinks'];
            $seafood = $_POST['seafood'];
            $kiddie_meal = $_POST['kiddie_meal'];
            $kiddie_drinks = $_POST['kiddie_drinks'];
            
            //check if full or not
            $stmt = $dbh->prepare("Select COUNT(*)total from tblreservation WHERE Status=1 AND Event_date=:date");
            $stmt->bindParam(':date',$date_event);
            $stmt->execute();
            $records = $stmt->fetchAll();
            foreach($records as $booked)
            {
                if($booked["total"]==4)
                {
                    ?>
                    <script>
                        alert("Sorry! But there are no more available slots for the said date. Please select another date");
                    </script>
                    <?php
                }
                else
                {
                    if(empty($name))
                    {
                        //do nothing
                    }
                    else
                    {
                        $move =  move_uploaded_file($temp,"../resources/cake/".$filename);
                    }
                    //save the menu
                    $stmt = $dbh->prepare("insert into tbl_selected_menu(Code,Appetizer,Beef,Pork,Chicken,Vegetables,Pasta,Dessert,Drinks,Seafood,KiddieMeal,KiddieDrinks)
                    values(:code,:a,:b,:c,:d,:e,:f,:g,:h,:i,:j,:k)");
                    $stmt->bindParam(':code',$codes);
                    $stmt->bindParam(':a',$appetizer);
                    $stmt->bindParam(':b',$beef);
                    $stmt->bindParam(':c',$pork);
                    $stmt->bindParam(':d',$chicken);
                    $stmt->bindParam(':e',$vege);
                    $stmt->bindParam(':f',$pasta);
                    $stmt->bindParam(':g',$dessert);
                    $stmt->bindParam(':h',$drinks);
                    $stmt->bindParam(':i',$seafood);
                    $stmt->bindParam(':j',$kiddie_meal);
                    $stmt->bindParam(':k',$kiddie_drinks); 
                    $stmt->execute();
                    //rents
                    
                    $rowCounts = count((array)$_POST["itemID"]);
                    if($rowCounts>0)
                    {
                        for($i=0;$i<$rowCounts;$i++)
                        {
                            $stmt=$dbh->prepare("Select Name,Rate from tblrental WHERE rentID='" . $_POST["itemID"][$i] . "'");
                            $stmt->execute();
                            $data  = $stmt->fetchAll();
                            foreach($data as $row)
                            {
                                //save
                                $stmt = $dbh->prepare("insert into tblothers(Code,Item,Amount)values(:code,:item,:amount)");
                                $stmt->bindParam(':code',$codes);
                                $stmt->bindParam(':item',$row['Name']);
                                $stmt->bindParam(':amount',$row['Rate']);
                                $stmt->execute();
                            }
                        }
                    }
                    //get the total
                    $total;
                    $stmt = $dbh->prepare("Select IFNULL(SUM(Amount),0)total from tblothers WHERE Code=:code");
                    $stmt->bindParam(':code',$codes);
                    $stmt->execute();
                    $getTotal = $stmt->rowCount();
                    $sum   = $stmt->fetch(PDO::FETCH_ASSOC);
                    if($getTotal == 1 && !empty($sum))
                    {
                        $total = $sum['total'];
                    }
                    //charge
                    $charge;
                    $stmt = $dbh->prepare("Select Rate from tblcharge WHERE chargeID=:city");
                    $stmt->bindParam(':city',$city);
                    $stmt->execute();
                    $counter = $stmt->rowCount();
                    $rate   = $stmt->fetch(PDO::FETCH_ASSOC);
                    if($counter == 1 && !empty($rate))
                    {
                        $charge = $rate['Rate'];
                    }
					//price
					$price;
                    $stmt = $dbh->prepare("Select Price from tblproduct WHERE productID=:id");
                    $stmt->bindParam(':id',$package);
                    $stmt->execute();
                    $counters = $stmt->rowCount();
                    $rowss   = $stmt->fetch(PDO::FETCH_ASSOC);
                    if($counters == 1 && !empty($rowss))
                    {
                        $price = $rowss['Price'];
                    }
                    //total
                    $amount  = $price + $charge + $total;
                    //save the data
                    $stmt = $dbh->prepare("insert into tblreservation
                    (customerID,Fullname,Contact,EmailAddress,Address,Event_date,Event_time,Event_name,Event_location,pID,City,eventID,Guest,productID,Theme,Cake,Amount,Status,Code,DateCreated)
                    values(:user,:client,:phone,:email,:address,:date,:time,:event,:location,:province,:city,:type,:guest,:package,:theme,:cake,:amount,:stat,:code,:datecreated)");
                    $stmt->bindParam(':user',$user);
                    $stmt->bindParam(':client',$client_name);
                    $stmt->bindParam(':phone',$phone);
                    $stmt->bindParam(':email',$email);
                    $stmt->bindParam(':address',$address);
                    $stmt->bindParam(':date',$date_event);
                    $stmt->bindParam(':time',$time_event);
                    $stmt->bindParam(':event',$event_name);
                    $stmt->bindParam(':location',$location);
                    $stmt->bindParam(':province',$province);
                    $stmt->bindParam(':city',$city);
                    $stmt->bindParam(':type',$type_event);
                    $stmt->bindParam(':guest',$guest);
					$stmt->bindParam(':package',$package);
                    $stmt->bindParam(':theme',$theme);
                    $stmt->bindParam(':cake',$filename);
                    $stmt->bindParam(':amount',$amount);
                    $stmt->bindParam(':stat',$status);
                    $stmt->bindParam(':code',$codes);
                    $stmt->bindParam(':datecreated',$datecreated);
                    $stmt->execute();
                    $now = time();
                    $your_date = strtotime($date_event);
                    $datediff = $your_date-$now;
                    $days = round($datediff / (60 * 60 * 24));
                    if($days>7)
                    {
                        $mail->IsHTML(true);
                        $mail->AddAddress($email, $client_name);
                        $mail->SetFrom("zephaniah.catering@gmail.com", "Zephaniah's Event & Catering");
                        $mail->AddCC("zephaniah.catering@gmail.com", "Zephaniah's Event & Catering");
                        $mail->Subject = "Instructions for Making Payment for a Future Reservation Confirmation";
                        $content = "Dear ".$client_name.",


                        We are grateful that you chose Zephaniah's Event and Catering Services for your upcoming reservation. We are pleased to inform you that your reservation request has been received and is being handled as a regular booking. To confirm your reservation, we kindly need a 10% down payment with the following information:<br/><br/>
                        
                        Reservation Details:<br/>
                        Reservation Date: ".$date_event."<br/>
                        Reservation Time: ".$time_event."<br/>
                        Reservation Name: ".$client_name."<br/>
                        Reservation : ".$codes."<br/>
                        
                        Gcash and bank account numbers will be sent to you via a Google Meet or Zoom meeting under the Data Privacy Act.<br/>
                        
                        Please make sure the down payment is paid by the deadline to guarantee your reservation.<br/>
                        
                        Best regards,<br/><br/>
                        Zephaniah's Event & Catering Services";
                        $mail->MsgHTML($content);
                        $mail->Send();
                    ?>
                    <script>
                        Swal.fire({
                              title: 'Great!',
                              text: "To confirm regular bookings, within one week payment is required at the time of booking. We recommend making your reservations in advance to ensure availability. Once payment has been received, your booking will be confirmed and we will send you a confirmation email with all the details. Please note that any cancellations within 24 hours of the booking date will not be refunded. If you have any questions or concerns, please contact us and we'll be happy to assist you.",
                              icon: 'success',
                              showCancelButton: false,
                              confirmButtonColor: '#3085d6',
                            }).then((result) => {
                              if (result.isConfirmed) {
                                window.location.href="/";
                              }
                            });
                    </script>
                    <?php
                    }
                    else
                    {
                        $mail->IsHTML(true);
                        $mail->AddAddress($email, $client_name);
                        $mail->SetFrom("zephaniah.catering@gmail.com", "Zephaniah's Event & Catering");
                        $mail->AddCC("zephaniah.catering@gmail.com", "Zephaniah's Event & Catering");
                        $mail->Subject = "Instructions for Making Payment for a Future Reservation Confirmation";
                        $content = "Dear ".$client_name.",<br/><br/>

                        We are grateful that you chose Zephaniah's Event and Catering Services for your upcoming reservation. We are pleased to inform you that your reservation request has been received and is being handled as a rush booking. To confirm your reservation, we kindly need a 50% down payment with the following information:<br/><br/>
                        
                        Reservation Details:<br/>
                        Reservation Date: ".$date_event."<br/>
                        Reservation Time: ".$time_event."<br/>
                        Reservation Name: ".$client_name."<br/>
                        Reservation : ".$codes."<br/>
                        
                        Gcash and bank account numbers will be sent to you via a Google Meet or Zoom meeting under the Data Privacy Act.<br/>
                        
                        Please make sure the down payment is paid by the deadline to guarantee your reservation.<br/>
                        
                        Best regards,<br/><br/>
                        Zephaniah's Event & Catering Services";
                        $mail->MsgHTML($content);
                        $mail->Send();
                    echo $client_name;
					?>
                    <script>
                        Swal.fire({
                              title: 'Great!',
                              text: "Thank you for your recent booking request. We would like to confirm that your request has been processed and accepted as a rush booking. We kindly remind you that payment is due within 24 hours in order to secure your reservation. Failure to make payment within this timeframe may result in your booking being cancelled. If you have any further questions or concerns, please do not hesitate to contact us.",
                              icon: 'success',
                              showCancelButton: false,
                              confirmButtonColor: '#3085d6',
                            }).then((result) => {
                              if (result.isConfirmed) {
                                window.location.href="/";
                              }
                            });
                    </script>
                    <?php   
                    }
                }
            }
        }
    }
    catch(Exception $e)
    {
        echo $e->getMessage();
    }
?>
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
    		<div class="container">
    		    <a href="index.php" class="btn btn-link">Back to Home</a>
    		</div>	
		<div class="container">
			<div class="xs-pd-20-10 pd-ltr-20">
				<form method="post" id="frmBook" class="row" enctype="multipart/form-data">
				    <div class="col-lg-6 form-group">
				        <div class="card-box">
				            <div class="card-body">
				                <div class="card-title">Customer Information</div>
				                <div class="row">
				                    <div class="col-12">
				                        <label>Customer's Name</label>
				                        <input type="text" class="form-control" name="client_name" required/>
				                    </div>
				                    <div class="col-12">
				                        <div class="row">
				                            <div class="col-lg-6">
				                                <label>Contact #</label>
				                                <input type="tel" pattern="[0-9\W+]{13}" placeholder="+63XXXXXXXXXX" class="form-control" name="phone" maxlength="13" required/>
				                            </div>
				                            <div class="col-lg-6">
				                                <label>Email Address</label>
				                                <input type="email" id="email" class="form-control" name="email" required/>
				                            </div>
				                        </div>
				                    </div>
				                    <div class="col-12">
				                        <label>Complete Address</label>
				                        <textarea class="form-control" name="address" style="height:100px;" required></textarea>
				                    </div>
				                </div>
                                <br/>
				                <div class="card-title">Event Information</div>
				                <div class="row">
				                    <div class="col-12">
				                        <div class="row">
				                            <div class="col-lg-6">
				                                <label>Date of Event</label>
				                                <input type="date" class="form-control" name="date_event" id="date_event" required/>
				                            </div>
				                            <div class="col-lg-6">
				                                <label>Time</label>
				                                <input type="time" class="form-control" name="time_event" required/>
				                            </div>
				                        </div>
				                    </div>
				                    <div class="col-12">
				                        <label>Event Name</label>
				                        <input type="text" class="form-control" name="event_name" required/>
				                    </div>
				                    <div class="col-12">
				                        <label>Address</label>
				                        <input type="text" class="form-control" name="event_location" required/>
				                    </div>
				                    <div class="col-12">
				                        <div class="row">
				                            <div class="col-6">
				                                <label>Province</label>
				                                <select class="form-control" id="province" name="province" required>
				                                    <option value=""></option>
												</select>
				                            </div>
				                            <div class="col-6">
				                                <label>City</label>
				                                <select class="form-control" id="city" name="city" required>
				                                    <option value=""></option>
				                                </select>
				                            </div>
				                        </div>
				                    </div>
				                    <div class="col-12">
				                        <p><i>Price may differ based on the location of the event.</i></p>
				                    </div>
				                    <div class="col-12">
				                        <div class="row">
				                            <div class="col-lg-8">
				                                <label>Type of Event</label>
				                                <select class="form-control" id="type_event" name="type_event" required>
				                                    <option value=""></option>
				                                </select>
				                            </div>
				                            <div class="col-lg-4">
				                                <label>No of Guests</label>
				                                <input type="number" class="form-control" name="guest" required/>
				                            </div>
				                        </div>
				                    </div>
									<div class="col-12">
				                        <label>Package</label>
				                        <select class="form-control" name="package" id="package" required>
				                            <option value="">Choose</option>
				                        </select>
				                    </div>
				                    <div class="col-12">
				                        <label>Theme</label>
				                        <input type="text" class="form-control" name="event_theme" required/>
				                    </div>
				                </div>
				            </div>
				        </div>   
				    </div>
				    <div class="col-lg-6 form-group">
				        <div class="card-box" id="package_menu">
				            <div class="card-body">
				                <div class="card-title">Menu</div>
				                <div class="row">
				                    <div class="col-6">
				                        <label>Appetizer and Side</label>
				                        <select class="form-control" id="appetizer" name="appetizer" required>
				                            <option value=""></option>
				                            <?php
				                            try
				                            {
				                                $stmt = $dbh->prepare("Select a.Food_Name from tblmenu a LEFT JOIN tblcategory b ON b.catID=a.catID WHERE b.Category_Name='Appetizer and Sides' AND a.Status=1");
				                                $stmt->execute();
				                                $data = $stmt->fetchAll();
				                                foreach($data as $row)
				                                {
				                                    ?>
				                                    <option><?php echo $row['Food_Name'] ?></option>
				                                    <?php
				                                }
				                            }
				                            catch(Exception $e)
				                            {
				                                echo $e->getMessage();
				                            }
				                            ?>
				                        </select>
				                    </div>
				                    <div class="col-6">
				                        <label>Beef</label>
				                        <select class="form-control" id="beef" name="beef" required>
				                            <option value=""></option>
				                            <?php
				                            try
				                            {
				                                $stmt = $dbh->prepare("Select a.Food_Name from tblmenu a LEFT JOIN tblcategory b ON b.catID=a.catID WHERE b.Category_Name='Beef' AND a.Status=1");
				                                $stmt->execute();
				                                $data = $stmt->fetchAll();
				                                foreach($data as $row)
				                                {
				                                    ?>
				                                    <option><?php echo $row['Food_Name'] ?></option>
				                                    <?php
				                                }
				                            }
				                            catch(Exception $e)
				                            {
				                                echo $e->getMessage();
				                            }
				                            ?>
				                        </select>
				                    </div>
				                </div>
				                <div class="row">
				                    <div class="col-6">
				                        <label>Pork</label>
				                        <select class="form-control" id="pork" name="pork" required>
				                            <option value=""></option>
				                            <?php
				                            try
				                            {
				                                $stmt = $dbh->prepare("Select a.Food_Name from tblmenu a LEFT JOIN tblcategory b ON b.catID=a.catID WHERE b.Category_Name='Pork' AND a.Status=1");
				                                $stmt->execute();
				                                $data = $stmt->fetchAll();
				                                foreach($data as $row)
				                                {
				                                    ?>
				                                    <option><?php echo $row['Food_Name'] ?></option>
				                                    <?php
				                                }
				                            }
				                            catch(Exception $e)
				                            {
				                                echo $e->getMessage();
				                            }
				                            ?>
				                        </select>
				                    </div>
				                    <div class="col-6">
				                        <label>Chicken</label>
				                        <select class="form-control" id="chicken" name="chicken" required>
				                            <option value=""></option>
				                            <?php
				                            try
				                            {
				                                $stmt = $dbh->prepare("Select a.Food_Name from tblmenu a LEFT JOIN tblcategory b ON b.catID=a.catID WHERE b.Category_Name='Chicken' AND a.Status=1");
				                                $stmt->execute();
				                                $data = $stmt->fetchAll();
				                                foreach($data as $row)
				                                {
				                                    ?>
				                                    <option><?php echo $row['Food_Name'] ?></option>
				                                    <?php
				                                }
				                            }
				                            catch(Exception $e)
				                            {
				                                echo $e->getMessage();
				                            }
				                            ?>
				                        </select>
				                    </div>
				                </div>
				                <div class="row">
				                    <div class="col-6">
				                        <label>Vegetables</label>
				                        <select class="form-control" id="vegetable" name="vegetable" required>
				                            <option value=""></option>
				                            <?php
				                            try
				                            {
				                                $stmt = $dbh->prepare("Select a.Food_Name from tblmenu a LEFT JOIN tblcategory b ON b.catID=a.catID WHERE b.Category_Name='Vegetables' AND a.Status=1");
				                                $stmt->execute();
				                                $data = $stmt->fetchAll();
				                                foreach($data as $row)
				                                {
				                                    ?>
				                                    <option><?php echo $row['Food_Name'] ?></option>
				                                    <?php
				                                }
				                            }
				                            catch(Exception $e)
				                            {
				                                echo $e->getMessage();
				                            }
				                            ?>
				                        </select>
				                    </div>
				                    <div class="col-6">
				                        <label>Pasta</label>
				                        <select class="form-control" id="pasta" name="pasta" required>
				                            <option value=""></option>
				                            <?php
				                            try
				                            {
				                                $stmt = $dbh->prepare("Select a.Food_Name from tblmenu a LEFT JOIN tblcategory b ON b.catID=a.catID WHERE b.Category_Name='Pasta' AND a.Status=1");
				                                $stmt->execute();
				                                $data = $stmt->fetchAll();
				                                foreach($data as $row)
				                                {
				                                    ?>
				                                    <option><?php echo $row['Food_Name'] ?></option>
				                                    <?php
				                                }
				                            }
				                            catch(Exception $e)
				                            {
				                                echo $e->getMessage();
				                            }
				                            ?>
				                        </select>
				                    </div>
				                </div>
				                <div class="row">
				                    <div class="col-6">
				                        <label>Dessert</label>
				                        <select class="form-control" id="dessert" name="dessert" required>
				                            <option value=""></option>
				                            <?php
				                            try
				                            {
				                                $stmt = $dbh->prepare("Select a.Food_Name from tblmenu a LEFT JOIN tblcategory b ON b.catID=a.catID WHERE b.Category_Name='Dessert' AND a.Status=1");
				                                $stmt->execute();
				                                $data = $stmt->fetchAll();
				                                foreach($data as $row)
				                                {
				                                    ?>
				                                    <option><?php echo $row['Food_Name'] ?></option>
				                                    <?php
				                                }
				                            }
				                            catch(Exception $e)
				                            {
				                                echo $e->getMessage();
				                            }
				                            ?>
				                        </select>
				                    </div>
				                    <div class="col-6">
				                        <label>Drinks</label>
				                        <select class="form-control" id="drinks" name="drinks" required>
				                            <option value=""></option>
				                            <?php
				                            try
				                            {
				                                $stmt = $dbh->prepare("Select a.Food_Name from tblmenu a LEFT JOIN tblcategory b ON b.catID=a.catID WHERE b.Category_Name='Drinks' AND a.Status=1");
				                                $stmt->execute();
				                                $data = $stmt->fetchAll();
				                                foreach($data as $row)
				                                {
				                                    ?>
				                                    <option><?php echo $row['Food_Name'] ?></option>
				                                    <?php
				                                }
				                            }
				                            catch(Exception $e)
				                            {
				                                echo $e->getMessage();
				                            }
				                            ?>
				                        </select>
				                    </div>
				                </div>
				                <div class="row">
				                    <div class="col-12">
				                        <label>Seafood</label>
				                        <select class="form-control" id="seafood" name="seafood" required>
				                            <option value=""></option>
				                            <?php
				                            try
				                            {
				                                $stmt = $dbh->prepare("Select a.Food_Name from tblmenu a LEFT JOIN tblcategory b ON b.catID=a.catID WHERE b.Category_Name='Seafood (Additional)' AND a.Status=1");
				                                $stmt->execute();
				                                $data = $stmt->fetchAll();
				                                foreach($data as $row)
				                                {
				                                    ?>
				                                    <option><?php echo $row['Food_Name'] ?></option>
				                                    <?php
				                                }
				                            }
				                            catch(Exception $e)
				                            {
				                                echo $e->getMessage();
				                            }
				                            ?>
				                        </select>
				                    </div>
				                </div>
				                <div class="row">
				                    <div class="col-12">
				                        <label>Kiddie Menu - Meal (Optional)</label>
				                        <select class="form-control" id="kiddie_meal" name="kiddie_meal">
				                            <option value=""></option>
				                            <?php
				                            try
				                            {
				                                $stmt = $dbh->prepare("Select a.Food_Name from tblmenu a LEFT JOIN tblcategory b ON b.catID=a.catID WHERE b.Category_Name='Kiddie Menu - Meal' AND a.Status=1");
				                                $stmt->execute();
				                                $data = $stmt->fetchAll();
				                                foreach($data as $row)
				                                {
				                                    ?>
				                                    <option><?php echo $row['Food_Name'] ?></option>
				                                    <?php
				                                }
				                            }
				                            catch(Exception $e)
				                            {
				                                echo $e->getMessage();
				                            }
				                            ?>
				                        </select>
				                    </div>
				                </div>
				                <div class="row">
				                    <div class="col-12">
				                        <label>Kiddie Menu - Drinks (Optional)</label>
				                        <select class="form-control" id="kiddie_drinks" name="kiddie_drinks">
				                            <option value=""></option>
				                            <?php
				                            try
				                            {
				                                $stmt = $dbh->prepare("Select a.Food_Name from tblmenu a LEFT JOIN tblcategory b ON b.catID=a.catID WHERE b.Category_Name='Kiddie Menu - Drinks' AND a.Status=1");
				                                $stmt->execute();
				                                $data = $stmt->fetchAll();
				                                foreach($data as $row)
				                                {
				                                    ?>
				                                    <option><?php echo $row['Food_Name'] ?></option>
				                                    <?php
				                                }
				                            }
				                            catch(Exception $e)
				                            {
				                                echo $e->getMessage();
				                            }
				                            ?>
				                        </select>
				                    </div>
				                </div>
                                <br/>
				                <div class="row">
				                    <input type="file" class="form-control" name="file" style="display:none;"/>
				                    <div class="col-12">
									<label>Add Ons</label>
				                    </div>
				                    <div class="col-12"  id="add-ons">
				                        <div class="table-responsive" style="height:200px;overflow-y:auto;">
				                        <table class="table nowrap">
				                            <tbody>
				                        <?php
				                        try
				                        {
				                            $stmt = $dbh->prepare("Select rentID,Name,FORMAT(Rate,2)Rate from tblrental WHERE Status=1");
				                            $stmt->execute();
				                            $data = $stmt->fetchAll();
				                            foreach($data as $row)
				                            {
				                                ?>
				                                <tr>
				                                    <td><input type="checkbox" value="<?php echo $row['rentID'] ?>" name="itemID[]" id="itemID"  style="width:15px;height:15px;"/></td>
				                                    <td><?php echo $row['Name'] ?></td>
				                                    <td><?php echo $row['Rate'] ?></td>
				                                </tr>
				                                <?php
				                            }
				                        }
				                        catch(Exception $e)
				                        {
				                            echo $e->getMessage();
				                        }
				                        $dbh=null;
				                        ?>
				                            </tbody>
				                        </table>
				                        </div>
				                    </div>
				                    <div class="col-12">
				                        <br/>
				                        <input type="checkbox" required/> By ticking the box, you are confirming that you have read, understood and agreed to Zephaniah's Event and Catering Services <a href="ZEPHANIAHS-NEW-CONTRACT-AGREEMENT.pdf" target="_BLANK">terms and conditions.</a>
				                    </div>
				                    <div class="col-12">
				                        <br/>
				                        <input type="submit" class="form-control btn btn-primary text-white" name="btnSave" value="Reserve"/>
				                    </div>
				                </div>
				            </div>    
				        </div>
				    </div>
				</form>
			</div>
		</div>
		<!-- js -->
		<script src="pages/vendors/scripts/core.js"></script>
		<script src="pages/vendors/scripts/script.min.js"></script>
		<script src="pages/vendors/scripts/process.js"></script>
		<script src="pages/vendors/scripts/layout-settings.js"></script>
		<script src="pages/src/plugins/apexcharts/apexcharts.min.js"></script>
		<script src="pages/src/plugins/datatables/js/jquery.dataTables.min.js"></script>
		<script src="pages/src/plugins/datatables/js/dataTables.bootstrap4.min.js"></script>
		<script src="pages/src/plugins/datatables/js/dataTables.responsive.min.js"></script>
		<script src="pages/src/plugins/datatables/js/responsive.bootstrap4.min.js"></script>
		<script>
		    $(document).ready(function()
		    { debugger;
		        var today = new Date();
                var dd = String(today.getDate()).padStart(2, '0');
                var mm = String(today.getMonth() + 1).padStart(2, '0');
                var yyyy = today.getFullYear();
            
                today = yyyy + '-' + mm + '-' + dd;
                $('#date_event').attr('min',today);
		       event();fetch(); 
		       
		    });
		    function myFunction()
		    {
		        var checkBox = document.getElementById("add");
                if (checkBox.checked == true){
                    document.getElementById("add-ons").style="display:block";
                }
                else
                {
                    document.getElementById("add-ons").style="display:none";
                }
		    }
            
		    function fetch()
		    { debugger;
		        var action = "province";
		        $.ajax({
		            url:"resources/fetch.php",method:"GET",
		            data:{action:action},
		            success:function(data)
		            { console.log (data)
		                $('#province').append(data);
		            }
		        });
		    }
		    $('#province').change(function(){
		        var action = "get-city";
		        var val = $(this).val();
		        $('#city').find('option').not(':first').remove();
		        $.ajax({
		            url:"resources/fetch.php",method:"GET",
		            data:{action:action,value:val},
		            success:function(data)
		            {
		                $('#city').append(data);
		            }
		        });
		    });
		    function event()
		    {
		        var action = "event";
		        $.ajax({
		            url:"resources/fetch.php",method:"GET",
		            data:{action:action},
		            success:function(data)
		            {
		                $('#type_event').append(data);
		            }
		        });
		    }
		    $('#type_event').change(function()
		    {
		       var action = "package";
		       var val = $(this).val();
		       $.ajax({
		            url:"resources/fetch.php",method:"GET",
		            data:{action:action,value:val},
		            success:function(data)
		            {
		                $('#package').append(data);
		            }
		        });
		    });
		</script>
	</body>
</html>
