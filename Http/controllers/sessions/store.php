<?php

use Core\Authenticator;
use Core\Session;
use Http\Forms\LoginForm;



// Form Validation
$form = LoginForm::validate($attributes = [
    'email' => $_POST['email'],
    'password' => $_POST['password'],
]);


// Form authentication
$auth = new Authenticator();

if ($auth->attempt($attributes['email'], $attributes['password'])){
    redirect("/home");
} else {
    Session::flash('errors', $auth->errors());
    Session::flash('old', $_POST['email']);
    redirect("/login");
}
    

