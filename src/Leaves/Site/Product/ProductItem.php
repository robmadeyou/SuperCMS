<?php

namespace SuperCMS\Leaves\Site\Product;

use Rhubarb\Leaf\Crud\Leaves\ModelBoundLeaf;
use Rhubarb\Leaf\Crud\Leaves\ModelBoundModel;
use SuperCMS\Controls\Notification\NotificationPrint;
use SuperCMS\Models\Product\ProductVariation;
use SuperCMS\Models\Shopping\Basket;

class ProductItem extends ModelBoundLeaf
{

    /** @var ProductItemModel */
    protected $model;

    protected function getViewClass()
    {
        return ProductItemView::class;
    }

    protected function createModel()
    {
        $model = new ProductItemModel();

        $model->addToCartEvent->attachHandler(function() {
            Basket::addVariationToBasket($this->model->selectedVariation);
            print new NotificationPrint('Item: <strong>' . $this->model->selectedVariation->Name . '</strong> successfully added to basket <a href="google.com">Click here to view your basket</a>');
        });

        $model->changeSelectedVariationEvent->attachHandler(function($id) {
            $this->setSelectedVariation(new ProductVariation($id));
            $variation = $this->model->selectedVariation;

            $class = new \stdClass();
            $class->MainImage = $variation->getPrimaryImage();
            $class->LargeImage = $variation->getPrimaryImage();
            $class->Cost = $variation->Price;
            $class->AmountAvailable = $variation->AmountAvailable;


            return $class;
        });

        return $model;
    }

    protected function onModelCreated()
    {
        $model = parent::onModelCreated();

        if (!$this->model->selectedVariation && $this->model->selectedVariationId) {
            $this->model->selectedVariation = new ProductVariation($this->model->selectedVariationId);
        }

        $this->model->selectedVariation = $this->model->restModel->getDefaultProductVariation();

        return $model;
    }

    public function setSelectedVariation(ProductVariation $variation)
    {
        $this->model->selectedVariationId = $variation->UniqueIdentifier;
        $this->model->selectedVariation = $variation;
    }


}
