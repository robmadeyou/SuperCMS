<?php

namespace SuperCMS\Leaves\Site\Checkout\Address;

use Rhubarb\Leaf\Controls\Common\Text\TextBox;
use SuperCMS\Controls\HtmlButton\HtmlButton;
use SuperCMS\Leaves\Site\Checkout\CheckoutView;

class CheckoutAddressView extends CheckoutView
{
    protected function getTitle()
    {
        return 'Your Shipping address';
    }

    protected function createSubLeaves()
    {
        parent::createSubLeaves();

        $this->registerSubLeaf(
            new TextBox('Address1'),
            new TextBox('Address2'),
            new TextBox('Address3'),
            $nextButton = new HtmlButton('Next', 'Next: Payment', function() {
                $this->model->nextEvent->raise();
            })
        );

        $nextButton->addCssClassNames('button', 'button-checkout');

    }

    protected function printBody()
    {
        ?>
        <div class="row">
            <div class="col-sm-6">
                <?php
                $this->printFieldset('',
                    [
                        'Address 1' => 'Address1',
                        'Address 2' => 'Address2',
                        'Address 3' => 'Address3'
                    ]
                );
                ?>
            </div>
            <div class="col-sm-6">

            </div>
        </div>
        <?php
    }

    protected function printStepButtons()
    {
        print '<a href="/" class="btn btn-default">Cancel</a>' . $this->leaves['Next'];
    }
}
