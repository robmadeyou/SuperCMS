<?php

namespace SuperCMS\Leaves\Admin\Categories\Hierarchy;

use Rhubarb\Crown\Events\Event;
use Rhubarb\Leaf\Leaves\LeafModel;

class HierarchyModel extends LeafModel
{
    public $savePressedEvent;
    public $cancelPressedEvent;

    public function __construct()
    {
        parent::__construct();

        $this->savePressedEvent = new Event();
        $this->cancelPressedEvent = new Event();
    }
}
