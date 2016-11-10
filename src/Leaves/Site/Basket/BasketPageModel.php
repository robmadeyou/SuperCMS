<?php

namespace SuperCMS\Leaves\Site\Basket;

use Rhubarb\Crown\Events\Event;
use Rhubarb\Leaf\Leaves\LeafModel;
use SuperCMS\Models\Shopping\Basket;

class BasketPageModel extends LeafModel
{
    /** @var Basket */
    public $basket;

    /** @var Event */
    public $toCheckoutEvent;

    public function __construct()
    {
        parent::__construct();

        $this->toCheckoutEvent = new Event();
    }
}
