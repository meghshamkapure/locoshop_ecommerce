<?php
include('./zel_admin/conn.php');
include('./lock.php');
$error="";
$show="display:none;";
$alert="alert alert-success";
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
 if(isset($_SESSION['login_euser']) && isset($_SESSION['login_password']))
{
}
else
{
  header("Location:login.php");
  exit;
}
if (isset($_GET['pid'])) {
	$pid=$_GET['pid'];	
}
else{
	header('Location:./home.php');
}
error_reporting(E_ALL);
$sql = "SELECT p.pid, p.imgpath, p.pcode, p.pname, p.pdesc, c.cat_name, sc.sc_name, r.rate_id, r.price FROM rate r, products p, category c, sub_category sc WHERE p.pid=r.pid AND c.cid=sc.cid AND sc.sc_id=p.sc_id AND p.pid=$pid AND c.cat_name!='Equipments & Accessories' AND p.status=1 ORDER BY p.pname ASC";			  
$result = $conn->query($sql);
if ($result->num_rows > 0) {
  while($row = $result->fetch_assoc()) {
	$pid=$row['pid'];
	$rate_id=$row['rate_id'];
	$pname=$row['pname'];
	$price=$row['price'];
	$pcode=$row['pcode'];
	$pdesc=$row['pdesc'];
    $pdesc=preg_replace("#\[sp\]#", "&nbsp;", $pdesc);
	$pdesc=preg_replace("#\[nl\]#", "<br>\n", $pdesc);
	$cat_name=$row['cat_name'];
	$sc_name=$row['sc_name'];
	$imgpath=$row['imgpath'];
 }
}
else{
echo "No Product Available at that time!";
header('Location:./home.php');
}

if (isset($_POST['submitorder'])){
	if ($_SERVER["REQUEST_METHOD"] == "POST") {		
		$pid = test_input($_POST["pid"]);
		$order_date = date("Y-m-d");
		$pid = $_POST["pid"];
		$qty = $_POST["qty"];
		$status=1;
		$currdate=date("Y-m-d");	
		$sql = "INSERT INTO orders (euid, order_date, order_status) VALUES ($user_id, '$currdate', $status)";
		if ($conn->query($sql) === TRUE) {
			$order_id = $conn->insert_id;
			//$number = count($_POST["pid"]); 
			//for($i=0; $i<$number; $i++)  
			//{  
			  // if($_POST["pid"][$i] != '')  
			  // { 	   
				$pid=$_POST["pid"];
				$qty=$_POST["qty"];
				$rate_id=$_POST["rate_id"];			
				$fmSql = "INSERT INTO order_item (order_id, pid, rate_id, qty, order_item_status) 
				VALUES ($order_id, $pid, $rate_id, '$qty', 1)";
				$conn->query($fmSql);			
			   //}  
			//} 	
				$error="Order Placed Successfully! Thank You.";
				$show="display:show;";
				$alert="alert alert-success";
				header("Location:./order_success.php?pid=$pid&error=$error&show=$show&alert=$alert");
				//header("Location:./cart.php?pid=$pid&error=$error&show=$show&alert=$alert");
		}
		else{
				$error="Something Went Wrong! Please Try Again.";;
				$show="display:show;";
				$alert="alert alert-success";
				header("Location:./cart.php?pid=$pid&error=$error&show=$show&alert=$alert");
		}			
	}
}
function order_add(){
	include('./zel_admin/conn.php');
	include('./zel_admin/lock.php');
	$pid = $_POST["pid"];
	$qty = $_POST["qty"];
	$status=1;
	$currdate=date("Y-m-d");	
	$sql = "INSERT INTO orders (euid, order_date, order_status) VALUES ($fr_id, '$currdate', $status)";
	echo $sql;
	if ($conn->query($sql) === TRUE) {
		$order_id = $conn->insert_id;
		//$number = count($_POST["pid"]); 
		//for($i=0; $i<$number; $i++)  
		//{  
		  // if($_POST["pid"][$i] != '')  
		  // { 	   
			$pid=$_POST["pid"];
			$qty=$_POST["qty"];
			$rate_id=$_POST["rate_id"];			
			$fmSql = "INSERT INTO order_item (order_id, pid, rate_id, qty, order_item_status) 
			VALUES ($order_id, $pid, $rate_id, '$qty', 1)";
			$conn->query($fmSql);			
		   //}  
		//} 	
		$msg="Order Is Placed successfully!";	
	}
	else{
		$msg="Something Is Wrong! Please Try Again!!!";
	}
	return $msg;
}
if (isset($_GET['error'])) {
	$error=$_GET['error'];
	$show=$_GET['show'];
	$alert=$_GET['alert'];
}
function test_input($data) {
   $data = trim($data);
   $data = stripslashes($data);
   $data = htmlspecialchars($data);
   return $data;
}
?>
<!DOCTYPE html>
<html lang="en">
  
