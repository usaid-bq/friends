<?php

namespace Core;
use Core\Database;

class Authenticator {

    protected $errors = [];

    public function attempt($email, $password){

        $user = App::resolve(Database::class)->query('SELECT * FROM users WHERE email = :email', [
            'email' => $email,
        ])->find();

        if(! $user){
            $this->errors['email'] = "The email or password is wrong.";
        }
        
        // Do the passwords match?
        if($user){
            if (! password_verify($password, $user['password'])){
                $this->errors['email'] = "The email or password is wrong.";
            }
        }
            
        if (empty($this->errors)) {
            $this->login([
                'email' => $email,
            ]);
            
            return true;
        } else {
            return false;
        }
    }

    public function login($user){
        $_SESSION['user'] = [
            'email' => $user['email'],
        ];
    
        session_regenerate_id(true);
    }
    
    public function logout(){
        $_SESSION = [];
        session_destroy();
    
        $params = session_get_cookie_params();
    
        setcookie('PHPSESSID', '', time() - 3600, $params['path'], $params['domain']);
    }

    public function errors(){
        return $this->errors;
    }

}