<?php

namespace SuperCMS\Leaves\Admin\Products\ProductVariations;

use Rhubarb\Crown\Events\Event;
use Rhubarb\Leaf\Leaves\LeafModel;
use SuperCMS\Models\Product\Product;
use SuperCMS\Models\Product\ProductVariation;

class ProductVariationsModel extends LeafModel
{
    /**
     * @var Product
     */
    public $product = null;
    public $selectedVariationId;

    /** @var ProductVariation|null $selectedVariation */
    private $selectedVariation = null;

    /** @var Event $changeVariationEvent */
    public $changeVariationEvent = null;
    /** @var Event $deleteVariationEvent */
    public $deleteVariationEvent = null;
    /** @var Event $saveVariationEvent */
    public $saveVariationEvent = null;

    public function __construct()
    {
        parent::__construct();

        $this->changeVariationEvent = new Event();
        $this->deleteVariationEvent = new Event();
        $this->saveVariationEvent = new Event();
    }

    public function getVariations()
    {
        return $this->product->Variations;
    }

    public function getCurrentVariation()
    {
        if (!$this->selectedVariation || ($this->selectedVariationId && $this->selectedVariation->UniqueIdentifier != $this->selectedVariationId)) {
            $this->selectedVariation = new ProductVariation($this->selectedVariationId);
        }

        return $this->selectedVariation;
    }

    protected function getExposableModelProperties()
    {
        $properties = parent::getExposableModelProperties();

        $properties[] = 'selectedVariationID';

        return $properties;
    }
}
