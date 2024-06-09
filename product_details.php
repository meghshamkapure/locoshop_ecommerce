<?php
include('./zel_admin/conn.php');

if (isset($_GET['pid'])) {
	$pid=$_GET['pid'];	
}
else{
	header('Location:./home.php');
}
error_reporting(E_ALL);
$sql = "SELECT p.pid, p.imgpath, p.pcode, p.pname, p.pdesc, p.color, p.size, c.cat_name, sc.sc_name, sc.sc_id, r.price, s.sname, s.smob, s.address FROM rate r, products p, category c, sub_category sc, seller s WHERE s.sid=p.sid AND p.pid=r.pid AND c.cid=sc.cid AND sc.sc_id=p.sc_id AND p.pid=$pid AND c.cat_name!='Equipments & Accessories' AND p.status=1 ORDER BY p.pname ASC";			  
$result = $conn->query($sql);
if ($result->num_rows > 0) {
  while($row = $result->fetch_assoc()) {
	$pid=$row['pid'];
	$pname=$row['pname'];
	$price=$row['price'];
	$pcode=$row['pcode'];
	$color=$row['color'];
	$size=$row['size'];
	$pdesc=$row['pdesc'];
    $pdesc=preg_replace("#\[sp\]#", "&nbsp;", $pdesc);
	$pdesc=preg_replace("#\[nl\]#", "<br>\n", $pdesc);
	$cat_name=$row['cat_name'];
	$sc_name=$row['sc_name'];
	$sc_id=$row['sc_id'];
	$imgpath=$row['imgpath'];
	$sname=$row['sname'];
	$smob=$row['smob'];
	$address=$row['address'];
 }
}
else{
echo "No Product Available at that time!";
header('Location:./home.php');
}
?>
<!DOCTYPE html>
<html lang="en">
  
<!-- Mirrored from designing-world.com/suha-v2.1.0/single-product.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 17 Sep 2020 08:34:24 GMT -->
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, viewport-fit=cover, shrink-to-fit=no">
    <meta name="description" content="Amplewish">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="theme-color" content="#004c91">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
	
	<meta property="og:title" content="<?echo $pname;?>" />
	<meta property="og:url" content="<?echo $_SERVER['REQUEST_URI'];?>" />
	<meta property="og:description" content="<?echo $cat_name." - ".$pname;?>">
	<meta property="og:image" itemprop="image" content="<?echo "https://www.amplewish.com/zel_seller/".$imgpath;?>"/>
	<meta property="og:type" content="Product" />
	<meta property="og:locale" content="en_GB" />
    <!-- The above tags *must* come first in the head, any other head content must come *after* these tags-->
    <!-- Title-->
    <title>Products Details</title>
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

