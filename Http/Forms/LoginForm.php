<?php

namespace Http\Forms;

use Core\Validator;
use Core\ValidationException;


class LoginForm {

    protected $errors = [];

    public function __construct(public array $attributes){
        if (! Validator::string($attributes['password'])){
            $this->errors['password'] = "Please include a password!";
        }

        if (! Validator::email($attributes['email'])){
            $this->errors['email'] = "Please include a valid email";
        }
    }
    public static function validate($attributes){
        $instance = new static($attributes);
        if($instance->failed()){
            ValidationException::throw($instance->errors, $instance->attributes);
        }

        return $instance;

    }

    public function failed(){
        return count($this->errors);
    }

    public function errors(){
        return $this->errors;
    }

}