<?php
	$user_check = $_SESSION['login_user'];
	if(!isset($user_check)){
		header("location: login.php");
	}
?>
