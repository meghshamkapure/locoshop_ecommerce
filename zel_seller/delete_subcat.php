<?php 	
//require_once 'core.php';
require_once 'conn.php';
$valid['success'] = array('success' => false, 'messages' => array());
$scid = $_POST['scid'];
if($scid) { 
 $sql = "UPDATE sub_category SET status=0 WHERE sc_id = $scid";
 if($conn->query($sql) === TRUE ) {
 	$valid['success'] = true;
	$valid['messages'] = "Successfully Removed";		
 } else {
 	$valid['success'] = false;
 	$valid['messages'] = "Error while remove the brand";
 }
 $conn->close();
 echo json_encode($valid);
} // /if $_POST