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
	$sc_id = test_input($_POST["sc_id"]);
	$pname = test_input($_POST["pname"]);
	 $today=date('Y-m-d');
     $sql = "SELECT * FROM products WHERE pname='$pname' AND sc_id=$sc_id AND status=1";
	 $query = $conn->query($sql);
	 $count = $query->num_rows;
if(!isset($_FILES['userfile']))
{
  $error="Please Select File To Upload!";
    $show="display:show;";
    $alert="alert alert-danger";
}	 
else if ($count >0){
	$error="Product Is Already Exist!";
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
header( "Refresh:3; url=./add_products.php?alert=$alert&show=$show&error=$error", true, 303);
}
}
//***********************************************************************************************************
function upload($uidsend) {
   $msg=null;
  include ("conn.php");
     $sc_id = test_input($_POST["sc_id"]);
	 $pname = test_input($_POST["pname"]);
	 $manufacturer = test_input($_POST["manufacturer"]);
	 $pur_price = test_input($_POST["pur_price"]);
	 $full_price = test_input($_POST["full_price"]);
	 $pdesc = test_input($_POST["pdesc"]);
	 $color = test_input($_POST["color"]);
	 $size = test_input($_POST["size"]);
	 $price = test_input($_POST["price"]);
	 $avbl_qty = test_input($_POST["avbl_qty"]);
	 $cod = test_input($_POST["cod"]);
	 $delivery_charges = test_input($_POST["delivery_charges"]);
	 $today=date('Y-m-d');
     $uid=$uidsend;
    $maxsize = 900000; //set to approx 300 KB
    if($_FILES['userfile']['error']==UPLOAD_ERR_OK) {
        if(is_uploaded_file($_FILES['userfile']['tmp_name'])) {    
            if( $_FILES['userfile']['size'] < $maxsize) {  
                 $finfo = finfo_open(FILEINFO_MIME_TYPE);
                if(strpos(finfo_file($finfo, $_FILES['userfile']['tmp_name']),"image")===0) {    
                    $imgData =addslashes (file_get_contents($_FILES['userfile']['tmp_name']));
					$temp = explode(".", $_FILES["userfile"]["name"]);
					$newfilename = $uid."_".date("Ymdhis").'.' . end($temp);
					move_uploaded_file($_FILES['userfile']['tmp_name'],"./uploads/products/".$newfilename);
					$imgpath="/uploads/products/".$newfilename;
                    $sql = "INSERT INTO products (pname, manufacturer, color,size,avbl_qty, pur_price, full_price, pdesc, cod, delivery_charges, imgpath, sc_id, sid, regdate, status) 
							VALUES ('$pname', '$manufacturer', '$color','$size','$avbl_qty', '$pur_price','$full_price', '$pdesc','$cod','$delivery_charges', '$imgpath', $sc_id, $uid, '$today', 1)";							
                    if($conn->query($sql)===TRUE){
						$pid = $conn->insert_id;
						$sql = "INSERT INTO rate (pid, price, rate_status, rate_date, sid) 
							VALUES ($pid, '$price', 1, '$today', $uid)";
						if($conn->query($sql)===TRUE){							
						$msg='<p>Product and Price Is Updated successfully !</p>';
						}
						$filecount=count($_FILES['otherfile']['name']);
						for($i=0; $i<$filecount; $i++){
							if($_FILES['otherfile']['error'][$i]==UPLOAD_ERR_OK) {
								if(is_uploaded_file($_FILES['otherfile']['tmp_name'][$i])) {    
									if( $_FILES['otherfile']['size'][$i] < $maxsize) {  
										 $finfo = finfo_open(FILEINFO_MIME_TYPE);
										if(strpos(finfo_file($finfo, $_FILES['otherfile']['tmp_name'][$i]),"image")===0) {    
											$imgData =addslashes (file_get_contents($_FILES['otherfile']['tmp_name'][$i]));
											$temp = explode(".", $_FILES["otherfile"]["name"][$i]);
											$newfilename = $uid."_".$i."_".date("Ymdhis").'.' . end($temp);
											move_uploaded_file($_FILES['otherfile']['tmp_name'][$i],"./uploads/products_images/".$newfilename);
											$imgpath="/uploads/products_images/".$newfilename;
											$sql = "INSERT INTO product_img ( imgpath, status, pid, sid)VALUES ('$imgpath', 1, $pid, $uid)";
											$conn->query($sql);							  
										}
									}
								}
							}
							
						}						
					$msg='<p>Product Is Updated successfully !</p>';
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
 <title> Add Products </title>
  <link rel="shortcut icon" type="image/x-icon" href="./images/favicon.ico" />
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
 <link rel="stylesheet" href="./resources/bootstrap-3.3.6-dist/css/bootstrap.min.css">
  <script src="./resources/bootstrap-3.3.6-dist/js/jquery.min.js"></script>
  <script src="./resources/bootstrap-3.3.6-dist/js/bootstrap.min.js"></script>
  <script src="./sss.js"></script>
  <script>
  function addnewline(){
	  text=document.getElementById('pdesc').value;
	  text=text.replace(/ /g, "[sp][sp]");
	  text=text.replace(/\n/g, "[nl]");
	  document.getElementById('pdesc').value=text;
	  return false;
  }
  </script>
</head>
<body>
<?php
include('./header.php');
?>
<div class="container-fluid" style="margin-top:20px">
<div class="row">
    <div class="col-md-12">
      <div align="center" class="<?php echo $alert; ?>" role="alert" style="<?php echo $show; ?>"><?php echo $error; ?></div>
    </div> <!-- close col-->
  </div> <!--close row-->
<div class="row">
  <div class = "col-md-3">
<!--<div class="alert alert-success alert-sm" role="alert" id="signalert" style="display:show;">Well done! You successfully Signup!</div> -->
<div class="panel panel-info" style="border-color: #004c91;">
      <div class="panel-heading" style="color: #ffffff;background-color: #004c91;border-color: #004c91;" align="center">Add Products </div>
      <div class="panel-body">
 <form enctype="multipart/form-data" data-toggle="validator" onsubmit="addnewline();" role="form" method="post" action="">
   <div class="form-group">
        <label class="control-label">Select Subcategory </label>
            <select class="form-control" id="sc_id" name="sc_id" required>
              <option value="">Select Subcategory</option>
			  <?php
				$query = "SELECT sc_id, sc_name from sub_category where status=1 ORDER BY sc_name ASC";
				$result = $conn->query($query);  
					while($row = $result->fetch_assoc()) {                                                 
					echo "<option value='".$row['sc_id']."'>".$row['sc_name']."</option>";
					}
				?>     
            </select>
    </div>
  <div class="form-group">
   <label class="control-label">Enter Product Name</label>
    <input class="form-control" type="text" id="pname" name= "pname" placeholder="Enter Product Name" required>
  </div>
  <div class="form-group">
   <label class="control-label">Enter Product Manufacturer</label>
    <input class="form-control" type="text" id="manufacturer" name= "manufacturer" placeholder="Enter Nanufacturer Name" required>
  </div>
  <div class="form-group">
   <label class="control-label">Enter Purchase Price</label>
    <input class="form-control" type="number" id="pur_price" name= "pur_price" value="0.00" placeholder="Enter Purchase Price" required>
  </div>
  <div class="form-group">
   <label class="control-label">Enter sale Price</label>
    <input class="form-control" type="number" id="price" name= "price" value="0.00" placeholder="Enter Sale Price" required>
  </div> 
  <div class="form-group">
   <label class="control-label">Enter Full Price</label>
    <input class="form-control" type="number" id="full_price" name= "full_price" value="0.00" placeholder="Enter Full Price" required>
  </div> 
  <div class="form-group">
   <label class="control-label">Color</label>
    <input class="form-control" type="text" id="color" name= "color" placeholder="Enter Available Color" required>
  </div>
  <div class="form-group">
   <label class="control-label">Product Size</label>
    <input class="form-control" type="text" id="size" name= "size" placeholder="Enter Product Size" required>
  </div>
  <div class="form-group">
   <label class="control-label">Available Quantity</label>
    <input class="form-control" type="text" id="avbl_qty" name= "avbl_qty" value="0.00" placeholder="Enter Available Quantity" required>
  </div>   
  <div class="form-group">
	<label class="control-label">Select COD Availability </label>
		<select class="form-control" id="cod" name="cod" required>
		  <option value="">Select COD</option>
		 <option value="Available">Available</option>					  
		 <option value="Not Available">Not Available</option>					  					  
		</select>
  </div>
  <div class="form-group">
	<label class="control-label">Select Delivery Charges </label>
		<select class="form-control" id="delivery_charges" name="delivery_charges" required>
		  <option value="">Select Delivery Charges</option>
		 <option value="Applicable">Delivery Charges Applicable</option>					  
		 <option value="Not Applicable">Delivery Charges Not Applicable</option>					  
					  					  
		</select>
  </div>
  <div class="form-group">
   <label class="control-label">Enter Product Description</label>
    <textarea class="form-control" rows="4" id="pdesc" name= "pdesc" placeholder="Enter Description" required></textarea>
  </div>
  <div class="form-group">
  <label class="control-label">Image Size Limit Max 300 kb (Resolution widht=500 Px & Height=600 px)</label>
  <input class="form-control" name="userfile" type="file" required/>
 </div>
 <div class="form-group">
  <label class="control-label">Other Images</label>
  <input class="form-control" name="otherfile[]" type="file" multiple />
 </div>
  <div class="form-group" align="center">
    <button type="submit" class="btn btn-info" name="submit" style="background-color: #004c91;">Add Product</button>
  </div>
</form>
</div> <!-- Close panel Body -->
</div> <!-- Close Panel -->
</div> <!-- Close Col -->
<div class="col-md-9">
<div class="panel panel-info" style="border-color: #004c91;">
      <div class="panel-heading" style="color: #ffffff;background-color: #004c91;border-color: #004c91;" align="center">Products Details</div>
      <div class="panel-body">
        <div class='table-responsive'>
      <?php
      include('./conn.php');
      error_reporting(E_ALL);
      $sql = "SELECT p.pid, p.pname, p.manufacturer, p.avbl_qty, p.pur_price, p.pcode, p.hsncode, p.pdesc, p.cod, p.delivery_charges, p.imgpath, p.regdate, sc.sc_name, r.price, r.cgst, r.sgst, r.igst FROM products p, sub_category sc, rate r, seller s WHERE s.sid=p.sid AND sc.sc_id=p.sc_id AND p.pid=r.pid AND r.rate_status=1 AND p.status=1 AND s.sid=$user_id ORDER BY p.pid DESC;";
      $result = $conn->query($sql);
      if ($result->num_rows > 0) {
          echo "<table class='table table-striped'>
          <thead>
            <tr>
              <th>Image</th>
			  <th>Sub Category</th>
              <th>Product Name</th>                            
              <th>Manufacturer</th>                            
              <th>Pur Price</th>              
              <th>Sale Price</th>              
              <th>Quantity Price</th>              
              <th>COD Status</th>              
              <th>Delivery Charges</th>              
              <th>Date</th>
              <th>Description</th>
              <th>Action</th>
           </tr>
          </thead>
          <tbody>";
          while($row = $result->fetch_assoc()) {            
           echo"<tr>";
		   echo "<td><img src='./".$row['imgpath']."' height='50' width='50'/></td>";              
              echo "<td>".$row['sc_name']."</td>";
              echo "<td>".$row['pname']."</td>";              
              echo "<td>".$row['manufacturer']."</td>";              
              echo "<td>".$row['pur_price']."</td>";
              echo "<td>".$row['price']."</td>";
              echo "<td>".$row['avbl_qty']."</td>";
              echo "<td>".$row['cod']."</td>";
              echo "<td>".$row['delivery_charges']."</td>";
              echo "<td>".date( 'd/m/Y', strtotime($row['regdate']))."</td>";
			  $pdesc=$row['pdesc'];
			  $pdesc=preg_replace("#\[sp\]#", "&nbsp;", $pdesc);
			  $pdesc=preg_replace("#\[nl\]#", "<br>\n", $pdesc);
			  echo "<td>".$pdesc."</td>";
              echo  "<td> <button type='submit' class='btn btn-default btn-sm' onclick='delete_product(".$row['pid'].")' name ='btndel' id='btndel'> <span class='glyphicon glyphicon-trash'></span> Delete</button></td>";
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