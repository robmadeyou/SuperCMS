<?php

namespace SuperCMS\Leaves\Admin\Orders;

use Rhubarb\Crown\Exceptions\ForceResponseException;
use Rhubarb\Crown\Response\RedirectResponse;
use SuperCMS\Leaves\Admin\AdminCrudLeaf;
use SuperCMS\Models\Shopping\OrderItem;

class OrdersItem extends AdminCrudLeaf
{
    protected function getViewClass()
    {
        return OrdersItemView::class;
    }

    protected function onModelCreated()
    {
        parent::onModelCreated();

        foreach ($this->model->restModel->OrderItems as $orderItem) {
            $this->model->OrderItemStatus[$orderItem->UniqueIdentifier] = $orderItem->Status;
        }
    }

    protected function saveRestModel()
    {
        foreach ($this->model->OrderItemStatus as $key => $status) {
            $orderItem = new OrderItem($key);
            $orderItem->Status = $status;
            $orderItem->save();
        }

        $save = parent::saveRestModel();
        return $save;
    }

    protected function redirectAfterCancel()
    {
        throw new ForceResponseException(new RedirectResponse('../'));
    }
}
