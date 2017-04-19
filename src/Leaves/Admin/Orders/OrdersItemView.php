<?php

namespace SuperCMS\Leaves\Admin\Orders;

use Rhubarb\Leaf\Controls\Common\SelectionControls\DropDown\DropDown;
use Rhubarb\Leaf\Table\Leaves\Columns\LeafColumn;
use Rhubarb\Leaf\Table\Leaves\Table;
use Rhubarb\Stem\Repositories\MySql\Schema\Columns\MySqlEnumColumn;
use SuperCMS\Models\Shopping\Order;
use SuperCMS\Views\SuperCMSCrudView;

class OrdersItemView extends SuperCMSCrudView
{
    protected function createSubLeaves()
    {
        parent::createSubLeaves();

        $this->registerSubLeaf(
            $table = new Table($this->model->restModel->OrderItems, 5, 'OrderItems'),
            $status = new DropDown('OrderItemStatus')
        );

        $status->setSelectionItems(MySqlEnumColumn::getEnumValues('OrderItem', 'Status'));

        $table->columns = [
            'Item' => '<a href="{BasketItem.ProductVariation.PublicUrl}">{BasketItem.ProductVariation.Name}</a>',
            'BasketItem.Quantity',
            new LeafColumn($status)
        ];


        $table->addCssClassNames('table', 'table-striped', 'table-bordered', 'table-hover');

        $this->bootstrapInputs();
    }

    protected function printBody()
    {
        /** @var Order $order */
        $order = $this->model->restModel;
        ?>
        <form>
            <div class="form-group">
                <label>Order ID</label><br>
                <?= $order->UniqueIdentifier;?>
            </div>
            <div class="form-group">
                <label>Status</label><br>
                <?= $order->Status;?>
            </div>
            <?= $this->leaves['OrderItems']?>
        </form>
        <?php
}

    protected function printLeftButtons()
    {
        print '<a href="../" class="btn btn-default"><i class="fa fa-arrow-circle-left"></i> Back</a>';
    }
}
