<?php

namespace SuperCMS\Leaves\Site\Basket;

use Rhubarb\Crown\Exceptions\ForceResponseException;
use Rhubarb\Crown\Response\RedirectResponse;
use Rhubarb\Leaf\Table\Leaves\Table;
use Rhubarb\Stem\Exceptions\RecordNotFoundException;
use SuperCMS\Controls\GlobalBasket\GlobalBasket;
use SuperCMS\Models\Shopping\Basket;
use SuperCMS\Models\Shopping\BasketItem;
use SuperCMS\SuperCMS;

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
                    GlobalBasket::getInstance()->replace();

                    return SuperCMS::$currencySymbol . number_format(Basket::getCurrentBasket()->getTotalCost(), 2);
                } else {
                    throw new ForceResponseException(new RedirectResponse('/403/'));
                }
            } catch (RecordNotFoundException $ex) {
            }
        });

        $this->model->updateQuantityEvent->attachHandler(function($id, $amount) {
            try {
                $basketItem = new BasketItem($id);
                $basket = Basket::getCurrentBasket();
                if ($basketItem->BasketID == $basket->UniqueIdentifier) {
                    $basketItem->Quantity = $amount;
                    $basketItem->save();
                    GlobalBasket::getInstance()->replace();

                    $data = new \stdClass();
                    $data->Total = SuperCMS::$currencySymbol . number_format($basket->getTotalCost(), 2);
                    $data->Single = $basketItem->getTotalCost();
                    return $data;
                } else {
                    throw new ForceResponseException(new RedirectResponse('/403/'));
                }
            } catch (RecordNotFoundException $ex) {
            }
        });
    }
}
