<?php

namespace SuperCMS\Leaves\Admin\ShippingType;

use SuperCMS\Views\SuperCMSCrudView;

class ShippingTypeItemView extends SuperCMSCrudView
{
    protected function createSubLeaves()
    {
        parent::createSubLeaves();

        $this->registerSubLeaf(
            'ShippingType',
            'UK',
            'NI',
            'ROI',
            'EU',
            'W1',
            'W2'
        );

        $this->bootstrapInputs();
    }

    protected function printBody()
    {
        $this->printFieldset('', [
            'ShippingType',
            'United Kingdom' => 'UK',
            'Northern Ireland' => 'NI',
            'Republic of Ireland' => 'ROI',
            'Europe' => 'EU',
            'World area 1' => 'W1',
            'World area 2' => 'W2',
        ]);
    }
}
