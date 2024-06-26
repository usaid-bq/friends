<?php
use Core\Database;
use Core\Validator;
use Core\App;


$friendID = $_GET['id'];

// Database stuff
$db = App::resolve(Database::class);

$friend = $db->query("SELECT * FROM friends WHERE id = ?" , [$friendID])->findOrFail();

$notes = $db->query("SELECT * FROM info WHERE friend_id = ?" , [$friendID])->get();

//Find ID
$userEmail = $_SESSION['user']['email'];

$theUser = $db->query('SELECT * FROM users WHERE email = :email', [
    'email' => $userEmail,
])->find();

$currentUserID = $theUser['id'];

authorize($currentUserID === $friend['user_id']);

//SHOW
$heading = $friend['first_name'];

view('friends/show.view.php', [
    'heading' => $heading,
    'notes' => $notes,
    'friend' => $friend,
    'page' => $uri,
]);