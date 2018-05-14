<?php
require_once('config.php');
on_load();

function on_load() {
	session_start();

	$loggedin = session_is_logged_in();
	if(!isset($loggedin)) {
		session_logout_user();
	}

	if($_SESSION['last_csrf_cleanup'] + 86400 < time()) {
 		session_csrf_cleanup();
 	}
}

function change_item_state($item, $user) { 
	global $config;
	$conn = new PDO("mysql:host=" . $config['db']['host'] . ";dbname=" . $config['db']['name'], $config['db']['user'], $config['db']['pass']);
    	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    	$id = get_user_from_library_card($user);
    	$sth = $conn->prepare('SELECT * FROM items WHERE `id` = ?');
	$sth->execute(array($item));
	if($sth->rowCount() == 1) {
		$arr = $sth->fetch(PDO::FETCH_BOTH);
		if($arr['user_id'] == NULL) {
			$sth2 = $conn->prepare('UPDATE items SET user_id = ? WHERE id = ?');
			$sth2->execute(array($id, $item));
			die(header("Location: /admin?err=goodcheckout"));
		} else {
			$sth2 = $conn->prepare('UPDATE items SET user_id = NULL WHERE id = ?');
			$sth2->execute(array($item));
			die(header("Location: /admin?err=goodcheckin"));
		}
	} else {
		die(header("Location: /admin?err=noitem"));
	}
}

function get_user_from_library_card($user) { 
	global $config;
	$conn = new PDO("mysql:host=" . $config['db']['host'] . ";dbname=" . $config['db']['name'], $config['db']['user'], $config['db']['pass']);
    	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    	
    	$sth = $conn->prepare('SELECT id FROM users WHERE `user` = ?');
	$sth->execute(array($user));
	if($sth->rowCount() == 1) {
		$arr = $sth->fetch(PDO::FETCH_BOTH);
		return $arr['id'];
	} else {
		die(header("Location: /admin?err=nouser"));
	}
}

function get_media_name($media_id) { 
	global $config;
	$conn = new PDO("mysql:host=" . $config['db']['host'] . ";dbname=" . $config['db']['name'], $config['db']['user'], $config['db']['pass']);
    	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    	
    	$sth = $conn->prepare('SELECT name FROM media WHERE `id` = ?');
	$sth->execute(array($media_id));
	if($sth->rowCount() == 1) {
		$arr = $sth->fetch(PDO::FETCH_BOTH);
		return $arr['name'];
	} else {
		return "error";
	}
}

function get_checked_out_items($user) { 
	global $config;
	$conn = new PDO("mysql:host=" . $config['db']['host'] . ";dbname=" . $config['db']['name'], $config['db']['user'], $config['db']['pass']);
    	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    	$id = get_user_from_library_card($user);
    	$sth = $conn->prepare('SELECT media_id FROM items WHERE user_id = ?');
	$sth->execute(array($id));
	$arr = $sth->fetchAll(PDO::FETCH_BOTH);
	return $arr;
}

//Session Functions
function randString($length, $charset = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789') {
	$str = '';
	$count = strlen($charset);
	while ($length--) {
		$str .= $charset[mt_rand(0, $count-1)];
	}
	return $str;
}

function session_is_logged_in() {
	if(isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true) {
		return true;
	} else {
		return false;
	}
}

function session_attempt_login($user, $pass) { 
	global $config;
	$conn = new PDO("mysql:host=" . $config['db']['host'] . ";dbname=" . $config['db']['name'], $config['db']['user'], $config['db']['pass']);
    	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    	
    	$sth = $conn->prepare('SELECT * FROM admins WHERE `user` = ?');
	$sth->execute(array($user));
	if($sth->rowCount() == 1) {
		$arr = $sth->fetch(PDO::FETCH_BOTH);
		if(password_verify($pass, $arr['pass'])) {
			session_login_user($arr['id']);
			die(header("Location: /admin"));
		} else {
			die(header("Location: /login?err=badinfo"));
		}
	} else {
		die(header("Location: /login?err=nouser"));
	}
}

function session_login_user($uid) {
	$_SESSION['uid'] = $uid;
	$_SESSION['logged_in'] = true;
	$_SESSION['login_time'] = time();
	session_csrf_cleanup();
}

function session_get_user_id() {
	if(isset($_SESSION['uid'])) {
		return $_SESSION['uid'];
	} else {
		return false;
	}
}

function session_logout_user() {
	session_unset();
	session_destroy();
	session_start();
	$_SESSION['logged_in'] = false;
	$_SESSION['ip'] = $_SERVER['REMOTE_ADDR'];
	session_csrf_cleanup();
}

function session_set_value($name, $value) {
	$_SESSION['vars'][$name] = $value;
}

function session_delete_value($name) {
	unset($_SESSION['vars'][$name]);
}

function session_get_value($name) {
	return $_SESSION['vars'][$name];
}

function session_csrf_add() {
	$value = randString(16);
	$_SESSION['csrf'][$value] = time() + 86400; //1 day expiry
	return $value;
}

function session_csrf_check($value) {
	if(!empty($_SESSION['csrf'][$value]) && time() < $_SESSION['csrf'][$value]) {
		unset($_SESSION['csrf'][$value]);
		return true;
	} else {
		return false;
	}
}

function session_csrf_cleanup() {
	if(isset($_SESSION['csrf']) && sizeof($_SESSION['csrf']) >= 1) {
		foreach($_SESSION['csrf'] as $str => $time) {
			if($time < time()) {
				unset($_SESSION['csrf'][$str]);
			}
		}
	}
	$_SESSION['last_csrf_cleanup'] = time();
}

function csrf_render_html($fieldname = "_csrf") {
	echo csrf_get_html($fieldname);
}

function csrf_get_html($fieldname = "_csrf") {
	return '<input type="hidden" name="' . $fieldname . '" value="' . session_csrf_add() . '" />';
}