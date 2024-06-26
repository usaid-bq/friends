<?php
namespace Http\Forms;

use Core\Validator;

class RegisterForm {

    protected $errors = [];

    public function validate($name, $email, $password){

        if (! Validator::string($name, 1, 100)){
            $this->errors['name'] = "Please include a name (maximum 100 letters)";
        } 
        
        if (! Validator::string($password, 7, 100)){
            $this->errors['password'] = "Please include a password (maximum 100 letters)";
        }
        
        if (! Validator::email($email)){
            $this->errors['email'] = "Please include a valid email";
        }

        return empty($this->errors);
    }

    public function errors(){
        return $this->errors;
    }

}