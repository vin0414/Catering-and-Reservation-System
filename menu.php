<?php
session_start();
require_once("resources/dbconfig.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Zephaniah's Event & Catering Services</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/logo.png" rel="icon">
  <link href="assets/img/logo.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&family=Poppins:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&family=Source+Sans+Pro:ital,wght@0,300;0,400;0,600;0,700;1,300;1,400;1,600;1,700&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Variables CSS Files. Uncomment your preferred color scheme -->
  <link href="assets/css/variables.css" rel="stylesheet">

  <!-- Template Main CSS File -->
  <link href="assets/css/main.css" rel="stylesheet">
</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top" data-scrollto-offset="0">
    <div class="container-fluid d-flex align-items-center justify-content-between">

      <a href="index.php">
        <!-- Uncomment the line below if you also wish to use an image logo -->
        <img src="assets/img/logo.png" alt="Zephaniah's Event & Catering Services"  width="80" height="80">
      </a>

      <nav id="navbar" class="navbar">
        <ul>
            
              <li><a class="nav-link scrollto text-primary" href="index.php">Home</a></li>
              <li><a class="nav-link scrollto text-primary" href="menu.php">Menu</a></li>
              <li><a class="nav-link scrollto text-primary" href="index.php#services">Services</a></li>
              <li><a class="nav-link scrollto text-primary" href="index.php#portfolio">Gallery</a></li>
              <li><a class="nav-link scrollto text-primary" href="index.php#about">About</a></li>
              <li><a class="nav-link scrollto text-primary" href="index.php#contact">Contact</a></li>
            
        </ul>
        <i class="bi bi-list mobile-nav-toggle d-none"></i>
      </nav><!-- .navbar -->

      <a class="btn-getstarted scrollto" href="book.php">Book Now</a>

    </div>
  </header><!-- End Header -->

  <main id="main">

    <!-- ======= About Section ======= -->
    <section id="menu" class="portfolio">
      <div class="container" data-aos="fade-up">

        <div class="section-header">
          <h2>Our Menu</h2>
        </div>
        <div class="row g-2">
            <div class="col-12">
                <div class="portfolio-isotope" data-portfolio-filter="*" data-portfolio-layout="masonry" data-portfolio-sort="original-order">
                    <ul class="portfolio-flters">
                        <li data-filter="*" class="filter-active">All</li>
                        <li data-filter=".Appetizer">Appetizer and Sides</li>
                        <li data-filter=".Beef">Beef</li>
                        <li data-filter=".Pork">Pork</li>
                        <li data-filter=".Chicken">Chicken</li>
                        <li data-filter=".Vegetables">Vegetables</li>
                        <li data-filter=".Seafood">Seafood</li>
                        <li data-filter=".Pasta">Pasta</li>
                        <li data-filter=".Drinks">Drinks</li>
                        <li data-filter=".Dessert">Dessert</li>
                        <li data-filter=".Menu">Menu (Kiddie)</li>
                        <li data-filter=".Drinks">Drinks (Kiddie)</li>
                    </ul>
                </div>  
                <div class="row g-0 portfolio-container" style="height:auto;">
                    <?php
                    try
                    {
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
                                    <a href="<?php echo $name ?>" title="<?php echo $row['Food_Name'] ?><br/><?php echo $row['Details'] ?>" data-gallery="portfolio-gallery" class="glightbox preview-link"><i class="bi bi-zoom-in"></i></a>
                                  </div>
                            </div>
                            <?php
                        }
                    }
                    catch(Exception $e)
                    {
                        echo $e->getMessage();
                    }
                    $dbh = null;
                    ?>
                </div>
            </div>
        </div>
      </div>
    </section><!-- End About Section -->

  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  <footer id="footer" class="footer">

    <div class="footer-content">
      <div class="container">
        <div class="row">

          <div class="col-lg-6 col-md-6">
            <div class="footer-info">
              <h3>Zephaniah's Event & Catering Services</h3>
              <p>
                P. Burgos Ave. Cavite City, Cavite<br>
                <strong>Phone:</strong> (046) 434-0015 | 09953741205<br>
                <strong>Email:</strong> zephaniahs.event@gmail.com<br>
              </p>
            </div>
          </div>

          <div class="col-lg-3 col-md-6 footer-links">
            <h4>Useful Links</h4>
            <ul>
              <li><i class="bi bi-chevron-right"></i> <a href="index.php">Home</a></li>
              <li><i class="bi bi-chevron-right"></i> <a href="index.php#about">About us</a></li>
              <li><i class="bi bi-chevron-right"></i> <a href="index.php#services">Services</a></li>
              <li><i class="bi bi-chevron-right"></i> <a href="#">Terms of service</a></li>
              <li><i class="bi bi-chevron-right"></i> <a href="#">Privacy policy</a></li>
            </ul>
          </div>

          <div class="col-lg-3 col-md-6 footer-links">
            <h4>Our Services</h4>
            <ul>
              <li><i class="bi bi-chevron-right"></i> <a href="index.php#portfolio">Birthday</a></li>
              <li><i class="bi bi-chevron-right"></i> <a href="index.php#portfolio">Wedding</a></li>
              <li><i class="bi bi-chevron-right"></i> <a href="index.php#portfolio">Corporate Events</a></li>
              <li><i class="bi bi-chevron-right"></i> <a href="index.php#portfolio">Grand Events</a></li>
            </ul>
          </div>

        </div>
      </div>
    </div>

    <div class="footer-legal text-center">
      <div class="container d-flex flex-column flex-lg-row justify-content-center justify-content-lg-between align-items-center">

        <div class="d-flex flex-column align-items-center align-items-lg-start">
          <div class="copyright">
            &copy; Copyright <strong><span>Zephaniah's Event & Catering Services</span></strong>. All Rights Reserved
          </div>
        </div>

        <div class="social-links order-first order-lg-last mb-3 mb-lg-0">
          <a href="https://www.facebook.com/zephaniascatering?mibextid=ZbWKwL" class="facebook"><i class="bi bi-facebook"></i></a>
          <a href="https://instagram.com/zephaniah_events?igshid=MzRlODBiNWFlZA==" class="instagram"><i class="bi bi-instagram"></i></a>
        </div>

      </div>
    </div>

  </footer><!-- End Footer -->

  <a href="#" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <div id="preloader"></div>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>
</body>

</html>