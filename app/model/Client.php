<?php

namespace app\model;

/**
 *
 * @author mdegayon
 */

use app\model\Model;

class Client extends Model{

    private $id,
            $email,
            $password,
            $civil,
            $firstname,
            $lastname,
            $birthdate,
            $conditionsAccepted,
            $phone;

    public function __construct($id, $email, $password, $civil, $firstname, $lastname, 
                            $birthdate, $conditionsAccepted, $phone = null){

        parent::__construct();
        
        $this->id = $id;
        $this->email = $email;
        $this->password = $password;
        $this->civil = $civil;
        $this->firstname = $firstname;
        $this->lastname = $lastname;
        $this->birthdate = $birthdate;
        $this->conditionsAccepted = $conditionsAccepted;
        $this->phone = $phone;

    }
    
    public function __get($property) {
            if (property_exists($this, $property)) {
                return $this->$property;
            }
    }

    public function __set($property, $value) {
        if (property_exists($this, $property)) {
            $this->$property = $value;
        }
    }    

    private function parseBirthdayToMySQL(){

        return date( 'Y-m-d', strtotime(str_replace('/', '-', $this->birthdate)));
    }

    public function insert(){
        
        $sql =  "INSERT INTO ".
                    $this->table."  "
                ."(`id`, `email`, `password`, `firstname`, `lastname`, `birthdate`, `civilite`, `phone`, `conditionsAccepted`) "
                ."VALUES "
                    . "(NULL, :email, :password, :firstname, :lastname, :birthdate, :civility, :phone, :conditionsAccepted);";

        $q = $this->conn->prepare($sql);

        $q->execute(array(  ':email'=>$this->email,
                            ':password'=>$this->password,
                            ':firstname'=>$this->firstname,
                            ':lastname'=>$this->lastname,
                            ':civility'=>$this->civil,
                            ':phone'=>$this->phone,
                            ':birthdate'=> $this->parseBirthdayToMySQL(),
                            ':conditionsAccepted'=>$this->conditionsAccepted));
        
        $this->id = $this->conn->lastInsertId();        
        return $this->id;
    }
}
