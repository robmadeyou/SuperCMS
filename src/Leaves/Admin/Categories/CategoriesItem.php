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

    protected function saveRestModel()
    {
        if (!$this->model->restModel->Visible) {
            $this->model->restModel->Visible = true;
        }
        return parent::saveRestModel();
    }
}
