<?php

namespace app\validator;

/**
 *
 * @author mdegayon
 */

use app\validator\Validator;

class NewUserValidator extends Validator{
       
    public function __construct($form) {
        
        $this->form = $form;
        $this->validForm = false;
        $this->data = false;
        $this->errors = [];
    }   
    
    public function validate(){
        
        //Mandatory fields
        $email = $this->validateField($this->form, 'email');
        $password = $this->validateField($this->form, 'password');
        $civility = $this->validateField($this->form, 'civility');
        $firstname = $this->validateField($this->form, 'firstname');
        $lastname = $this->validateField($this->form, 'lastname');
        $birthdate = $this->validateField($this->form, 'birthdate');
        $conditionsAccepted = $this->validateField($this->form, 'conditions');
        
        //Non mandatory fields
        $phone = $this->validateField($this->form, 'phone', false);
        
        if(sizeof($this->errors) == 0){
            
            $this->validForm = true;
            
            $this->data = new \app\model\Client(null, $email, $password, $civility, 
                $firstname, $lastname, $birthdate, $conditionsAccepted, $phone);
        }
        
        return $this->validForm;        
    }
    
    public function getData(){
        
        $data = null;
        
        if($this->validForm){
            
            $data = $this->data;
        }
        
        return $data;
    }
    
    public function getErrors(){
        
        return $this->errors;
    }
}
