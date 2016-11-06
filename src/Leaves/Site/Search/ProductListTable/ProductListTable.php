<?php

namespace SuperCMS\Leaves\Site\Search\ProductListTable;

use Rhubarb\Leaf\Table\Leaves\Table;

class ProductListTable extends Table
{
    protected function getViewClass()
    {
        return ProductListTableView::class;
    }
}
