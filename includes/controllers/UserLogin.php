<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 27.02.2019
 * Time: 20:45
 */

class UserLogin
{
    private static function login($key, $secret) {

        $dbPass = DB::query("SELECT password FROM users WHERE email = :key LIMIT 1", array('key' => $key), PDO::FETCH_ASSOC);


        if(empty($dbPass)) {
            //user does not exists
            Notification::makeNotification('Bład', 'Taki użytkownik nie istnieje', 'is-danger');
            Route::redirect('');
            return;
        }

        $dbPass = $dbPass[0]['password'];

        if (!password_verify($secret, $dbPass)) {
            //passwords are not equals
            Notification::makeNotification('Bład', 'E-mail lub hasło niepoprawne.', 'is-danger');
            Route::redirect('');
            return;
        }

        Login::registerLogin($key);
        Notification::makeNotification('Zalogowano pomyślnie', '', 'is-success');
        Route::redirect('zaplecze');
        return;



        /*
         * sprawdzenie czy użytkownik istnieje
         * sprawdzenie jakosci hasla
         * pobranie hasla z bazy
         * porownanie
         * if true
         * rejestracja zalogowania
         * przekierowanie do zaplecza
         * else
         * odrzucenie
         */
    }

    public static function processLogin() {

        if(Login::isLogged()) {
            Notification::makeNotification('Jestes już zalogowany', '', 'is-success');
            Route::redirect('zaplecze');
            return;
        }
        try {
            $email = Request::post('email');
            $pass = Request::post('password');
        }
        catch (Exception $e) {
            Notification::makeNotification('Błąd', 'Coś poszło nie tak :(. Spróbuj ponownie.', 'is-danger');
            Route::redirect('');
            return;
        }
        self::login($email, $pass);
    }

    public static function processLogout() {

        if(!Login::isLogged()) {
            Notification::makeNotification('Byłeś niezalogowany', '', 'is-warning');
            Route::redirect('');
            return;
        }
        Login::unregisterLogin();
        Notification::makeNotification('Wylogowano pomyślnie', isset($_SESSION['login']), 'is-success');
        Route::redirect('');
        return;
    }
}