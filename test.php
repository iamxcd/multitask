<?php

require_once './vendor/autoload.php';

use Iamxcd\Multitask\Woker;



$woker = new Woker();

$woker->setCount(10)->task(function () {
    echo '123';
})->run();
