<?php

namespace SuperCMS\Leaves\Site\Checkout;

use Rhubarb\Crown\Events\Event;
use Rhubarb\Leaf\Leaves\LeafModel;
use SuperCMS\Models\Shopping\Basket;

class CheckoutModel extends LeafModel
{
    /** @var Basket */
    public $basket;

    public $previousEvent;
    public $nextEvent;

    public function __construct()
    {
        parent::__construct();

        $this->previousEvent = new Event();
        $this->nextEvent = new Event();
    }
}
