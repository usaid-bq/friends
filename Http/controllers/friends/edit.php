<?php
use Core\App;
use Core\Database;

$db = App::resolve(Database::class);

$info = $db->query('SELECT * FROM friends WHERE id = :id', ['id'=>$_GET['id']])->findOrFail();

$heading = 'Edit Friend';

view('friends/edit.view.php', [
    'heading' => $heading,
    'info' => $info,
    'page' => $uri,
]);