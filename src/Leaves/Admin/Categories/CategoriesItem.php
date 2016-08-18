<?php

namespace SuperCMS\Leaves\Admin\Categories;

use Rhubarb\Leaf\Crud\Leaves\CrudLeaf;
use SuperCMS\Leaves\Admin\AdminCrudLeaf;

class CategoriesItem extends AdminCrudLeaf
{
    protected function getViewClass()
    {
        return CategoriesItemView::class;
    }
}
