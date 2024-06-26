<?php

$router->get('/home', 'home.php');

$router->get('/friends', 'friends/index.php')->only('Auth');
$router->delete('/friends', 'friends/destroy.php');

$router->get('/friends/create', 'friends/create.php')->only('Auth');
$router->post('/friends/create', 'friends/store.php');

$router->get('/friends/edit', 'friends/edit.php')->only('Auth');
$router->put('/friends/edit', 'friends/update.php');

$router->get('/friend', 'friends/show.php')->only('Auth');
$router->post('/friend', 'friends/notes/store.php');
$router->delete('/friend', 'friends/notes/destroy.php');

$router->get('/friend/edit', 'friends/notes/edit.php')->only('Auth');
$router->put('/friend/edit', 'friends/notes/update.php');

$router->get('/register', 'registration/create.php')->only('Guest');
$router->post('/register', 'registration/store.php');

$router->get('/login', 'sessions/create.php')->only('Guest');
$router->post('/login', 'sessions/store.php');

$router->delete('/logout', 'sessions/destroy.php')->only('Auth');