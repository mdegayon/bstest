<?php
namespace app\manager;
/**
 *
 * @author mdegayon
 */

use app\model\Client;
use app\model\Address;
use app\model\Order;
use app\security\ClientEncoder;

class NewOrderManager {

    private $client, $address, $errors;
    
    public function __construct(Client $client, Address $address) {
//    public function __construct(Client $client, Address $address) {
        
        $this->client = $client;
        $this->address = $address;
        $this->errors = [];
    }
    
    public function createNewOrder(){                        
        
        $newOrderCreated = true;
                
        //Encode Client password
        $encoder = new ClientEncoder($this->client);
        $this->client->password = $encoder->encodePassword();
        
        
        //Insert Client
        if(!$this->client->insert()){
            
            $this->logError('An error occurred while attempting to insert the new Client');
            return false;
        }
        
        //create relationship between the client and the address clasesse 
        //and Insert Address
        $this->address->client_id = $this->client->id;
        if(!$this->address->insert()){
            
            $this->logError('An error occurred while attempting to insert the new Address');
            return false;
        }
        
        //Create order 
        $order = new Order(null, $this->client->id, $this->address->id, date('Y-m-d H:i:s'), Order::READY_TO_SETUP);
        //Insert order
        if(!$order->insert()){
            
            $this->logError('An error occurred while attempting to insert the Order');
            return false;
        }
        
        return $newOrderCreated;
    }
    
    private function logError($errorMsg){
        
        $this->errors[] = $errorMsg;
    }
    
    public function getErrors(){
        return $this->errors;
    }
    
}
