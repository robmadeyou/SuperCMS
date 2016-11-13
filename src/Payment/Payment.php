<?php

namespace SuperCMS\Payment;

use Rhubarb\Crown\DependencyInjection\SingletonInterface;
use Rhubarb\Crown\DependencyInjection\SingletonTrait;
use SuperCMS\Models\Shopping\Basket;

abstract class Payment implements SingletonInterface
{
    use SingletonTrait;

    public function handleBasket(Basket $basket) {
        if ($this->pay()) {
            Basket::markPaid($basket);
        }
    }

    abstract public function pay():boolean;
}