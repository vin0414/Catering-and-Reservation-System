<?php
require_once("dbconfig.php");
try
{
    switch($_GET['action'])
    {
        case "search-list":
            $text = "%".$_GET['keyword']."%";
            $stmt = $dbh->prepare("Select a.Fullname,a.Code,FORMAT(a.Amount,2)Total,FORMAT(b.Paid,2)Paid,FORMAT(b.Balance,2)Balance,b.Reference,b.Remarks,b.Payment,b.Date from tblreservation a 
            INNER JOIN tblpayment b ON b.Code=a.Code WHERE a.Code LIKE :text GROUP BY a.Code");
            $stmt->bindParam(':text',$text);
            $stmt->execute();
            $data = $stmt->fetchAll();
            foreach($data as $row)
            {
                if($row['Remarks']=="Down Payment")
                {
                    ?>
                    <tr>
                        <td><?php echo $row['Code'] ?></td>
                        <td><?php echo $row['Fullname'] ?></td>
                        <td style="text-align:right;"><?php echo $row['Total'] ?></td>
                        <td style="text-align:right;"><?php echo $row['Paid'] ?></td>
                        <td style="text-align:right;"><?php echo $row['Balance'] ?></td>
                        <td><?php echo $row['Date'] ?></td>
                        <td><?php echo $row['Payment'] ?></td>
                        <td><?php echo $row['Reference'] ?></td>
                        <td><?php echo $row['Remarks'] ?></td>
                        <td>
                            <button type="button" class="btn btn-warning btn-sm pay" value="<?php echo $row['Code'] ?>"> Pay</button>
                        </td>
                    </tr>
                    <?php
                }
                else
                {
                    ?>
                    <tr>
                        <td><?php echo $row['Code'] ?></td>
                        <td><?php echo $row['Fullname'] ?></td>
                        <td style="text-align:right;"><?php echo $row['Total'] ?></td>
                        <td style="text-align:right;"><?php echo $row['Paid'] ?></td>
                        <td style="text-align:right;"><?php echo $row['Balance'] ?></td>
                        <td><?php echo $row['Date'] ?></td>
                        <td><?php echo $row['Payment'] ?></td>
                        <td><?php echo $row['Reference'] ?></td>
                        <td><?php echo $row['Remarks'] ?></td>
                        <td><span class="badge bg-success">Fully Paid</span></td>
                    </tr>
                    <?php
                }
            }
            break;
        case "list":
            $stmt = $dbh->prepare("Select a.Fullname,a.Code,FORMAT(a.Amount,2)Total,FORMAT(b.Paid,2)Paid,FORMAT(b.Balance,2)Balance,b.Reference,b.Remarks,b.Payment,(b.date)Date from tblreservation a 
            INNER JOIN tblpayment b ON b.Code=a.Code GROUP BY a.Code");
            $stmt->execute();
            $data = $stmt->fetchAll();
            foreach($data as $row)
            {
                if($row['Remarks']=="Down Payment")
                {
                    ?>
                    <tr>
                        <td><?php echo $row['Code'] ?></td>
                        <td><?php echo $row['Fullname'] ?></td>
                        <td style="text-align:right;"><?php echo $row['Total'] ?></td>
                        <td style="text-align:right;"><?php echo $row['Paid'] ?></td>
                        <td style="text-align:right;"><?php echo $row['Balance'] ?></td>
                        <td><?php echo $row['Date'] ?></td>
                        <td><?php echo $row['Payment'] ?></td>
                        <td><?php echo $row['Reference'] ?></td>
                        <td><?php echo $row['Remarks'] ?></td>
                        <td>
                            <button type="button" class="btn btn-warning btn-sm pay" value="<?php echo $row['Code'] ?>"> Pay</button>
                        </td>
                    </tr>
                    <?php
                }
                else
                {
                    ?>
                    <tr>
                        <td><?php echo $row['Code'] ?></td>
                        <td><?php echo $row['Fullname'] ?></td>
                        <td style="text-align:right;"><?php echo $row['Total'] ?></td>
                        <td style="text-align:right;"><?php echo $row['Paid'] ?></td>
                        <td style="text-align:right;"><?php echo $row['Balance'] ?></td>
                        <td><?php echo $row['Date'] ?></td>
                        <td><?php echo $row['Payment'] ?></td>
                        <td><?php echo $row['Reference'] ?></td>
                        <td><?php echo $row['Remarks'] ?></td>
                        <td><span class="badge bg-success">Fully Paid</span></td>
                    </tr>
                    <?php
                }
            }
            break;
        case "total":
            $stmt = $dbh->prepare("Select FORMAT(COUNT(*),0)total from tblreservation WHERE Status <>0");
            $stmt->execute();
            $data = $stmt->fetchAll();
            foreach($data as $row)
            {
                echo $row['total'];
            }
            break;
        case "upcoming":
            $date = date("Y-m-d");
            $stmt = $dbh->prepare("Select FORMAT(COUNT(*),0)total from tblreservation WHERE Status=1 AND Event_date >".$date."");
            $stmt->execute();
            $data = $stmt->fetchAll();
            foreach($data as $row)
            {
                echo $row['total'];
            }
            break;
        case "upcoming-customer":
            $date = date("Y-m-d");
            $stmt = $dbh->prepare("Select Event_date,Event_time,Fullname,Event_location from tblreservation WHERE Status=1 AND Event_date >".$date." ORDER BY Event_date");
            $stmt->execute();
            $data = $stmt->fetchAll();
            ?>
            <table class="table nowrap">
                <tbody>
            <?php
            foreach($data as $row)
            {
                ?>
                <tr>
                    <td><?php echo $row['Event_date'] ?></td>
                    <td><?php echo $row['Event_time'] ?></td>
                    <td><?php echo $row['Fullname'] ?></td>
                    <td><?php echo $row['Event_location'] ?></td>
                </tr>
                <?php
            }
            ?>
                </tbody>
            </table>
            <?php
            break;
        case "pending":
            $stmt = $dbh->prepare("Select FORMAT(COUNT(*),0)total from tblreservation WHERE Status=0");
            $stmt->execute();
            $data = $stmt->fetchAll();
            foreach($data as $row)
            {
                echo $row['total'];
            }
            break;
        case "income":
            $month = date('m');
            $year = date('Y');
            $stmt = $dbh->prepare("Select FORMAT(IFNULL(SUM(Amount),0),2)total from tblreservation WHERE Status<>0 AND DATE_FORMAT(DateCreated,'%m')=:month AND DATE_FORMAT(DateCreated,'%Y')=:year");
            $stmt->bindParam(':month',$month);
            $stmt->bindParam(':year',$year);
            $stmt->execute();
            $data = $stmt->fetchAll();
            foreach($data as $row)
            {
                echo $row['total'];
            }
            break;
        case "event":
            $stmt = $dbh->prepare("Select eventID,Event_Name from tblevent WHERE Event_Name IN ('Birthday','Wedding','Baptismal','Corporate Event')");
            $stmt->execute();
            $data = $stmt->fetchAll();
            foreach($data as $row)
            {
                ?>
                <option value="<?php echo $row['eventID'] ?>"><?php echo $row['Event_Name'] ?></option>
                <?php
            }
            break;
        case "package":
            $val = $_GET['value'];
            $stmt = $dbh->prepare("Select productID,Package_Name from tblproduct WHERE eventID=:id");
            $stmt->bindParam(':id',$val);
            $stmt->execute();
            $data = $stmt->fetchAll();
            foreach($data as $row)
            {
                ?>
                <option value="<?php echo $row['productID'] ?>"><?php echo $row['Package_Name'] ?></option>
                <?php
            }
            break;
        case "search-rent":
            $text = "%".$_GET['keyword']."%";
            $stmt = $dbh->prepare("Select rentID,Name,FORMAT(Rate,2)rate,Status from tblrental WHERE Name LIKE :text");
            $stmt->bindParam(':text',$text);
            $stmt->execute();
            $data = $stmt->fetchAll();
            foreach($data as $row)
            {
                if($row['Status']==1)
                {
                    ?>
                    <tr>
                        <td><?php echo $row['Name'] ?></td>
                        <td><?php echo $row['rate'] ?></td>
                        <td><span class="badge bg-success">Available</span></td>
                        <td><button type="button" class="btn btn-default btn-sm edit" value="<?php echo $row['rentID'] ?>"><span class="bi bi-pencil-square"></span> Edit</button></td>
                    </tr>
                    <?php
                }
                else
                {
                    ?>
                    <tr>
                        <td><?php echo $row['Name'] ?></td>
                        <td><?php echo $row['rate'] ?></td>
                        <td><span class="badge bg-danger">Unavailable</span></td>
                        <td><button type="button" class="btn btn-default btn-sm edit" value="<?php echo $row['rentID'] ?>"><span class="bi bi-pencil-square"></span> Edit</button></td>
                    </tr>
                    <?php
                }
            }
            break;
        case "rent":
            $stmt = $dbh->prepare("Select rentID,Name,FORMAT(Rate,2)rate,Status from tblrental");
            $stmt->execute();
            $data = $stmt->fetchAll();
            foreach($data as $row)
            {
                if($row['Status']==1)
                {
                    ?>
                    <tr>
                        <td><?php echo $row['Name'] ?></td>
                        <td><?php echo $row['rate'] ?></td>
                        <td><span class="badge bg-success">Available</span></td>
                        <td><button type="button" class="btn btn-default btn-sm edit" value="<?php echo $row['rentID'] ?>"><span class="bi bi-pencil-square"></span> Edit</button></td>
                    </tr>
                    <?php
                }
                else
                {
                    ?>
                    <tr>
                        <td><?php echo $row['Name'] ?></td>
                        <td><?php echo $row['rate'] ?></td>
                        <td><span class="badge bg-danger">Unavailable</span></td>
                        <td><button type="button" class="btn btn-default btn-sm edit" value="<?php echo $row['rentID'] ?>"><span class="bi bi-pencil-square"></span> Edit</button></td>
                    </tr>
                    <?php
                }
            }
            break;




            
        case "search-charge":
            $text = "%".$_GET['keyword']."%";
            $stmt = $dbh->prepare("Select a.City,FORMAT(a.Rate,2)rate,a.chargeID,b.Province from tblcharge a LEFT JOIN tblprovince b ON b.pID=a.pID WHERE a.City LIKE :text GROUP BY a.chargeID");
            $stmt->bindParam(':text',$text);
            $stmt->execute();
            $data = $stmt->fetchAll();
            foreach($data as $row)
            {
                ?>
                    <tr>
                        <td><?php echo $row['Province'] ?></td>
                        <td><?php echo $row['City'] ?></td>
                        <td><?php echo $row['rate'] ?></td>
                        <td><button type="button" class="btn btn-default btn-sm editcharge" value="<?php echo $row['chargeID'] ?>"><span class="bi bi-pencil-square"></span> Edit</button></td>
                    </tr>
                <?php
            }
            break;
        case "charge":
            $stmt = $dbh->prepare("Select a.City,FORMAT(a.Rate,2)rate,a.chargeID,b.Province from tblcharge a LEFT JOIN tblprovince b ON b.pID=a.pID GROUP BY a.chargeID");
            $stmt->execute();
            $data = $stmt->fetchAll();
            foreach($data as $row)
            {
                ?>
                    <tr>
                        <td><?php echo $row['Province'] ?></td>
                        <td><?php echo $row['City'] ?></td>
                        <td><?php echo $row['rate'] ?></td>
                        <td><button type="button" class="btn btn-default btn-sm editcharge" value="<?php echo $row['chargeID'] ?>"><span class="bi bi-pencil-square"></span> Edit</button></td>
                    </tr>
                <?php
            }
            break;
        case "province":
            $stmt = $dbh->prepare("Select pID,Province from tblprovince");
            $stmt->execute();
            $data = $stmt->fetchAll();
            foreach($data as $row)
            {
                ?>
                <option value="<?php echo $row['pID'] ?>"><?php echo $row['Province'] ?></option>
                <?php
            }
            break;
        case "get-city":
            $val = $_GET['value'];
            $stmt = $dbh->prepare("Select City,FORMAT(Rate,2)rate,chargeID from tblcharge WHERE pID=:id");
            $stmt->bindParam(':id',$val);
            $stmt->execute();
            $data = $stmt->fetchAll();
            foreach($data as $row)
            {
                ?>
                <option value="<?php echo $row['chargeID'] ?>"><?php echo $row['City'] ?></option>
                <?php
            }
            break;
        case "view":
            $val = $_GET['value'];
            $stmt = $dbh->prepare("Select Message from tblinquiry WHERE inqID=:id");
            $stmt->bindParam(':id',$val);
            $stmt->execute();
            $data = $stmt->fetchAll();
            foreach($data as $row)
            {
                echo $row['Message'];
            }
            break;
        case "inquire":
            $stmt = $dbh->prepare("Select * from tblinquiry");
            $stmt->execute();
            $data = $stmt->fetchAll();
            foreach($data as $row)
            {
                ?>
                    <tr>
                        <td><?php echo $row['Fullname'] ?></td>
                        <td><?php echo $row['EmailAddress'] ?></td>
                        <td><?php echo $row['Subject'] ?></td>
                        <td><?php echo substr($row['Message'],0,30) ?>....</td>
                        <td><button type="button" class="btn btn-default btn-sm view" value="<?php echo $row['inqID'] ?>"><span class="bi bi-envelope"></span> Read</button></td>
                    </tr>
                <?php
            }
            break;
        case "search-inquire":
            $val = "%".$_GET['keyword']."%";
            $stmt = $dbh->prepare("Select * from tblinquiry WHERE EmailAddress LIKE :text OR Fullname LIKE :text");
            $stmt->bindParam(':text',$val);
            $stmt->execute();
            $data = $stmt->fetchAll();
            foreach($data as $row)
            {
                ?>
                    <tr>
                        <td><?php echo $row['Fullname'] ?></td>
                        <td><?php echo $row['EmailAddress'] ?></td>
                        <td><?php echo $row['Subject'] ?></td>
                        <td><?php echo substr($row['Message'],0,30) ?>....</td>
                        <td><button type="button" class="btn btn-default btn-sm view" value="<?php echo $row['inqID'] ?>"><span class="bi bi-envelope"></span> Read</button></td>
                    </tr>
                <?php
            }
            break;
        case "logs":
            $stmt = $dbh->prepare("Select a.*,b.Fullname from tblactivities a LEFT JOIN tblaccount b ON b.userID=a.userID GROUP BY a.activityID ORDER BY activityID DESC");
            $stmt->execute();
            $data = $stmt->fetchAll();
            foreach($data as $row)
            {
                ?>
                    <tr>
                        <td><?php echo $row['DateTime'] ?></td>
                        <td><?php echo $row['Fullname'] ?></td>
                        <td><?php echo $row['Activities'] ?></td>
                    </tr>
                <?php
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
$dbh=null;
?>