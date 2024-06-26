<?php

namespace Core\Middleware;

class Guest {
    public function resolve(){
        if(isset($_SESSION['user'])){
            header('location: /home');
            exit();
        }
    }
}