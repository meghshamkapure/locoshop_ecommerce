<?php
$error="";
$login_session="";
$show="display:none;";
$alert="";
include("./zel_admin/conn.php");
include('./sms.php');
include('./otpgenerator.php');
require_once('./mail/class.phpmailer.php');
require_once('./mail/class.smtp.php');
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
//check up
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
 if(isset($_SESSION['login_euser']))
{
  header("Location:./home.php");
  exit;
}
else
{
  //header("Location:login.php");
  //exit;
}
if (isset($_GET['alert'])) {
$alert=$_GET['alert'];
$error=$_GET['error'];
$show=$_GET['show'];
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
  
<!-- Mirrored from designing-world.com/suha-v2.1.0/register.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 17 Sep 2020 08:35:01 GMT -->
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
    <title>New User Registration</title>
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
    <!-- Login Wrapper Area-->
    <div class="login-wrapper d-flex align-items-center justify-content-center text-center">
      <!-- Background Shape-->
      <div class="background-shape"></div>
      <div class="container">	  
        <div class="row justify-content-center">
          <div class="col-12 col-sm-9 col-md-7 col-lg-6 col-xl-5"><img class="big-logo" src="img/core-img/logo-small.png" alt="">
            <!-- Register Form-->
			<div class="alert <?php echo $alert; ?>" role="alert" style="<?php echo $show; ?>"><?php echo $error; ?></div>
            <div class="register-form mt-5 px-4">
              <form action="./otp.php" method="POST">
                <div class="form-group text-left mb-4"><span>Username</span>
                  <label for="username"><i class="lni lni-user"></i></label>
                  <input class="form-control" name="eusername" id="eusername" type="text" placeholder="Name" required>
                </div>
                <div class="form-group text-left mb-4"><span>Mobile Number</span>
                  <label for="mobile"><i class="lni lni-phone"></i></label>
                  <input class="form-control" name="mobile" id="mobile" type="number" placeholder="Mobile Number" required>
                </div>
                <div class="form-group text-left mb-4"><span>Password</span>
                  <label for="password"><i class="lni lni-lock"></i></label>
                  <input class="input-psswd form-control" name="registerPassword" id="registerPassword" type="password" placeholder="********************" required>
                </div>				
				<div class="form-group text-left mb-4"><span>Location / City</span>
                  <label for="address"><i class="lni lni-home"></i></label>
                  <input class="form-control" name="address" id="address" type="text" placeholder="City" required>
                </div>
                <button class="btn btn-success btn-lg w-100" name="submitsignup" type="submit">Sign Up</button>
              </form>
            </div>
            <!-- Login Meta-->
            <div class="login-meta-data">
              <p class="mt-3 mb-0">Already have an account?<a class="ml-1" href="login.php">Sign In</a></p>
            </div>
          </div>
        </div>
      </div>
    </div>
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

<!-- Mirrored from designing-world.com/suha-v2.1.0/register.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 17 Sep 2020 08:35:01 GMT -->
</html>