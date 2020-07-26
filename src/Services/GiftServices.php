<?php

namespace App\Services;

use Psr\Log\LoggerInterface;
use Psr\Log\LoggerTrait;

class GiftServices{
       public $gifts = ['flowers','car','piano','money'];

       public function __construct(LoggerInterface $logger)
       {
           $logger->info("Gift were randomized!");
           shuffle($this->gifts);
       }

}
