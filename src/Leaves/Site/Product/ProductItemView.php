<?php

namespace SuperCMS\Leaves\Site\Product;

use Rhubarb\Leaf\Controls\Common\Buttons\Button;
use Rhubarb\Leaf\Views\View;

class ProductItemView extends View
{
    protected function createSubLeaves()
    {
        $this->registerSubLeaf(
            $addToBasket = new Button('AddToBasket', 'Add To Basket', function()
            {
                $this->model->addToCartEvent->raise();
            }, true)
        );
    }

    protected function printViewContent()
    {
        print $this->model->restModel->Name;
        print $this->leaves['AddToBasket'];
    }
}
