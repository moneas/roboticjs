<?php
session_start();
if(isset($_POST)){
	foreach($_POST as $k => $v){
		$_SESSION[$k] = $v;
	}
	return true;
}
return false;
?>