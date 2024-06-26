<?php
use Core\Database;
use Core\App;


// Database stuff
$db = App::resolve(Database::class);

//Find ID
$userEmail = $_SESSION['user']['email'];

$theUser = $db->query('SELECT * FROM users WHERE email = :email', [
    'email' => $userEmail,
])->find();

$currentUserID = $theUser['id'];

//SHOW
$friends = $db->query('select * from friends where user_id = :id', ['id'=>$currentUserID])->get();

$heading = 'Friends List';
view('friends/index.view.php', [
    'heading' => $heading,
    'friends' => $friends,
    'page' => $uri,
]);