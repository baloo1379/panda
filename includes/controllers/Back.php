<?php
/**
 * Created by PhpStorm.
 * User: barte
 * Date: 27.02.2019
 * Time: 17:22
 */

class Back extends Controller
{
	public static function createView($viewName, $params = array())
	{
        if(!Login::isLogged()) {
            Notification::makeNotification('Brak dostępu', 'Zaloguj się, by wejść do zaplecza.', 'is-warning');
            Route::redirect('');
            return;
        }
        $sql = "SELECT news.id, news.name, news.description, news.created_at, users.first_name, users.last_name\n"
            . "FROM news\n"
            . "LEFT JOIN users\n"
            . "ON news.author_id = users.id\n"
            . "WHERE news.is_active = 1 AND users.email = :key";

        $dbNews = DB::query($sql, array(':key' => $_SESSION['login']), PDO::FETCH_ASSOC);
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
}