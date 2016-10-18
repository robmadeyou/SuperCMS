<?php

namespace SuperCMS\Leaves\Site\Product;


use Rhubarb\Crown\Events\Event;
use Rhubarb\Leaf\Crud\Leaves\ModelBoundModel;

class ProductItemModel extends ModelBoundModel
{

    /** @var Event */
    public $addToCartEvent;

    public function __construct()
    {
        parent::__construct();

        $this->addToCartEvent = new Event();
    }
}
