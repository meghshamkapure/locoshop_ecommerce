<?php
$login_session="" ;
 $url="";
 $status="";
 include('lock.php');
 include('conn.php');
$error="";
$show="display:none;";
$alert="";
if (isset($_POST['submit'])){
	if ($_SERVER["REQUEST_METHOD"] == "POST") {
	 $cname = test_input($_POST["txtcatagory"]);
     $sql = "SELECT cat_name FROM category WHERE cat_name='$cname' AND status=1";
	 $query = $conn->query($sql);
	 $count = $query->num_rows;
	 $today=date("Y-m-d");
      if ($count >0){
        $error="Your Category Name Is Already Exist!";
        $show="display:show;";
        $alert="alert alert-danger";		
      }
	  else{
		$sql = "INSERT INTO category (cat_name, regdate, status, uid) VALUES ('$cname', '$today', 1, $user_id)";
		if($conn->query($sql)===TRUE){
			$error="Your Category Name Is Added Successfully!";
			$show="display:show;";
			$alert="alert alert-success";
		}
		else{
			$error="Proccess Is Invalid!";
			$show="display:show;";
			$alert="alert alert-success";
		}
	  }
	  header( "Refresh:3; url=./add_category.php?alert=$alert&show=$show&error=$error", true, 303);
	}
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
<head>
 <title> Update Category </title>
  <link rel="shortcut icon" type="image/x-icon" href="./images/favicon.ico" />
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
 <link rel="stylesheet" href="./resources/bootstrap-3.3.6-dist/css/bootstrap.min.css">
  <script src="./resources/bootstrap-3.3.6-dist/js/jquery.min.js"></script>
  <script src="./resources/bootstrap-3.3.6-dist/js/bootstrap.min.js"></script>
  <script src="./sss.js"></script>
</head>
<body>
<?php
include('./header.php');
?>
<div class="container" style="margin-top:20px">
<div class="row">
    <div class="col-md-12">
      <div align="center" class="<?php echo $alert; ?>" role="alert" style="<?php echo $show; ?>"><?php echo $error; ?></div>
    </div> <!-- close col-->
  </div> <!--close row-->
<div class="row">
  <div class = "col-md-4">
<!--<div class="alert alert-success alert-sm" role="alert" id="signalert" style="display:show;">Well done! You successfully Signup!</div> -->
<div class="panel panel-info"style="border-color: #004c91;">
      <div class="panel-heading" style="color: #ffffff;background-color: #004c91;border-color: #004c91;" align="center">Update Catagory </div>
      <div class="panel-body">
 <form enctype="multipart/form-data" data-toggle="validator" role="form" method="post" action="">
  <div class="form-group">
   <label class="control-label">Enter Catagory Name</label>
    <input class="form-control" type="text" id="txtcatagory" name= "txtcatagory" placeholder="Enter Catagory Name" required>
  </div>
  <div class="form-group" align="center">
    <button type="submit" class="btn btn-info" name="submit" style="background-color:#004c91">Add Catagory</button>
  </div>
</form>
</div> <!-- Close panel Body -->
</div> <!-- Close Panel -->
</div> <!-- Close Col -->
<div class="col-md-8">
<div class="panel panel-info" style="border-color: #004c91;">
      <div class="panel-heading" style="color: #ffffff;background-color: #004c91;border-color: #004c91;" align="center">Catagory Details</div>
      <div class="panel-body">
        <div class='table-responsive'>
      <?php
      include('./conn.php');
      error_reporting(E_ALL);
      $sql = "SELECT * FROM category WHERE status=1 order by cat_name asc;";
      $result = $conn->query($sql);
      if ($result->num_rows > 0) {
          echo "<table class='table table-striped'>
          <thead>
            <tr>
              <th>Catagory Name</th>
              <th>Added Date</th>
              <th>Action</th>
           </tr>
          </thead>
          <tbody>";
          while($row = $result->fetch_assoc()) {            
           echo"<tr>";
              echo "<td>".$row['cat_name']."</td>";
              echo "<td>".date( 'd/m/Y', strtotime($row['regdate']))."</td>";
              echo  "<td> <button type='submit' class='btn btn-default btn-sm' onclick='delete_cat(".$row['cid'].")' name ='btndel' id='btndel'> <span class='glyphicon glyphicon-trash'></span> Delete</button></td>";
           echo "</tr>";
         }
          echo"</tbody>
      </table>";
        }  
        else {
         echo "0 results";
        }
        $conn->close();
        ?> 
      </div>
      </div><!-- Close panel Body -->
</div> <!-- Close Panel -->
</div>
</div> <!-- Close Row -->
</div> <!-- Close Container -->
<?php
include('footer.php');
?>
</body>
</html>