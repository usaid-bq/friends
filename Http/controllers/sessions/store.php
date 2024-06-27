<?php

use Core\Authenticator;
use Core\Session;
use Http\Forms\LoginForm;

$password = $_POST['password'];
$email = $_POST['email'];


// Form Validation
$form = new LoginForm();

if (! $form->validate($email, $password)){
    /* $_SESSION['_flash']['errors'] = $form->errors(); */
    Session::flash('errors', $form->errors());
    Session::flash('old', $_POST['email']);
    redirect("/login");
}


// Does email exist? Is the password wrong?
$auth = new Authenticator();

if ($auth->attempt($email, $password)){
    redirect("/home");
} else {
    /* $_SESSION['_flash']['errors'] = $auth->errors(); */
    Session::flash('errors', $auth->errors());
    Session::flash('old', $_POST['email']);
    redirect("/login");
}
    

