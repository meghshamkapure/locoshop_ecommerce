<?php 
include('./lock.php');
if($login_session)  
{   
	$status="Welcome ".$login_name; 
	$url="./logout.php";
	$status1="Logout";  
}
else
{ 
	$status="Welcome Guest"; 
	$url="./login.php";
	$status1="Login"; 
 }
  ?>
<div class="sidenav-black-overlay"></div>
    <!-- Side Nav Wrapper-->
    <div class="suha-sidenav-wrapper" id="sidenavWrapper">
      <!-- Sidenav Profile-->
      <div class="sidenav-profile">
        <div class="user-profile1"><img src="img/bg-img/logo.png" alt=""></div>
        <div class="user-info">
          <h6 class="user-name mb-0"><?php echo $status; ?></h6>
          <p class="available-balance"><a style="color:#000000;"href="<?php echo $url?>"><?php echo $status1; ?></a></p>
        </div>
      </div>
      <!-- Sidenav Nav-->
      <ul class="sidenav-nav pl-0">
        <li><a href="home.php"><i class="lni lni-home"></i>Home</a></li>
        <!-- <li><a href="about.php"><i class="lni lni-users"></i>About Us</a></li>
       <li><a href="franchise_application.php"><i class="lni lni-cart"></i>Apply For Franchise</a></li>
        <li><a href="store_locator.php"><i class="lni lni-heart"></i>Store Locator</a></li>
        <li><a href="contact.php"><i class="lni lni-user"></i>Contact Us</a></li>        -->
        <li><a href="./zel_seller" target="slef"><i class="lni lni-power-switch"></i>Seller Login</a></li>
        
      </ul>
      <!-- Go Back Button-->
      <div class="go-home-btn" id="goHomeBtn"><i class="lni lni-arrow-left"></i></div>
    </div>