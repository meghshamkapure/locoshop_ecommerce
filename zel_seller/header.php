<nav class="navbar navbar-default" style="background-color: #004c91">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" style="border-color: #fff;" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span style="background-color: #fff;" class="icon-bar"></span>
        <span style="background-color: #fff;" class="icon-bar"></span>
        <span style="background-color: #fff;" class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#" style="color: white"> Seller Panel </a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li><a href="./dashboard.php" style="color: white">Home</a></li>
		<li><a href="./add_products.php" style="color: white">Add Products</a></li>    
		<li><a href="./order_add.php" style="display:none;color: white">Add Orders</a></li>        
		<li><a href="./order_list.php" style="color: white">Manage Orders</a></li>   
      </ul>
      
      <ul class="nav navbar-nav navbar-right">
       
        <li class="dropdown">
          <?php if($login_session)  
        {   
            $status="Welcome ".$login_session; 
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
          <a href="" style="background-color: #004c91;color: white"class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php echo $status; ?><span class="caret"></span></a>
          <ul class="dropdown-menu" style="background-color: #004c91;">  
           <li><a href="./changepass.php" style="color: white">Change Password</a></li>
           <li><a href="./profile.php" style="color: white">My Profile</a></li>
		    <li role="separator" class="divider"></li>          
            <li><a href="<?php echo  $url; ?>" style="color: white"><?php echo $status1; ?></a></li>
          </ul>
        </li>
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>