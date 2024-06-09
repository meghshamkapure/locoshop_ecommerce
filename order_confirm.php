<?php
$show="display:none;";
if (isset($_GET['alert'])) {
 $alert=$_GET['alert'];
 $error=$_GET['error'];
 $show=$_GET['show'];
}
?>
<!DOCTYPE html>
<html lang="en">
  
<!-- Mirrored from designing-world.com/suha-v2.1.0/change-password.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 17 Sep 2020 08:35:01 GMT -->
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
    <title>Order Confirm</title>
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
          <h6 class="mb-0">Application For Franchise</h6>
        </div>
        <!-- Navbar Toggler-->
        <div class="suha-navbar-toggler d-flex justify-content-between flex-wrap" id="suhaNavbarToggler"><span></span><span></span><span></span></div>
      </div>
    </div>
	<?php
	include('sidenav.php');
	?>
    <div class="page-content-wrapper">
      <div class="container">
        <!-- Profile Wrapper-->
        <div class="profile-wrapper-area py-3">
          <!-- User Information-->
          <div class="card user-info-card">
            <div class="card-body p-4 d-flex align-items-center">
              <div class="user-profile mr-3"><img src="img/franchise.png" alt=""></div>
              <div class="user-info">
                <p class="mb-0 text-white">We are providing Franchise over the Maharashtra</p>
                <h5 class="mb-0">Aura Cakes</h5>
				<div align="center" id="success-alert" class="<?php echo $alert; ?>" role="alert" style="color:green;<?php echo $show; ?>"><?php echo $error; ?></div>
              </div>
            </div>
          </div>
          <!-- User Meta Data-->
          <div class="card user-data-card">
            <div class="card-body">
              <form enctype="multipart/form-data" action="./mailus.php?task=Franchise&sender=<?php echo $sender;?>" method="post">
                <div class="mb-3">
                  <div class="title mb-2"><i class="lni lni-user"></i><span>Name</span></div>
                  <input class="form-control" name="name" type="text" required>
                </div>
                <div class="mb-3">
                  <div class="title mb-2"><i class="lni lni-home"></i><span>Address</span></div>
                  <textarea class="form-control" rows="4" name="address" type="text" required></textarea>
                </div>
                <div class="mb-3">
                  <div class="title mb-2"><i class="lni lni-mobile"></i><span>Mobile No.</span></div>
                  <input class="form-control" name="mob" type="number" required>
                </div>
				<div class="mb-3">
                  <div class="title mb-2"><i class="lni lni-mobile"></i><span>Alternate Mobile No.</span></div>
                  <input class="form-control" name="altmob" type="number" required>
                </div>
				<div class="mb-3">
                  <div class="title mb-2"><i class="lni lni-map"></i><span>Shop Location / City</span></div>
                  <input class="form-control" name="location" type="text" required>
                </div>
				<div class="mb-3">
                  <div class="title mb-2"><i class="lni lni-map"></i><span>Map Location</span></div>
                  <input class="form-control" name="maplocation" type="text" required>
                </div>
				<div class="mb-3">
                  <div class="title mb-2"><i class="lni lni-users"></i><span>Rent / Owner</span></div>
					 <select class="mb-3 form-control form-select" id="rent_owner" name="rent_owner" required>
					  <option value="">Select Any One</option>
					  <option value="Rent">Rent</option>
					  <option value="Owner">Owner</option>
					</select>
                </div>				
				<div class="mb-3">
                  <div class="title mb-2"><i class="lni lni-layers"></i><span>Shop Area (Squere Feet)</span></div>
                  <input class="form-control" name="area" type="text" required>
                </div>
				<div class="mb-3">
                  <div class="title mb-2"><i class="lni lni-handshake"></i><span>Partnership / Ownership</span></div>
                  <select class="mb-3 form-control form-select" id="partner_owner" name="partner_owner" required>
					  <option value="">Select Any One</option>
					  <option value="Partnership">Partnership</option>
					  <option value="Ownership">Ownership</option>
					</select>
                </div>
                <button class="btn btn-success w-100" name="franchise_application" type="submit">Submit Application</button>
              </form>
            </div>
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
    <script src="js/default/active.js"></script>
    <script src="js/pwa.js"></script>
  </body>

<!-- Mirrored from designing-world.com/suha-v2.1.0/change-password.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 17 Sep 2020 08:35:01 GMT -->
</html>