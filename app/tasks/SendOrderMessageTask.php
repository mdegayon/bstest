<?php
namespace app\tasks;

use app\model\Order;
use app\webservice\OrderReadyWebService;
use app\xmlparser\ParserFactory;
//use app\webservice\WebService;
/**
 *
 * @author Miguel
 */
class SendOrderMessageTask {

    private $orders;
    
    private $service;
    
    public function __construct(OrderReadyWebService $service) {
        
        $this->service = $service;
        $this->orders = null;
    }
   
    public function run(){

        //Get from database any unsend order and parse them into Order objets
        $this->orders = Order::queryOrdersWithStatus(Order::READY_TO_SETUP);

        //XML Parser 
        $parser = ParserFactory::createParser('Order');
        $xmlMessage = $parser->parse($this->orders);
                
        //Get service and send message
        $response = $this->service->sendOrderReady($xmlMessage);
        
        if($response){
            echo "->SERVER RESPONSE: $response";
        }else{
            echo "->SERVER RESPONSE: An error occurred";
        }
    }
    
}

?>
