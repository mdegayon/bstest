<?php

namespace app\xmlparser;
/**
 * Description of XmlOrderParser
 *
 * @author Miguel
 */
use app\xmlparser\ParserInterface;
use app\model\Order;

class XmlOrderParser implements ParserInterface{
            
    public function parse($orders) {
        
        try{

            // a new dom object 
            $dom = new \domDocument; 
            // make the output tidy 
            $dom->formatOutput = true;
            // create the root element 
            $root = $dom->appendChild($dom->createElement( "ORDERS" ));

            // create the simple xml element 
            $sxe = simplexml_import_dom( $dom );

            foreach ($orders as $currentOrder){

                $this->parseOrder($currentOrder, $sxe);
                break;
            }
            // show the xml
            return $sxe->asXML();

        }catch( Exception $e ){
            echo $e->getMessage();
        }
    }
    
    private function parseOrder(Order $order, \SimpleXMLElement $sxe){
               
        /*** add a order node ***/
        $orderMessge = $sxe->addchild("OP"); 

        $orderMessge->addChild("CodeActivite", 'CodeActivite'); 
        $orderMessge->addChild("CodeEnseigne", 'CodeEnseigne'); 
        $orderMessge->addChild("LangueBL", $order->address->country); 

        $orderMessge->addChild("OrdrePreparation", $order->status);
        $orderMessge->addChild("TypeCommande", "Typecommande");         
        
        //Livraison - infos client
        $orderMessge->addChild("LivraisonNom", $order->client->lastname);
        $orderMessge->addChild("LivraisonPrenom", $order->client->firstname);
        $orderMessge->addChild("LivraisonSociete", "societe");
        $orderMessge->addChild("LivraisonTelephone", $order->client->phone);
        $orderMessge->addChild("LivraisonMobile", $order->client->phone);
        $orderMessge->addChild("LivraisonEmail", $order->client->email);
        
        //Livraison - Addresse
        $orderMessge->addChild("LivraisonAdresse1", $order->address->address);
        $orderMessge->addChild("LivraisonAdresse2", $order->address->address_c1);
        $orderMessge->addChild("LivraisonAdresse3", $order->address->address_c2);
        $orderMessge->addChild("LivraisonCodePostal", $order->address->zipcode);
        $orderMessge->addChild("LivraisonVille", $order->address->city);
        $orderMessge->addChild("LivraisonPays", $order->address->country);
        
        $orderMessge->addChild("FacturationNotes1", $order->id);
        $orderMessge->addChild("FacturationNotes2", $order->id);
        $orderMessge->addChild("FacturationNotes3", $order->id);
        
        $orderMessge->addChild("CodeTransport", '202');
        $orderMessge->addChild("CodeServiceTransport", 'ST');
//        Ligne /CodeArticle O 
//        Ligne/Quantite O                 
    }    

}

?>
