<?php

namespace SuperCMS\Leaves\Site\Checkout\Payments;

use Rhubarb\Leaf\Leaves\LeafDeploymentPackage;
use SuperCMS\Leaves\Site\Checkout\CheckoutView;

class CheckoutPaymentsView extends CheckoutView
{
    protected function getTitle()
    {

    }

    protected function printBody()
    {
    }

    protected function printStepButtons()
    {
    }

    public function getDeploymentPackage()
    {
        return new LeafDeploymentPackage(
            __DIR__ . '/' . $this->getViewBridgeName() . '.js'
        );
    }

    protected function getViewBridgeName()
    {
        return 'CheckoutPaymentsViewBridge';
    }
}
