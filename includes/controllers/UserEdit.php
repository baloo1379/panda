<?php

class UserEdit extends Controller
{
    private static function edit($email, $fname, $lname, $gender) {
        $gender = $gender=='m' ? 1 : 0;
        $sql = "UPDATE users SET first_name = :fname, last_name = :lname, gender = :gender, updated_at = NOW() WHERE email = :email";
        try {
            DB::query($sql, array('fname' => $fname, 'lname' => $lname, 'email' => $email, 'gender' => $gender));
        }
        catch (Exception $e) {
            Notification::makeNotification('Coś poszło nie tak', 'Zaloguj się ponownie', 'is-warning');
            Route::redirect('logout');
            return;
        }
        Notification::makeNotification('Zapisano pomyślnie', '', 'is-success');
        Route::redirect('zaplecze');
        return;
    }

    public static function processEdition() {
        if(!Login::isLogged()) {
            Notification::makeNotification('Brak uprawnień', 'Nie masz uprawnień do wykonania tej czynności.', 'is-danger');
            Route::redirect('');
            return;
        }
        try {
            $fname = htmlentities(Request::post('first_name'));
            $lname = htmlentities(Request::post('last_name'));
            $gender = Request::post('gender');
        }
        catch (Exception $e) {
            Notification::makeNotification('Błąd', 'Coś poszło nie tak :(. Spróbuj ponownie.', 'is-danger');
            Route::redirect('');
            return;
        }
        $email = $_SESSION['login'];
        self::edit($email, $fname, $lname, $gender);
    }
}