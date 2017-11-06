<?php

namespace SuperCMS\Leaves\Admin\Products\ProductVariations;

use Rhubarb\Crown\Events\Event;
use Rhubarb\Leaf\Leaves\LeafModel;
use SuperCMS\Models\Product\Product;

class ProductVariationsModel extends LeafModel
{
    /**
     * @var Product
     */
    public $product = null;
    public $selectedVariationId;

    /** @var Event $changeVariationEvent */
    public $changeVariationEvent = null;
    /** @var Event $deleteVariationEvent */
    public $deleteVariationEvent = null;

    public function __construct()
    {
        parent::__construct();

        $this->changeVariationEvent = new Event();
        $this->deleteVariationEvent = new Event();
    }

    public function getVariations()
    {
        return $this->product->Variations;
    }

    protected function getExposableModelProperties()
    {
        $properties = parent::getExposableModelProperties();

        $properties[] = 'selectedVariationID';

        return $properties;
    }
}
