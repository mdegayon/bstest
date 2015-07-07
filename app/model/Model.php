<?php

namespace app\model;

/**
 *
 * @author mdegayon
 */

abstract class Model {
    
    protected   $conn,
                $model,
                $table;
    
        
    public function __construct() {
        
//        $config = \app\config\Config::getInstance();
//        
//        $database = $config->getParam('database_name');
//        $user = $config->getParam('database_user');
//        $password = $config->getParam('database_password');        
//                
//        $this->conn = new \PDO("mysql:host=localhost;dbname=$database", $user, $password);
//        
//        $this->conn->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);                
        
        $this->conn = static::getConnection();
        
        $reflect = new \ReflectionClass($this);
        $this->model = $reflect->getShortName();         
        
        $this->table = strtolower($this->model)."s";            
    }            
    
    public abstract function insert();
    
    public static function getConnection(){
        
        $config = \app\config\Config::getInstance();
        
        $database = $config->getParam('database_name');
        $user = $config->getParam('database_user');
        $password = $config->getParam('database_password');        
                
        $connexion = new \PDO("mysql:host=localhost;dbname=$database", $user, $password);
        
        $connexion->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);        
        
        return $connexion;
    }
    
}
