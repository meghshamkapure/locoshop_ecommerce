<?php
if (isset($_GET['cid'])) {
 $cid=$_GET['cid'];
 if($cid<3){
	 header("Location:./products.php?cid=$cid");
 }
 else{
 $sql = "SELECT c.cat_name, sc.sc_id, sc.sc_name, sc.imgpath FROM category c, sub_category sc WHERE c.cid=sc.cid AND sc.status=1 AND c.cat_name!='Equipments & Accessories' AND sc.cid=$cid ORDER BY sc.sc_id ASC";
 }
}
else{
	$sql = "SELECT c.cat_name, sc.sc_id, sc.sc_name, sc.imgpath FROM category c, sub_category sc WHERE c.cid=sc.cid AND sc.status=1 AND c.cat_name!='Equipments & Accessories' ORDER BY sc.sc_id ASC";
}
?>
<!DOCTYPE html>
<html lang="en">
  
<!-- Mirrored from designing-world.com/suha-v2.1.0/categories.php by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 17 Sep 2020 08:34:36 GMT -->
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, viewport-fit=cover, shrink-to-fit=no">
    <meta name="description" content="Amplewish">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="theme-color" content="#004c91">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <!-- The above tags *must* come first in the head, any other head content must come *after* these tags-->
    <!-- Title-->
    <title>Products Categories</title>
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
          <h6 class="mb-0">Product Category</h6>
        </div>
        <!-- Filter Option-->
        <div class="suha-navbar-toggler d-flex justify-content-between flex-wrap" id="suhaNavbarToggler"><span></span><span></span><span></span></div>
      </div>
    </div>
    <?php
	include('sidenav.php');
	?>
    <div class="page-content-wrapper">
      <!-- Catagory Single Image-->
     <!-- <div class="catagory-single-img" style="background-image: url('img/bg-img/4.jpg')"></div>-->
      <!-- Product Catagories-->
      <!-- Top Products-->
            <div class="top-products-area clearfix py-3">
        <div class="container-fluid">
          <div class="section-heading d-flex align-items-center justify-content-between">
            <h6 class="ml-1">All Categories</h6><a class="btn btn-danger btn-sm" href="./products.php">View All</a>
          </div>
          <div class="row g-3">
            <!-- Single Top Product Card-->
			<?php
				  include('./zel_admin/conn.php');
				  error_reporting(E_ALL);				  
				  $result = $conn->query($sql);
				  if ($result->num_rows > 0) {
					  while($row = $result->fetch_assoc()) {
							$sql = "SELECT * FROM products WHERE status=1 AND sc_id=".$row['sc_id'];
							$query = $conn->query($sql);
							$countproduct = $query->num_rows;
						echo"<div class='col-6 col-md-4 col-lg-3'>
						  <div class='card top-product-card'>
							<div class='card-body'><span style='display:none;' class='badge badge-success'>".$row['cat_name']."</span><a class='wishlist-btn' href='#'><i class='lni lni-heart'></i></a><a class='product-thumbnail d-block' href='./products.php?sc_id=".$row['sc_id']."'><img class='mb-2' src='./zel_admin".$row['imgpath']."' alt=''></a><a class='product-title d-block' href='products.php?sc_id=".$row['sc_id']."'>".$row['sc_name']."</a>
							  <p class='sale-badge badge-success' style='color:white;'>".$row['cat_name']."</p>
							  <p class='sale-price'> Available: ".$countproduct."</p>
							  <div class='product-rating'><i class='lni lni-star-filled'></i><i class='lni lni-star-filled'></i><i class='lni lni-star-filled'></i><i class='lni lni-star-filled'></i><i class='lni lni-star-filled'></i></div><a class='btn btn-success btn-sm add2cart-notify' style='border-radius: 48%; width: 35px;' href='products.php?sc_id=".$row['sc_id']."'><i class='lni lni-eye'></i></a>
							</div>
						  </div>
						</div>";
					 }
				  }
				  else{
				   echo "No Categories Available at that time!";
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
    <script src="js/app.js"></script>
  </body>

<!-- Mirrored from designing-world.com/suha-v2.1.0/categories.php by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 17 Sep 2020 08:34:36 GMT -->
</html>