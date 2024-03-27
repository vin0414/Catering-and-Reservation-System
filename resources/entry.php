<?php
session_start();
require_once("dbconfig.php");
$action = $_POST['action'];
switch($action)
{
    case "inquire":
        $name = $_POST['name'];
        $email = $_POST['email'];
        $subj = $_POST['subject'];
        $msg = $_POST['message'];
        $stmt = $dbh->prepare("insert into tblinquiry(EmailAddress,Fullname,Subject,Message)values(:email,:name,:subj,:msg)");
        $stmt->bindParam(':email',$email);
        $stmt->bindParam(':name',$name);
        $stmt->bindParam(':subj',$subj);
        $stmt->bindParam(':msg',$msg);
        $stmt->execute();
        echo "Success";
        break;
    case "deactivate":
        $val = $_POST['value'];
        $stat = 0;
        $stmt = $dbh->prepare("update tblmenu SET Status=:stat WHERE menuID=:id");
        $stmt->bindParam(':stat',$stat);
        $stmt->bindParam(':id',$val);
        $stmt->execute();
        //logs
        $act = "Deactivated selected menu";
        $act_date = date('Y-m-d h:i:s a');
        $stmt = $dbh->prepare("insert into tblactivities(DateTime,userID,Activities)values(:datetime,:user,:activity)");
        $stmt->bindParam(':datetime',$act_date);
        $stmt->bindParam(':user',$_SESSION['sess_id']);
        $stmt->bindParam(':activity',$act);
        $stmt->execute();
        echo "success";
        break;
    case "activate":
        $val = $_POST['value'];
        $stat = 1;
        $stmt = $dbh->prepare("update tblmenu SET Status=:stat WHERE menuID=:id");
        $stmt->bindParam(':stat',$stat);
        $stmt->bindParam(':id',$val);
        $stmt->execute();
        //logs
        $act = "Activated selected menu";
        $act_date = date('Y-m-d h:i:s a');
        $stmt = $dbh->prepare("insert into tblactivities(DateTime,userID,Activities)values(:datetime,:user,:activity)");
        $stmt->bindParam(':datetime',$act_date);
        $stmt->bindParam(':user',$_SESSION['sess_id']);
        $stmt->bindParam(':activity',$act);
        $stmt->execute();
        echo "success";
        break;
    case "remove-category":
        $val = $_POST['value'];
        $stmt = $dbh->prepare("delete from tblcategory WHERE catID=:id");
        $stmt->bindParam(':id',$val);
        $stmt->execute();
        //logs
        $act = "Deleted selected Category";
        $act_date = date('Y-m-d h:i:s a');
        $stmt = $dbh->prepare("insert into tblactivities(DateTime,userID,Activities)values(:datetime,:user,:activity)");
        $stmt->bindParam(':datetime',$act_date);
        $stmt->bindParam(':user',$_SESSION['sess_id']);
        $stmt->bindParam(':activity',$act);
        $stmt->execute();
        echo "success";
        break;
    case "remove-menu":
        $val = $_POST['value'];
        $stmt = $dbh->prepare("delete from tblmenu WHERE menuID=:id");
        $stmt->bindParam(':id',$val);
        $stmt->execute();
        //logs
        $act = "Deleted selected menu";
        $act_date = date('Y-m-d h:i:s a');
        $stmt = $dbh->prepare("insert into tblactivities(DateTime,userID,Activities)values(:datetime,:user,:activity)");
        $stmt->bindParam(':datetime',$act_date);
        $stmt->bindParam(':user',$_SESSION['sess_id']);
        $stmt->bindParam(':activity',$act);
        $stmt->execute();
        echo "success";
        break;
    case "food":
        $stmt = $dbh->prepare("Select * from tblcategory");
        $stmt->execute();
        $data = $stmt->fetchAll();
        foreach($data as $row)
        {
            ?>
            <option value="<?php echo $row['catID'] ?>"><?php echo $row['Category_Name'] ?></option>
            <?php
        }
        break;
    case "update-menu":
        $id = $_POST['menuID'];
        $menu = $_POST['food_name'];
        $details = $_POST['details'];
        $name=$_FILES['file']['name'];
        $size=$_FILES['file']['size'];
        $type=$_FILES['file']['type'];
        $temp=$_FILES['file']['tmp_name'];
        $file = date("YmdHis").'_'.$name;
        if(empty($name))
        {
            echo "Invalid! Please select Image to upload";
        }
        else
        {
            $move =  move_uploaded_file($temp,"../resources/menu/".$file);
            $stmt = $dbh->prepare("update tblmenu SET Image=:file,Food_Name=:food,Details=:details WHERE menuID=:id");
            $stmt->bindParam(':file',$file);
            $stmt->bindParam(':food',$menu);
            $stmt->bindParam(':details',$details);
            $stmt->bindParam(':id',$id);
            $stmt->execute();
            //logs
            $act = "Updated the menu : ".$menu;
            $act_date = date('Y-m-d h:i:s a');
            $stmt = $dbh->prepare("insert into tblactivities(DateTime,userID,Activities)values(:datetime,:user,:activity)");
            $stmt->bindParam(':datetime',$act_date);
            $stmt->bindParam(':user',$_SESSION['sess_id']);
            $stmt->bindParam(':activity',$act);
            $stmt->execute();
            echo "success";
        }
        break;
    case "add-menu":
        $name=$_FILES['file']['name'];
        $size=$_FILES['file']['size'];
        $type=$_FILES['file']['type'];
        $temp=$_FILES['file']['tmp_name'];
        $file = date("YmdHis").'_'.$name;
        
        $cat = $_POST['category'];
        $food = $_POST['food'];
        $desc = $_POST['details'];
        $stat = 1;
        if(empty($cat)||empty($food))
        {
            echo "Invalid! Please fill in the form";
        }
        else
        {
            $move =  move_uploaded_file($temp,"../resources/menu/".$file);
            $stmt = $dbh->prepare("insert into tblmenu(catID,Food_Name,Details,Status,Image)values(:cat,:food,:desc,:stat,:file)");
            $stmt->bindParam(':cat',$cat);
            $stmt->bindParam(':food',$food);
            $stmt->bindParam(':desc',$desc);
            $stmt->bindParam(':stat',$stat);
            $stmt->bindParam(':file',$file);
            $stmt->execute();
            //logs
            $act = "Added new menu : ".$food;
            $act_date = date('Y-m-d h:i:s a');
            $stmt = $dbh->prepare("insert into tblactivities(DateTime,userID,Activities)values(:datetime,:user,:activity)");
            $stmt->bindParam(':datetime',$act_date);
            $stmt->bindParam(':user',$_SESSION['sess_id']);
            $stmt->bindParam(':activity',$act);
            $stmt->execute();
            echo "success";
        }
        break;
    case "list":
        $stmt = $dbh->prepare('Select a.Food_Name,a.Status,b.Category_Name,Image,menuID from tblmenu a LEFT JOIN tblcategory b ON b.catID=a.catID GROUP BY a.menuID');
        $stmt->execute();
        $data = $stmt->fetchAll();
        foreach($data as $row)
        {
            $imgURL = "../resources/menu/".$row['Image'];
            if($row['Status']==1)
            {
                ?>
                <tr>
                    <td><?php echo $row['Food_Name'] ?></td>
                    <td><img src="<?php echo $imgURL ?>" style="width:50px;height:50px;"/></td>
                    <td><?php echo $row['Category_Name'] ?></td>
                    <td><span class="badge bg-success">Available</span></td>
                    <td>
                        <button type="button" class="btn btn-light btn-sm dropdown-toggle waves-effect" data-toggle="dropdown" aria-expanded="false">
							Action <span class="caret"></span>
						</button>
						<div class="dropdown-menu">
						    <button type="button" class="dropdown-item btn edit1" value="<?php echo $row['menuID'] ?>">Deactivate</button>
						    <button type="button" class="dropdown-item btn update" value="<?php echo $row['menuID'] ?>">Update</button>
							<button type="button" class="dropdown-item btn delete" value="<?php echo $row['menuID'] ?>">Delete</button>
						</div>
                    </td>
                </tr>
                <?php
            }
            else
            {
                ?>
                <tr>
                    <td><?php echo $row['Food_Name'] ?></td>
                    <td><img src="<?php echo $imgURL ?>" style="width:50px;height:50px;"/></td>
                    <td><?php echo $row['Category_Name'] ?></td>
                    <td><span class="badge bg-danger">Unavailable</span></td>
                    <td>
                        <button type="button" class="btn btn-light btn-sm dropdown-toggle waves-effect" data-toggle="dropdown" aria-expanded="false">
							Action <span class="caret"></span>
						</button>
						<div class="dropdown-menu">
						    <button type="button" class="dropdown-item btn edit2" value="<?php echo $row['menuID'] ?>">Activate</button>
							<button type="button" class="dropdown-item btn delete" value="<?php echo $row['menuID'] ?>">Delete</button>
						</div>
                    </td>
                </tr>
                <?php   
            }
        }
        break;
    case "search-list":
        $val = "%".$_POST['keyword']."%";
        $stmt = $dbh->prepare('Select a.Food_Name,a.Status,b.Category_Name,Image,menuID from tblmenu a LEFT JOIN tblcategory b ON b.catID=a.catID WHERE a.Food_Name LIKE :text GROUP BY a.menuID');
        $stmt->bindParam(':text',$val);
        $stmt->execute();
        $data = $stmt->fetchAll();
        foreach($data as $row)
        {
            $imgURL = "../resources/menu/".$row['Image'];
            if($row['Status']==1)
            {
                ?>
                <tr>
                    <td><?php echo $row['Food_Name'] ?></td>
                    <td><img src="<?php echo $imgURL ?>" style="width:50px;height:50px;"/></td>
                    <td><?php echo $row['Category_Name'] ?></td>
                    <td><span class="badge bg-success">Available</span></td>
                    <td>
                        <button type="button" class="btn btn-light btn-sm dropdown-toggle waves-effect" data-toggle="dropdown" aria-expanded="false">
							Action <span class="caret"></span>
						</button>
						<div class="dropdown-menu">
						    <button type="button" class="dropdown-item btn edit1" value="<?php echo $row['menuID'] ?>">Deactivate</button>
							<button type="button" class="dropdown-item btn update" value="<?php echo $row['menuID'] ?>">Update</button>
							<button type="button" class="dropdown-item btn delete" value="<?php echo $row['menuID'] ?>">Delete</button>
						</div>
                    </td>
                </tr>
                <?php
            }
            else
            {
                ?>
                <tr>
                    <td><?php echo $row['Food_Name'] ?></td>
                    <td><img src="<?php echo $imgURL ?>" style="width:50px;height:50px;"/></td>
                    <td><?php echo $row['Category_Name'] ?></td>
                    <td><span class="badge bg-danger">Unavailable</span></td>
                    <td>
                        <button type="button" class="btn btn-light btn-sm dropdown-toggle waves-effect" data-toggle="dropdown" aria-expanded="false">
							Action <span class="caret"></span>
						</button>
						<div class="dropdown-menu">
						    <button type="button" class="dropdown-item btn edit2" value="<?php echo $row['menuID'] ?>">Activate</button>
							<button type="button" class="dropdown-item btn delete" value="<?php echo $row['menuID'] ?>">Delete</button>
						</div>
                    </td>
                </tr>
                <?php   
            }
        }
        break;
    case "add-category":
        $cat = $_POST['category_name'];
        if(empty($cat))
        {
            echo "Invalid! Please enter category name";
        }
        else
        {
            $stmt = $dbh->prepare("insert into tblcategory(Category_Name)values(:cat)");
            $stmt->bindParam(':cat',$cat);
            $stmt->execute();

            //logs
            $act = "Added ".$cat." as new category";
            $act_date = date('Y-m-d h:i:s a');
            $stmt = $dbh->prepare("insert into tblactivities(DateTime,userID,Activities)values(:datetime,:user,:activity)");
            $stmt->bindParam(':datetime',$act_date);
            $stmt->bindParam(':user',$_SESSION['sess_id']);
            $stmt->bindParam(':activity',$act);
            $stmt->execute();
            echo "success";
        }
        break;
    case "load":
        $stmt = $dbh->prepare('Select * from tblcategory');
        $stmt->execute();
        $data = $stmt->fetchAll();
        foreach($data as $row)
        {
            ?>
            <tr>
                <td><?php echo $row['Category_Name'] ?></td>
                <td><button type="button" class="btn btn-default remove" value="<?php echo $row['catID'] ?>"><span class="bi bi-trash"></span> Remove</button></td>
            </tr>
            <?php
        }
        break;
    case "fetch":
        $stmt = $dbh->prepare("Select * from tblevent");
        $stmt->execute();
        $data = $stmt->fetchAll();
        foreach($data as $row)
        {
            ?>
            <option value="<?php echo $row['eventID'] ?>"><?php echo $row['Event_Name'] ?></option>
            <?php
        }
        break;
    case "Event":
        $sql = "Select * from tblevent";
        $stmt = $dbh->prepare($sql);
        $stmt->execute();
        $data = $stmt->fetchAll();
        foreach($data as $row)
        {
            ?>
            <tr>
                <td><?php echo $row['Event_Name'] ?></td>
                <td>
                    <button type="button" class="btn btn-default btn-sm delete" value="<?php echo $row['eventID'] ?>"><span class="bi bi-trash"></span> Remove</button>
                </td>
            </tr>
            <?php
        }
        break;
    case "add-event":
        $name=$_FILES['file']['name'];
        $size=$_FILES['file']['size'];
        $type=$_FILES['file']['type'];
        $temp=$_FILES['file']['tmp_name'];
        $file = date("YmdHis").'_'.$name;
        $event = $_POST['event_name']; 
        $details = $_POST['details'];
        if(empty($name)||empty($event))
        {
                echo "Invalid! Please fill in the form";
        }
        else
        {
            $move =  move_uploaded_file($temp,"../resources/event/".$file);
            $sql = "insert into tblevent(Event_Name,Details,Image)values(:event,:details,:file)";
            $stmt = $dbh->prepare($sql);
            $stmt->bindParam(':event',$event);
            $stmt->bindParam(':details',$details);
            $stmt->bindParam(':file',$file);
            $stmt->execute();
            //logs
            $act = "Added new event : ".$event;
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
        $stmt = $dbh->prepare("delete from tblevent WHERE eventID=:id");
        $stmt->bindParam(':id',$val);
        $stmt->execute();
        //logs
        $act = "Remove Event";
        $act_date = date('Y-m-d h:i:s a');
        $stmt = $dbh->prepare("insert into tblactivities(DateTime,userID,Activities)values(:datetime,:user,:activity)");
        $stmt->bindParam(':datetime',$act_date);
        $stmt->bindParam(':user',$_SESSION['sess_id']);
        $stmt->bindParam(':activity',$act);
        $stmt->execute();
        echo "Successfully removed";
        break;
    case "add-package":
        $event = $_POST['event'];
        $type = $_POST['package'];
        $rate = str_replace(',', '', $_POST['rate']);
        $status = 1;
        if(empty($event)||empty($type)||empty($rate))
        {
            echo "Invalid! Please fill in the form";
        }
        else
        {
            $stmt = $dbh->prepare("insert into tblproduct(eventID,Package_Name,Price,Status)values(:event,:package,:rate,:stat)");
            $stmt->bindParam(':event',$event);
            $stmt->bindParam(':package',$type);
            $stmt->bindParam(':rate',$rate);
            $stmt->bindParam(':stat',$status);
            $stmt->execute();
            //logs
            $act = "Added new package : ".$type;
            $act_date = date('Y-m-d h:i:s a');
            $stmt = $dbh->prepare("insert into tblactivities(DateTime,userID,Activities)values(:datetime,:user,:activity)");
            $stmt->bindParam(':datetime',$act_date);
            $stmt->bindParam(':user',$_SESSION['sess_id']);
            $stmt->bindParam(':activity',$act);
            $stmt->execute();
            echo "success";
        }
        break;
    case "Packages":
        $sql = "Select a.Package_Name,FORMAT(a.Price,2)Amount,a.Status,b.Event_Name,a.productID,a.Description from tblproduct a LEFT JOIN tblevent b ON b.eventID=a.eventID GROUP BY a.productID";
        $stmt = $dbh->prepare($sql);
        $stmt->execute();
        $data = $stmt->fetchAll();
        foreach($data as $row)
        {
            if($row['Status']==1)
            {
                ?>
                <tr>
                    <td><?php echo $row['Event_Name'] ?></td>
                    <td><?php echo $row['Package_Name'] ?></td>
                    <td><?php echo $row['Description'] ?></td>
                    <td style="text-align:right;"><?php echo $row['Amount'] ?></td>
                    <td><span class="badge bg-success">Available</span></td>
                    <td><button type="button" class="btn btn-default btn-sm edit" value="<?php echo $row['productID'] ?>"> <span class="bi bi-pencil-square"></span> Edit</button></td>
                </tr>
                <?php
            }
            else
            {
                ?>
                <tr>
                    <td><?php echo $row['Event_Name'] ?></td>
                    <td><?php echo $row['Package_Name'] ?></td>
                    <td><?php echo $row['Description'] ?></td>
                    <td style="text-align:right;"><?php echo $row['Amount'] ?></td>
                    <td><span class="badge bg-danger">Unavailable</span></td>
                    <td><button type="button" class="btn btn-default btn-sm edit" value="<?php echo $row['productID'] ?>"> <span class="bi bi-pencil-square"></span> Edit</button></td>
                </tr>
                <?php   
            }
        }
        break;
    case "search-Packages":
        $val = "%".$_POST['keyword']."%";
        $sql = "Select a.Package_Name,FORMAT(a.Price,2)Amount,a.Status,b.Event_Name,a.productID,a.Description from tblproduct a 
        LEFT JOIN tblevent b ON b.eventID=a.eventID WHERE b.Event_Name LIKE :text OR a.Package_Name LIKE :text GROUP BY a.productID";
        $stmt = $dbh->prepare($sql);
        $stmt->bindParam(':text',$val);
        $stmt->execute();
        $data = $stmt->fetchAll();
        foreach($data as $row)
        {
            if($row['Status']==1)
            {
                ?>
                <tr>
                    <td><?php echo $row['Event_Name'] ?></td>
                    <td><?php echo $row['Package_Name'] ?></td>
                    <td><?php echo $row['Description'] ?></td>
                    <td style="text-align:right;"><?php echo $row['Amount'] ?></td>
                    <td><span class="badge bg-success">Available</span></td>
                    <td><button type="button" class="btn btn-default btn-sm edit" value="<?php echo $row['productID'] ?>"> <span class="bi bi-pencil-square"></span> Edit</button></td>
                </tr>
                <?php
            }
            else
            {
                ?>
                <tr>
                    <td><?php echo $row['Event_Name'] ?></td>
                    <td><?php echo $row['Package_Name'] ?></td>
                    <td><?php echo $row['Description'] ?></td>
                    <td style="text-align:right;"><?php echo $row['Amount'] ?></td>
                    <td><span class="badge bg-danger">Unavailable</span></td>
                    <td><button type="button" class="btn btn-default btn-sm edit" value="<?php echo $row['productID'] ?>"> <span class="bi bi-pencil-square"></span> Edit</button></td>
                </tr>
                <?php   
            }
        }
        break;
    case "edit":
        $val = $_POST['value'];
        $stmt = $dbh->prepare("Select a.productID,a.Package_Name,FORMAT(a.Price,2)Amount,a.Status,b.Event_Name,a.productID,a.Description from tblproduct a 
        LEFT JOIN tblevent b ON b.eventID=a.eventID WHERE a.productID=:id GROUP BY a.productID");
        $stmt->bindParam(':id',$val);
        $stmt->execute();
        $data = $stmt->fetchAll();
        foreach($data as $row)
        {
            ?>
            <form method="POST" class="row">
                <div class="col-12">
                    <label>Event Name</label>
                    <input type="text" class="form-control" value="<?php echo $row['Event_Name'] ?>" readonly/>
                </div>
                <div class="col-12">
                    <label>Package Name</label>
                    <input type="text" class="form-control" value="<?php echo $row['Package_Name'] ?>" readonly/>
                </div>
                <div class="col-12">
                    <label>Description</label>
                    <textarea class="form-control" id="description"><?php echo $row['Description'] ?></textarea>
                </div>
                <div class="col-12">
                    <div class="row">
                        <div class="col-6">
                            <label>Package Rate</label>
                            <input type="text" class="form-control" id="rate" value="<?php echo $row['Amount'] ?>"/>
                        </div>
                        <div class="col-6">
                            <label>Status</label>
                            <select class="form-control" id="status">
                                <option value="">Choose</option>
                                <option value="1">Available</option>
                                <option value="0">Unavailable</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <br/>
                    <button type="submit" class="form-control btn btn-primary update" value="<?php echo $row['productID'] ?>">Update</button>    
                </div>
            </form>
            <?php
        }
        break;
    case "update":
        $val = $_POST['value'];
        $desc = $_POST['description'];
        $rate = str_replace(',', '', $_POST['rate']);
        $stat = $_POST['status'];
        $stmt = $dbh->prepare("update tblproduct SET Description=:desc,Price=:rate,Status=:stat WHERE productID=:id");
        $stmt->bindParam(':desc',$desc);
        $stmt->bindParam(':rate',$rate);
        $stmt->bindParam(':stat',$stat);
        $stmt->bindParam(':id',$val);
        $stmt->execute();
        //logs
        $act = "Updated details";
        $act_date = date('Y-m-d h:i:s a');
        $stmt = $dbh->prepare("insert into tblactivities(DateTime,userID,Activities)values(:datetime,:user,:activity)");
        $stmt->bindParam(':datetime',$act_date);
        $stmt->bindParam(':user',$_SESSION['sess_id']);
        $stmt->bindParam(':activity',$act);
        $stmt->execute();
        echo "success";
        break;
    default:
        break;
}
?>