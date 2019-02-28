<?php

class Login {
	public static function registerLogin($key) {
		$_SESSION['login'] = $key;
	}

	public static function unregisterLogin() {
	    unset($_SESSION['login']);
	    session_unset();
	    //session_destroy();
    }

	public static function isLogged() {
		if(isset($_SESSION['login'])) {
		    return true;
        }
		else false;
	}
}