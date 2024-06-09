<?php
$login_session="" ;
 $url="";
 $status="";
 include('lock.php');
?>
<?php
$error="";
$show="display:none;";
$alert="";
$name ="";
$order_id = "";
$euid = "";
$order_date = "";
$order_status = "";
	if (isset($_GET['order_id'])) {	
		$order_id=$_GET['order_id'];
		// // coding for fetching user name
		$sql1="SELECT * FROM orders WHERE order_id='$order_id' and order_status=1";
		$result = $conn->query($sql1);
		if ($result->num_rows > 0){
			while($row = $result->fetch_assoc()) {
				$order_id = $row["order_id"];
				$euid = $row["euid"];
				$order_date = $row["order_date"];
				$order_status = $row["order_status"];				
			}
				$error="Project Is Found successfully!";
				$show="display:none;";
				$alert="alert alert-success";
				$vis="show";
		}
		else 
		{
			$error='<b>'.$order_id.'</b>'." "."Order Id Is Not Exist!";
			$show="display:show;";
			$alert="alert alert-danger";
		}
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
<head>
  <title>Edit Order</title>
  <link rel="shortcut icon" type="image/x-icon" href="./images/favicon.ico" />
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="./resources/bootstrap-3.3.6-dist/css/bootstrap.min.css">
  <script src="./resources/bootstrap-3.3.6-dist/js/jquery.min.js"></script>
  <script src="./resources/bootstrap-3.3.6-dist/js/bootstrap.min.js"></script>
   <script src="./activemenu.js"></script>
	<script src="./order_items.js"></script>
	<script src="./sss.js"></script>
</head>
<body id="addcutomer">
<?php
include('./header.php');
?>
<div class="container">
<div class="row">
<div class = "col-md-12">
<!--<div class="alert alert-success alert-sm" role="alert" id="signalert" style="display:show;">Well done! You successfully Signup!</div> -->
<div class="panel panel-info">
      <div class="panel-heading" align="center">Edit Order <a class="pull-right" align="right" href="./order_list.php"  >Go Back</a></div>
      <div class="panel-body">
<div class="<?php echo $alert; ?>" role="alert" style="<?php echo $show; ?>"><?php echo $error; ?></div>
<div class="form-group">
<form enctype="multipart/form-data" method="POST" action="php_action/order_edit.php" onsubmit="return true;">
	<div class="row">
		<div class="col-md-6">	
		<div class="form-group">
        <label class="control-label">Select Customer User </label>
            <select class="form-control" id="euid" name="euid" required readonly>
			  <?php
				$query = "SELECT euid, euname from end_user where status=1 ORDER BY euname ASC";
				$result = $conn->query($query);  
					while($row = $result->fetch_assoc()) {
					if($row['euid']==$euid){						
					echo "<option selected value='".$row['euid']."'>".$row['euname']."</option>";
					}
					else{
					//echo "<option value='".$row['euid']."'>".$row['euname']."</option>";
					}
					}
				?>     
            </select>
		</div>			 
		</div> 
		<div class="col-md-6">	        	
		<div class="form-group">
		  <label class="control-label">Order Date </label>
			<input class="form-control" type="date" id="txtdate" name= "txtdate" value="<?php echo $order_date; ?>" placeholder="Order Date" required >
			<input class="form-control" type="hidden" id="order_id" name= "order_id" value="<?php echo $order_id; ?>" placeholder="Order Id" required >
		</div>			
		</div>	
	</div>
<hr/>	
	<table class="table" id="productTable">
		<thead>
			<tr>			  			
				<th style="width:30%;">Item Name</th>
				<th style="width:15%;">Quantity</th>
				<th style="width:20%;">Price </th>
				<th style="width:20%;">GST (in %)</th>	
				<th style="width:15%;">Sub Amount</th>	
				<th style="width:5%;">Action</th>
			</tr>
		</thead>
		<tbody>
			<?php 
			if($order_id!=null){
		  $sql = "SELECT * FROM order_item oi, rate r  WHERE r.rate_id=oi.rate_id AND order_id=$order_id AND order_item_status=1";
			}
			else{
				$sql = "SELECT * FROM order_item WHERE order_id=0 AND order_item_status=1";
			}
		  $result = $conn->query($sql);
		  if ($result->num_rows > 0) {
		  $x=0;
		  $y=0;
		  $gst=0;
		  $totalgst=0;
		  $subtotal=0;
		  $total=0;
		   while($row = $result->fetch_assoc()) {
				$x++;
				$gst = $row['cgst'] + $row['sgst'] + $row['igst'];
				$totalgst = $row['price'] * $row['qty'] * $gst / 100;
				$subamt = ($row['price'] * $row['qty']) + $totalgst;
				$total += $subamt;
				echo"<tr id='row".$x."' class='".$y."'>	
				<input type='hidden' name='order_item_idEdit[]' id='order_item_id".$x."' value='".$row['order_item_id']."'/>
				<td>
					<div class='form-group'>
					<select class='form-control' name='productNameEdit[]' id='productName".$x."' onchange='getProductData(".$x.")' >
						<option value=''>~~SELECT~~</option>";

							$productSql = 'SELECT * FROM products WHERE status = 1 ORDER BY pname ASC';
							$productData = $conn->query($productSql);
							while($row1 = $productData->fetch_array()) {	
								if($row1['pid']==$row['pid']){								
								echo "<option selected value='".$row1['pid']."' id='changeProduct".$row1['pid']."'>".$row1['pname']."</option>";
								}
								else{								
								echo "<option value='".$row1['pid']."' id='changeProduct".$row1['pid']."'>".$row1['pname']."</option>";
								}
								} // /while 
					echo"</select>
					</div>
				</td>
				<td>
					<div class='form-group'>
					<input type='number' name='quantityEdit[]' id='quantity".$x."' value='".$row['qty']."' onkeyup='getTotal(".$x.")' autocomplete='off' class='form-control' min='1' />					
					</div>
				</td>				
				<td>
					<input type='text' name='rate[]' id='rate".$x."' value='".$row['price']."' autocomplete='off' disabled='true' class='form-control' />			  					
			  		<input type='hidden' name='rateValueEdit[]' id='rateValue".$x."' value='".$row['rate_id']."' autocomplete='off' class='form-control' />			  					
				</td>							
				<td>
					<input type='text' name='gst[]' id='gst".$x."' value='".$gst."' autocomplete='off' disabled='true' class='form-control' />			  								  					  				
				</td>							
				<td>
					<input type='text' name='total[]' id='total".$x."' value='".$subamt."' autocomplete='off' class='form-control' disabled='true' />			  					
			  		<input type='hidden' name='totalValue[]' id='totalValue".$x."' value='".$subamt."' autocomplete='off' class='form-control' />			  					
				</td>
				<td> 
					<button class='form-control btn btn-default removeProductRowBtn' type='button' onclick='delete_order_item(".$row['order_item_id'].")'><i class='glyphicon glyphicon-trash'></i></button>					
				</td>	
			</tr>";
			$y++;
		   }
	  }
			?>
		</tbody>		  	
	</table>
	<div class="col-md-6">
			  	<div class="form-group">
				    <label for="subTotal" class="col-sm-3 control-label">Total Amount</label>
				    <div class="col-sm-9">
				      <input type="text" class="form-control" value="<?php echo $total; ?>" id="subTotal" name="subTotal" disabled="true" />
				      <input type="hidden" class="form-control" id="subTotalValue" name="subTotalValue" />
				    </div>
				  </div> <!--/form-group-->			  				  		  		 
			  </div> <!--/col-md-6-->

			  <div class="col-md-6">
			  	  <div class="form-group" align="center">
				  <button type="button" class="btn btn-default" onclick="addRow()" id="addRowBtn" data-loading-text="Loading..."> <i class="glyphicon glyphicon-plus-sign"></i> Add New Item </button>
					<button type="submit" class="btn btn-info" name="editorder" id="editorder">Place Order</button>
				  </div>						  
			  </div> <!--/col-md-6-->
</form>
</div> <!-- Form Group-->
</div> <!-- Close panel Body -->
</div> <!-- Close Panel -->
</div> <!-- Close Col -->
</div> <!-- Close Row -->
</div> <!-- Close Container -->
<?php
include('./footer.php');
?>
</body>
</html>