<?php

namespace app\config;

/**
 *
 * @author mdegayon
 */
class Config {
       
   private static $instance;
   private $params;
   
   private function __construct()
   {
      
      $this->params = [ 'root' => __DIR__ .'/'.'..',
                        'controller_folder' => __DIR__ .'/'.'..'.'/controller',
                        'view_folder' => __DIR__ .'/'.'..'.'/view',
                        'database_name' => 'test',
                        'database_user' => 'miguel',
                        'database_password' => 'degayon',
                ];
   }

   public static function getInstance()
   {
      if (  !self::$instance instanceof self)
      {
         self::$instance = new self;
      }
      return self::$instance;
   } 
   
   public function getParam($key){
       
       if(in_array($key, array_keys($this->params))){
           return $this->params[$key];
       }
       
       return null;
   }
   
   private function loadConfigFromFile(){
       
   }
    
}
