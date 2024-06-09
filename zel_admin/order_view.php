<?php
include('conn.php');
include('lock.php');
   //fetch Company Details
$compsql = "SELECT * FROM company_profile WHERE comp_id = 1";
$compQuery = $conn->query($compsql);
while ($compResult = $compQuery->fetch_assoc()) {
	$comp_id = $compResult['comp_id'];
	$comp_name = $compResult['comp_name'];
	$comp_tag_line = $compResult['comp_tag_line'];
	$pro_pra_name = $compResult['pro_pra_name'];
	$comp_add = $compResult['comp_add'];
	$comp_mob= $compResult['comp_mob'];
	$comp_mob1= $compResult['comp_mob1'];
	$comp_web= $compResult['comp_web'];
}
if (isset($_GET['order_id'])) {	
	$order_id=$_GET['order_id'];
	// // coding for fetching user name
    $sql = "SELECT * FROM orders o, franchise f WHERE f.fr_id=o.fr_id AND o.order_id=$order_id";
    $result = $conn->query($sql);
    if ($result->num_rows > 0){
        while($row = $result->fetch_assoc()) {
			$fr_id = $row["fr_id"];
			$order_id = $row["order_id"];
			$name = $row["name"];
			$mob = $row["mob"];
			$address = $row["address"];
			$altmob = $row["altmob"];
			$shop_location = $row["shop_location"];
			$order_date = $row["order_date"];
			$order_status = $row["order_status"];				
		}
	}
}
			if($order_status==1){
                $order_status="info";      
                $order_remark="Received";      
              }
              else if($order_status==2){
                $order_status="success";  
				$order_remark="Delivered";      				
              }
              else if($order_status==0){
                $order_status="danger";
				$order_remark="Cancel";      					
              }
              else if($order_status==3){
                $order_status="warning";  
				$order_remark="Ongoing";      				
              }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>View Order Details</title>
  <link rel="shortcut icon" type="image/x-icon" href="./images/favicon.ico" />
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="./resources/bootstrap-3.3.6-dist/css/bootstrap.min.css">
  <script src="./resources/bootstrap-3.3.6-dist/js/jquery.min.js"></script>
  <script src="./resources/bootstrap-3.3.6-dist/js/bootstrap.min.js"></script>
   <script src="./activemenu.js"></script>
   <script src="./familymember.js"></script>
   <script src="./printreceipt.js"></script>
   <script type="text/javascript">