function copy() {
    var copyText = document.getElementById("desc");
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
  <link itemprop="thumbnailUrl" href="<?echo "https://www.amplewish.com/zel_seller/".$imgpath;?>">

<span itemprop="thumbnail" itemscope itemtype="http://schema.org/ImageObject">
<link itemprop="url" href="<?echo "https://www.amplewish.com/zel_seller/".$imgpath;?>">
</span>
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
          <h6 class="mb-0">Product Details</h6>
        </div>
        <!-- Navbar Toggler-->
        <div class="suha-navbar-toggler d-flex justify-content-between flex-wrap" id="suhaNavbarToggler"><span></span><span></span><span></span></div>
      </div>
    </div>
    <!-- Sidenav Black Overlay-->
   <?php
	include('sidenav.php');
	?>
    <div class="page-content-wrapper">
      <!-- Product Slides-->
      <div class="product-slides owl-carousel">
        <!-- Single Hero Slide-->
		<div style="overflow:hidden;" class="single-product-slide text-align-items-center"> 
		<img style="display:block;position:relative;top:50%;left:50%;transform:translate(-50%, -50%);width:auto;height:100%" src="./zel_seller<?php echo $imgpath;?>">
		    <div class='carousel-caption'>
                <a href="./zel_seller<?php echo $imgpath;?>" download >
                <button class="btn btn-sm btn-success ml-3">Download</button></a>
            </div>
        </div>
		<?php
      //include('./conn.php');
      error_reporting(E_ALL);
      $sql = "SELECT imgpath FROM product_img WHERE status=1 AND pid=$pid ORDER BY pimg_id ASC;";
      $result = $conn->query($sql);
      if ($result->num_rows > 0) {
          while($row = $result->fetch_assoc()) {
        echo"<div style='overflow:hidden;' class='single-product-slide text-align-items-center'>
            <img style='display:block;position:relative;top:50%;left:50%;transform:translate(-50%, -50%);width:auto;height:100%' src='./zel_seller/".$row['imgpath']."')'>
            <div class='carousel-caption'>
                <a href='./zel_seller". $row['imgpath'] ."' download>
                <button class='btn btn-sm btn-success ml-3'>Download</button></a>
            </div>
        </div>";
		  }
	  }
	  ?>
      </div>
      <div class="product-description pb-3">
        <!-- Product Title & Meta Data-->
        <div class="specification bg-white mb-3 py-3">
          <div class="container d-flex justify-content-between">
            <div class="p-title-price">
                <p>Tab on image to download!</p>
              <h6 class="mb-1"><?php echo $pname;?></h6>
              <p class='sale-price'> Price: <i class='lni lni-rupee'></i> <?php echo $price;?><span></span></p>
              <p class="sale-price mb-0"><?php echo $pcode;?></p>
              <p class="sale-price mb-0"><?php echo $cat_name."-".$sc_name;?></p>
            </div>
            <div class="p-wishlist-share"><a href="#"><i class="lni lni-heart"></i></a></div>
          </div>
          <!-- Ratings-->          
        </div>
        <!-- Product Specification-->
        <div class="p-specification bg-white mb-3 py-3">
          <div class="container">
            <h6>Specifications</h6>
            
            <p style="text-align:justify;" id="desc"><?php echo $pdesc;?></p>
            <ul class="mb-3 pl-3">
              <li><i class="lni lni-checkmark-circle"> </i> Color: <?php echo $color;?> </li>
              <li><i class="lni lni-checkmark-circle"> </i> Size: <?php echo $size;?> </li>
              <li><i class="lni lni-checkmark-circle"> </i> 100% Good Reviews</li>
            </ul>

			<div class='product-rating1'><a style='background-color:#ffc500' href='#' Onclick='copy()'><i class='lni lni-clipboard'><b>Copy</b></i></a> &ensp;
			<a style='background-color:#ffc500' href='https://wa.me?text=https://www.amplewish.com/product_details.php?pid=<?php echo $pid;?>'><i class='lni lni-whatsapp'><b> Share</b></i></a></div>            
          </div>
        </div>
		<div class="p-specification bg-white mb-3 py-3">
          <div class="container">
            <h6>Shop Details</h6>
            
            <p style="text-align:justify;" id="desc"><b><?php echo $sname;?></b></p>
            <ul class="mb-3 pl-3">
             <li><i class="lni lni-checkmark-circle"> </i> Mobile No: <?php echo $smob;?> </li>
              <li><i class="lni lni-checkmark-circle"> </i> Address: <?php echo $address;?> </li>
            </ul>			
          </div>
        </div>
		<div class="cart-form-wrapper bg-white mb-3 py-3">
          <div class="container">		  
            <a href='cart.php?pid=<?php echo $pid; ?>'>              
              <button class="btn btn-danger ml-3" type="submit">Order Now</button>
            </a>
          </div>
        </div>
		      <!-- Top Products-->
      <div class="top-products-area clearfix py-3">
        <div class="container-fluid">
          <div class="section-heading d-flex align-items-center justify-content-between">
            <h6 class="ml-1">Recommended Products</h6><a class="btn btn-danger btn-sm" href="./products.php?sc_id=<?php echo $sc_id;?>">View All</a>
          </div>
          <div class="row g-3">
            <!-- Single Top Product Card-->
			<?php
				  include('./zel_admin/conn.php');
				  error_reporting(E_ALL);
				  $sql = "SELECT p.pid, p.imgpath, p.pcode, p.pname, r.price FROM rate r, products p, category c, sub_category sc WHERE p.pid=r.pid AND c.cid=sc.cid AND sc.sc_id=p.sc_id AND p.pid!=$pid AND p.sc_id=$sc_id AND p.status=1 ORDER BY p.pid DESC LIMIT 4";
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
        <!-- Rating & Review Wrapper-->
       <!-- <div class="rating-and-review-wrapper bg-white py-3 mb-3">
          <div class="container">
            <h6>Ratings &amp; Reviews</h6>
            <div class="rating-review-content">
              <ul class="pl-0">
                <li class="single-user-review d-flex">
                  <div class="user-thumbnail"><img src="img/bg-img/7.jpg" alt=""></div>
                  <div class="rating-comment">
                    <div class="rating"><i class="lni lni-star-filled"></i><i class="lni lni-star-filled"></i><i class="lni lni-star-filled"></i><i class="lni lni-star-filled"></i><i class="lni lni-star-filled"></i></div>
                    <p class="comment mb-0">Very good product. It's just amazing!</p><span class="name-date">Designing World 12 Dec 2020</span>
                  </div>
                </li>
                <li class="single-user-review d-flex">
                  <div class="user-thumbnail"><img src="img/bg-img/8.jpg" alt=""></div>
                  <div class="rating-comment">
                    <div class="rating"><i class="lni lni-star-filled"></i><i class="lni lni-star-filled"></i><i class="lni lni-star-filled"></i><i class="lni lni-star-filled"></i><i class="lni lni-star-filled"></i></div>
                    <p class="comment mb-0">WOW excellent product. Love it.</p><span class="name-date">Designing World 8 Dec 2020</span>
                  </div>
                </li>
                <li class="single-user-review d-flex">
                  <div class="user-thumbnail"><img src="img/bg-img/9.jpg" alt=""></div>
                  <div class="rating-comment">
                    <div class="rating"><i class="lni lni-star-filled"></i><i class="lni lni-star-filled"></i><i class="lni lni-star-filled"></i><i class="lni lni-star-filled"></i><i class="lni lni-star-filled"></i></div>
                    <p class="comment mb-0">What a nice product it is. I am looking it's.</p><span class="name-date">Designing World 28 Nov 2020</span>
                  </div>
                </li>
              </ul>
            </div>
          </div>
        </div>
        <!-- Ratings Submit Form-->
       <!-- <div class="ratings-submit-form bg-white py-3">
          <div class="container">
            <h6>Submit A Review</h6>
            <form action="#" method="">
              <div class="stars mb-3">
                <input class="star-1" type="radio" name="star" id="star1">
                <label class="star-1" for="star1"></label>
                <input class="star-2" type="radio" name="star" id="star2">
                <label class="star-2" for="star2"></label>
                <input class="star-3" type="radio" name="star" id="star3">
                <label class="star-3" for="star3"></label>
                <input class="star-4" type="radio" name="star" id="star4">
                <label class="star-4" for="star4"></label>
                <input class="star-5" type="radio" name="star" id="star5">
                <label class="star-5" for="star5"></label><span></span>
              </div>
              <textarea class="form-control mb-3" id="comments" name="comment" cols="30" rows="10" data-max-length="200" placeholder="Write your review..."></textarea>
              <button class="btn btn-sm btn-primary" type="submit">Save Review</button>
            </form>
          </div>
        </div> -->
      </div>
    </div>
    <!-- Internet Connection Status-->
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

<!-- Mirrored from designing-world.com/suha-v2.1.0/single-product.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 17 Sep 2020 08:34:27 GMT -->
</html>