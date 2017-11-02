<?php

namespace SuperCMS\Leaves\Site\Product;

use Rhubarb\Crown\Events\Event;
use Rhubarb\Leaf\Crud\Leaves\ModelBoundModel;
use SuperCMS\Models\Product\Product;
use SuperCMS\Models\Product\ProductVariation;

class ProductItemModel extends ModelBoundModel
{
    /** @var Product */
    public $restModel;

    /** @var Event */
    public $addToCartEvent;

    /** @var Event */
    public $changeSelectedVariationEvent;

    /** @var ProductVariation */
    public $selectedVariation;

    public $selectedVariationId;

    public $getImagesHTMLEvent;

    public function __construct()
    {
        parent::__construct();

        $this->addToCartEvent = new Event();
        $this->changeSelectedVariationEvent = new Event();
        $this->getImagesHTMLEvent = new Event();
    }

    protected function getExposableModelProperties()
    {
        $properties = parent::getExposableModelProperties();

        $properties[] = 'selectedVariationId';

        return $properties;
    }
}
