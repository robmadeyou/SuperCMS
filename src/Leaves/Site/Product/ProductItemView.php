<?php

namespace SuperCMS\Leaves\Site\Product;

use Rhubarb\Leaf\Controls\Common\Buttons\Button;
use Rhubarb\Leaf\Views\View;
use SuperCMS\Models\Product\Product;

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
        $product = $this->model->restModel;
        print $this->leaves['AddToBasket'];

        $this->printProductTitle($product);
        ?>
        <div class="row">
            <div class="col-sm-5 c-product-image-section">
                <?php $this->printProductImages($product); ?>
            </div>
            <div class="col-sm-7">
                <?php $this->printProductDescription($product); ?>
            </div>
        </div>
        <?php
    }

    protected function printProductTitle(Product $product)
    {
        print $product->Name;
    }

    protected function printProductImages(Product $product)
    {
        ?>
        <img class="main-image" src="<?=$product->getDefaultImage()?>">
        <?php
    }

    protected function printProductDescription(Product $product)
    {
        print $product->Description;
    }
}
