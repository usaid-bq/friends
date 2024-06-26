<?php
use Core\Database;
use Core\Validator;
use Core\App;

$errors = [];

$db = App::resolve(Database::class);

//Find ID
$userEmail = $_SESSION['user']['email'];

$theUser = $db->query('SELECT * FROM users WHERE email = :email', [
    'email' => $userEmail,
])->find();

$currentUserID = $theUser['id'];


//STORE
if (! Validator::string($_POST['first-name'], 1)) {
    $errors['first-name'] = 'The first name is required.';
}

if (!empty($errors)){
    $heading = 'Add Friend';
    view('friends/create.view.php', [
    'heading' => $heading,
    'errors' => $errors,
    'page' => $uri,
]);
}

if (empty($errors)) {
    $db->query('INSERT INTO friends (first_name, last_name, email, location, user_id) VALUES (:first_name, :last_name, :email, :location, :user_id)' , [
    'first_name' => $_POST['first-name'],
    'last_name' => $_POST['last-name'],
    'email' => $_POST['email'],
    'location' => $_POST['location'],
    'user_id' => $currentUserID
    ]);

    header("Location: /friends");
    exit;
}


