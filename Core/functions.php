<?php
use Core\Response;

function base_path($destination){
    return BASE_PATH . $destination;
}

function view($path, $attributes = []){
    extract($attributes);
    require base_path("views/" . $path);
}

function dd($variable){

    echo '<pre>';
    var_dump($variable);
    echo '</pre>';
    die();

}

function authorize($condition, $error = Response::FORBIDDEN){
    if(!$condition){
        abort($error);
    }
}

function abort($code = 404) {
    http_response_code($code);

    require base_path("/views/{$code}.php");

    die();
}

function redirect($path){
    header("location: {$path}");
    exit();
}
