<?php

class Home extends Controller {

	private static function checkLogin() {
		try {
			$hiddenField = Request::post('login_in_progress');
			if ($hiddenField == 'ok') {
				return true;
			}
			else {
				return false;
			}
		}
		catch (Exception $e) {
			return false;
		}
	}

	public static function createView($viewName, $params = array())
	{
		if(!self::checkLogin()) {

            $sql = "SELECT news.name, news.description, news.created_at, users.first_name, users.last_name\n"
                . "FROM news\n"
                . "LEFT JOIN users\n"
                . "ON news.author_id = users.id\n"
                . "WHERE news.is_active = 1";

            $dbNews = DB::query($sql, array(), PDO::FETCH_ASSOC);
            if(empty($dbNews)) {
                parent::createView($viewName);
            }
            //print_r($dbNews[0]);
		    //pobranie z bazy
            //konwersja na html
            //brak możliwości edycji


            parent::createView($viewName, array('news' => $dbNews));
			return;
		}
		else {
            echo 'Zalogowano';
		}
	}


}