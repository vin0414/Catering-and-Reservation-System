<?php
session_start();
require_once("dbconfig.php");
try
{
    switch($_POST['action'])
    {
        case "update-charge":
            $id = $_POST['_new_id'];
            $amount = str_replace(',', '',$_POST['amount']);
            if(empty($amount))
            {
                echo "Invalid! Please fill in the form";
            }
            else
            {
                $stmt = $dbh->prepare('update tblcharge SET Rate=:rate WHERE chargeID=:id');
                $stmt->bindParam(':rate',$amount);
                $stmt->bindParam(':id',$id);
                $stmt->execute();
                //logs
                $act = "Update new rate";
                $act_date = date('Y-m-d h:i:s a');
                $stmt = $dbh->prepare("insert into tblactivities(DateTime,userID,Activities)values(:datetime,:user,:activity)");
                $stmt->bindParam(':datetime',$act_date);
                $stmt->bindParam(':user',$_SESSION['sess_id']);
                $stmt->bindParam(':activity',$act);
                $stmt->execute();
                echo "success";
            }
            break;
        case "update-rent":
            $id = $_POST['id'];
            $amount = str_replace(',', '',$_POST['amount']);
            $stat = $_POST['status'];
            if(empty($amount))
            {
                echo "Invalid! Please fill in the form";
            }
            else
            {
                $stmt = $dbh->prepare('update tblrental SET Rate=:rate,Status=:stat WHERE rentID=:id');
                $stmt->bindParam(':rate',$amount);
                $stmt->bindParam(':stat',$stat);
                $stmt->bindParam(':id',$id);
                $stmt->execute();
                //logs
                $act = "Update rentals";
                $act_date = date('Y-m-d h:i:s a');
                $stmt = $dbh->prepare("insert into tblactivities(DateTime,userID,Activities)values(:datetime,:user,:activity)");
                $stmt->bindParam(':datetime',$act_date);
                $stmt->bindParam(':user',$_SESSION['sess_id']);
                $stmt->bindParam(':activity',$act);
                $stmt->execute();
                echo "success";
            }
            break;
        case "upload":
            $name=$_FILES['file']['name'];
            $size=$_FILES['file']['size'];
            $type=$_FILES['file']['type'];
            $temp=$_FILES['file']['tmp_name'];
            $file = date("YmdHis").'_'.$name;
            $file_name = $_POST['file_name'];
            if(empty($name)||empty($file_name))
            {
                echo "Invalid! Please fill in the form";
            }
            else
            {
                $move =  move_uploaded_file($temp,"../resources/gallery/".$file);
                $stmt = $dbh->prepare("insert into tblgallery(Filename,File)values(:name,:file)");
                $stmt->bindParam(':name',$file_name);
                $stmt->bindParam(':file',$file);
                $stmt->execute();
                //logs
                $act = "Uploaded gallery image";
                $act_date = date('Y-m-d h:i:s a');
                $stmt = $dbh->prepare("insert into tblactivities(DateTime,userID,Activities)values(:datetime,:user,:activity)");
                $stmt->bindParam(':datetime',$act_date);
                $stmt->bindParam(':user',$_SESSION['sess_id']);
                $stmt->bindParam(':activity',$act);
                $stmt->execute();
                echo "success";
            }
            break;
        case "remove":
            $val = $_POST['value'];
            $stmt = $dbh->prepare("Delete from tblgallery WHERE galleryID=:id");
            $stmt->bindParam(':id',$val);
            $stmt->execute();
            //logs
            $act = "Remove selected image";
            $act_date = date('Y-m-d h:i:s a');
            $stmt = $dbh->prepare("insert into tblactivities(DateTime,userID,Activities)values(:datetime,:user,:activity)");
            $stmt->bindParam(':datetime',$act_date);
            $stmt->bindParam(':user',$_SESSION['sess_id']);
            $stmt->bindParam(':activity',$act);
            $stmt->execute();
            echo "success";
            break;
        case "gallery":
            $stmt = $dbh->prepare('Select * from tblgallery');
            $stmt->execute();
            $data = $stmt->fetchAll();
            foreach($data as $row)
            {
                $ImgURL = "../resources/gallery/".$row['File'];
                ?>
                <div class="col-4 form-group">
                    <div class="card-box pd-10">
                        <img src="<?php echo $ImgURL ?>" class="img-fluid"/>
                        <p><?php echo $row['Filename'] ?></p>
                        <button class="btn btn-outline-danger btn-sm remove" value="<?php echo $row['galleryID'] ?>"><span class="bi bi-trash"></span> Remove</button>
                    </div>
                </div>
                <?php
            }
            break;
        case "sort":
            $val = $_POST['value'];
            if(empty($val))
            {
                $stmt = $dbh->prepare('Select * from tblgallery');
                $stmt->execute();
                $data = $stmt->fetchAll();
                foreach($data as $row)
                {
                    $ImgURL = "../resources/gallery/".$row['File'];
                    ?>
                    <div class="col-4 form-group">
                        <div class="card-box pd-10">
                            <img src="<?php echo $ImgURL ?>" class="img-fluid"/>
                            <p><?php echo $row['Filename'] ?></p>
                            <button class="btn btn-outline-danger btn-sm remove" value="<?php echo $row['galleryID'] ?>"><span class="bi bi-trash"></span> Remove</button>
                        </div>
                    </div>
                    <?php
                }
            }
            else
            {
                $stmt = $dbh->prepare('Select * from tblgallery WHERE Filename=:val');
                $stmt->bindParam(':val',$val);
                $stmt->execute();
                $data = $stmt->fetchAll();
                foreach($data as $row)
                {
                    $ImgURL = "../resources/gallery/".$row['File'];
                    ?>
                    <div class="col-4 form-group">
                        <div class="card-box pd-10">
                            <img src="<?php echo $ImgURL ?>" class="img-fluid"/>
                            <p><?php echo $row['Filename'] ?></p>
                            <button class="btn btn-outline-danger btn-sm remove" value="<?php echo $row['galleryID'] ?>"><span class="bi bi-trash"></span> Remove</button>
                        </div>
                    </div>
                    <?php
                }
            }
            break;
        case "rent":
            $desc = $_POST['desc'];
            $rate = str_replace(',', '', $_POST['rate']);
            $stat = 1;
            if(empty($desc)||empty($rate))
            {
                echo "Invalid! Please fill in the form";
            }
            else
            {
                $stmt = $dbh->prepare('insert into tblrental(Name,Rate,Status)values(:name,:rate,:stat)');
                $stmt->bindParam(':name',$desc);
                $stmt->bindParam(':rate',$rate);
                $stmt->bindParam(':stat',$stat);
                $stmt->execute();
                //logs
                $act = "Added new rental";
                $act_date = date('Y-m-d h:i:s a');
                $stmt = $dbh->prepare("insert into tblactivities(DateTime,userID,Activities)values(:datetime,:user,:activity)");
                $stmt->bindParam(':datetime',$act_date);
                $stmt->bindParam(':user',$_SESSION['sess_id']);
                $stmt->bindParam(':activity',$act);
                $stmt->execute();
                echo "success";
            }
            break;
        case "province":
            $name = $_POST['province'];
            if(empty($name))
            {
                echo "Invalid! Please fill in the form";
            }
            else
            {
                $stmt = $dbh->prepare("Select Province from tblprovince WHERE Province=:name");
                $stmt->bindParam(':name',$name);
                $stmt->execute();
                $count = $stmt->rowCount();
                $row   = $stmt->fetch(PDO::FETCH_ASSOC);
                if($count == 1 && !empty($row))
                {
                    echo "Invalid! ".$name." already exists";
                }
                else
                {
                    $stmt = $dbh->prepare('insert into tblprovince(Province)values(:name)');
                    $stmt->bindParam(':name',$name);
                    $stmt->execute();
                    //logs
                    $act = "Added new province";
                    $act_date = date('Y-m-d h:i:s a');
                    $stmt = $dbh->prepare("insert into tblactivities(DateTime,userID,Activities)values(:datetime,:user,:activity)");
                    $stmt->bindParam(':datetime',$act_date);
                    $stmt->bindParam(':user',$_SESSION['sess_id']);
                    $stmt->bindParam(':activity',$act);
                    $stmt->execute();
                    echo "success";
                }
            }
            break;
        case "city":
            $name = $_POST['province'];
            $city = $_POST['city'];
            $rate = str_replace(',', '', $_POST['charge']);
            if(empty($name)||empty($city)||empty($rate))
            {
                echo "Invalid! Please fill in the form";
            }
            else
            {
                $stmt = $dbh->prepare("insert into tblcharge(pID,City,Rate)values(:name,:city,:rate)");
                $stmt->bindParam(':name',$name);
                $stmt->bindParam(':city',$city);
                $stmt->bindParam(':rate',$rate);
                $stmt->execute();
                //logs
                $act = "Added new city";
                $act_date = date('Y-m-d h:i:s a');
                $stmt = $dbh->prepare("insert into tblactivities(DateTime,userID,Activities)values(:datetime,:user,:activity)");
                $stmt->bindParam(':datetime',$act_date);
                $stmt->bindParam(':user',$_SESSION['sess_id']);
                $stmt->bindParam(':activity',$act);
                $stmt->execute();
                echo "success";
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