<?php

/**
 *
 * @author mdegayon
 */

use app\validator\NewUserValidator;

class NewUserValidatorTest extends PHPUnit_Framework_TestCase{

        
//    public function testValidForm(){
//
//        $form = ['email' => 'miguel@migueldegayon.com',
//                 'password' => 'motD3P4ss3',
//                 'civility' => '1',
//                 'firstname' => 'Miguel',
//                 'lastname' => 'Degayon',
//                 'birthdate' => '17/10/1983',
//                 'conditions' => true,
//                 'phone' => '',
//                ];
//        
//        $validator = new NewUserValidator($form);
//        
//        $this->assertTrue($validator->validate());
//    }

    /**
    * @dataProvider provideDataToInvalidForm
    */    
    public function testInvalidForm($form){
        
        $validator = new NewUserValidator($form);
        
        $this->assertFalse($validator->validate());
    }  
    
    public function provideDataToInvalidForm(){
        
        return array(
                array(
                    ['email' => 'miguel@migueldegayon.com',
                     'password' => 'motD3P4ss3',
                     'civility' => '',
                     'firstname' => 'Miguel',
                     'lastname' => 'Degayon',
                     'birthdate' => '17/10/1983',
                     'conditions' => true,
                     'phone' => '',]),
                array(            
                    ['email' => null,
                     'password' => 'motD3P4ss3',
                     'civility' => '1',
                     'firstname' => 'Miguel',
                     'lastname' => 'Degayon',
                     'birthdate' => '17/10/1983',
                     'conditions' => true,
                     'phone' => '',]),
                array(            
                    ['email' => 'miguel@migueldegayon.com',
                     'password' => '',
                     'civility' => '1',
                     'firstname' => '',
                     'lastname' => 'Degayon',
                     'birthdate' => '17/10/1983',
                     'conditions' => true,
                     'phone' => '',]),
                array(            
                    ['email' => 'miguel@migueldegayon.com',
                     'password' => 'motD3P4ss3',
                     'civility' => '1',
                     'firstname' => '',
                     'lastname' => '',
                     'birthdate' => '17/10/1983',
                     'conditions' => true,
                     'phone' => '',]),
                array(            
                    ['email' => 'miguel@migueldegayon.com',
                     'password' => 'motD3P4ss3',
                     'civility' => '1',
                     'firstname' => 'Miguel',
                     'lastname' => 'Degayon',
                     'birthdate' => '',
                     'conditions' => true,
                     'phone' => '',]),
                array(            
                    ['email' => 'miguel@migueldegayon.com',
                     'password' => 'motD3P4ss3',
                     'civility' => '1',
                     'lastname' => 'Degayon',
                     'birthdate' => '17/10/1983',
                     'conditions' => true,
                     'phone' => '',],));        
    }
    
    
    
    
}
