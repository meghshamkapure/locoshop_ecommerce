<?php
$error="";
$show="display:none;";
$alert="";
include('./lock.php');
include('./conn.php');
//fetch Company Details
if (isset($_GET['sid'])) {
	$sid=$_GET['sid'];	
}
else{
	header('Location:./seller_list.php');
}
$sql = "SELECT * FROM seller WHERE sid = $sid";
$query = $conn->query($sql);
while ($result = $query->fetch_assoc()) {
	$sid = $result['sid'];
	$sname = $result['sname'];
	$smob = $result['smob'];
	$spass = $result['spass'];
	$altmob = $result['altmob'];
	$email = $result['email'];
	$gst = $result['gst'];
	$bank_name = $result['bank_name'];
	$ac_name = $result['ac_name'];
	$ac_no = $result['ac_no'];
	$ifsc = $result['ifsc'];
	$address = $result['address'];
	$pincode = $result['pincode'];
	$regdate = $result['regdate'];
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
  <title>My Profile</title>
  <link rel="shortcut icon" type="image/x-icon" href="./images/favicon.ico" />
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="./resources/bootstrap-3.3.6-dist/css/bootstrap.min.css">
  <script src="./resources/bootstrap-3.3.6-dist/js/jquery.min.js"></script>
  <script src="./resources/bootstrap-3.3.6-dist/js/bootstrap.min.js"></script>
   <script src="./activemenu.js"></script>
   <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
    <script
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyA98Q7bgqRSax-gSZJW9eBG9OUJmPomZIw&callback=initMap&libraries=&v=weekly"
      defer
    ></script>
    <style type="text/css">
      /* Always set the map height explicitly to define the size of the div
       * element that contains the map. */
      #map {
        height: 400px;
      }

      /* Optional: Makes the sample page fill the window. */
      html,
      body {
        height: 100%;
        margin: 0;
        padding: 0;
      }
    </style>
    <script>
      // In this example, we center the map, and add a marker, using a LatLng object
      // literal instead of a google.maps.LatLng object. LatLng object literals are
      // a convenient way to add a LatLng coordinate and, in most cases, can be used
      // in place of a google.maps.LatLng object.
      let map;

      function initMap() {
        const mapOptions = {
          zoom: 14,
          center: { lat: <?php echo $latitude; ?>, lng: <?php echo $longitude; ?> },
        };
        map = new google.maps.Map(document.getElementById("map"), mapOptions);
        const marker = new google.maps.Marker({
          // The below line is equivalent to writing:
          // position: new google.maps.LatLng(-34.397, 150.644)
          position: { lat: <?php echo $latitude; ?>, lng: <?php echo $longitude; ?> },
          map: map,
        });
        // You can use a LatLng literal in place of a google.maps.LatLng object when
        // creating the Marker object. Once the Marker object is instantiated, its
        // position will be available as a google.maps.LatLng object. In this case,
        // we retrieve the marker's position using the
        // google.maps.LatLng.getPosition() method.
        const infowindow = new google.maps.InfoWindow({
          content: "<p>Marker Location:" + marker.getPosition() + "</p>",
        });
        google.maps.event.addListener(marker, "click", () => {
          infowindow.open(map, marker);
        });
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
        <h2 align="center" class="page-title remove-top-padding">Seller Profile</h2>
         <div class="row">         
		<div class="col-sm-8 col-md-12 col-lg-12">
            <div class="panel panel-info" style="border-color: #004c91;">
              <div class="panel-heading" style="color: #ffffff;background-color: #004c91;border-color: #004c91;">
                <div class="panel-caption">
                  <h3 class="panel-title">Seller Profile<a class="pull-right" style="color:white" align="right" href="edit_seller_profile.php?sid=<?php echo $sid;?>" >Edit Profile</a></h3>
				   
                </div>
              </div>
              <div class="panel-body">
                <div class="row">
                  <div class="col-md-4 col-lg-3"> 						  
                          
						  <a href="#"><img src="../zel_seller/images/login.png" width="152" height="152" class="thumbnail" /></a>
                          </div>
                  <div class="col-md-8 col-lg-9">
                    <h4><?php echo $sname." ( - ID ". $sid." )"; ?></h4>
                    <div class="row">
                      <div class="col-lg-6">
                        <table class="table table-condensed table-user-information">
                          <tbody>
						  <tr>
                              <td class="col-xs-4 col-sm-4">Seller Name</td>
                              <td><span>:</span>  <?php echo $sname; ?></td>
                            </tr>	
							<tr>
                              <td class="col-xs-4 col-sm-4">Mobile Number</td>
                              <td><span>:</span> <?php echo $smob;?></td>
                            </tr>							
							<tr>
                              <td class="col-xs-4 col-sm-4">Password </td>
                              <td><span>:</span> <?php echo $spass; ?>  </td>
                            </tr>
							<tr>
                              <td class="col-xs-4 col-sm-4">Alt Mobile </td>
                              <td><span>:</span> <?php echo $altmob; ?>  </td>
                            </tr>
							<tr>
                              <td class="col-xs-4 col-sm-4">GST Number </td>
                              <td><span>:</span> <?php echo $gst; ?>  </td>
                            </tr>
							<tr>
                              <td class="col-xs-4 col-sm-4">Address</td>
                              <td><span>:</span> <?php echo $address;?></td>
                            </tr>
                          </tbody>
                        </table>
                      </div>
                      <div class="col-lg-6">
                        <table class="table table-condensed table-user-information">
                          <tbody>
							<tr>
                              <td class="col-xs-4 col-sm-4">Bank Name</td>
                              <td><span>:</span> <?php echo $bank_name;?></td>
                            </tr>
							<tr>
                              <td class="col-xs-4 col-sm-4">Account Name</td>
                              <td><span>:</span> <?php echo $ac_name;?></td>
                            </tr>
							<tr>
                              <td class="col-xs-4 col-sm-4">Account Number</td>
                              <td><span>:</span> <?php echo $ac_no;?></td>
                            </tr>
							<tr>
                              <td class="col-xs-4 col-sm-4">IFSC Code</td>
                              <td><span>:</span> <?php echo $ifsc;?></td>
                            </tr>							
							<tr>
                              <td class="col-xs-4 col-sm-4">PIN Code</td>
                              <td><span>:</span> <?php echo $pincode;?></td>
                            </tr>
							<tr>
                              <td class="col-xs-4 col-sm-4">Registration Date</td>
                              <td><span>:</span> <?php echo date( 'd/m/Y', strtotime($regdate));?></td>
                            </tr>																							
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
<!--Footer-->
<?php
include('./footer.php');
?>  
</body>
</html>