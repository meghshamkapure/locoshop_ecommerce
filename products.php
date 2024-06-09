<?php
$cap="";
if (isset($_GET['pid'])) {
 $pid=$_GET['pid'];
 $sql = "SELECT p.pid, p.imgpath, p.pcode, p.pname. p.pdesc, r.price FROM rate r, products p, category c, sub_category sc WHERE p.pid=r.pid AND c.cid=sc.cid AND sc.sc_id=p.sc_id AND p.pid=$pid AND p.status=1 ORDER BY p.pid DESC";
}
else if (isset($_GET['sc_id'])) {
 $sc_id=$_GET['sc_id'];
 $sql = "SELECT p.pid, p.imgpath, p.pcode, p.pname, p.pdesc, r.price FROM rate r, products p, category c, sub_category sc WHERE p.pid=r.pid AND c.cid=sc.cid AND sc.sc_id=p.sc_id AND p.sc_id=$sc_id AND p.status=1 ORDER BY p.pid DESC";
}
else if (isset($_GET['sc_name'])) {
 $sc_name=$_GET['sc_name'];
 $sql = "SELECT p.pid, p.imgpath, p.pcode, p.pname, p.pdesc, r.price FROM rate r, products p, category c, sub_category sc WHERE p.pid=r.pid AND c.cid=sc.cid AND sc.sc_id=p.sc_id AND sc.sc_name='$sc_name' AND p.status=1 ORDER BY p.pid DESC";
}
else if (isset($_GET['cid'])) {
 $cid=$_GET['cid'];
 $today=date('Y-m-d');
 if($cid==1){
	$cap="Today's Deal";
 $sql = "SELECT p.pid, p.imgpath, p.pcode, p.pname, p.pdesc, r.price FROM rate r, products p, category c, sub_category sc WHERE p.pid=r.pid AND c.cid=sc.cid AND sc.sc_id=p.sc_id AND p.status=1 AND p.regdate='$today' ORDER BY p.pid DESC";
 }
 if($cid==2){
	 $cap="Within Week Deal";
 $sql = "SELECT p.pid, p.imgpath, p.pcode, p.pname, p.pdesc, r.price FROM rate r, products p, category c, sub_category sc WHERE p.pid=r.pid AND c.cid=sc.cid AND sc.sc_id=p.sc_id AND p.status=1 AND p.regdate BETWEEN date_sub(now(),INTERVAL 1 WEEK) and now() ORDER BY p.pid DESC";
 }
}
else if (isset($_GET['pincode_cat']) && isset($_GET['sc_name_search'])) {
 $pincode=$_GET['pincode_cat'];
 $sc_name=$_GET['sc_name_search'];
 $sql = "SELECT p.pid, p.imgpath, p.pcode, p.pname, p.pdesc, r.price FROM rate r, products p, category c, sub_category sc, seller s WHERE s.sid=p.sid AND p.pid=r.pid AND c.cid=sc.cid AND sc.sc_id=p.sc_id AND s.pincode=$pincode AND sc.sc_name='$sc_name' AND p.status=1 ORDER BY p.pid DESC";
}
else if (isset($_GET['pincode'])) {
 $pincode=$_GET['pincode'];
 $sql = "SELECT p.pid, p.imgpath, p.pcode, p.pname, p.pdesc, r.price FROM rate r, products p, category c, sub_category sc, seller s WHERE s.sid=p.sid AND p.pid=r.pid AND c.cid=sc.cid AND sc.sc_id=p.sc_id AND s.pincode=$pincode AND p.status=1 ORDER BY p.pid DESC";
}
else{
	$sql = "SELECT p.pid, p.imgpath, p.pcode, p.pname, p.pdesc, r.price FROM rate r, products p, category c, sub_category sc WHERE p.pid=r.pid AND c.cid=sc.cid AND sc.sc_id=p.sc_id AND p.status=1 ORDER BY p.pid DESC";
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
    <title> All Products</title>
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
	<script>
	//document.getElementById("cp_btn").addEventListener("click", copy_password);

function copy(count = null) {
    var copyText = document.getElementById("desc"+count);
    var textArea = document.createElement("textarea");
    textArea.value = copyText.textContent;
    document.body.appendChild(textArea);
    textArea.select();
    document.execCommand("Copy");
    textArea.remove();
}
</script>
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
        <div class="top-search-form">
          <form class="inline-form" action="./products.php" method="get">
            <input class="form-control" id="pincode" name="pincode" type="search" autocomplete="off" placeholder="Enter Pin Code" />
            <button type="submit"><i class="fa fa-search"></i></button>
          </form>
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
           <!-- Top Products-->
      <div class="top-products-area clearfix py-3">
        <div class="container-fluid">
          <div class="section-heading d-flex align-items-center justify-content-between">
            <h6 class="ml-1">Top Products <?php echo $cap;?></h6><a class="btn btn-danger btn-sm" href="./search.php">Search By Category</a>
          </div>
          <div class="row g-3">
            <!-- Single Top Product Card-->
			<?php
				  include('./zel_admin/conn.php');
				  error_reporting(E_ALL);				  
				  $result = $conn->query($sql);
				  if ($result->num_rows > 0) {
					  $count=0;
					  while($row = $result->fetch_assoc()) {
						  $count++;
						echo"<div class='col-12 col-md-4 col-lg-3'>
						  <div class='card top-product-card'>
							<div class='card-body' style='background-color:#fff6f6;'>
							<span class='badge badge-success'>New</span>
							<a class='wishlist-btn' href='#'><i class='lni lni-heart'></i></a>
							<a class='product-thumbnail d-block' style='height:350px; overflow:hidden;' href='./product_details.php?pid=".$row['pid']."'>
							<img style='display:block;position:relative;top:50%;left:50%;transform:translate(-50%, -50%);' class='mb-2' src='./zel_seller".$row['imgpath']."' alt=''></a><a class='product-title d-block' href='product_details.php?pid=".$row['pid']."'>".$row['pname']."</a>
							<p class='sale-price'> Price: <i class='lni lni-rupee'></i> ".$row['price']."<span></span></p>";
								$pdesc=$row['pdesc'];
			                    $pdesc=preg_replace("#\[sp\]#", "&nbsp;", $pdesc);
			                    $pdesc=preg_replace("#\[nl\]#", "<br>\n", $pdesc);
								if (strlen($pdesc) > 110){
									$pdesc = substr($pdesc, 0, 100) . '...';
								}
							  echo"<p style='text-align:justify; display:none;' id='desc".$count."'>".$pdesc."</p>
							  <div class='product-rating1'><a style='background-color:#ffc500' href='#' Onclick='copy(".$count.")'><i class='lni lni-clipboard'><b>Copy</b></i></a> &ensp;
							  <a style='background-color:#ffc500' href='https://wa.me?text=https://www.amplewish.com/product_details.php?pid=".$row['pid']."'><i class='lni lni-whatsapp'> <b>Share</b></i></a></div>								
							  <a class='btn btn-success btn-sm add2cart-notify' href='./cart.php?pid=".$row['pid']."'><i class='lni lni-cart'></i> Confirm Order</a>
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