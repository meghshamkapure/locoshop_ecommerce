<?php 	
//require_once 'core.php';
require_once 'conn.php';
$valid['success'] = array('success' => false, 'messages' => array());
$order_item_id = $_POST['order_item_id'];
if($order_item_id) { 
 $sql = "Update order_item SET order_item_status=0 WHERE order_item_id = $order_item_id";
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