<?php
use Core\Database;
use Core\App;

$errors = [];
$friendID = $_GET['id'];

// Database stuff
$db = App::resolve(Database::class);

//Find ID
$userEmail = $_SESSION['user']['email'];

$theUser = $db->query('SELECT * FROM users WHERE email = :email', [
    'email' => $email,
])->find();

$currentUserID = $theUser['id'];

//DELETE
$noteCheck = $db->query('SELECT * FROM info WHERE id = :id', ['id' => $_POST['delete']])->findOrFail();
authorize($noteCheck['friend_id'] == $friendID);

$db->query('DELETE FROM info WHERE id = :id', ['id'=>$_POST['delete']]);

header("Location: /friend?id={$friendID}");
exit;

