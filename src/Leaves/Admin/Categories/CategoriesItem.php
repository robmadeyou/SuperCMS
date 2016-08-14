<?php

namespace SuperCMS\Leaves\Admin\Categories;


use Rhubarb\Leaf\Crud\Leaves\CrudLeaf;

class CategoriesItem extends CrudLeaf
{
    protected function getViewClass()
    {
        return CategoriesItemView::class;
    }
}