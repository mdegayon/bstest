<?php

namespace app\config;

/**
 * Description of Router
 *
 * @author mdegayon
 */

use app\config\Config;
//use app\controller\FrontController;
//use app\controller\SignInController;

class Router {
    
    private static $routes = [ 
                        'createOrder'=>'/BSTest/SignIn/newOrder',
                        'createOrderRequest'=>'/BSTest/SignIn/createOrder',
                        'home' => '/BSTest/Front/index',
                        ];
    
    
    public static function getRoute($routeName){
        
        $route = null;
                
        if(array_key_exists($routeName, self::$routes)){
            $route = self::$routes[$routeName];
        }
            
        return $route;
    }
    
            
    public function resolve($controllerName, $method){
        
        
        $config = Config::getInstance();
        
        $parsedControllerName = $controllerName;
        if(!$controllerName){
            $parsedControllerName = 'Front';
        }
                    
        $controllerFullName = $config->getParam('controller_folder') .'/' 
                                . $parsedControllerName . 'Controller.php';        
        
        if(!file_exists($controllerFullName)){
            
            throw new \InvalidArgumentException('Requested controller doesn\'t exists');            
        }
        $controllerClass = "app\\controller\\$controllerName"."Controller"; 
        $controller = new $controllerClass();
        
        $parsedControllerMethod = $method;
        if(!$method){
            $parsedControllerMethod = 'index';
        }
        $controllerMethod = $parsedControllerMethod.'Action';

        if(!method_exists($controller, $controllerMethod)){
            
            throw new \InvalidArgumentException('Requested method doesn\'t exists');
        }
        
        return $controller->$controllerMethod();
                
    }
    
    
}
