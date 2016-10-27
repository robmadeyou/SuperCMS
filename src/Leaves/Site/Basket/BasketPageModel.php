<?php

namespace SuperCMS\Leaves\Site\Basket;

use Rhubarb\Leaf\Leaves\LeafModel;
use SuperCMS\Models\Shopping\Basket;

class BasketPageModel extends LeafModel
{
    /** @var Basket */
    public $basket;
}
