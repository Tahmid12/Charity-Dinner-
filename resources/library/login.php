<?php

require '../config.php';
require 'mysql_queries.php';
require "../templates/successfully_created_user.php";

if (isset($_POST['username']) && isset($_POST['password'])) {
	$username = $_POST['username'];
	$password = $_POST['password'];

	if (user_exists_p($username, $password)) {
			login_user();
	} else {
			echo "Invalid user!";
	}
} else {
	echo "All fields are required!";
}

function login_user()
{
	session_start();
	$_SESSION['sess_user']=$user;
	$_SESSION['sess_id']=$userid;
	$_SESSION['sess_name']=$name;

	/* Redirect browser */
	header('Location: ../../html/host_event.html');
}
?>
