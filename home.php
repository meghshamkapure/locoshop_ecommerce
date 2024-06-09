<?php
include('./lock.php');
?>
<!DOCTYPE html>
<html lang="en">
  
<!-- Mirrored from designing-world.com/suha-v2.1.0/home.php by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 17 Sep 2020 08:33:53 GMT -->
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, viewport-fit=cover, shrink-to-fit=no">
    <meta name="description" content="Loco Shop">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="theme-color" content="#004c91">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <!-- The above tags *must* come first in the head, any other head content must come *after* these tags-->
    <!-- Title-->
    <title>Loco Shop | Home</title>
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
        <!-- Logo Wrapper-->
        <div class="logo-wrapper"><a href="home.php"><img src="img/core-img/logo-small.png" alt=""></a></div>
        <!-- Search Form-->
        <div class="top-search-form">
          <form class="inline-form" action="./products.php" method="get">
            <input class="form-control" id="sc_name" name="sc_name" type="search" autocomplete="off" placeholder="Enter your keyword" />
            <button type="submit"><i class="fa fa-search"></i></button>
          </form>
        </div>
        <!-- Navbar Toggler-->
        <div class="suha-navbar-toggler d-flex flex-wrap" id="suhaNavbarToggler"><span></span><span></span><span></span></div>
      </div>
    </div>
    <!-- Sidenav Black Overlay-->
    <?php
	include('sidenav.php');
	?>
    <!-- PWA Install Alert-->
    <div class="page-content-wrapper">
      <!-- Hero Slides-->
      <?php
		  include('./zel_admin/conn.php');
		  error_reporting(E_ALL);
		  $sql = "SELECT * FROM slider WHERE status=1 ORDER BY RAND() LIMIT 1";
		  $result = $conn->query($sql);
		  if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()) {
			  echo"<img src='zel_admin/".$row['imgpath']."' alt='".$row['slider_name']."'>";
			 }
			}			
		?>
      <!-- Product Catagories-->
      <div class="product-catagories-wrapper py-3">
        <div class="container-fluid">
          <div class="section-heading">
            <h6 class="ml-1">Category</h6>
          </div>
          <div class="product-catagory-wrap">
            <div class="row g-3">			
              <!-- Single Catagory Card-->
			  <?php
				  include('./zel_admin/conn.php');
				  error_reporting(E_ALL);
				  $sql = "SELECT * FROM category WHERE status!=0 ORDER BY cat_name ASC LIMIT 3";
				  $result = $conn->query($sql);
				  if ($result->num_rows > 0) {
					while($row = $result->fetch_assoc()) {
					  echo"<div class='col-4'>
						<div class='card catagory-card'>
						  <div class='card-body'><a href='categories.php?cid=".$row['cid']."'><i class='lni lni-gift'></i><span>".$row['cat_name']."</span></a></div>
						</div>
					  </div>";
					 }
					}
					else{
					echo "No Data Available at that time!";
					}
				?>
            </div>
          </div>
        </div>
      </div>
      <!-- Flash Sale Slide-->
      <div class="flash-sale-wrapper">
        <div class="container-fluid">
          <div class="section-heading d-flex align-items-center justify-content-between">
            <h6 class="ml-1">Sub Category</h6><a class="btn btn-primary btn-sm" href="categories.php">View All</a>
          </div>
          <!-- Flash Sale Slide-->
          <div class="flash-sale-slide owl-carousel">
            <!-- Single Flash Sale Card-->
			 <?php
				  include('./zel_admin/conn.php');
				  error_reporting(E_ALL);
				  $sql = "SELECT c.cat_name, sc.sc_id, sc.sc_name, sc.imgpath FROM category c, sub_category sc WHERE c.cid=sc.cid AND sc.status=1 ORDER BY RAND()";
				  $result = $conn->query($sql);
				  if ($result->num_rows > 0) {
					while($row = $result->fetch_assoc()) {
						echo"<div class='card flash-sale-card'>
						  <div class='card-body'>
						  <div>
						  <a href='products.php?sc_id=".$row['sc_id']."'>
						  <img class='mb-2' src='./zel_admin".$row['imgpath']."' alt=''>
						  </a>
						  </div><hr/>
						  <span class='product-title'>".$row['sc_name']."</span>							  
							  <!-- Progress Bar-->
							  </div>
						</div>";
					 }
				}
				else{
				echo "No Data Available at that time!";
				}
				?>
          </div>
        </div>
      </div>
      <!-- Top Products-->
      <div class="top-products-area clearfix py-3">
        <div class="container-fluid">
          <div class="section-heading d-flex align-items-center justify-content-between">
            <h6 class="ml-1">Top Products</h6><a class="btn btn-danger btn-sm" href="./products.php">View All</a>
          </div>
          <div class="row g-3">
            <!-- Single Top Product Card-->
			<?php
				  include('./zel_admin/conn.php');
				  error_reporting(E_ALL);
				  $sql = "SELECT p.pid, p.imgpath, p.pcode, p.pname, r.price FROM rate r, products p, category c, sub_category sc WHERE p.pid=r.pid AND c.cid=sc.cid AND sc.sc_id=p.sc_id AND p.status=1 ORDER BY p.pid DESC LIMIT 8";
				  $result = $conn->query($sql);
				  if ($result->num_rows > 0) {
					  while($row = $result->fetch_assoc()) {
						echo"<div class='col-6 col-md-4 col-lg-3'>
						  <div class='card top-product-card'>
							<div class='card-body' style='background-color:#fff6f6;'>
							<span class='badge badge-success'>New</span>
							<a class='wishlist-btn' href='#'><i class='lni lni-heart'></i></a>
							<a class='product-thumbnail d-block' style='height:350px; overflow:hidden;' href='./product_details.php?pid=".$row['pid']."'>
							<img style='display:block;position:relative;top:50%;left:50%;transform:translate(-50%, -50%);' class='mb-2' src='./zel_seller".$row['imgpath']."' alt=''></a>
							<a class='product-title d-block' href='product_details.php?pid=".$row['pid']."'>".$row['pname']."</a>
							<p class='sale-price'> Price: <i class='lni lni-rupee'></i> ".$row['price']."<span></span></p>
							  <p class='sale-price'>".$row['pcode']."</p>							  
							  <div class='product-rating'><i class='lni lni-star-filled'></i><i class='lni lni-star-filled'></i><i class='lni lni-star-filled'></i><i class='lni lni-star-filled'></i><i class='lni lni-star-filled'></i></div><a class='btn btn-success btn-sm add2cart-notify' style='border-radius: 50%; width: 30px;' href='product_details.php?pid=".$row['pid']."'><i class='lni lni-eye'></i></a>
							</div>
						  </div>
						</div>";
					 }
				  }
				  else{
				   echo "No Data Available at that time!";
				  }
				?>

          </div>
        </div>
      </div>
      <!-- Cool Facts Area-->
      <!-- Discount Coupon Card-->
      <!-- Featured Products Wrapper-->

      <!-- Night Mode View Card-->

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
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-3-typeahead/4.0.2/bootstrap3-typeahead.min.js"></script>
	
  </body>

<!-- Mirrored from designing-world.com/suha-v2.1.0/home.php by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 17 Sep 2020 08:34:19 GMT -->
</html>
	<script>
$(document).ready(function(){
 
 $('#sc_name').typeahead({
  source: function(query, result)
  {
   $.ajax({
    url:"searchsubcat.php",
    method:"POST",
    data:{query:query},
    dataType:"json",
    success:function(data)
    {
     result($.map(data, function(item){
      return item;
     }));
    }
   })
  }
 });
 
});
</script>