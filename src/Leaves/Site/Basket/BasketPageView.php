<?php

namespace SuperCMS\Leaves\Site\Basket;

use Rhubarb\Crown\Settings\HtmlPageSettings;
use Rhubarb\Leaf\Controls\Common\Buttons\Button;
use Rhubarb\Leaf\Views\View;
use Rhubarb\Stem\Exceptions\RecordNotFoundException;
use SuperCMS\Controls\HtmlButton\HtmlButton;
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
            $table = new BasketTable( $this->model->basket->BasketItems, '10', 'Table' ),
            $removeItemButton = new Button( 'RemoveItem', 'Remove', function ( $id ) {
                try {
                    $basketItem = new BasketItem( $id );
                    $basketItem->delete();
                } catch ( RecordNotFoundException $ex ) {
                }
            } ),
            $toCheckoutButton = new HtmlButton( 'ToCheckout',
                'To Checkout <i class="fa fa-shopping-cart" aria-hidden="true"></i>', function () {
                    $this->model->toCheckoutEvent->raise();
                } )
        );

        $toCheckoutButton->addCssClassNames( 'button', 'button-full-width' );

        $table->addCssClassNames( 'table' );
    }

    protected function printViewContent()
    {
        $count = $this->model->basket->BasketItems->count();
        ?>
        <div class="c-basket-outer">
            <h1 class="c-title"><?= $count ? 'Your Basket' : 'Oh no!' ?></h1>
            <?php
            if ($count) {
                ?>
                <div class="row marginless c-basket-outer">
                    <div class="col-sm-9">
                        <?php $this->printBasketControl(); ?>
                    </div>
                    <div class="col-sm-3 c-basket-summary">
                        <div class="c-basket-summary--inner">
                            <h3>Summary</h3>
                            <h4>Total: <span
                                    class="c-basket-total">&pound;<?= number_format( Basket::getCurrentBasket()->getTotalCost(),
                                        2 ) ?></span></h4>
                        </div>
                        <div class="c-to-checkout">
                            <?= $this->leaves[ 'ToCheckout' ] ?>
                        </div>
                    </div>
                </div>
                <?php
            } else {
                print '<div class="c-basket-empty">Your basket seems to be empty, why not <a href="/">add some items?</a></div>';
            }
            ?>
            <div class="clearfix"></div>
        </div>
        <?php
    }

    protected function printBasketControl()
    {
        print $this->leaves[ 'Table' ];
    }
}
