<?php

namespace app\model;

/**
 *
 * @author mdegayon
 */

use app\model\Model;
use app\model\Client;
use app\model\Address;

class Order extends Model{

    //Database fields
    private $id, $client_id, $address_id, $date, $status;
    
    private $client, $address;
    
    const   READY_TO_SEND = 1,
            SENT = 2,
            READY_TO_SETUP = 3,
            SETUP = 4;

    public function __construct($id, $client_id, $address_id, $date, $status) {

        parent::__construct();

        $this->id = $id;
        $this->client_id = $client_id;
        $this->address_id = $address_id;
        $this->date = $date;
        $this->status = $status;
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
                ."(`id`, `client_id`, `address_id`, `date`, `status`) "
                ."VALUES "
                    . "(NULL, :client_id, :address_id, :date, :status);";

        $q = $this->conn->prepare($sql);

        $q->execute(array(  ':client_id'=>$this->client_id,
                            ':address_id'=>$this->address_id,
                            ':date'=>$this->date,
                            ':status'=>$this->status));
        
        $this->id = $this->conn->lastInsertId();        
        return $this->id;
    }
    
    public static function queryOrdersWithStatus($status){

        $orders = [];
        $conn = Model::getConnection();
        $readyToSetupOrdersQuery =
                "SELECT 
                    * 
                FROM 
                    ORDERS
                INNER JOIN
                    CLIENTS
                ON
                    ORDERS.CLIENT_ID = CLIENTS.ID
                INNER JOIN
                    ADDRESSES
                ON
                    ORDERS.ADDRESS_ID = ADDRESSES.ID
                WHERE
                    STATUS = :status";
        //$status
        $sth = $conn->prepare($readyToSetupOrdersQuery);
        $sth->execute(array(":status" => $status));
        $result = $sth->fetchAll();
                
//        foreach ($conn->query($readyToSetupOrdersQuery) as $row) {
        foreach ($result as $row) {
                        
            $currentOrder = new Order($row['id'], $row['client_id'], $row['address_id'], 
                    $row['date'], $row['status']);
            
            $currentOrder->address = new Address($row['address_id'], $row['client_id'], 
                    $row['address'], $row['address_c1'], $row['address_c2'], 
                    $row['zipcode'], $row['city'], $row['country']);
            
            $currentOrder->client = new Client($row['client_id'], $row['email'], 
                    $row['password'], $row['civilite'], $row['firstname'], 
                    $row['lastname'], $row['birthdate'], 
                    $row['conditionsAccepted'], $row['phone']);
            
            $orders[] = $currentOrder;
            break;
        }

        return $orders;
    }      
    
}
