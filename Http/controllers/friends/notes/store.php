<?php
use Core\Database;
use Core\Validator;
use Core\App;

$errors = [];
$friendID = $_GET['id'];


$db = App::resolve(Database::class);

//Find ID
$userEmail = $_SESSION['user']['email'];

$theUser = $db->query('SELECT * FROM users WHERE email = :email', [
    'email' => $userEmail,
])->find();

$currentUserID = $theUser['id'];

//STORE

$friend = $db->query("SELECT * FROM friends WHERE id = ?" , [$friendID])->findOrFail();

$notes = $db->query("SELECT * FROM info WHERE friend_id = ?" , [$friendID])->get();


if (! Validator::string($_POST['body'], 1, 1000)) {
    $errors['body'] = 'Your note cannot be empty or longer than 1000 letters.';
}

authorize($friend['user_id']==$currentUserID);

if (! empty($errors)){
    $heading = $friend['first_name'];
    view('friends/show.view.php', [
        'heading' => $heading,
        'notes' => $notes,
        'errors' => $errors,
        'page' => $uri,
    ]);

}


if (empty($errors)) {
    $db->query('INSERT INTO info (body, friend_id) VALUES (:body, :friend_id)' , [
    'body' => $_POST['body'],
    'friend_id' => $friendID,
    ]);

    header("Location: /friend?id={$friendID}");
    exit;
}

