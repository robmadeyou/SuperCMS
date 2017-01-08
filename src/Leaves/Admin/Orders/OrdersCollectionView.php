<?php

namespace SuperCMS\Leaves\Admin\Orders;

use Rhubarb\Leaf\Table\Leaves\Table;
use SuperCMS\Models\Shopping\Order;
use SuperCMS\SuperCMS;
use SuperCMS\Views\SuperCMSCollectionView;

class OrdersCollectionView extends SuperCMSCollectionView
{
    protected function createSubLeaves()
    {
        parent::createSubLeaves();

        $this->registerSubLeaf(
            $orders = new Table(Order::find()->addSort('DateOrdered'), 50, 'OrdersTable')
        );

        $orders->addCssClassNames('table', 'table-striped', 'table-bordered', 'table-hover');

        $orders->columns = [
            'Total Items' => '{Basket.TotalQuantity}',
            'Total Cost' => SuperCMS::$currencySymbol . '{Basket.TotalCost}',
            'Progress' => '{OrderItemStatus}',
            'Status',
            '' => '<a href="{UniqueIdentifier}/">View</a>',
        ];
    }

    public function printBody()
    {
        print $this->leaves['OrdersTable'];
    }
}
