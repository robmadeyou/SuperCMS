<?php

namespace SuperCMS\Leaves\Site\Category;

use Rhubarb\Leaf\Views\View;

class CategoryItemView extends View
{
    protected function printViewContent()
    {
        print $this->model->restModel->Name;
    }
}
