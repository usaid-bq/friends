<?php

namespace Core;
use PDO;

class Database {
    
    public $connection;
    public $statement;

    public function __construct($config, $username = 'root', $password = ''){
        $dsn = 'mysql:' . http_build_query($config['database'], '', ';');
        $this->connection = new PDO($dsn, 'root', '', [
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]);
    }
   
    public function query($query, $params = []){
        $this->statement = $this->connection->prepare($query);
        $this->statement->execute($params);

        return $this;
    }

    public function get()
    {
        return $this->statement->fetchAll();
    }

    public function find()
    {
        return $this->statement->fetch();
    }

    public function getOrFail()
    {
        $result = $this->statement->fetchAll();

        if(!$result){
            abort();
        }
        return $result;
    }

    public function findOrFail()
    {
        $result = $this->statement->fetch();
        if(!$result){
            abort();
        }
        return $result;
    }


}