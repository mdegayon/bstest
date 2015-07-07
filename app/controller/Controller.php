<?php

namespace app\controller;

/**
 *
 * @author mdegayon
 */

use app\config\Config;

class Controller {
    
    
    public function renderView($view, $params=null){
        
        $config = Config::getInstance();
        $viewFile = $config->getParam('view_folder') .'/' . $view . '.php';
        
        if(!file_exists($viewFile)){
            throw new \InvalidArgumentException('Requested View doesn\'t exists');
        }
        
        include $viewFile;        
    }
    
    public function redirectTo($route){
        
        header("Location: ".$route);
        die();        
    }
}
