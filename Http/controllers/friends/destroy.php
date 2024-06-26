<?php
use Core\Database;
use Core\App;


$db = App::resolve(Database::class);

//Find ID
$userEmail = $_SESSION['user']['email'];

$theUser = $db->query('SELECT * FROM users WHERE email = :email', [
    'email' => $userEmail,
])->find();

$currentUserID = $theUser['id'];


$friendCheck = $db->query('select * from friends where id = :id', ['id' => $_POST['delete']])->findOrFail();
authorize($friendCheck['user_id'] === $currentUserID);

$db->query('delete from friends where id = :id', ['id'=> $_POST['delete']]);
// Database stuff

header("Location: /friends");
exit;
