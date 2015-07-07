<?php

namespace app\controller;

use app\controller\Controller;
use app\validator\NewUserValidator;
use \app\validator\NewAddressValidator;
use app\manager\NewOrderManager;
//use app\validator\NewUserValidator;
/**
 *
 * @author mdegayon
 */
class SignInController extends Controller{
    
    
    public function indexAction(){
     
        $this->renderView('suscribe');
    }
    
    public function newOrderAction(){
           
        $options = [];
        
        if ( array_key_exists('formErrors', $_SESSION) ) {
            
            $options['errors'] = $_SESSION['formErrors'];
            unset($_SESSION['formErrors']);
        }
        
        if ( array_key_exists('formSuccess', $_SESSION) ) {
            
            $options['formSuccess'] = $_SESSION['formSuccess'];
            unset($_SESSION['formSuccess']);
        }        
        
        $this->renderView('suscribe', $options);
    }        
    
    public function createOrderAction(){
        
        $postVals = filter_input_array ( INPUT_POST);
        $userValidator = new NewUserValidator($postVals);
        $addressValidator = new NewAddressValidator($postVals);

        if(! $userValidator->validate()){

            $_SESSION['formErrors'] = $userValidator->getErrors();
            $this->redirectTo(\app\config\Router::getRoute('createOrder'));
        }
        
        if(! $addressValidator->validate()){

            $_SESSION['formErrors'] = $addressValidator->getErrors();
            $this->redirectTo(\app\config\Router::getRoute('createOrder'));
        }
                
        $user = $userValidator->getData();
        $address = $addressValidator->getData();
        
        $manager = new NewOrderManager($user, $address);
        
        if(!$manager->createNewOrder()){
            
            $_SESSION['formErrors'] = $manager->getErrors();
            $this->redirectTo(\app\config\Router::getRoute('createOrder'));
        }
        
        $_SESSION['formSuccess'] = 'New Order was successfully created !';
        $this->redirectTo(\app\config\Router::getRoute('createOrder'));        
                    
    }            
}
