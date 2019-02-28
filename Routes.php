<?php

Route::set('404', function (){
    Controller::createView('notFound');
});

Route::set('', function (){
    Home::CreateView('Home');
});

Route::set('login', function (){
    UserLogin::processLogin();
});

Route::set('logout', function (){
    UserLogin::processLogout();
});

Route::set('register', function (){});

Route::set('zaplecze', function (){
	Back::CreateView('Back');
});

Route::set('notify', function (){
	Notification::makeNotification('<p><b>Tu nie wolno!</b><br>Tutaj nie możesz się znajdować</p>', 'is-danger');
	Route::redirect('');
});

Route::invoke();