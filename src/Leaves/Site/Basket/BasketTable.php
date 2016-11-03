<?php

namespace SuperCMS\Leaves\Site\Basket;

use Rhubarb\Leaf\Table\Leaves\Table;

class BasketTable extends Table
{
    protected function getViewClass()
    {
        return BasketTableView::class;
    }
}
