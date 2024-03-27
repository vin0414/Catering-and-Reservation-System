<?php
require_once("dbconfig.php");
try
{
    switch($_GET['action'])
    {
        case "reservation":
            $user = $_GET['user'];
            $stmt = $dbh->prepare("Select a.*,b.Event_Name from tblreservation a LEFT JOIN tblevent b ON b.eventID=a.eventID WHERE a.customerID=:user ORDER BY a.Status");
            $stmt->bindParam(':user',$user);
            $stmt->execute();
            $data = $stmt->fetchAll();
            foreach($data as $row)
            {
                if($row['Status']==0)
                {
                    ?>
                    <tr>
                        <td><?php echo $row['DateCreated'] ?></td>
                        <td><?php echo $row['Code'] ?></td>
                        <td><?php echo $row['Event_date'] ?></td>
                        <td><?php echo $row['Event_time'] ?></td>
                        <td><?php echo $row['Event_Name'] ?></td>
                        <td><span class="badge bg-warning">PENDING</span></td>
                    </tr>
                    <?php
                }
                else if($row['Status']==1)
                {
                    ?>
                    <tr>
                        <td><?php echo $row['DateCreated'] ?></td>
                        <td><?php echo $row['Code'] ?></td>
                        <td><?php echo $row['Event_date'] ?></td>
                        <td><?php echo $row['Event_time'] ?></td>
                        <td><?php echo $row['Event_Name'] ?></td>
                        <td><span class="badge bg-primary">RESERVED</span></td>
                    </tr>
                    <?php
                }
                else if($row['Status']==2)
                {
                    ?>
                    <tr>
                        <td><?php echo $row['DateCreated'] ?></td>
                        <td><?php echo $row['Code'] ?></td>
                        <td><?php echo $row['Event_date'] ?></td>
                        <td><?php echo $row['Event_time'] ?></td>
                        <td><?php echo $row['Event_Name'] ?></td>
                        <td><span class="badge bg-success">DONE</span></td>
                    </tr>
                    <?php
                }
                else
                {
                    ?>
                    <tr>
                        <td><?php echo $row['DateCreated'] ?></td>
                        <td><?php echo $row['Code'] ?></td>
                        <td><?php echo $row['Event_date'] ?></td>
                        <td><?php echo $row['Event_time'] ?></td>
                        <td><?php echo $row['Event_Name'] ?></td>
                        <td><span class="badge bg-danger">CANCELLED</span></td>
                    </tr>
                    <?php
                }
            }
            break;
        case "search":
            $user = $_GET['user'];
            $text = "%".$_GET['keyword']."%";
            $stmt = $dbh->prepare("Select a.*,b.Event_Name from tblreservation a LEFT JOIN tblevent b ON b.eventID=a.eventID WHERE a.customerID=:user AND a.Code LIKE :text ORDER BY a.Status");
            $stmt->bindParam(':user',$user);
            $stmt->bindParam(':text',$text);
            $stmt->execute();
            $data = $stmt->fetchAll();
            foreach($data as $row)
            {
                if($row['Status']==0)
                {
                    ?>
                    <tr>
                        <td><?php echo $row['DateCreated'] ?></td>
                        <td><?php echo $row['Code'] ?></td>
                        <td><?php echo $row['Event_date'] ?></td>
                        <td><?php echo $row['Event_time'] ?></td>
                        <td><?php echo $row['Event_Name'] ?></td>
                        <td><span class="badge bg-warning">PENDING</span></td>
                    </tr>
                    <?php
                }
                else if($row['Status']==1)
                {
                    ?>
                    <tr>
                        <td><?php echo $row['DateCreated'] ?></td>
                        <td><?php echo $row['Code'] ?></td>
                        <td><?php echo $row['Event_date'] ?></td>
                        <td><?php echo $row['Event_time'] ?></td>
                        <td><?php echo $row['Event_Name'] ?></td>
                        <td><span class="badge bg-primary">RESERVED</span></td>
                    </tr>
                    <?php
                }
                else if($row['Status']==2)
                {
                    ?>
                    <tr>
                        <td><?php echo $row['DateCreated'] ?></td>
                        <td><?php echo $row['Code'] ?></td>
                        <td><?php echo $row['Event_date'] ?></td>
                        <td><?php echo $row['Event_time'] ?></td>
                        <td><?php echo $row['Event_Name'] ?></td>
                        <td><span class="badge bg-success">DONE</span></td>
                    </tr>
                    <?php
                }
                else
                {
                    ?>
                    <tr>
                        <td><?php echo $row['DateCreated'] ?></td>
                        <td><?php echo $row['Code'] ?></td>
                        <td><?php echo $row['Event_date'] ?></td>
                        <td><?php echo $row['Event_time'] ?></td>
                        <td><?php echo $row['Event_Name'] ?></td>
                        <td><span class="badge bg-danger">CANCELLED</span></td>
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
$dbh = null;
?>