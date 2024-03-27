<?php
require_once("resources/dbconfig.php"); 
session_start();
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
        <img src="assets/img/logo.png" alt="Zephaniah's Event & Catering Services" width="80" height="80">
      </a>

      <nav id="navbar" class="navbar">
        <ul>
              <li><a class="nav-link scrollto text-primary" href="#">Home</a></li>
              <li><a class="nav-link scrollto text-primary" href="#services">Services</a></li>
              <li><a class="nav-link scrollto text-primary" href="menu.php">Menu</a></li>
              <li><a class="nav-link scrollto text-primary" href="#portfolio">Gallery</a></li>
              <li><a class="nav-link scrollto text-primary" href="#about">About</a></li>
              <li><a class="nav-link scrollto text-primary" href="#contact">Contact</a></li>
          
        </ul>
        <i class="bi bi-list mobile-nav-toggle d-none"></i>
      </nav><!-- .navbar -->

      <a class="btn-getstarted scrollto" href="book.php">Book Now</a>

    </div>
  </header><!-- End Header -->

  <section id="hero-static" class="hero-static d-flex align-items-center">
    <div class="container d-flex flex-column justify-content-center align-items-center text-center position-relative" data-aos="zoom-out">
      <img src="assets/img/logo.png" alt="Zephaniah's Event & Catering Services" width="400"/>
      <div class="d-flex">
        <a href="book.php" class="btn-get-started scrollto">Book Now</a>
        <a href="https://drive.google.com/file/d/1u54ppCgm00Fu2zBIeC1M_yGBG0579U4p/preview" class="glightbox btn-watch-video d-flex align-items-center"><i class="bi bi-play-circle"></i><span>Watch Video</span></a>
      </div>
    </div>
  </section>
  <main id="main">
    <!-- ======= Services Section ======= -->
    <section id="best_seller" class="services">
      <div class="container" data-aos="fade-up">

        <div class="section-header">
          <h2>Best Seller</h2>
        </div>

        <div class="row gy-5">

          <div class="col-xl-4 col-md-6" data-aos="zoom-in" data-aos-delay="200">
            <div class="service-item">
              <div class="img">
                <img src="assets/features/7kinds.jpg" class="img-fluid" alt="">
              </div>
              <div class="details position-relative">
                <div class="icon">
                  <img src="assets/img/logo.png" width="50"  alt="Zephaniah's Event & Catering Services">
                </div>
                <h3>7 Kinds</h3>
                <a href="assets/features/7kinds.jpg" class="glightbox preview-link">
                    Preview
                </a>
              </div>
            </div>
          </div><!-- End Service Item -->

          <div class="col-xl-4 col-md-6" data-aos="zoom-in" data-aos-delay="300">
            <div class="service-item">
              <div class="img">
                <img src="assets/features/beef_mechado.jpg" class="img-fluid" alt="">
              </div>
              <div class="details position-relative">
                <div class="icon">
                  <img src="assets/img/logo.png" width="50"  alt="Zephaniah's Event & Catering Services">
                </div>
                <h3>Beef Mechado</h3>
                <a href="assets/features/beef_mechado.jpg" class="glightbox preview-link">
                    Preview
                </a>
              </div>
            </div>
          </div><!-- End Service Item -->

          <div class="col-xl-4 col-md-6" data-aos="zoom-in" data-aos-delay="400">
            <div class="service-item">
              <div class="img">
                <img src="assets/features/Sweet_and_Sour_Pork.jpg" class="img-fluid" alt="">
              </div>
              <div class="details position-relative">
                <div class="icon">
                  <img src="assets/img/logo.png" width="50" alt="Zephaniah's Event & Catering Services">
                </div>
                <h3>Sweet and Sour Pork</h3>
                <a href="assets/features/Sweet_and_Sour_Pork.jpg" class="glightbox preview-link">
                    Preview  
                </a>
              </div>
            </div>
          </div><!-- End Service Item -->

        </div>

      </div>
    </section><!-- End Services Section -->
    

    <!-- ======= Services Section ======= -->
    <section id="services" class="services">
      <div class="container" data-aos="fade-up">

        <div class="section-header">
          <h2>Our Catering Services</h2>
        </div>

        <div class="row gy-5">
          <?php
          try
          {
            $stmt = $dbh->prepare("Select * from tblevent");   
            $stmt->execute();
            $data = $stmt->fetchAll();
            foreach($data as $row)
            {
                $imgURL = "resources/event/".$row['Image'];
          ?>
          <div class="col-xl-4 col-md-6" data-aos="zoom-in" data-aos-delay="200">
            <div class="service-item">
              <div class="img">
                <img src="<?php echo $imgURL ?>" width="100%" height="300" class="" alt="">
              </div>
              <div class="details position-relative">
                <div class="icon">
                  <img src="assets/img/logo.png" width="50" alt="Zephaniah's Event & Catering Services">
                </div>
                <a href="javascript:void(0);" class="view stretched-link">
                  <h3><?php echo $row['Event_Name'] ?></h3>
                </a>
                <p><?php echo $row['Details'] ?></p>
              </div>
            </div>
          </div><!-- End Service Item -->
          <?php 
            }
          }
          catch(Exception $e)
          {
              echo $e->getMessage();
          }
          ?>
        </div>

      </div>
    </section><!-- End Services Section -->
    
    <!-- ======= Portfolio Section ======= -->
    <section id="portfolio" class="portfolio" data-aos="fade-up">

      <div class="container">

        <div class="section-header">
          <h2>Gallery</h2>
        </div>

      </div>
       
      <div class="container-fluid" data-aos="fade-up" data-aos-delay="200">

        <div class="portfolio-isotope" data-portfolio-filter="*" data-portfolio-layout="masonry" data-portfolio-sort="original-order">
          <ul class="portfolio-flters">
            <li data-filter="*" class="filter-active">All</li>
            <li data-filter=".Birthday">Birthday</li>
            <li data-filter=".Wedding">Wedding</li>
            <li data-filter=".Corporate">Corporate Events</li>
          </ul>
          <div class="row g-0 portfolio-container" id="gallery_items">
          <?php
          try
          {
                $stmt = $dbh->prepare("select * from tblgallery");
                $stmt->execute();
                $data = $stmt->fetchAll();
                foreach($data as $row)
                {
                    $filter = $row['Filename'];
                    $imgUrl = "resources/gallery/".$row['File'];
                    ?>
                    <div class="col-xl-3 col-lg-4 col-md-6 portfolio-item <?php echo $filter ?>">  
                    <img src="<?php echo $imgUrl ?>" class="img-fluid" alt="" style="height:300px;width:100%;">
                      <div class="portfolio-info">
                        <h4><?php echo $row['Filename'] ?></h4>
                        <a href="<?php echo $imgUrl ?>" title="<?php echo $row['Filename'] ?>" data-gallery="portfolio-gallery" class="glightbox preview-link"><i class="bi bi-zoom-in"></i></a>
                        <a href="javascript:void(0);" title="More Details" ><i class="bi bi-link-45deg"></i></a>
                      </div>
                    </div>
                    <?php
                }
          }catch(Exception $e)
          {
              echo $e->getMessage();
          }
          $dbh = null;
          ?>
          </div><!-- End Portfolio Container -->

        </div>

      </div>
    </section><!-- End Portfolio Section -->
    
    <!-- ======= About Section ======= -->
    <section id="about" class="about">
      <div class="container" data-aos="fade-up">

        <div class="section-header">
          <h2>About Us</h2>
        </div>

        <div class="row g-4 g-lg-5" data-aos="fade-up" data-aos-delay="200">

          <div class="col-lg-5">
            <div class="">
              <img src="assets/img/logo.png" class="img-fluid" alt="" style="margin-top:-100px;">
            </div>
          </div>

          <div class="col-lg-7">
            <h6 class="pt-0 pt-lg-2">Zephaniah's Event and Catering Services is a full-service catering company that specializes in creating memorable experiences through food. Offer catering services for weddings, corporate events, private parties, and more.<br/><br/>

