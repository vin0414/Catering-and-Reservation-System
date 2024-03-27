<?php
require_once("dbconfig.php");
try
{
    switch($_GET['action'])
    {
        case "search":
            $text = "%".$_GET['keyword']."%";
            $stmt = $dbh->prepare("Select a.*,b.Category_Name,Image from tblmenu a LEFT JOIN tblcategory b ON b.catID=a.catID WHERE a.Food_Name LIKE :text group by a.menuID ORDER BY b.Category_Name");
            $stmt->bindParam(':text',$text);
            $stmt->execute();
            $data = $stmt->fetchAll();
            foreach($data as $row)
            {
                 $name;
                 if(empty(substr($row['Image'],15)))
                 {
                     $name = "assets/img/logo.png";
                 }
                 else
                 {
                     $name = "resources/menu/".$row['Image'];
                 }
                ?>
                <div class="col-lg-3 form-group">
                    <div class="card">
                        <div class="card-body">
                            <img src = "<?php echo $name ?>" class="img-fluid" style="height:300px;width:300px;"/>
                            <p><?php echo $row['Food_Name'] ?></p>
                            <p><?php echo $row['Details'] ?></p>
                            <p><small><span class="badge bg-success"><?php echo $row['Category_Name'] ?></span></small></p>
                        </div>
                    </div>
                </div>
                <?php
            }
            break;
        case "load":
            $stmt = $dbh->prepare("Select a.*,b.Category_Name,Image from tblmenu a LEFT JOIN tblcategory b ON b.catID=a.catID group by a.menuID ORDER BY b.Category_Name");
            $stmt->execute();
            $data = $stmt->fetchAll();
            foreach($data as $row)
            {
                 $name;
                 if(empty(substr($row['Image'],15)))
                 {
                     $name = "assets/img/logo.png";
                 }
                 else
                 {
                     $name = "resources/menu/".$row['Image'];
                 }
                 
                ?>
                <div class="col-xl-3 col-lg-4 col-md-6 portfolio-item <?php echo $row['Category_Name'] ?>">
                      <img src="<?php echo $name ?>" class="img-fluid" alt="" style="height:300px;width:100%;">
                      <div class="portfolio-info">
                        <h4><?php echo $row['Food_Name'] ?></h4>
                        <a href="<?php echo $name ?>" title="<?php echo $row['Food_Name'] ?>" data-gallery="portfolio-gallery" class="glightbox preview-link"><i class="bi bi-zoom-in"></i></a>
                        <a href="javascript:void(0);" title="More Details" class="details-link"><i class="bi bi-link-45deg"></i></a>
                      </div>
                </div>
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