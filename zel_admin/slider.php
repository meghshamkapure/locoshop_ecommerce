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
  $uidsend=$user_id;
//********************************************************************************************************
	$slider_name = test_input($_POST["slider_name"]);
	 $today=date('Y-m-d');
     $sql = "SELECT * FROM slider WHERE slider_name='$slider_name' AND status=1";
	 $query = $conn->query($sql);
	 $count = $query->num_rows;
if(!isset($_FILES['userfile']))
{
  $error="Please Select File To Upload!";
    $show="display:show;";
    $alert="alert alert-danger";
}	 
else if ($count >0){
	$error="Slider Is Already Exist!";
	$show="display:show;";
	$alert="alert alert-danger";	
}
else
{
    try {
    $msg= upload($uidsend);  //this will upload your image
    $error=$msg;
    $show="display:show;";
    $alert="alert alert-info";
    //echo $msg;  //Message showing success or failure.
    }
    catch(Exception $e) {
    echo $e->getMessage();
    //echo 'Sorry, could not upload file';
    $error="Sorry, could not upload file";
    $show="display:show;";
    $alert="alert alert-danger";
    }
}
	  header( "Refresh:3; url=./slider.php?alert=$alert&show=$show&error=$error", true, 303);
}
}
//***********************************************************************************************************
function upload($uidsend) {
   $msg=null;
  include ("conn.php");
	 $slider_name = test_input($_POST["slider_name"]);
	 $today=date('Y-m-d');
     $uid=$uidsend;
    $maxsize = 900000; //set to approx 900 KB
    if($_FILES['userfile']['error']==UPLOAD_ERR_OK) {
        if(is_uploaded_file($_FILES['userfile']['tmp_name'])) {    
            if( $_FILES['userfile']['size'] < $maxsize) {  
                 $finfo = finfo_open(FILEINFO_MIME_TYPE);
                if(strpos(finfo_file($finfo, $_FILES['userfile']['tmp_name']),"image")===0) {    
                    $imgData =addslashes (file_get_contents($_FILES['userfile']['tmp_name']));
					$temp = explode(".", $_FILES["userfile"]["name"]);
					$newfilename = $uid."_".date("Ymdhis").'.' . end($temp);
					move_uploaded_file($_FILES['userfile']['tmp_name'],"./uploads/slider/".$newfilename);
					$imgpath="/uploads/slider/".$newfilename;
                    $sql = "INSERT INTO slider (slider_name, imgpath, regdate, status, uid) 
							VALUES ('$slider_name', '$imgpath','$today', 1, $uid)";
                    if($conn->query($sql)===TRUE){
                    $msg='<p>Slider Is Updated successfully !</p>';
                    }                  
                }
                else
                    $msg="<p>Uploaded file is not an image.</p>";
            }
             else {
                $msg='<div>File exceeds the Maximum File limit</div>
                <div>Maximum File limit is '.$maxsize.' bytes</div>
                <div>File '.$_FILES['userfile']['name'].' is '.$_FILES['userfile']['size'].
                ' bytes</div><hr />';
                }
        }
        else
		{
            $msg="File not uploaded successfully.";
		}
    }
    else {
        $msg= file_upload_error_message($_FILES['userfile']['error']);
    }
    return $msg;
}
//*********************************************************************************************************************
function file_upload_error_message($error_code) {
    switch ($error_code) {
        case UPLOAD_ERR_INI_SIZE:
            return 'The uploaded file exceeds the upload_max_filesize directive in php.ini';
        case UPLOAD_ERR_FORM_SIZE:
            return 'The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form';
        case UPLOAD_ERR_PARTIAL:
            return 'The uploaded file was only partially uploaded';
        case UPLOAD_ERR_NO_FILE:
            return 'No file was uploaded';
        case UPLOAD_ERR_NO_TMP_DIR:
            return 'Missing a temporary folder';
        case UPLOAD_ERR_CANT_WRITE:
            return 'Failed to write file to disk';
        case UPLOAD_ERR_EXTENSION:
            return 'File upload stopped by extension';
        default:
            return 'Unknown upload error';
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
 <title> Update Sliders </title>
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
<div class="panel panel-info" style="border-color: #004c91;">
      <div class="panel-heading" style="color: #ffffff;background-color: #004c91;border-color: #004c91;" align="center">Update Sliders </div>
      <div class="panel-body">
 <form enctype="multipart/form-data" data-toggle="validator" role="form" method="post" action="">
  <div class="form-group">
   <label class="control-label">Enter Slider Name</label>
    <input class="form-control" type="text" id="slider_name" name= "slider_name" placeholder="Enter Slider Name" required>
  </div>
  <div class="form-group">
  <label class="control-label">Image Size Limit Max 900 kb (Resolution widht=1900 Px & Height=540 px)</label>
  <input class="form-control" name="userfile" type="file" />
 </div>
  <div class="form-group" align="center">
    <button type="submit" class="btn btn-info" name="submit" style="background-color: #004c91;">Add Slider</button>
  </div>
</form>
</div> <!-- Close panel Body -->
</div> <!-- Close Panel -->
</div> <!-- Close Col -->
<div class="col-md-8">
<div class="panel panel-info" style="border-color: #004c91;">
      <div class="panel-heading" style="color: #ffffff;background-color: #004c91;border-color: #004c91;" align="center">Slider Details</div>
      <div class="panel-body">
        <div class='table-responsive'>
      <?php
      include('./conn.php');
      error_reporting(E_ALL);
      $sql = "SELECT * FROM slider WHERE status=1 ORDER BY slider_id DESC";
      $result = $conn->query($sql);
      if ($result->num_rows > 0) {
          echo "<table class='table table-striped'>
          <thead>
            <tr>
              <th>Image</th>
              <th>Slider Name</th>
              <th>Added Date</th>
              <th>Action</th>
           </tr>
          </thead>
          <tbody>";
          while($row = $result->fetch_assoc()) {            
           echo"<tr>";
		   echo "<td><img src='./".$row['imgpath']."' height='75' width='150'/></td>";              
              echo "<td>".$row['slider_name']."</td>";
              echo "<td>".date( 'd/m/Y', strtotime($row['regdate']))."</td>";
              echo  "<td> <button type='submit' class='btn btn-default btn-sm' onclick='delete_slider(".$row['slider_id'].")' name ='btndel' id='btndel'> <span class='glyphicon glyphicon-trash'></span> Delete</button></td>";
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