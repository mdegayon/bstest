<?php

namespace app\xmlparser;

/**
 * Description of ParserFactory
 *
 * @author Miguel
 */

use app\model\Order;
use app\model\Model;
use app\xmlparser\XmlOrderParser;


class ParserFactory {

    public static function createParser($classname){
        
        $parser = null;
        
        if ($classname == 'Order'){
            $parser = new XmlOrderParser();
        }
        
        return $parser;    
    }
    
}

?>
