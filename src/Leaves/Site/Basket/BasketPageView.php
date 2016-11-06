<?php

namespace SuperCMS\Leaves\Site\Basket;

use Rhubarb\Crown\Settings\HtmlPageSettings;
use Rhubarb\Leaf\Controls\Common\Buttons\Button;
use Rhubarb\Leaf\Views\View;
use Rhubarb\Stem\Exceptions\RecordNotFoundException;
use SuperCMS\Models\Shopping\Basket;
use SuperCMS\Models\Shopping\BasketItem;

class BasketPageView extends View
{
    /** @var BasketPageModel */
    protected $model;

    protected function createSubLeaves()
    {
        $settings = HtmlPageSettings::singleton();
        $settings->pageTitle = 'Your basket';

        $this->registerSubLeaf(
            $table = new BasketTable($this->model->basket->BasketItems, '10', 'Table'),
            $removeItemButton = new Button('RemoveItem', 'Remove', function ($id) {
                try {
                    $basketItem = new BasketItem($id);
                    $basketItem->delete();
                } catch (RecordNotFoundException $ex) {
                }
            }),
            $toCheckoutButton = new Button('ToCheckout', 'To Checkout', function () {

            })
        );

        $table->setNoDataHtml('Your basket seems to be empty, why not <a href="/">add some items?</a>');

        $table->addCssClassNames('table');
    }

    protected function printViewContent()
    {
        ?>
        <div class="c-basket-outer">
            <h1>Your Basket</h1>
            <div class="row marginless c-basket-outer">
                <div class="col-sm-9">
                    <?php $this->printBasketControl(); ?>
                </div>
                <div class="col-sm-3 c-basket-summary">
                    <div class="c-basket-summary--inner">
                        <h3>Summary</h3>
                        <h4>Total: <span class="c-basket-total">&pound;<?= number_format(Basket::getCurrentBasket()->getTotalCost(), 2) ?></span></h4>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }

    protected function printBasketControl()
    {
        print $this->leaves['Table'];
    }
}
