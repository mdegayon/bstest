<?php

namespace app\model;

/**
 *
 * @author mdegayon
 */

use app\model\Model;

class Address extends Model{

    private $id, 
            $client_id,
            $address,
            $address_c1,
            $address_c2,
            $zipcode,
            $city,
            $country;
    
    public function __construct($id, $client_id, $address, $address_c1, $address_c2, $zipcode, $city, $country) {
        
        parent::__construct();
        
        $this->table = 'addresses';
        
        $this->id = $id;
        $this->client_id = $client_id;
        $this->address = $address;
        $this->address_c1 = $address_c1;
        $this->address_c2 = $address_c2;
        $this->zipcode = $zipcode;
        $this->city = $city;
        $this->country = $country;        
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
    
    public function insert(){
        
        $sql =  "INSERT INTO ".
                    $this->table."  "
                ."(`id`, `client_id`, `address`, `address_c1`, `address_c2`, `zipcode`, `city`, `country`) "
                ."VALUES "
                    . "(NULL, :client_id, :address, :address_c1, :address_c2, :zipcode, :city, :country);";

        $q = $this->conn->prepare($sql);

        $q->execute(array(  ':client_id'=>$this->client_id,
                            ':address'=>$this->address,
                            ':address_c1'=>$this->address_c1,
                            ':address_c2'=>$this->address_c2,
                            ':zipcode'=>$this->zipcode,
                            ':city'=>$this->city,
                            ':country'=>$this->country));
        
        $this->id = $this->conn->lastInsertId();        
        return $this->id;        
    }    
    
}
