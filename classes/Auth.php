<?php
// require_once 'DB.php';
require_once 'user.php';

// authentication
session_start();
class Auth {
	public static function id() {
		if (static::check()) {
			return $_SESSION['user_id'];
		}
		return null;
	}

	public static function guest() {
		return empty($_SESSION['user_id']);
	}

	public static function check() {
		return isset($_SESSION['user_id']);
	}

	public static function user() {
		if (static::check()) {
			return User::get_user($_SESSION['user_id']);
		}
		return null;
	}
}

// Auth::id();
// Auth::guest();
// Auth::check();
// $user = Auth::user();
