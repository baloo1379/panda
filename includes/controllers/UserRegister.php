<?php
/**
 * Created by PhpStorm.
 * User: barte
 * Date: 27.02.2019
 * Time: 17:10
 */

class UserRegister extends Controller
{
    private static function register($email, $pass, $fname, $lname, $gender) {
        $pass = password_hash($pass, PASSWORD_DEFAULT);
        $gender = $gender=='m' ? 1 : 0;
        $sql = "INSERT INTO users (id, first_name, last_name, email, gender, is_active, password, created_at, updated_at) ".
            "VALUES (NULL, :fname, :lname, :email, :gender, 1, :pass, NOW(), NOW())";

        try {
            DB::query($sql, array('fname' => $fname, 'lname' => $lname, 'email' => $email, 'gender' => $gender, 'pass' => $pass));
        }
        catch (Exception $e) {
            Notification::makeNotification();
            Route::redirect('');
            return;
        }
        Notification::makeNotification('Zarejestrowano pomyślnie', 'Możesz zalogować się teraz na swoje konto.', 'is-success');
        Route::redirect('');
        return;
    }

    public static function processRegistration() {
        if(Login::isLogged()) {
            Notification::makeNotification('Jestes już zalogowany', '', 'is-success');
            Route::redirect('zaplecze');
            return;
        }
        try {
            $email = htmlentities(Request::post('email'));
            $pass = htmlentities(Request::post('password'));
            $pass2 = htmlentities(Request::post('password2'));
            $fname = htmlentities(Request::post('first_name'));
            $lname = htmlentities(Request::post('last_name'));
            $gender = Request::post('gender');
        }
        catch (Exception $e) {
            Notification::makeNotification('Błąd', 'Coś poszło nie tak :(. Spróbuj ponownie.', 'is-danger');
            Route::redirect('');
            return;
        }
        if ($pass != $pass2) {
            Notification::makeNotification("Błąd", 'Hasła nie są zgodne.', 'is-danger');
            Route::redirect('');
            return;
        }
        self::register($email, $pass, $fname, $lname, $gender);
    }
}