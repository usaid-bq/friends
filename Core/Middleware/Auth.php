<?php

namespace Core\Middleware;

class Auth {
    public function resolve(){
        if(! isset($_SESSION['user'])){
            header('location: /register');
            exit();
        } 
    }
}