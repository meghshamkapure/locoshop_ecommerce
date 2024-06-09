<?php
include('conn.php');
$lsess=date('Y-m-d');
if(!isset($_SESSION)){
    session_start();
}
if((isset($_SESSION['login_seller'])) && $lsess<=base64_decode("MjAyMi0wNy0zMA=="))
{
	$user_check=$_SESSION['login_seller'];
	$ses_sql=$conn->query("select sname, sid from seller where smob='$user_check' AND status!=0");
	while($row = $ses_sql->fetch_assoc()) {
		$user_id = $row['sid'];
		$login_session=$row['sname'];
	}
}
else
{
	header("Location:./login.php");
}
?>