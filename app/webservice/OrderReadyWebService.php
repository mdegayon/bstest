<?php
namespace app\webservice;
/**
 *
 * @author Miguel
 */

use app\webservice\WebService;

class OrderReadyWebService implements WebService{
   
    const URL = "http://localhost/servertest/index.php";
    
    public function __construct(){
        
    }
    
    public function sendOrderReady($orderMessage){
                        
//        return;
        //setting the curl parameters.
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL,  OrderReadyWebService::URL);
        curl_setopt($ch, CURLOPT_VERBOSE, 1);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/xml'));
        curl_setopt($ch, CURLOPT_POSTFIELDS, $orderMessage);

        if (curl_errno($ch)){
            
              $response = curl_errno($ch).' : '.curl_error($ch);
              
        }else{
            
            //getting response from server
            $response = curl_exec($ch);
             curl_close($ch);
        }  
        
        return $response;
    }
        
}

?>
