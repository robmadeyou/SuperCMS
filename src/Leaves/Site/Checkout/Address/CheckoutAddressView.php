<?php

namespace SuperCMS\Leaves\Site\Checkout\Address;

use Rhubarb\Leaf\Leaves\LeafDeploymentPackage;
use SuperCMS\Controls\HtmlButton\HtmlButton;
use SuperCMS\Controls\LocationPicker\LocationPicker;
use SuperCMS\Leaves\Site\Checkout\CheckoutView;

class CheckoutAddressView extends CheckoutView
{
    protected function getTitle()
    {
        return 'Your Shipping address <button type="button" class="btn btn-primary js-add-location" data-toggle="modal" data-target=".modal-location-edit">Add a new Location</button>';
    }

    protected function createSubLeaves()
    {
        parent::createSubLeaves();

        $this->registerSubLeaf(
            $nextButton = new HtmlButton('Next', 'Next: Payment', function() {
                $this->model->nextEvent->raise();
            }),
            new LocationPicker('Locations')
        );

        $nextButton->addCssClassNames('button', 'button-checkout');
        $nextButton->addHtmlAttribute('style', 'display:none;');
    }

    protected function printBody()
    {
        ?>
        <script src="https://checkout.stripe.com/checkout.js"></script>
        <div id="js-payment-target">
        </div>
        <?= $this->leaves['Locations']?>
        <?php
    }

    protected function printStepButtons()
    {
        print '<a href="/" class="btn btn-default">Cancel</a> <input type="button" class=" btn button button-checkout" id="stripe-payment" value="Next: Payment">' . $this->leaves['Next'];
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
