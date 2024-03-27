<?php
require_once("dbconfig.php");
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require '../PHPMailer-master/src/Exception.php';
require '../PHPMailer-master/src/PHPMailer.php';
require '../PHPMailer-master/src/SMTP.php';
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
    switch($_POST['action'])
    {
        case "view":
            $val = $_POST['value'];
            $output="";
            $stmt = $dbh->prepare("Select a.Event_name,a.Event_date,a.Event_time,a.Event_location,FORMAT(a.Amount,2)Amount from tblreservation a WHERE a.Code=:code");
            $stmt->bindParam(':code',$val);
            $stmt->execute();
            $count = $stmt->rowCount();
            $row   = $stmt->fetch(PDO::FETCH_ASSOC);
            if($count == 1 && !empty($row))
            {
                $output.="<div class='row'>
                            <div class='col-12'>
                            <label>Event's Name</label>
                            <input type='text' class='form-control' value='".$row['Event_name']."'/>
                            </div>
                            <div class='col-12'>
                                <div class='row'>
                                    <div class='col-6'>
                                        <label>Date</label>
                                        <input type='date' class='form-control' value='".$row['Event_date']."'/>
                                    </div>
                                    <div class='col-6'>
                                        <label>Time</label>
                                        <input type='time' class='form-control' value='".$row['Event_time']."'/>
                                    </div>
                                </div>
                            </div>
                            <div class='col-12'>
                                <div class='row'>
                                    <div class='col-6'>
                                        <label>Location</label>
                                        <input type='text' class='form-control' value='".$row['Event_location']."'/>
                                    </div>
                                    <div class='col-6'>
                                        <label>Total Amount</label>
                                        <input type='text' class='form-control' value='".$row['Amount']."'/>
                                    </div>
                                </div>
                            </div>
                        </div><br/>";
            }
            $output.="<p>Menu</p>";
            //menu
            $stmt = $dbh->prepare("Select * from tbl_selected_menu WHERE Code=:code");
            $stmt->bindParam(':code',$val);
            $stmt->execute();
            $count = $stmt->rowCount();
            $row   = $stmt->fetch(PDO::FETCH_ASSOC);
            if($count == 1 && !empty($row))
            {
                $output.="<table class='table table-bordered' style='font-size:12px;'>
                            <tr><td>Appetizer</td><td>".$row['Appetizer']."</td></tr>
                            <tr><td>Beef</td><td>".$row['Beef']."</td></tr>
                            <tr><td>Pork</td><td>".$row['Pork']."</td></tr>
                            <tr><td>Chicken</td><td>".$row['Chicken']."</td></tr>
                            <tr><td>Vegetables</td><td>".$row['Vegetables']."</td></tr>
                            <tr><td>Pasta</td><td>".$row['Pasta']."</td></tr>
                            <tr><td>Seafood</td><td>".$row['Seafood']."</td></tr>
                            <tr><td>Dessert</td><td>".$row['Dessert']."</td></tr>
                            <tr><td>Drinks</td><td>".$row['Drinks']."</td></tr>
                            <tr><td>Kiddie Meal</td><td>".$row['KiddieMeal']."</td></tr>
                            <tr><td>Kiddie Drinks</td><td>".$row['KiddieDrinks']."</td></tr>
                            <tr><td>Kiddie Soup</td><td>".$row['Soup']."</td></tr>
                        </table>";
            }
            //others
            $output.="<p>Additional</p>";
            $output.="<table class='table table-bordered' style='font-size:12px;'>";
            $stmt = $dbh->prepare("Select IFNULL(Item,'N/A')Item from tblothers WHERE Code=:code");
            $stmt->bindParam(':code',$val);
            $stmt->execute();
            $data = $stmt->fetchAll();
            foreach($data as $row)
            {
                $output.="<tr><td>".$row['Item']."</td></tr>";
            }
            $output.="</table>";
            echo $output;
            break;
        case "reschedule":
            $code = $_POST['code'];
            $date = $_POST['date'];
            $time = $_POST['time'];
            
            $stmt = $dbh->prepare("Select * from tblreservation WHERE Code=:code");
            $stmt->bindParam(':code',$val);
            $stmt->execute();
            $data = $stmt->fetchAll();
            foreach($data as $row)
            {
                $mail->IsHTML(true);
                $mail->AddAddress($row['EmailAddress'], $row['Fullname']);
                $mail->SetFrom("zephaniah.catering@gmail.com", "Zephaniah's Event & Catering");
                $mail->AddCC("zephaniah.catering@gmail.com", "Zephaniah's Event & Catering");
                $mail->Subject = "Request to Reschedule a Reservation :".$code;
                $content = "Dear ".$row['Fullname'].",<br/><br/>

                We sincerely hope you are doing well. We appreciate your decision to make your next reservation with Zephaniah's Event and Catering Services. We acknowledge that schedules might change, and we are here to help you reschedule your reservation.<br/><br/>

                Your request to postpone your reservation has been received. Based on availability, we'll do our best to fulfill your request.<br/><br/>
                
                Previous Reservation Details:
                Reservation No :".$code."
                Original Reservation Date: ".$row['Event_date']."<br/>
                Original Reservation Time: ".$row['Event_time']."<br/>
                Number of Guests: ".$row['Guest']."<br/><br/>
                
                
                We respectfully ask that you confirm the suggested revised date and time or offer alternate suggestions that would be most convenient for you. We will quickly check for availability and make the required preparations once we receive your confirmation.<br/><br/>
                
                Proposed New Reservation Details:
                Preferred New Reservation Date: ".$date."
                Preferred New Reservation Time: ".$time."
                Number of Guests: ".$row['Guest']."<br/><br/>
                
                Please be aware that the availability of your selected day and time depends on whether our services are available. We will make every effort to comply with your request, and we'll let you know if any modifications are needed.<br/><br/>
                
                Please do not hesitate to contact us by phone at (046) 434-0015 | 09953741205 or by email at zephaniahs.event@gmail.com if you have any queries or require additional help with the rescheduling of your reservation. We are here to help and can set up everything for you.<br/><br/>
                
                We appreciate your cooperation and hope to see you at Zephaniah's Event and Catering Services on your new date.<br/><br/>
                
                Best regards,<br/><br/>
                
                Zephaniah's Event and Catering Services";
                $mail->MsgHTML($content);
                $mail->Send();
            }
            $stmt = $dbh->prepare("update tblreservation SET Status=0,Event_date=:date,Event_time=:time WHERE Code=:code");
            $stmt->bindParam(':date',$date);
            $stmt->bindParam(':time',$time);
            $stmt->bindParam(':code',$code);
            $stmt->execute();
            echo "success";
            break;
        case "rebook":
            $code = $_POST['code'];
            $date = $_POST['date'];
            $time = $_POST['time'];
            
            $stmt = $dbh->prepare("Select * from tblreservation WHERE Code=:code");
            $stmt->bindParam(':code',$val);
            $stmt->execute();
            $data = $stmt->fetchAll();
            foreach($data as $row)
            {
                $mail->IsHTML(true);
                $mail->AddAddress($row['EmailAddress'], $row['Fullname']);
                $mail->SetFrom("zephaniah.catering@gmail.com", "Zephaniah's Event & Catering");
                $mail->AddCC("zephaniah.catering@gmail.com", "Zephaniah's Event & Catering");
                $mail->Subject = "Rebooking of Catering Reservation";
                $content = "Dear ".$row['Fullname'].",<br/><br/>

                We sincerely hope you are doing well. We appreciate your decision to make your next reservation with Zephaniah's Event and Catering Services. We acknowledge that schedules might change, and we are here to help you reschedule your reservation.<br/><br/>

                Your request to postpone your reservation has been received. Based on availability, we'll do our best to fulfill your request.<br/><br/>
                
                Previous Reservation Details:<br/>
                Reservation No:".$code."<br/>
                Original Reservation Date: ".$row['Event_date']."<br/>
                Original Reservation Time: ".$row['Event_time']."<br/>
                Number of Guests: ".$row['Guest']."<br/><br/>
                
                
                We respectfully ask that you confirm the suggested revised date and time or offer alternate suggestions that would be most convenient for you. We will quickly check for availability and make the required preparations once we receive your confirmation.<br/><br/>
                
                Proposed New Reservation Details:<br/>
                Preferred New Reservation Date: ".$date."<br/>
                Preferred New Reservation Time: ".$time."<br/>
                Number of Guests: ".$row['Guest']."<br/>
                
                Please be aware that the availability of your selected day and time depends on whether our services are available. We will make every effort to comply with your request, and we'll let you know if any modifications are needed.<br/>
                
                Please do not hesitate to contact us by phone at (046) 434-0015 | 09953741205 or by email at zephaniahs.event@gmail.com if you have any queries or require additional help with the rescheduling of your reservation. We are here to help and can set up everything for you.<br/>
                
                We appreciate your cooperation and hope to see you at Zephaniah's Event and Catering Services on your new date.
                <br/>
                
                Best regards,<br/><br/>
                
                Zephaniah's Event and Catering Services";
                $mail->MsgHTML($content);
                $mail->Send();
            }
            $stmt = $dbh->prepare("update tblreservation SET Status=0,Event_date=:date,Event_time=:time WHERE Code=:code");
            $stmt->bindParam(':date',$date);
            $stmt->bindParam(':time',$time);
            $stmt->bindParam(':code',$code);
            $stmt->execute();
            echo "success";
            break;
        case "reject":
            $val = $_POST['value'];
            $stmt = $dbh->prepare("delete from tblreservation WHERE Code=:code");
            $stmt->bindParam(':code',$val);
            $stmt->execute();
            echo "success";
            break;
        case "complete":
            $val = $_POST['value'];
            $stmt = $dbh->prepare("update tblreservation SET Status=2 WHERE Code=:code");
            $stmt->bindParam(':code',$val);
            $stmt->execute();
            echo "success";
            break;
        case "pay":
            $val = $_POST['code'];
            $reference = $_POST['reference'];
            $pay = $_POST['payment_method'];
            $downpayment = $_POST['amount'];
            $date = date('Y-m-d');
            $remarks = "Full Payment";
            $stmt = $dbh->prepare('Select Paid,Total from tblpayment WHERE Code=:code');
            $stmt->bindParam(':code',$val);
            $stmt->execute();
            $data = $stmt->fetchAll();
            foreach($data as $row)
            {
                $amount = $downpayment+$row['Paid'];
                $bal = $row['Total']-$amount;
                $stmt = $dbh->prepare("update tblpayment SET Paid=:paid,Balance=:bal,Remarks=:rem,date=:date,Reference=:ref,Payment=:pay WHERE Code=:code");
                $stmt->bindParam(':paid',$amount);
                $stmt->bindParam(':balance',$bal);
                $stmt->bindParam(':rem',$remarks);
                $stmt->bindParam(':date',$date);
                $stmt->bindParam(':ref',$reference);
                $stmt->bindParam(':pay',$pay);
                $stmt->bindParam(':code',$val);
                $stmt->execute();
            }
            echo "success";
            break;
        case "accept":
            $val = $_POST['code'];
            $paymentMethod = $_POST['payment'];
            $reference = $_POST['reference'];
            $typeOfPayment = $_POST['payment'];
            $downpayment = $_POST['amount'];
            $date = date('Y-m-d');
            $stmt = $dbh->prepare("update tblreservation SET Status=1 WHERE Code=:code");
            $stmt->bindParam(':code',$val);
            $stmt->execute();
            if($typeOfPayment=="Down Payment")
            {
                //send email
                $stmt = $dbh->prepare("Select *,FORMAT(Amount,2)TotalAmount from tblreservation WHERE Code=:code");
                $stmt->bindParam(':code',$val);
                $stmt->execute();
                $data = $stmt->fetchAll();
                foreach($data as $row)
                {
                    $bal = $row['Amount']-$downpayment;
                    $stmt = $dbh->prepare("insert into tblpayment(Code,Total,Paid,Balance,Remarks,Payment,Reference,date)
                    values(:code,:total,:paid,:balance,:remarks,:payment,:reference,:date)");
                    $stmt->bindParam(':code',$val);
                    $stmt->bindParam(':total',$row['Amount']);
                    $stmt->bindParam(':paid',$downpayment);
                    $stmt->bindParam(':balance',$bal);
                    $stmt->bindParam(':remarks',$typeOfPayment);
                    $stmt->bindParam(':payment',$paymentMethod);
                    $stmt->bindParam(':reference',$reference);
                    $stmt->bindParam(':date',$date);
                    $stmt->execute();
                    
                    $mail->IsHTML(true);
                    $mail->AddAddress($row['EmailAddress'], $row['Fullname']);
                    $mail->SetFrom("zephaniah.catering@gmail.com", "Zephaniah's Event & Catering");
                    $mail->AddCC("zephaniah.catering@gmail.com", "Zephaniah's Event & Catering");
                    $mail->Subject = "Confirmation of Reservation";
                    $content = "Dear ".$row['Fullname'].",
    
                    Your reservation with Zephaniah's Event and Catering Services has been confirmed, and we are happy to do so. We appreciate you considering us for your upcoming event. Please find a summary of your reservation information and a breakdown of the payment below:<br/><br/>
                    
                    Reservation Details:<br/>
                    Reservation Name: ".$row['Fullname']."<br/>
                    Reservation Date: ".$row['Event_date']."<br/>
                    Reservation Time: ".$row['Event_time']."<br/>
                    Number of Guests: ".$row['Guest']."<br/>
                    Type of Reservation: ".$row['Event_name']."<br/>
                    
                    Payment Details:
                    Total Amount: ".$row['TotalAmount']."<br/>
                    Down Payment: ".$downpayment."<br/>
                    Remaining Balance: ".$bal."<br/>
                    
                    To prevent any problems during your event, please make sure the outstanding balance is paid by the deadline.<br/>
                    
                    Do not hesitate to contact us through email at zephaniahs.event@gmail.com or phone at (046) 434-0015 | 09953741205 if you have any problems or need more help with your reservation or the payment procedure. We are here to help you and make the process as easy as we can.<br/>
                    
                    We are eager to have you as our guests and give you a memorable experience. Thank you once again for choosing Zephaniah's Event and Catering Services.<br/>
                    
                    Best regards,<br/><br/>
                    
                    Zephaniah's Event and Catering Services";
                    $mail->MsgHTML($content);
                    $mail->Send();
                }
            }
            else
            {
                //send email
                $stmt = $dbh->prepare("Select * from tblreservation WHERE Code=:code");
                $stmt->bindParam(':code',$val);
                $stmt->execute();
                $data = $stmt->fetchAll();
                foreach($data as $row)
                {
                    $bal = $row['Amount']-$downpayment;
                    $stmt = $dbh->prepare("insert into tblpayment(Code,Total,Paid,Balance,Remarks,Payment,Reference,date)
                    values(:code,:total,:paid,:balance,:remarks,:payment,:reference,:date)");
                    $stmt->bindParam(':code',$val);
                    $stmt->bindParam(':total',$row['Amount']);
                    $stmt->bindParam(':paid',$downpayment);
                    $stmt->bindParam(':balance',$bal);
                    $stmt->bindParam(':remarks',$typeOfPayment);
                    $stmt->bindParam(':payment',$paymentMethod);
                    $stmt->bindParam(':reference',$reference);
                    $stmt->bindParam(':date',$date);
                    $stmt->execute();

                    $mail->IsHTML(true);
                    $mail->AddAddress($row['EmailAddress'], $row['Fullname']);
                    $mail->SetFrom("zephaniah.catering@gmail.com", "Zephaniah's Event & Catering");
                    $mail->AddCC("zephaniah.catering@gmail.com", "Zephaniah's Event & Catering");
                    $mail->Subject = "Reservation Confirmation: Paid in Full";
                    $content = "Dear ".$row['Fullname'].",
    
                    Congratulations! We are overjoyed to inform you that Zephaniah's Event and Catering Services has successfully confirmed your reservation. We appreciate you paying the entire amount due for your reservation. We're excited to give you an outstanding experience.<br/><br/>

                    Reservation Details:<br/>
                    Reservation No: ".$val."<br/>
                    Reservation Date: ".$row['Event_date']."<br/>
                    Reservation Time: ".$row['Event_time']."<br/>
                    Number of Guests: ".$row['Guest']."<br/>
                    
                    Payment Details:
                    Total Amount Paid: ".$downpayment."<br/>
                    Payment Method: ".$paymentMethod."<br/>
                    Transaction ID/Reference: ".$reference."<br/>
                    
                    Please double-check the reservation information listed above to make sure it is accurate. Please get in touch with our customer service team right away if you spot any errors or have any inquiries.<br/>
                    
                    Your reservation is now secure since the complete payment has been received. With complete assurance that your reservation has been made, you can move forward.<br/>
                    
                    We want to thank you once more for choosing Zephaniah's Event and Catering Services. We value your confidence in us and are dedicated to giving you an exceptional experience.<br/>
                    
                    We appreciate your contribution and help.<br/>
                    
                    Best regards,<br/><br/>
                    
                    Zephaniah's Event and Catering Services";
                    $mail->MsgHTML($content);
                    $mail->Send();
                }
            }
            echo "success";
            break;
        case "cancel":
            $val = $_POST['value'];
            $stmt = $dbh->prepare("update tblreservation SET Status=3 WHERE Code=:code");
            $stmt->bindParam(':code',$val);
            $stmt->execute();
            //send email
            $stmt = $dbh->prepare("Select * from tblreservation WHERE Code=:code");
            $stmt->bindParam(':code',$val);
            $stmt->execute();
            $data = $stmt->fetchAll();
            foreach($data as $row)
            {
                $mail->IsHTML(true);
                $mail->AddAddress($row['EmailAddress'], $row['Fullname']);
                $mail->SetFrom("zephaniah.catering@gmail.com", "Zephaniah's Event & Catering");
                $mail->AddCC("zephaniah.catering@gmail.com", "Zephaniah's Event & Catering");
                $mail->Subject = "Service Cancellation: No Refund Policy";
                $content = "Dear ".$row['Fullname'].",<br/><br/>

                I hope you are well and are reading my email. I'm writing to inform you that Zephaniah's Event and Catering Services has been notified of your cancellation request. I hate to inform you that due to our company's stringent'no refund' policy, we cannot issue a refund if you decide to cancel.<br/>
                
                We'd like to take a moment to explain the thinking behind our return policy.<br/>
                
                As a business, we work hard to keep our prices low while providing our cherished clients with high-quality goods and services. We spent a lot of time, effort, and money creating, producing, and distributing our offerings to do this. Therefore, we have put in place a no-refund policy to make sure that.<br/>
                
                Best regards,<br/><br/>
                
                Zephaniah's Event and Catering Services";
                $mail->MsgHTML($content);
                $mail->Send();
            }
            echo "success";
            break;
        case "filter":
            $filter = $_POST['filter'];
            $sql="";
            if($filter=="Date")
            {
                $sql = "Select a.*,b.Event_Name from tblreservation a LEFT JOIN tblevent b ON b.eventID=a.eventID ORDER BY a.Event_date";
            }
            else if($filter=="Event")
            {
                $sql = "Select a.*,b.Event_Name from tblreservation a LEFT JOIN tblevent b ON b.eventID=a.eventID ORDER BY b.Event_Name";
            }
            else if($filter=="Pending")
            {
                $sql = "Select a.*,b.Event_Name from tblreservation a LEFT JOIN tblevent b ON b.eventID=a.eventID WHERE a.Status=0 ORDER BY a.Status";
            }
            else if($filter=="Reserved")
            {
                $sql = "Select a.*,b.Event_Name from tblreservation a LEFT JOIN tblevent b ON b.eventID=a.eventID WHERE a.Status=1 ORDER BY a.Status";
            }
            else if($filter=="Cancelled")
            {
                $sql = "Select a.*,b.Event_Name from tblreservation a LEFT JOIN tblevent b ON b.eventID=a.eventID WHERE a.Status=3 ORDER BY a.Status";
            }
            else
            {
                $sql = "Select a.*,b.Event_Name from tblreservation a LEFT JOIN tblevent b ON b.eventID=a.eventID ORDER BY a.Status";
            }
            $stmt = $dbh->prepare($sql);
            $stmt->execute();
            $data = $stmt->fetchAll();
            foreach($data as $row)
            {
                if($row['Status']==0)
                {
                    ?>
                    <tr>
                        <td><?php echo $row['Code'] ?></td>
                        <td><?php echo $row['Fullname'] ?></td>
                        <td><?php echo $row['Contact'] ?></td>
                        <td><?php echo $row['EmailAddress'] ?></td>
                        <td><?php echo $row['Event_date'] ?></td>
                        <td><?php echo $row['Event_time'] ?></td>
                        <td><?php echo $row['Event_Name'] ?></td>
                        <td><span class="badge bg-warning">PENDING</span></td>
                        <td>
                            <button type="button" class="btn btn-light btn-sm dropdown-toggle waves-effect" data-toggle="dropdown" aria-expanded="false">
								Action <span class="caret"></span>
							</button>
							<div class="dropdown-menu">
							    <button type="button" class="dropdown-item btn view" value="<?php echo $row['Code'] ?>">View</button>
								<button type="button" class="dropdown-item btn accept" value="<?php echo $row['Code'] ?>">Accept</button>
								<button type="button" class="dropdown-item btn reject" value="<?php echo $row['Code'] ?>">Reject</button>
							</div>
                        </td>
                    </tr>
                    <?php
                }
                else if($row['Status']==1)
                {
                    ?>
                    <tr>
                        <td><?php echo $row['Code'] ?></td>
                        <td><?php echo $row['Fullname'] ?></td>
                        <td><?php echo $row['Contact'] ?></td>
                        <td><?php echo $row['EmailAddress'] ?></td>
                        <td><?php echo $row['Event_date'] ?></td>
                        <td><?php echo $row['Event_time'] ?></td>
                        <td><?php echo $row['Event_Name'] ?></td>
                        <td><span class="badge bg-primary">RESERVED</span></td>
                        <td>
                            <button type="button" class="btn btn-light btn-sm dropdown-toggle waves-effect" data-toggle="dropdown" aria-expanded="false">
								Action <span class="caret"></span>
							</button>
							<div class="dropdown-menu">
							    <button type="button" class="dropdown-item btn view" value="<?php echo $row['Code'] ?>">View</button>
								<button type="button" class="dropdown-item btn complete" value="<?php echo $row['Code'] ?>">Mark as Done</button>
								<a href="reschedule.php?code=<?php echo $row['Code'] ?>" class="dropdown-item btn reschedule">Re-Schedule</a>
								<button type="button" class="dropdown-item btn cancel" value="<?php echo $row['Code'] ?>">Cancel</button>
							</div>
                        </td>
                    </tr>
                    <?php
                }
                else if($row['Status']==2)
                {
                    ?>
                    <tr>
                        <td><?php echo $row['Code'] ?></td>
                        <td><?php echo $row['Fullname'] ?></td>
                        <td><?php echo $row['Contact'] ?></td>
                        <td><?php echo $row['EmailAddress'] ?></td>
                        <td><?php echo $row['Event_date'] ?></td>
                        <td><?php echo $row['Event_time'] ?></td>
                        <td><?php echo $row['Event_Name'] ?></td>
                        <td><span class="badge bg-success">DONE</span></td>
                        <td>-</td>
                    </tr>
                    <?php
                }
                else
                {
                    ?>
                    <tr>
                        <td><?php echo $row['Code'] ?></td>
                        <td><?php echo $row['Fullname'] ?></td>
                        <td><?php echo $row['Contact'] ?></td>
                        <td><?php echo $row['EmailAddress'] ?></td>
                        <td><?php echo $row['Event_date'] ?></td>
                        <td><?php echo $row['Event_time'] ?></td>
                        <td><?php echo $row['Event_Name'] ?></td>
                        <td><span class="badge bg-danger">CANCELLED</span></td>
                        <td>
                            <button type="button" class="btn btn-light btn-sm dropdown-toggle waves-effect" data-toggle="dropdown" aria-expanded="false">
								Action <span class="caret"></span>
							</button>
							<div class="dropdown-menu">
							    <button type="button" class="dropdown-item btn view" value="<?php echo $row['Code'] ?>">View</button>
								<a href="rebook.php?code=<?php echo $row['Code'] ?>" class="dropdown-item btn rebook">Re-Book</a>
							</div>
                        </td>
                    </tr>
                    <?php
                }
            }
            break;
        case "fetch":
            $stmt = $dbh->prepare("Select a.*,b.Event_Name from tblreservation a LEFT JOIN tblevent b ON b.eventID=a.eventID ORDER BY a.Status");
            $stmt->execute();
            $data = $stmt->fetchAll();
            foreach($data as $row)
            {
                if($row['Status']==0)
                {
                    ?>
                    <tr>
                        <td><?php echo $row['Code'] ?></td>
                        <td><?php echo $row['Fullname'] ?></td>
                        <td><?php echo $row['Contact'] ?></td>
                        <td><?php echo $row['EmailAddress'] ?></td>
                        <td><?php echo $row['Event_date'] ?></td>
                        <td><?php echo $row['Event_time'] ?></td>
                        <td><?php echo $row['Event_Name'] ?></td>
                        <td><span class="badge bg-warning">PENDING</span></td>
                        <td>
                            <button type="button" class="btn btn-light btn-sm dropdown-toggle waves-effect" data-toggle="dropdown" aria-expanded="false">
								Action <span class="caret"></span>
							</button>
							<div class="dropdown-menu">
							    <button type="button" class="dropdown-item btn view" value="<?php echo $row['Code'] ?>">View</button>
								<button type="button" class="dropdown-item btn accept" value="<?php echo $row['Code'] ?>">Accept</button>
								<button type="button" class="dropdown-item btn reject" value="<?php echo $row['Code'] ?>">Reject</button>
							</div>
                        </td>
                    </tr>
                    <?php
                }
                else if($row['Status']==1)
                {
                    ?>
                    <tr>
                        <td><?php echo $row['Code'] ?></td>
                        <td><?php echo $row['Fullname'] ?></td>
                        <td><?php echo $row['Contact'] ?></td>
                        <td><?php echo $row['EmailAddress'] ?></td>
                        <td><?php echo $row['Event_date'] ?></td>
                        <td><?php echo $row['Event_time'] ?></td>
                        <td><?php echo $row['Event_Name'] ?></td>
                        <td><span class="badge bg-primary">RESERVED</span></td>
                        <td>
                            <button type="button" class="btn btn-light btn-sm dropdown-toggle waves-effect" data-toggle="dropdown" aria-expanded="false">
								Action <span class="caret"></span>
							</button>
							<div class="dropdown-menu">
							    <button type="button" class="dropdown-item btn view" value="<?php echo $row['Code'] ?>">View</button>
								<button type="button" class="dropdown-item btn complete" value="<?php echo $row['Code'] ?>">Mark as Done</button>
								<a href="reschedule.php?code=<?php echo $row['Code'] ?>" class="dropdown-item btn reschedule">Re-Schedule</a>
								<button type="button" class="dropdown-item btn cancel" value="<?php echo $row['Code'] ?>">Cancel</button>
							</div>
                        </td>
                    </tr>
                    <?php
                }
                else if($row['Status']==2)
                {
                    ?>
                    <tr>
                        <td><?php echo $row['Code'] ?></td>
                        <td><?php echo $row['Fullname'] ?></td>
                        <td><?php echo $row['Contact'] ?></td>
                        <td><?php echo $row['EmailAddress'] ?></td>
                        <td><?php echo $row['Event_date'] ?></td>
                        <td><?php echo $row['Event_time'] ?></td>
                        <td><?php echo $row['Event_Name'] ?></td>
                        <td><span class="badge bg-success">DONE</span></td>
                        <td>-</td>
                    </tr>
                    <?php
                }
                else
                {
                    ?>
                    <tr>
                        <td><?php echo $row['Code'] ?></td>
                        <td><?php echo $row['Fullname'] ?></td>
                        <td><?php echo $row['Contact'] ?></td>
                        <td><?php echo $row['EmailAddress'] ?></td>
                        <td><?php echo $row['Event_date'] ?></td>
                        <td><?php echo $row['Event_time'] ?></td>
                        <td><?php echo $row['Event_Name'] ?></td>
                        <td><span class="badge bg-danger">CANCELLED</span></td>
                        <td>
                            <button type="button" class="btn btn-light btn-sm dropdown-toggle waves-effect" data-toggle="dropdown" aria-expanded="false">
								Action <span class="caret"></span>
							</button>
							<div class="dropdown-menu">
							    <button type="button" class="dropdown-item btn view" value="<?php echo $row['Code'] ?>">View</button>
								<a href="rebook.php?code=<?php echo $row['Code'] ?>" class="dropdown-item btn rebook">Re-Book</a>
							</div>
                        </td>
                    </tr>
                    <?php
                }
            }
            break;
        case "search":
            $val = "%".$_POST['keyword']."%";
            $stmt = $dbh->prepare("Select a.*,b.Event_Name from tblreservation a LEFT JOIN tblevent b ON b.eventID=a.eventID WHERE a.Code LIKE :text ORDER BY a.Status");
            $stmt->bindParam(':text',$val);
            $stmt->execute();
            $data = $stmt->fetchAll();
            foreach($data as $row)
            {
                if($row['Status']==0)
                {
                    ?>
                    <tr>
                        <td><?php echo $row['Code'] ?></td>
                        <td><?php echo $row['Fullname'] ?></td>
                        <td><?php echo $row['Contact'] ?></td>
                        <td><?php echo $row['EmailAddress'] ?></td>
                        <td><?php echo $row['Event_date'] ?></td>
                        <td><?php echo $row['Event_time'] ?></td>
                        <td><?php echo $row['Event_Name'] ?></td>
                        <td><span class="badge bg-warning">PENDING</span></td>
                        <td>
                            <button type="button" class="btn btn-light btn-sm dropdown-toggle waves-effect" data-toggle="dropdown" aria-expanded="false">
								Action <span class="caret"></span>
							</button>
							<div class="dropdown-menu">
							    <button type="button" class="dropdown-item btn view" value="<?php echo $row['Code'] ?>">View</button>
								<button type="button" class="dropdown-item btn accept" value="<?php echo $row['Code'] ?>">Accept</button>
								<button type="button" class="dropdown-item btn reject" value="<?php echo $row['Code'] ?>">Reject</button>
							</div>
                        </td>
                    </tr>
                    <?php
                }
                else if($row['Status']==1)
                {
                    ?>
                    <tr>
                        <td><?php echo $row['Code'] ?></td>
                        <td><?php echo $row['Fullname'] ?></td>
                        <td><?php echo $row['Contact'] ?></td>
                        <td><?php echo $row['EmailAddress'] ?></td>
                        <td><?php echo $row['Event_date'] ?></td>
                        <td><?php echo $row['Event_time'] ?></td>
                        <td><?php echo $row['Event_Name'] ?></td>
                        <td><span class="badge bg-primary">RESERVED</span></td>
                        <td>
                            <button type="button" class="btn btn-light btn-sm dropdown-toggle waves-effect" data-toggle="dropdown" aria-expanded="false">
								Action <span class="caret"></span>
							</button>
							<div class="dropdown-menu">
							    <button type="button" class="dropdown-item btn view" value="<?php echo $row['Code'] ?>">View</button>
								<button type="button" class="dropdown-item btn complete" value="<?php echo $row['Code'] ?>">Mark as Done</button>
								<button type="button" class="dropdown-item btn cancel" value="<?php echo $row['Code'] ?>">Cancel</button>
							</div>
                        </td>
                    </tr>
                    <?php
                }
                else if($row['Status']==2)
                {
                    ?>
                    <tr>
                        <td><?php echo $row['Code'] ?></td>
                        <td><?php echo $row['Fullname'] ?></td>
                        <td><?php echo $row['Contact'] ?></td>
                        <td><?php echo $row['EmailAddress'] ?></td>
                        <td><?php echo $row['Event_date'] ?></td>
                        <td><?php echo $row['Event_time'] ?></td>
                        <td><?php echo $row['Event_Name'] ?></td>
                        <td><span class="badge bg-success">DONE</span></td>
                        <td>-</td>
                    </tr>
                    <?php
                }
                else
                {
                    ?>
                    <tr>
                        <td><?php echo $row['Code'] ?></td>
                        <td><?php echo $row['Fullname'] ?></td>
                        <td><?php echo $row['Contact'] ?></td>
                        <td><?php echo $row['EmailAddress'] ?></td>
                        <td><?php echo $row['Event_date'] ?></td>
                        <td><?php echo $row['Event_time'] ?></td>
                        <td><?php echo $row['Event_Name'] ?></td>
                        <td><span class="badge bg-danger">CANCELLED</span></td>
                        <td>
                            <button type="button" class="btn btn-light btn-sm dropdown-toggle waves-effect" data-toggle="dropdown" aria-expanded="false">
								Action <span class="caret"></span>
							</button>
							<div class="dropdown-menu">
							    <button type="button" class="dropdown-item btn view" value="<?php echo $row['Code'] ?>">View</button>
								<a href="rebook.php?code=<?php echo $row['Code'] ?>" class="dropdown-item btn rebook">Re-Book</a>
							</div>
                        </td>
                    </tr>
                    <?php
                }
            }
            break;
        default:
            break;
    }
}
catch(Exception $e)
{
    echo $e->getMessage();
}
$dbh= null;
?>