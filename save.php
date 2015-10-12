<?php
session_start();
include_once('db.php'); 
if(isset($_POST['posx']) && isset($_POST['posy']) && isset($_POST['rotate']) && isset($_POST['sessid'])){
	foreach($_POST as $k => $v){
		$_SESSION[$k] = $v;
	}
	$posx = $_POST['posx'];
	$posy = $_POST['posy'];
	$rotate = $_POST['rotate'];
	$sessid = $_POST['sessid'];
	$time = date('Y-m-d H:i:s');
	mysqli_query($con,"INSERT INTO tb_session_detail (parentid,xpos,ypos,face,created) VALUES ('$sessid','$posx','$posy','$rotate','$time')");
	return true;
}
return false;
?>