<?php

namespace SuperCMS\Leaves\Site\Checkout\Address;

use Rhubarb\Leaf\Controls\Common\SelectionControls\RadioButtons\RadioButtons;
use Rhubarb\Leaf\Controls\Common\Text\TextBox;
use Rhubarb\Leaf\Leaves\LeafDeploymentPackage;
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
            new TextBox('Address'),
            new TextBox('Address2'),
            new TextBox('Town'),
            new TextBox('PostCode'),
            new RadioButtons('ShippingAddress'),
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
                        'Address Line 1' => 'Address',
                        'Address Line 2' => 'Address2',
                        'Town' => 'Town',
                        'Post Code' => 'PostCode',
                    ]
                );
                ?>
            </div>
        </div>
        <?php
    }

    protected function printStepButtons()
    {
        print '<a href="/" class="btn btn-default">Cancel</a>' . $this->leaves['Next'];
    }

    public function getDeploymentPackage()
    {
        return new LeafDeploymentPackage(
            __DIR__ . '/' . $this->getViewBridgeName() . '.js'
        );
    }

    protected function getViewBridgeName()
    {
        return 'CheckoutAddressViewBridge';
    }
}
