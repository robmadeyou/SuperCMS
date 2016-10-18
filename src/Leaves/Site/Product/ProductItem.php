<?php

namespace SuperCMS\Leaves\Site\Product;

use Rhubarb\Leaf\Crud\Leaves\ModelBoundLeaf;
use Rhubarb\Leaf\Crud\Leaves\ModelBoundModel;
use SuperCMS\Controls\Notification\NotificationPrint;

class ProductItem extends ModelBoundLeaf
{
    protected function getViewClass()
    {
        return ProductItemView::class;
    }

    protected function createModel()
    {
        $model = new ProductItemModel();

        $model->addToCartEvent->attachHandler(function() {
            print new NotificationPrint('Item successfully added to basket');
        });

        return $model;
    }
}
