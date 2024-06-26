<?php
use Core\Database;
use Core\App;

$db = App::resolve(Database::class);

//Find ID
if(isset($_SESSION['user'])){
    $userEmail = $_SESSION['user']['email'];

    $theUser = $db->query('SELECT * FROM users WHERE email = :email', [
        'email' => $userEmail,
    ])->find();

    $name = $theUser['name'];
} else {
    $name = 'Guest';
}
    


$heading = 'Home Page';
view('home.view.php', [
    'heading' => $heading,
    'page' => $uri,
    'name' => $name, 
]);