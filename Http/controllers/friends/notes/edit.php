<?php
use Core\Database;
use Core\Validator;
use Core\App;


$friendID = $_GET['friend'];
$noteID = $_GET['note'];

// Database stuff
$db = App::resolve(Database::class);


//Find ID
$userEmail = $_SESSION['user']['email'];

$theUser = $db->query('SELECT * FROM users WHERE email = :email', [
    'email' => $userEmail,
])->find();

$currentUserID = $theUser['id'];

//EDIT
$friend = $db->query("SELECT * FROM friends WHERE id = ?" , [$friendID])->findOrFail();

$notes = $db->query("SELECT * FROM info WHERE friend_id = ?" , [$friendID])->get();

$note = $db->query("SELECT * FROM info WHERE id = :id", ['id'=>$noteID])->findOrFail();

// Database stuff

authorize($friend['user_id']==$currentUserID);

$heading = $friend['first_name'];

view('friends/notes/edit.view.php', [
    'page' => $uri,
    'heading' => $heading,
    'notes' => $notes,
    'note' => $note,
    'friend' => $friend,
]);