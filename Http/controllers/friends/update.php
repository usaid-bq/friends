<?php
use Core\App;
use Core\Database;
use Core\Validator;

$errors = [];

$db = App::resolve(Database::class);

//Find ID
$userEmail = $_SESSION['user']['email'];

$theUser = $db->query('SELECT * FROM users WHERE email = :email', [
    'email' => $userEmail,
])->find();

$currentUserID = $theUser['id'];


//UPDATE
$info = $db->query('SELECT * FROM friends WHERE id = :id', ['id'=>$_GET['id']])->findOrFail();

if (! Validator::string($_POST['first-name'], 1)) {
    $errors['first-name'] = 'The first name is required.';
}

authorize($info['user_id'] == $currentUserID);

if (!empty($errors)){
    $heading = 'Edit Friend';
    view('friends/edit.view.php', [
    'heading' => $heading,
    'errors' => $errors,
    'info'=> $info,
]);
}

if (empty($errors)) {
    $db->query('UPDATE friends SET first_name = :first_name, last_name = :last_name, email = :email, location = :location WHERE id = :id' , [
    'first_name' => $_POST['first-name'],
    'last_name' => $_POST['last-name'],
    'email' => $_POST['email'],
    'location' => $_POST['location'],
    'id' => $_GET['id'],
    ]);

    header("Location: /friends");
    exit;
}

