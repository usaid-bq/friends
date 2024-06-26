<?php

use Core\Database;
use Core\App;
use Core\Validator;
use Core\Authenticator;
use Http\Forms\RegisterForm;

$name = $_POST['name'];
$password = $_POST['password'];
$email = $_POST['email'];
$errors = [];

$db = App::resolve(Database::class);

$form = new RegisterForm();

if(! $form->validate($name, $email, $password)){
    $_SESSION['_flash']['errors'] = $form->errors();
    redirect('/register');
} else {
    $db->query('INSERT INTO users (name, email, password) VALUES (:name, :email, :password)', [
        'name' => $name,
        'email' => $email,
        'password' => password_hash($password, PASSWORD_BCRYPT),
    ]);

    $auth = new Authenticator();
    $auth->login([
        'email' => $email,
    ]);

    redirect('/home');
}

