<?php
use Core\Authenticator;

$auth = new Authenticator();
$auth->logout();

header('location: /home');
exit();