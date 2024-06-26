<?php
use Core\Database;
use Core\Validator;
use Core\App;

$errors = [];
$friendID = $_GET['friend'];
$noteID = $_GET['note'];

$db = App::resolve(Database::class);

//Find ID
$userEmail = $_SESSION['user']['email'];

$theUser = $db->query('SELECT * FROM users WHERE email = :email', [
    'email' => $userEmail,
])->find();

$currentUserID = $theUser['id'];

//UPDATE
$friend = $db->query("SELECT * FROM friends WHERE id = ?" , [$friendID])->findOrFail();
$notes = $db->query("SELECT * FROM info WHERE friend_id = ?" , [$friendID])->get();
$note = $db->query("SELECT * FROM info WHERE id = ?" , [$noteID])->findOrFail();


if (! Validator::string($_POST['body'], 1, 1000)) {
    $errors['body'] = 'Your note cannot be empty or longer than 1000 letters.';
}

authorize($friend['user_id'] == $currentUserID);

if (! empty($errors)){
    $heading = $friend['first_name'];
    view('friends/notes/edit.view.php', [
        'heading' => $heading,
        'notes' => $notes,
        'errors' => $errors,
        'page' => $uri,
    ]);

}


if (empty($errors)) {
    $db->query('UPDATE info SET body = :body WHERE id = :id' , [
    'body' => $_POST['body'],
    'id' => $noteID,
    ]);

    header("Location: /friend?id={$friendID}");
    exit;
}