<?php

namespace SuperCMS\Leaves\Site\Checkout\Address;

use Rhubarb\Leaf\Leaves\LeafDeploymentPackage;
use SuperCMS\Controls\HtmlButton\HtmlButton;
use SuperCMS\Controls\LocationPicker\LocationPicker;
use SuperCMS\Leaves\Site\Checkout\CheckoutView;

class CheckoutAddressView extends CheckoutView
{
    protected function createSubLeaves()
    {
        parent::createSubLeaves();

        $this->registerSubLeaf(
            $nextButton = new HtmlButton('Next', 'Next: Payment', function() {
                $this->model->nextEvent->raise();
            }),
            new LocationPicker('Locations')
        );

        $nextButton->addCssClassNames('btn', 'button', 'button-checkout');
    }

    protected function getTitle()
    {
        return 'Your Shipping address';
    }

    protected function printBody()
    {
        ?>
        <button type="button" class="btn btn-primary js-add-location" data-toggle="modal" data-target=".modal-location-edit"><i class="fa fa-plus" aria-hidden="true"></i> Add a new Location</button>
        <?= $this->leaves['Locations']?>
        <?php
    }

    protected function printStepButtons()
    {
        print '<a href="/checkout/summary/" class="btn btn-default">Back</a> ' . $this->leaves['Next'];
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
