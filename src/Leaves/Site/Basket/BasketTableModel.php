<?php

namespace SuperCMS\Leaves\Site\Basket;

use Rhubarb\Crown\Events\Event;
use Rhubarb\Leaf\Table\Leaves\TableModel;

class BasketTableModel extends TableModel
{
    /** @var Event */
    public $removeItemEvent;
    
    /** @var Event */
    public $updateQuantityEvent;

    public function __construct()
    {
        parent::__construct();

        $this->removeItemEvent = new Event();
        $this->updateQuantityEvent = new Event();
    }
}
