<?php
include ("./zel_admin/conn.php");
?>
<!DOCTYPE html>
<html lang="en">
  
<!-- Mirrored from designing-world.com/suha-v2.1.0/shop-list.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 17 Sep 2020 08:34:24 GMT -->
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, viewport-fit=cover, shrink-to-fit=no">
    <meta name="description" content="Amplewish -  Manchar">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="theme-color" content="#004c91">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <!-- The above tags *must* come first in the head, any other head content must come *after* these tags-->
    <!-- Title-->
    <title>Shop Locator | Aura Cakes |</title>
    <!-- Favicon-->
    <link rel="icon" href="img/icons/icon-72x72.png">
    <!-- Apple Touch Icon-->
    <link rel="apple-touch-icon" href="img/icons/icon-96x96.png">
    <link rel="apple-touch-icon" sizes="152x152" href="img/icons/icon-152x152.png">
    <link rel="apple-touch-icon" sizes="167x167" href="img/icons/icon-167x167.png">
    <link rel="apple-touch-icon" sizes="180x180" href="img/icons/icon-180x180.png">
    <!-- Stylesheet-->
    <link rel="stylesheet" href="style.css">
    <!-- Web App Manifest-->
    <link rel="manifest" href="manifest.json">
  </head>
  <body>
    <!-- Preloader-->
    <div class="preloader" id="preloader">
      <div class="spinner-grow text-secondary" role="status">
        <div class="sr-only">Loading...</div>
      </div>
    </div>
    <!-- Header Area-->
    <div class="header-area" id="headerArea">
      <div class="container h-100 d-flex align-items-center justify-content-between">
        <!-- Back Button-->
        <div class="back-button"><a href="home.php"><i class="lni lni-arrow-left"></i></a></div>
        <!-- Page Title-->
        <div class="page-heading">
          <h6 class="mb-0">Shop Location List</h6>
        </div>
        <!-- Filter Option-->
        <div class="suha-navbar-toggler d-flex justify-content-between flex-wrap" id="suhaNavbarToggler"><span></span><span></span><span></span></div>
      </div>
    </div>
    <?php
	include('sidenav.php');
	?>
    <div class="page-content-wrapper">
      <!-- Top Products-->
      <div class="top-products-area py-3">
        <div class="container">
          <div class="section-heading d-flex align-items-center justify-content-between">
            <h6 class="ml-1">All Shop Locations</h6>
            <!-- Layout Options-->            
          </div>
          <div class="row g-3">
            <!-- Single Weekly Product Card-->
			<?php
				  include('./zel_admin/conn.php');
				  error_reporting(E_ALL);
				  $sql = "SELECT * FROM franchise WHERE fr_status=1 ORDER BY shop_location ASC";
				  $result = $conn->query($sql);
				  if ($result->num_rows > 0) {
					while($row = $result->fetch_assoc()) {
						
					echo"<div class='col-12 col-md-6'>
					  <div class='card weekly-product-card'>
						<div class='card-body d-flex align-items-center'>
						  <div class='product-thumbnail-side'>					  
							  <a class='wishlist-btn' href='#'><i class='lni lni-heart'></i></a>
							  <a href='".$row['map_location']."' target='self'><img src='./img/map.png' height='150' width='150'/></a>
						  </div>
						  <div class='product-description'><a class='product-title d-block' href='#'>".$row['name']." - ".$row['shop_location']."</a>
							<p class='sale-price'><i class='lni lni-home'></i>".$row['address']."</p>
							<div class='product-rating'><i class='lni lni-phone'></i>".$row['mob']."</div>
							<div class='product-rating'><i class='lni lni-whatsapp'></i>".$row['altmob']."</div>
						  </div>
						</div>
					  </div>
					</div>";
					}
				  }
				  else{
					  echo "No Stores Available at that time!";
				  }
				  ?>

          </div>
        </div>
      </div>
    </div>
	<?php
	include('footer.php');
	?>
    <!-- All JavaScript Files-->
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/waypoints.min.js"></script>
    <script src="js/jquery.easing.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <script src="js/jquery.counterup.min.js"></script>
    <script src="js/jquery.countdown.min.js"></script>
    <script src="js/default/jquery.passwordstrength.js"></script>
    <script src="js/wow.min.js"></script>
    <script src="js/jarallax.min.js"></script>
    <script src="js/jarallax-video.min.js"></script>
    <script src="js/default/dark-mode-switch.js"></script>
    <script src="js/default/no-internet.js"></script>
    <script src="js/default/active.js"></script>
    <script src="js/pwa.js"></script>
  </body>

<!-- Mirrored from designing-world.com/suha-v2.1.0/shop-list.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 17 Sep 2020 08:34:24 GMT -->
</html>