<?php 

view('registration/create.view.php', [
    'page' => $uri,
    'errors' => $_SESSION['_flash']['errors'] ?? [],
]);