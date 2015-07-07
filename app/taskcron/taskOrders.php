<?php

include '../../vendor/autoload.php';

use app\tasks\SendOrderMessageTask;
use app\webservice\OrderReadyWebService;

$service = new OrderReadyWebService();

$task = new SendOrderMessageTask($service);
$task->run();

