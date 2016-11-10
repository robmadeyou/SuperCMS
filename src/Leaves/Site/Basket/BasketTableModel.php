<?php

namespace SuperCMS\Leaves\Site\Basket;

use Rhubarb\Crown\Events\Event;
use Rhubarb\Leaf\Table\Leaves\TableModel;

class BasketTableModel extends TableModel
{
    /** @var Event */
    public $removeItemEvent;

    public function __construct()
    {
        parent::__construct();

        $this->removeItemEvent = new Event();
    }
}
