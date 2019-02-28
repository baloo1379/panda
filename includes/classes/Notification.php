<?php
/**
 * Created by PhpStorm.
 * User: barte
 * Date: 27.02.2019
 * Time: 17:23
 */

class Notification
{

	public static function makeNotification($title='Błąd', $message='', $class='')
	{
		$_SESSION['notify_message'] = "<p><b>$title</b><br>$message</p>";
        $_SESSION['notify_class'] = $class;
	}

	public static function resetNotification() {
		unset($_SESSION['notify_message']);
        unset($_SESSION['notify_class']);
	}

	public static function render() {
		if(isset($_SESSION['notify_message'])) {
			$tmp = "<div class=\"notification ".$_SESSION['notify_class']." is-radiusless is-marginless\"><button id=\"closeNotify\" class=\"delete\"></button>".$_SESSION['notify_message']."</div>";
			self::resetNotification();
			return $tmp;
		}
		else {
			return '';
		}
	}
}