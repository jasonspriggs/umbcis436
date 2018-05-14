<?php
require_once('functions.php');

if(session_is_logged_in()) {
	if(!isset($_GET['pg']) || empty($_GET['pg'])) {
		die(header("Location: /admin"));
	} else if($_GET['pg'] == "admin") {
		require('admin.php');
	} else if($_GET['pg'] == "logout") {
		session_logout_user();
		header("Location: /login");
	} else {
		http_response_code(404);
		die("Page Not Found");
	}
} else {
	if(!isset($_GET['pg']) || empty($_GET['pg'])) {
		die(header("Location: /home"));
	} else if($_GET['pg'] == "home") {
		require('home.php');
	} else if($_GET['pg'] == "account") {
		require('account.php');
	} else if($_GET['pg'] == "search") {
		require('search.php');
	} else if($_GET['pg'] == "login") {
		require('login.php');
	} else {
		http_response_code(404);
		die(header("Location: /home"));
	}
}