function printbill(){
//alert("hiiiiiiiiiiii");
var prtContent = document.getElementById("invoice");
var WinPrint = window.open('Todays Cases', 'Todays Cases', 'left=0,top=0,width=800,height=900,toolbar=0,scrollbars=0,status=0');
WinPrint.document.write(prtContent.innerHTML);
WinPrint.document.close();
WinPrint.focus();
WinPrint.print();
WinPrint.close();
}
</script>
</head>
<body id="addcutomer">
<?php
include('./header.php');
?>
  <div class="container">
    <div class="row">
      <div class="col-lg-12 col-md-12">
        <h2 align="center" class="page-title remove-top-padding">Order Details </h2>
         <div class="row">         
		<div class="col-sm-8 col-md-12 col-lg-12">
            <div class="panel panel-info light-pink">
              <div class="panel-heading action-box">
                <div class="panel-caption">
                  <h3 class="panel-title"> Order Details <a class="pull-right" align="right" href="#" onclick=printbill(); >Print Form</a></h3>
                </div>
              </div>
              <div class="panel-body">
                <div class="row">
                  <div class="col-md-12 col-lg-12">
                    <h4><?php echo $name." ( ID ". $fr_id." )"; ?></h4>
                    <div class="row">
                      <div class="col-lg-6">
                        <table class="table table-condensed table-user-information">
                          <tbody>
						    <tr>
                              <td class="col-xs-4 col-sm-4">Mobile</td>
                              <td><span>:</span>  <?php echo $mob; ?></td>
                            </tr>
							<tr>
                              <td class="col-xs-4 col-sm-4">Address</td>
                              <td><span>:</span>  <?php echo $address; ?></td>
                            </tr>
							<tr>
                              <td class="col-xs-4 col-sm-4">Working Status</td>
                              <td><span>:</span>  <?php echo $order_remark; ?></td>
                            </tr>							
                          </tbody>
                        </table>
                      </div>
                      <div class="col-lg-6">
                        <table class="table table-condensed table-user-information">
                          <tbody>
						    <tr>
                              <td class="col-xs-4 col-sm-4">Alternate Mobile </td>
                              <td ><span>:</span> <?php echo $altmob; ?>  </td>
                            </tr>
							<tr>
                              <td class="col-xs-4 col-sm-4">City / Location</td>
                              <td ><span>:</span> <?php echo $shop_location; ?>  </td>
                            </tr>
							<tr>
                              <td class="col-xs-4 col-sm-4">Order Date</td>
                              <td><span>:</span>  <?php echo date('d-m-Y', strtotime($order_date)); ?></td>
                            </tr>                                                        
                          </tbody>
                        </table>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-lg-12">
                    <div class="profile-subhead">
                      <h3 class="triangle">Product Items</h3>
                      <div class="row">
                        <div class="col-lg-12">
                          <table class="table" id="productTable">
							<thead>
								<tr>			  			
									<th style="width:%;">Product Name </th>
									<th style="width:%;">Quantity </th>
									<th style="width:%;">Price </th>
									<th style="width:%;">CGST </th>
									<th style="width:%;">SGST </th>
									<th style="width:%;">IGST </th>
									<th style="width:%;">Amount </th>			  						  			
									<th style="width:%;">Sub Amt </th>			  						  			
								</tr>
							</thead>
							<tbody>
								<?php 
								$sql = "SELECT * FROM order_item oi, products p, rate r WHERE p.pid=oi.pid AND p.pid=r.pid AND order_id=$order_id AND r.rate_status=1 AND order_item_status=1";
								$result = $conn->query($sql);
								if ($result->num_rows > 0) {
									$totalgst=0;
									$subamt=0;
									$totalamt=0;
								while($row = $result->fetch_assoc()) {	
								$totalgst=(($row['qty'] * $row['price']) * ($row['cgst'] + $row['sgst'] + $row['igst']) / 100) ;															
								$subamt=($row['qty'] * $row['price'])+$totalgst;
								$totalamt+=$subamt;
									echo"<tr>								  			
										<td>".$row['pname']."</td>										
										<td>".$row['qty']."</td>							
										<td>".$row['price']."</td>							
										<td>".$row['cgst']."</td>	
										<td>".$row['sgst']."</td>	
										<td>".$row['igst']."</td>											
										<td>".($row['qty'] * $row['price'])."</td>
										<td>".$subamt."</td>
									</tr>";
									}
									echo"<tr>
									<td colspan='7' align='right'> <b>Total Amount:</b></td>
									<td > <b>".$totalamt."</b></td>
									</tr>";
								}
								?>
							</tbody>
						  </table>	
                        </div>
                      </div>
                    </div>
                  </div>
                </div>            
			 </div>
            </div>
          </div>
        </div>
        </div>
      </div>
    </div>
  </div>
