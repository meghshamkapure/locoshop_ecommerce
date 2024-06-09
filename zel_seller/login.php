<?php
$error="";
$show="display:none;";
include("conn.php");
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
 if(isset($_SESSION['login_seller']))
{
  header("Location:./dashboard.php");
  exit;
}
 $active=null;
 $user_type=null;
if($_SERVER["REQUEST_METHOD"] == "POST")
{
$myusername=addslashes($_POST['txtuname']); 
$mypassword=addslashes($_POST['inputPassword']); 
$sql="SELECT status FROM seller WHERE smob='$myusername' and spass='$mypassword' AND (status=1 OR status=2)";
$result = $conn->query($sql);
while($row = $result->fetch_assoc()) {
    $active=$row['status'];
}
$count=$result->num_rows;
if($active!=0)
{
$_SESSION['login_seller']=$myusername;
header("location:./dashboard.php");
die(); 
}
  $error="Your Login Name or Password is invalid";
  $show="display:show;";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title> Login</title>
  <link rel="shortcut icon" type="image/x-icon" href="./images/favicon.ico" />
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="description" content=" ." />
<meta name="keywords" content="." />
  <link rel="stylesheet" href="./resources/bootstrap-3.3.6-dist/css/bootstrap.min.css">
  <script src="./resources/bootstrap-3.3.6-dist/js/jquery.min.js"></script>
  <script src="./resources/bootstrap-3.3.6-dist/js/bootstrap.min.js"></script>
</head>
<body>
<nav class="navbar navbar-default" style="background-color: #004c91">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" style="border-color: #fff;" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span style="background-color: #fff;" class="icon-bar"></span>
        <span style="background-color: #fff;" class="icon-bar"></span>
        <span style="background-color: #fff;" class="icon-bar"></span>                        
      </button>
      <a class="navbar-brand" style="color: white" href="#"> Seller Panel </a>
    </div>
    <div class="collapse navbar-collapse navbar-right" id="myNavbar">
      <ul class="nav navbar-nav">
        <li><a style="color: white" href="register.php">Create An Account</a></li>
      </ul>
     <!-- <ul class="nav navbar-nav navbar-right">    
        <li>
          <a href="./signup.php"><span class="glyphicon glyphicon-user"></span> Signup</a></li>
        <li><a href="login.php"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
      </ul>-->
    </div>
  </div>
</nav>
<div class="container" style="margin-top: 20px">
<div class="row">
<div class="col-md-4">
  <!--<img src="./images/diamond.jpg" class="img-responsive"/>-->
</div>
  <div class = "col-md-4" align="center">
<img src="./images/login.png">
<div class="panel panel-info" style="border-color: #004c91;">
      <div class="panel-heading" style="color: #ffffff;background-color: #004c91;border-color: #004c91;" align="center">Sign In</div>
      <div class="panel-body">
 <form data-toggle="validator" role="form" method ="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
  <div class="form-group">
     <input class="form-control" type="text" id="txtuname" name= "txtuname" placeholder="Mobile Number" required>
    <div class="help-block with-errors"></div>
  </div>
  <div class="form-group">
   <input type="password" data-minlength="6" class="form-control" id="inputPassword" name="inputPassword" placeholder="Password" required>
      <div class="help-block"></div>
  </div>
  <div class="form-group" align="center">
    <button type="submit" class="btn btn-info" style="background-color:#004c91">Login</button>
  </div>
</form>
<p><a href="register.php"> Create An Account</a></p>
<!--<div style="font-size:11px; color:#cc0000; margin-top:10px"><?php echo $error; ?></div>-->
<div class="alert alert-danger" role="alert" style="<?php echo $show; ?>"><?php echo $error; ?></div>
</div> <!-- Close panel Body -->
</div> <!-- Close Panel -->
</div> <!-- Close Col -->
<div class="col-md-4">
</div>
</div> <!-- Close Row -->
</div> <!-- Close Container -->
<?php
include('./footer.php');
?>
</body>
</html>