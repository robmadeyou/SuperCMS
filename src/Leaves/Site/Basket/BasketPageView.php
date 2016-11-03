<?php

namespace SuperCMS\Leaves\Site\Basket;

use Rhubarb\Leaf\Controls\Common\Buttons\Button;
use Rhubarb\Leaf\Table\Leaves\Columns\LeafColumn;
use Rhubarb\Leaf\Table\Leaves\Table;
use Rhubarb\Leaf\Views\View;
use Rhubarb\Stem\Exceptions\RecordNotFoundException;
use SuperCMS\Models\Shopping\BasketItem;

class BasketPageView extends View
{
    /** @var BasketPageModel */
    protected $model;

    protected function createSubLeaves()
    {
        $this->registerSubLeaf(
            $table = new Table($this->model->basket->BasketItems, '10', 'Table'),
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

        $removeItemButton->setConfirmMessage('Are you sure you want to remove these item(s) from your basket?');
        $removeItemButton->addCssClassNames('btn btn-link');

        $table->columns = [
            'Name' => '{ProductVariation.Name}',
            'Quantity',
            'Cost' => '{TotalCost}',
            $removeItemButtonColumn = new LeafColumn($removeItemButton),
        ];

        $table->setNoDataHtml('Your basket seems to be empty, why not <a href="/">add some items?</a>');

        $table->addCssClassNames('table');
    }

    protected function printViewContent()
    {
        ?>
        <div class="c-basket-outer">
            <div class="row">
                <div class="col-sm-12">
                    <h1>Your Basket</h1>
                    <?php $this->printBasketControl(); ?>
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