<!--Footer-->
<?php
include('./footer.php');
?>  
         <div  id="invoice"  style="border:1px solid #ccc; padding:10px; height:100%; width:590pt; display:none;">
		<div style="text-align:left; border:0px solid #ccc; padding-top:20px; float:left; width:70px;">
            <img src="./images/logo.png">
        </div>
        <div style="text-align:center; border:0px solid #ccc; padding-top:20px;  float:center; width:100%;">
            <b><?php echo $comp_name; ?></b><br/>
            <small><?php echo $comp_tag_line; ?></small><br/>
			<small><?php echo $comp_add.", ".$comp_mob; ?></small><br/>
        </div>       
         <div Style=" clear:both; float:none;"></div>
         <h4 align="center">Order Detail Card</h4><hr/>
         
		<div style="text-align:center; border:0px solid #ccc; float:left; width:690px;">
          <table style= 'width:100%; font-size:13px;' border-collapse: collapse; cellspacing='3'>
          <tbody>
			<tr>
              <td colspan="2" style='text-align:left; font-size:15px; font-style:bold; padding: 0px;'><b><?php echo $name; ?></b></td>
			  <td width="100" style='text-align:left; font-size:15px; font-style:bold; padding: 0px;'><b>Franchise Id</b></td>
			  <td  style='text-align:left; font-size:15px; font-style:bold;  padding: 0px;'> <span>:</span> <b><?php echo $fr_id; ?></b></td>
			</tr>
			<tr>
              <td style='text-align:left;  padding: 3px;'>Mobile Number</td>
              <td style='text-align:left;  padding: 3px;'><span>:</span> <?php echo $mob;?></td>
			  <td style='text-align:left;  padding: 3px;'>Alternate Mobile</td>
              <td style='text-align:left;  padding: 3px;'><span>:</span> <?php echo $altmob; ?></td>
			  </tr>
			<tr>
              <td style='text-align:left;  padding: 3px;'>Address</td>
              <td style='text-align:left;  padding: 3px;'><span>:</span> <?php echo $address; ?></td>
			  <td style='text-align:left;  padding: 3px;'>City Location</td>
              <td style='text-align:left;  padding: 3px;'><span>:</span> <?php echo $shop_location; ?></td>
			</tr>
			<tr>
			  <td style='text-align:left;  padding: 3px;'>Order Status</td>
              <td style='text-align:left;  padding: 3px;'><span>:</span> <?php echo $order_remark; ?></td>
			  <td style='text-align:left;  padding: 3px;'>Order Date</td>
              <td style='text-align:left;  padding: 3px;'><span>:</span>  <?php echo date('d-m-Y', strtotime($order_date)); ?></td>
			</tr>
			          								
          </tbody>
      </table>
	  </div>
	  		<div style=" clear:both; text-align:center; border:0px solid #ccc; float:right; width:100%;">
			<hr/>
			<h5>Product Items Details </h5>
				<table border="1" style= "width:100%; font-size:12px;  border-collapse:collapse;">
					<thead>
						<tr>			  			
					        <th style="width:5%; text-align:left;">Sr. No</th>
					        <th style="width:35%; text-align:left;">Product Name </th>
							<th style="width:8%; text-align:left;">Quantity</th>	  						  			
							<th style="width:8%; text-align:left;">Price</th>	  						  			
							<th style="width:8%; text-align:left;">CGST</th>
							<th style="width:8%; text-align:left;">SGST</th>
							<th style="width:8%; text-align:left;">IGST</th>
							<th style="width:10%; text-align:left;">Amount</th>	  						  			
							<th style="width:10%; text-align:left;">Sub Amount</th>	  						  			
						</tr>
					</thead>
					<tbody>
						<?php 
							$sql = "SELECT * FROM order_item oi, products p, rate r WHERE p.pid=oi.pid AND p.pid=r.pid AND order_id=$order_id AND r.rate_status=1 AND order_item_status=1";
							$result = $conn->query($sql);
							if ($result->num_rows > 0) {
								$totalgst=0;
								$subamt=0;
								$totalamt=0;
								$count=0;
							while($row = $result->fetch_assoc()) {	
							$totalgst=(($row['qty'] * $row['price']) * ($row['cgst'] + $row['sgst'] + $row['igst']) / 100) ;															
							$subamt=($row['qty'] * $row['price'])+$totalgst;
							$totalamt+=$subamt;
							$count++;
							echo"<tr>								  			
								<td style='text-align:left;  padding: 3px;'>".$count."</td>							
								<td style='text-align:left;  padding: 3px;'>".$row['pname']."</td>							
								<td style='text-align:left;  padding: 3px;'>".$row['qty']."</td>					
								<td style='text-align:left;  padding: 3px;'>".$row['price']."</td>					
								<td style='text-align:left;  padding: 3px;'>".$row['cgst']."</td>
								<td style='text-align:left;  padding: 3px;'>".$row['sgst']."</td>
								<td style='text-align:left;  padding: 3px;'>".$row['igst']."</td>
								<td style='text-align:left;  padding: 3px;'>".($row['qty'] * $row['price'])."</td>
								<td style='text-align:left;  padding: 3px;'>".$subamt."</td>
							</tr>";
							}
							echo"<tr>
								<td colspan='8' style='text-align:right;  padding: 3px;'> <b>Total Amount:</b></td>
								<td style='text-align:left;  padding: 3px;'> <b>".$totalamt."</b></td>
								</tr>";
						}
						?>
					</tbody>
				</table>	
	  </div>
	  <div style="text-align:center; border:0px solid #ccc; padding-top:50px;  float:right; width:150px;">
            <p><?php echo $pro_pra_name; ?><br/> Signature</p>
      </div>
</div> <!--Close Invoice-->
</body>
</html>