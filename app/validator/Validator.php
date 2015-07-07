<?php
namespace app\validator;

/**
 *
 * @author Miguel
 */
abstract class Validator {
    
    protected   $form,
                $validForm,
                $errors,
                $data;    
    
    public function validateField($fieldSet, $fieldName, $mandatory = true){
        
        $field = null;
        
        if (array_key_exists($fieldName, $fieldSet)){
            
            $field =  $fieldSet[$fieldName];
        }        
        
        if( $mandatory && 
            (   $field === null || 
                strlen($field) == 0) ){                        
            
            $this->errors[] = "Please enter $fieldName field";
        }
        
        return $field;
    }    
    
}

?>
