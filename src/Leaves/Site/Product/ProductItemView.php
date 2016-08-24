<?php

namespace SuperCMS\Leaves\Site\Product;

use Rhubarb\Leaf\Views\View;

class ProductItemView extends View
{
    protected function printViewContent()
    {
        print $this->model->restModel->Name;
    }
}
