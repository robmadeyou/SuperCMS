<?php

namespace SuperCMS\Leaves\Admin\Orders;

use Rhubarb\Leaf\Table\Leaves\Table;
use SuperCMS\Models\Shopping\Order;
use SuperCMS\SuperCMS;
use SuperCMS\Views\SuperCMSCollectionView;

class OrdersCollectionView extends SuperCMSCollectionView
{
    protected function getTitle()
    {
        return 'Orders';
    }

    protected function createSubLeaves()
    {
        parent::createSubLeaves();

        $this->registerSubLeaf(
            $orders = new Table(Order::find()->addSort('DateOrdered'), 50, 'OrdersTable'),
            $searchPanel = new OrdersSearchPanel('Search')
        );

        $orders->getRowCssClassesEvent->attachHandler(function($model) {
            switch ($model->Status) {
                case Order::STATUS_PENDING:
                    return ['active'];
                case Order::STATUS_IN_PROGRESS:
                    return ['warning'];
                case Order::STATUS_DISPATCHED:
                    return ['success'];
                default:
                    return [];
            }
        });

        $orders->addCssClassNames('table', 'table-striped', 'table-bordered', 'table-hover');

        $orders->columns = [
            'Total Items' => '{Basket.TotalQuantity}',
            'Total Cost' => SuperCMS::$currencySymbol . '{Basket.TotalCost}',
            'Progress' => '{OrderItemStatus}',
            'Status',
            'Date Ordered' => 'DateOrdered',
            '' => '<a class="go" href="{UniqueIdentifier}/">View</a>',
        ];

        $orders->bindEventsWith($searchPanel);
        $this->bootstrapInputs();
    }

    protected function printSearchPanel()
    {
        print $this->leaves['Search'];
    }

    public function printBody()
    {
        print $this->leaves['OrdersTable'];
    }
}
