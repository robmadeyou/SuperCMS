<?php

namespace SuperCMS\Leaves\Site\Basket;

use Rhubarb\Crown\Exceptions\ForceResponseException;
use Rhubarb\Crown\Response\RedirectResponse;
use Rhubarb\Leaf\Table\Leaves\Table;
use Rhubarb\Stem\Exceptions\RecordNotFoundException;
use SuperCMS\Models\Shopping\Basket;
use SuperCMS\Models\Shopping\BasketItem;

class BasketTable extends Table
{
    /** @var BasketTableModel */
    protected $model;

    protected function getViewClass()
    {
        return BasketTableView::class;
    }

    protected function createModel()
    {
        $model = new BasketTableModel();

        // Pass through for getRowCssClassesEvent;
        $this->getRowCssClassesEvent = $model->getRowCssClassesEvent;

        return $model;
    }

    protected function onModelCreated()
    {
        parent::onModelCreated();

        $this->model->removeItemEvent->attachHandler(function($id) {
            try {
                $basketItem = new BasketItem($id);
                if ($basketItem->BasketID == Basket::getCurrentBasket()->UniqueIdentifier) {
                    $basketItem->delete();
                } else {
                    throw new ForceResponseException(new RedirectResponse('/403/'));
                }
            } catch (RecordNotFoundException $ex) {
            }
        });
    }
}