One of the things that sets Zephaniah's apart from other catering companies is their commitment to using high-quality, locally-sourced ingredients. Believe that food should be both delicious and sustainable, and work closely with local farmers and producers to create seasonal menus that showcase the best of what the region has to offer.<br/><br/>

In addition to their catering services, Zephaniah's also offers event planning and coordination services. Understand that planning an event can be stressful, and dedicated to making the process as smooth and enjoyable as possible for their clients. Whether you're looking for help with venue selection, decor, or entertainment, the team at Zephaniah's is there to help.<br/><br/>

Overall, Zephaniah's Event and Catering Services is a great choice for anyone looking to create a truly special event. With their focus on quality, sustainability, and personalized service, they're sure to exceed your expectations.</h6>

          </div>

        </div>

      </div>
    </section><!-- End About Section -->

    <!-- ======= Contact Section ======= -->
    <section id="contact" class="contact">
      <div class="container">

        <div class="section-header">
          <h2>Contact Us</h2>
        </div>

      </div>

      <div class="map">
        <iframe src="https://www.google.com/maps/embed/v1/place?q=P.+Burgos+Ave,+Caridad,+Cavite+City,+Cavite,+Philippines&key=AIzaSyBFw0Qbyq9zTFTd-tUY6dZWTgaQzuU17R8" frameborder="0" allowfullscreen></iframe>
      </div><!-- End Google Maps -->

      <div class="container">

        <div class="row gy-5 gx-lg-5">

          <div class="col-lg-4">

            <div class="info">
              <h3>Get in touch</h3>

              <div class="info-item d-flex">
                <i class="bi bi-geo-alt flex-shrink-0"></i>
                <div>
                  <h4>Location:</h4>
                  <p>P. Burgos Ave. Cavite City, Cavite</p>
                </div>
              </div><!-- End Info Item -->

              <div class="info-item d-flex">
                <i class="bi bi-envelope flex-shrink-0"></i>
                <div>
                  <h4>Email:</h4>
                  <p>zephaniahs.event@gmail.com</p>
                </div>
              </div><!-- End Info Item -->

              <div class="info-item d-flex">
                <i class="bi bi-phone flex-shrink-0"></i>
                <div>
                  <h4>Call:</h4>
                  <p>(046) 434-0015|09953741205</p>
                </div>
              </div><!-- End Info Item -->

            </div>

          </div>

          <div class="col-lg-8">
            <form method="post" role="form" id="frmContact" class="php-email-form">
              <input type="hidden" name="action" value="inquire"/>
              <div class="row">
                <div class="col-md-6 form-group">
                  <input type="text" name="name" class="form-control" id="name" placeholder="Your Name" required>
                </div>
                <div class="col-md-6 form-group mt-3 mt-md-0">
                  <input type="email" class="form-control" name="email" id="email" placeholder="Your Email" required>
                </div>
              </div>
              <div class="form-group mt-3">
                <input type="text" class="form-control" name="subject" id="subject" placeholder="Subject" required>
              </div>
              <div class="form-group mt-3">
                <textarea class="form-control" name="message" placeholder="Message" required></textarea>
              </div>
              <div class="text-center"><button type="submit" id="btnSubmit">Send Message</button></div>
            </form>
          </div><!-- End Contact Form -->

        </div>

      </div>
    </section><!-- End Contact Section -->
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
              <li><i class="bi bi-chevron-right"></i> <a href="#">Home</a></li>
              <li><i class="bi bi-chevron-right"></i> <a href="#about">About us</a></li>
              <li><i class="bi bi-chevron-right"></i> <a href="#services">Services</a></li>
              <li><i class="bi bi-chevron-right"></i> <a href="#">Terms of service</a></li>
              <li><i class="bi bi-chevron-right"></i> <a href="#">Privacy policy</a></li>
            </ul>
          </div>

          <div class="col-lg-3 col-md-6 footer-links">
            <h4>Our Services</h4>
            <ul>
              <li><i class="bi bi-chevron-right"></i> <a href="#portfolio">Birthday</a></li>
              <li><i class="bi bi-chevron-right"></i> <a href="#portfolio">Wedding</a></li>
              <li><i class="bi bi-chevron-right"></i> <a href="#portfolio">Corporate Events</a></li>
              <li><i class="bi bi-chevron-right"></i> <a href="#portfolio">Grand Events</a></li>
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
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <!-- Template Main JS File -->
  <script src="assets/js/main.js"></script>
  <script>
      $(document).on('click','.view',function()
      {
          Swal.fire(
              'Inclusions',
              '<center><font size="2px">(4 Main Course)<br/>1 Choice of Beef<br/>1 Choice of Chicken<br/>1 Choice of Pork<br/>1 Choice of Veggies<br/><br/>1 Free Pasta Dish<br/>Appetizer | Rice | Dessert | Drinks<br/>Full Tables and Chairs Setup with centerpiece<br/>Buffet Setup with elegant centerpiece<br/>Complete Catering Utensils<br/>Table numbers</br/>Waiters<br/>FREE Basic backdrop design with basic floral/balloons setup<br/>Cake Table<br/>Souvenir table<br/>Styro cut-out Initials/Name</font></center>',
              'info'
            );
      });
      $('#btnSubmit').on('click',function(evt)
      {
        evt.preventDefault();
        var data = $('#frmContact').serialize();
        $.ajax({
            url:"resources/entry.php",method:"POST",
            data:data,
            success:function(data)
            {
                if(data==="Success")
                {
                    $('#frmContact')[0].reset();
                    alert("Great! Successfully submitted");
                }
                else
                {
                    alert(data);
                }
            }
        });
      });
  </script>
</body>

</html>