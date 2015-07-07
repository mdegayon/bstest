<?php

    include './vendor/autoload.php';
    
    use app\config\Router;
    use app\controller\FrontController;
    
    session_start();
    
    $path = filter_input(INPUT_GET, 'path', FILTER_DEFAULT);    
    $pathArray = explode('/', $path);
    
    //Get controller 
    $controller = isset($pathArray[0]) ? $pathArray[0] : false;
    //Get method
    $method = isset($pathArray[1]) ? $pathArray[1] : false;
        
    $router = new Router();
    try{

        $router->resolve($controller, $method);

    }  catch (Exception $e){

        $errorController = new FrontController();
        $errorController->ErrorAction($e->getMessage());
    }
    
    
    

    
