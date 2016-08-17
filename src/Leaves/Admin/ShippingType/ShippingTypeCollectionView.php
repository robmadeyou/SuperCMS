<?php

namespace SuperCMS\Leaves\Admin\ShippingType;

use Rhubarb\Leaf\Table\Leaves\Table;
use SuperCMS\Models\Shipping\ShippingType;
use SuperCMS\Views\SuperCMSCollectionView;

class ShippingTypeCollectionView extends SuperCMSCollectionView
{
    protected function createSubLeaves()
    {
        $this->registerSubLeaf(
            $table = new Table(ShippingType::find(), 50, 'Table')
        );

        $table->columns = [
            'ShippingType',
            'United Kingdom' => 'UK',
            'Northern Ireland' => 'NI',
            'Republic of Ireland' => 'ROI',
            'Europe' => 'EU',
            'World area 1' => 'W1',
            'World area 2' => 'W2',
            '' => '<a href="{ShippingTypeID}/edit/" class="btn btn-default">Edit</a>'
        ];

        $table->addCssClassNames('table', 'table-striped');
    }

    public function printBody()
    {
        print $this->leaves['Table'];
    }

    protected function printRightButtons()
    {
        print '<a href="add/" class="btn btn-success"><span class="glyphicon glyphicon-plus"></span> Add a Shipping Type</a>';
    }
}
