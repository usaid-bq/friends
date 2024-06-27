<?php 
view('sessions/create.view.php', [
    'errors' => Core\Session::get('errors') ?? [],
    'old' => Core\Session::get('old') ?? '',
    'page' => $uri,
]);