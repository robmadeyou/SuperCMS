<?php

namespace SuperCMS\Controls\Shipping;

use Rhubarb\Stem\Filters\Filter;
use SuperCMS\Controls\Chosen\MultiSelect\ChosenMultiSelect;
use SuperCMS\Models\Shipping\ShippingType;

class ShippingMultiSelection extends ChosenMultiSelect
{
    public function __construct($name = "", Filter $filters = null)
    {
        parent::__construct($name);

        $categories = [];
        foreach (ShippingType::find($filters) as $shippingType) {
            $categories[] = [$shippingType->UniqueIdentifier, $shippingType->ShippingType];
        }

        $this->setSelectionItems($categories);
    }
}
