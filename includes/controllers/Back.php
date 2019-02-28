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
        $sql = "SELECT news.id, news.name, news.description, news.created_at, news.is_active, users.first_name, users.last_name\n"
            . "FROM news\n"
            . "LEFT JOIN users\n"
            . "ON news.author_id = users.id\n"
            . "WHERE users.email = :key";

        $dbNews = DB::query($sql, array('key' => $_SESSION['login']), PDO::FETCH_ASSOC);
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

	public static function processActive() {
	    if(!Login::isLogged()) {
            Notification::makeNotification('Brak uprawnień', 'Nie masz uprawnień do wykonania tej czynności.', 'is-danger');
            Route::redirect('');
            return;
        }
        try {
            $newsId = Request::post('news_id');
        }
        catch (Exception $e) {
            Notification::makeNotification('Brak danych', '', 'is-danger');
            Route::redirect('zaplecze');
            return;
        }
	    //Notification::makeNotification('Dane', $newsId, 'is-success');
	    //Route::redirect('zaplecze');
        $sql = "SELECT is_active FROM news WHERE id = :id";
	    $oldState = DB::query($sql, array('id' => $newsId), PDO::FETCH_ASSOC)[0]['is_active'];
	    $newState = $oldState ? 0 : 1;
        //Notification::makeNotification('Dane', $newsId.' '.$oldState.' '.$newState, 'is-success');
        $sql = "UPDATE news SET is_active = :state, updated_at = NOW() WHERE news.id = :id";
        DB::query($sql, array('state' => $newState, 'id' => $newsId ));
	    return;
    }

    public static function processDelete() {
        if(!Login::isLogged()) {
            Notification::makeNotification('Brak uprawnień', 'Nie masz uprawnień do wykonania tej czynności.', 'is-danger');
            Route::redirect('');
            return;
        }
        try {
            $newsId = Request::post('news_id');
        }
        catch (Exception $e) {
            Notification::makeNotification('Brak danych', '', 'is-danger');
            Route::redirect('zaplecze');
            return;
        }
        Notification::makeNotification('Dane usuwane', $newsId, 'is-danger');
    }

    public static function createEdit() {
        if(!Login::isLogged()) {
            Notification::makeNotification('Brak uprawnień', 'Nie masz uprawnień do wykonania tej czynności.', 'is-danger');
            Route::redirect('');
            return;
        }
        try {
            $newsId = Request::get('id');
        }
        catch (Exception $e) {
            Notification::makeNotification('Brak danych', '', 'is-danger');
            Route::redirect('zaplecze');
            return;
        }
        $sql = "SELECT * FROM news WHERE id = :id";
        $element = DB::query($sql, array('id' => $newsId), PDO::FETCH_ASSOC);
        if(empty($element)) {
            Notification::makeNotification('Brak danych', '', 'is-danger');
            Route::redirect('zaplecze');
            return;
        }
        $element = $element[0];
        $name = $element['name'];
        $description = $element['description'];
	    $checked = $element['is_active'] ? 'checked' : '';
        parent::createView('EditEl', array('name' => $name, 'description' => $description, 'checked' => $checked));
    }
}