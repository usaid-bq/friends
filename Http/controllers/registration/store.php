<?php

use Core\Database;
use Core\App;
use Core\Validator;
use Core\Authenticator;

$name = $_POST['name'];
$password = $_POST['password'];
$email = $_POST['email'];
$errors = [];

$db = App::resolve(Database::class);

if (! Validator::string($name, 1, 100)){
    $errors['name'] = "Please include a name (maximum 100 letters)";
} 

if (! Validator::string($password, 7, 100)){
    $errors['password'] = "Please include a password (maximum 100 letters)";
}

if (! Validator::email($email)){
    $errors['email'] = "Please include a valid email";
}

if ($errors){
    view('registration/create.view.php', [
        'errors' => $errors,
        'page' => $uri,
    ]);
}

$auth = new Authenticator();

if (!$errors){
    $db->query('INSERT INTO users (name, email, password) VALUES (:name, :email, :password)', [
        'name' => $name,
        'email' => $email,
        'password' => password_hash($password, PASSWORD_BCRYPT),
    ]);

    $auth->login([
        'email' => $email,
    ]);

    redirect('/home');
}