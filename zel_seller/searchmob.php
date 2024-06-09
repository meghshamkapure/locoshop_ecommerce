<?php
include('conn.php');
if (isset($_GET['term'])){
	$return_arr = array();
	try {
	    $conn = new PDO("mysql:host=".$servername.";port=3306;dbname=".$database, $username, $password);
	    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	    $stmt = $conn->prepare('SELECT mob FROM franchise WHERE mob LIKE :term and fr_status=1');
	    $stmt->execute(array('term' => '%'.$_GET['term'].'%'));
	    while($row = $stmt->fetch()) {
	        $return_arr[] =  $row['mob'];
	    }
	} catch(PDOException $e) {
	    echo 'ERROR: ' . $e->getMessage();
	}
    /* Toss back results as json encoded array. */
    echo json_encode($return_arr);
}
?>