<!-- Mirrored from designing-world.com/suha-v2.1.0/cart.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 17 Sep 2020 08:34:36 GMT -->
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, viewport-fit=cover, shrink-to-fit=no">
    <meta name="description" content="Suha - Multipurpose Ecommerce Mobile HTML Template">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="theme-color" content="#100DD1">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <!-- The above tags *must* come first in the head, any other head content must come *after* these tags-->
    <!-- Title-->
    <title>Cart Confirm Order</title>
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
	<script type="text/javascript">
	  function cal(){
		  var counter=0;
		  var f1 = document.getElementById("price").value;
		  var f2 = document.getElementById("qty").value;
		  var r= parseFloat(f1) * parseFloat(f2);
		  if(parseFloat(f2)<=0 || isNaN(f2)){
			document.getElementById("qty").value=1;  
		  }
		  if(!isNaN(r))
		  {
			document.getElementById("total").innerHTML=r.toFixed(2);
		  }
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
        <div class="back-button"><a href="./home.php"><i class="lni lni-arrow-left"></i></a></div>
        <!-- Page Title-->
        <div class="page-heading">
          <h6 class="mb-0">My Cart</h6>
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
      <div class="container">
        <!-- Cart Wrapper-->
        <div class="cart-wrapper-area py-3">
		<div class="<?php echo $alert; ?>" role="alert" style="<?php echo $show; ?>"><?php echo $error; ?></div>
		<form method="post" action="cart.php?pid=<?php echo $pid;?>">
          <div class="cart-table card mb-3">
            <div class="table-responsive card-body">
              <table class="table mb-0">
                <tbody>                  
				  <?php
				 // for($i=1;$i<=1;$i++){
                    echo"<tr>
					<th scope='row'><a class='remove-product' href='#'><i class='lni lni-close'></i></a></th>
                    <td><img src='./zel_seller".$imgpath."' alt=''></td>
                    <td><a href='#'>".$pname."<span>Rs. ". $price." </span></a></td>
                    <td>
                      <div class='quantity'>
                        <input class='qty-text' type='hidden'  id='pid' name='pid' value='". $pid."' required>
                        <input class='qty-text' type='hidden'  id='rate_id' name='rate_id' value='".$rate_id."' required>
                        <input class='qty-text' type='hidden'  id='price' name='price' value='".$price."' required> 
                        <b>Quantity: </b><input class='qty-text' type='text'  id='qty' name='qty' onkeyup='cal()' required>
                      </div>
                    </td>
                  </tr>";
				  //}
					?>                  
                </tbody>
              </table>
            </div>
          </div>
          <!-- Coupon Area-->
          
          <!-- Cart Amount Area-->
          <div class="card cart-amount-area">
            <div class="card-body d-flex align-items-center justify-content-between">
              <h5 class="total-price mb-0">Rs.<span class="counter" id="total"></span></h5>
			  <input type="submit" class="btn btn-warning" name="submitorder" value="Place Order"/>
            </div>
          </div>
		  </form>
		  <div class="card coupon-card mb-3" style="display:none;">
            <div class="card-body">
              <div class="apply-coupon">
                <h6 class="mb-0">Have a coupon?</h6>
                <p class="mb-2">Enter your coupon code here &amp; get awesome discounts!</p>
                <div class="coupon-form">
                  <form action="#">
                    <input class="form-control" type="text" placeholder="SUHA30">
                    <button class="btn btn-primary" type="submit">Apply</button>
                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <!-- Internet Connection Status-->
    <div class="internet-connection-status" id="internetStatus"></div>
    <!-- Footer Nav-->
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

<!-- Mirrored from designing-world.com/suha-v2.1.0/cart.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 17 Sep 2020 08:34:36 GMT -->
</html>