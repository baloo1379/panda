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
        parent::createView('EditEl', array('name' => $name, 'description' => $description, 'active' => $checked, 'id' => $newsId));
    }

    public static function update() {
        if(!Login::isLogged()) {
            Notification::makeNotification('Brak uprawnień', 'Nie masz uprawnień do wykonania tej czynności.', 'is-danger');
            Route::redirect('');
            return;
        }
        try {
            $newsId = htmlentities(Request::post('id'));
            $newsName = htmlentities(Request::post('name'));
            $newsDesc = htmlentities(Request::post('description'));
            if(isset($_POST['active'])) $newsActive = 1;
            else $newsActive = 0;
        }
        catch (Exception $e) {
            Notification::makeNotification('Brak danych', '', 'is-danger');
            Route::redirect('zaplecze');
            return;
        }
        //Notification::makeNotification('Dane', $newsId.' '.$newsName.' '.$newsDesc.' '.$newsActive, 'is-info');
        //Route::redirect('zaplecze');
        //return;

        $sql = "UPDATE news SET name = :newsname, description = :newsdesc, is_active = :state, updated_at = NOW() WHERE news.id = :id";
        try {
            DB::query($sql, array('newsname' => $newsName, 'newsdesc' => $newsDesc, 'state' => $newsActive, 'id' => $newsId));
        }
        catch (Exception $e) {
            Notification::makeNotification('Błąd bazy danych', $e->getMessage(), 'is-danger');
        }
        Route::redirect('zaplecze');

    }

    public static function createNew() {
        if(!Login::isLogged()) {
            Notification::makeNotification('Brak uprawnień', 'Nie masz uprawnień do wykonania tej czynności.', 'is-danger');
            Route::redirect('');
            return;
        }
        parent::createView('Add');
    }

    public static function addNew() {
        if(!Login::isLogged()) {
            Notification::makeNotification('Brak uprawnień', 'Nie masz uprawnień do wykonania tej czynności.', 'is-danger');
            Route::redirect('');
            return;
        }
        try {
            $newsId = htmlentities(Request::post('id'));
            $newsName = htmlentities(Request::post('name'));
            $newsDesc = htmlentities(Request::post('description'));
            if(isset($_POST['active'])) $newsActive = 1;
            else $newsActive = 0;
        }
        catch (Exception $e) {
            Notification::makeNotification('Brak danych', '', 'is-danger');
            Route::redirect('zaplecze');
            return;
        }
        //Notification::makeNotification('Dane', $newsId.' '.$newsName.' '.$newsDesc.' '.$newsActive, 'is-info');
        //Route::redirect('zaplecze');
        //return;

        $authorID = DB::query("SELECT id FROM users WHERE email = :mail", array('mail' => $_SESSION['login']), PDO::FETCH_ASSOC)[0]['id'];

        $sql = "INSERT INTO news (id, name, description, is_active, created_at, updated_at, author_id) "
            ."VALUES (NULL, :newsname, :newsdesc, :state, NOW(), NOW(), :id)";
        try {
            DB::query($sql, array('newsname' => $newsName, 'newsdesc' => $newsDesc, 'state' => $newsActive, 'id' => $authorID));
        }
        catch (Exception $e) {
            Notification::makeNotification('Błąd bazy danych', $e->getMessage(), 'is-danger');
        }
        Route::redirect('zaplecze');
    }

    public static function createUserEdit() {
        if(!Login::isLogged()) {
            Notification::makeNotification('Brak uprawnień', 'Nie masz uprawnień do wykonania tej czynności.', 'is-danger');
            Route::redirect('');
            return;
        }
        $email = $_SESSION['login'];
        $sql = "SELECT * FROM users WHERE email = :id";
        $element = DB::query($sql, array('id' => $email), PDO::FETCH_ASSOC);
        if(empty($element)) {
            Notification::makeNotification('Brak danych', '', 'is-danger');
            Route::redirect('zaplecze');
            return;
        }
        $element = $element[0];
        $fname = $element['first_name'];
        $lname = $element['last_name'];
        $gender = $element['gender'];

        parent::createView('EditUser', array('fname' => $fname, 'lname' => $lname, 'gender' => $gender, 'email' => $email));
    }
}