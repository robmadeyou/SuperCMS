<?php

namespace SuperCMS\Leaves\Admin\Products;

use Rhubarb\Crown\Events\Event;
use Rhubarb\Leaf\Crud\Leaves\CrudModel;
use SuperCMS\Models\Product\ProductVariation;

class ProductsEditModel extends CrudModel
{
    /**
     * @var ProductVariation $selectedVariation
     */
    public $selectedVariation = null;

    /**
     * @var Event
     */
    public $ChangeProductVariationEvent;

    /**
     * @var Event
     */
    public $AddNewProductEvent;

    /** @var Event */
    public $VariationDeleteEvent;

    /** @var Event */
    public $reRenderEvent;

    public function __construct()
    {
        parent::__construct();

        $this->ChangeProductVariationEvent = new Event();
        $this->AddNewProductEvent = new Event();
        $this->VariationDeleteEvent = new Event();
        $this->reRenderEvent = new Event();
    }

    protected function getExposableModelProperties()
    {
        $properties = parent::getExposableModelProperties();
        $properties[] = 'selectedVariation';
        return $properties;
    }
}
