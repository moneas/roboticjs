<?php
session_start();
include_once('db.php'); 
if(isset($_POST['sessid'])){
	$sessid = $_POST['sessid'];
	$time = date('Y-m-d H:i:s');
	mysqli_query($con,"update tb_session set session_finish = '$time' where id = '$sessid'");
	return true;
}
return false;
?>