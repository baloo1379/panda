<?php
class Request
{
	public static function post($data) {
		if(isset($_POST[$data])) {
			return $_POST[$data];
		}
		else throw new Exception("'$data' isn't set.");
	}

	public static function get($data) {
		if(isset($_GET[$data])) {
			return $_GET[$data];
		}
		else throw new Exception("'$data' isn't set.");
	}

	public static function file($data) {
		if(isset($_FILES['file'])) {
			if (is_uploaded_file( $_FILES['file']['tmp_name'] )) {
				return $_FILES[$data];
			}
			else throw new Exception('Upload error');
		}
		else throw new Exception('No file provided');
	}
}