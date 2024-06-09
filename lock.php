<?php
include('./zel_admin/conn.php');
$lsess=date('Y-m-d');
$login_session="";

if(isset($_COOKIE["member_login"]) && isset($_COOKIE["member_password"])) { 
	$username=$_COOKIE["member_login"];
	$password=$_COOKIE["member_password"];
	$_SESSION['login_euser']=$username;
	$_SESSION['login_password']=$password;
}

if(!isset($_SESSION)){
    session_start();
}
if((isset($_SESSION['login_euser'])) && $lsess<=base64_decode("MjAyMi0wNy0zMA=="))
{
	$username=$_SESSION['login_euser'];
	$password=$_SESSION['login_password'];
	 $ses_sql=$conn->query("select euname, eumob, euid from end_user where eumob='$username' AND eupass='$password' AND status=1 ");
	 while($row = $ses_sql->fetch_assoc()) {
		$user_id = $row['euid'];
		$login_session=$row['eumob'];
		$login_name=$row['euname'];
	}
}
else
{
	header("Location:./login.php");  	
}
?>