<?php

namespace SuperCMS\Leaves\Admin\Products\ProductVariations;

use Rhubarb\Leaf\Leaves\Leaf;
use SuperCMS\Models\Product\Product;

class ProductVariations extends Leaf
{
    /**
     * @var ProductVariationsModel $model
     */
    protected $model;
    protected $product = null;

    public function __construct(Product $product, $name = null, $initialiseModelBeforeView = null)
    {
        $this->product = $product;

        parent::__construct($name, $initialiseModelBeforeView);
    }

    protected function createModel()
    {
        return new ProductVariationsModel();
    }

    protected function getViewClass()
    {
        return ProductVariationsView::class;
    }

    protected function onModelCreated()
    {
        $this->model->product = $this->product;
    }
}
