<?php

namespace SuperCMS\Leaves\Site\Product;

use Rhubarb\Leaf\Crud\Leaves\ModelBoundLeaf;
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
        return new ProductItemModel();
    }

    protected function onModelCreated()
    {
        parent::onModelCreated();

        $this->model->selectedVariation = $this->model->restModel->getDefaultProductVariation();

        $this->model->addToCartEvent->attachHandler(function() {
            Basket::addVariationToBasket($this->getSelectedVariation());
            print new NotificationPrint('Item: <strong>' . $this->getSelectedVariation()->Name . '</strong> successfully added to basket <a href="/basket/">Click here to view your basket</a>');
        });

        $this->model->changeSelectedVariationEvent->attachHandler(function($id) {
            $this->setSelectedVariation(new ProductVariation($id));
            $variation = $this->model->selectedVariation;

            $class = new \stdClass();
            $class->MainImage = $variation->getPrimaryImage();
            $class->LargeImage = $variation->getPrimaryImage();
            $class->Name = $variation->Name;
            $class->Cost = $variation->Price;
            $class->Desc = $variation->Description;
            $class->AmountAvailable = $variation->AmountAvailable;
            $class->ImagesHTML = $this->model->getImagesHTMLEvent->raise($variation);

            return $class;
        });
    }

    public function setSelectedVariation(ProductVariation $variation)
    {
        $this->model->selectedVariationId = $variation->UniqueIdentifier;
        $this->model->selectedVariation = $variation;
    }

    /**
     * @return ProductVariation
     */
    protected function getSelectedVariation()
    {
        if ($this->model->selectedVariationId&& $this->model->selectedVariationId != $this->model->selectedVariation->UniqueIdentifier) {
            return new ProductVariation($this->model->selectedVariationId);
        } else {
            return $this->model->selectedVariation;
        }
    }
}
