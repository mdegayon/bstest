<?php
namespace app\security;
/**
 *
 * @author Miguel
 */

use app\model\Client;

class ClientEncoder {

    private $client;
    
    public function __construct(Client $client) {
        
        $this->client = $client;
    }

    public function encodePassword(){
        
        return hash("sha256", $this->client->password);
//        return password_hash($this->client->password, PASSWORD_BCRYPT);
    }
}

?>
