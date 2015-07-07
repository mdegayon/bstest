<?php

namespace app\controller;

use app\controller\Controller;

class FrontController extends Controller{
    
    public function indexAction(){

        $this->renderView('home');
        
    }
    
    public function ErrorAction($error){
        
        $this->renderView('error', ['error'=>$error]);               
    }
        
}
