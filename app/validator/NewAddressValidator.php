<?php

namespace app\validator;

/**
 *
 * @author mdegayon
 */

use app\validator\Validator;

class NewAddressValidator extends Validator{
    
    public function __construct($form) {
        
        $this->form = $form;
        $this->validForm = false;
        $this->data = false;
        $this->errors = [];
    }
        
    public function validate(){
        
        //Mandatory fields
        $address = $this->validateField($this->form, 'address');
        $zipcode = $this->validateField($this->form, 'zipcode');
        $city = $this->validateField($this->form, 'city');
        $country = $this->validateField($this->form, 'country');
        
        //Non mandatory fields
        $address_c1 = $this->validateField($this->form, 'address_c_1', false);
        $address_c2 = $this->validateField($this->form, 'address_c_2', false);
        
        if(sizeof($this->errors) == 0){
            
            $this->validForm = true;
            
            $this->data = new \app\model\Address(null, null, $address, 
                        $address_c1, $address_c2, $zipcode, $city, $country);
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
