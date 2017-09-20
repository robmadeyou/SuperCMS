<?php

namespace SuperCMS\Leaves\Site\Checkout\Payment;

use Rhubarb\Leaf\Leaves\LeafDeploymentPackage;
use SuperCMS\Controls\HtmlButton\HtmlButton;
use SuperCMS\Leaves\Site\Checkout\CheckoutView;

class CheckoutPaymentView extends CheckoutView
{
    protected function getTitle()
    {
        return 'Payment';
    }

    protected function createSubLeaves()
    {
        parent::createSubLeaves();

        $this->registerSubLeaf(
            $nextButton = new HtmlButton('Next', 'Submit', function() {
                $this->model->nextEvent->raise();
            })
        );

        $nextButton->addCssClassNames('btn', 'button', 'button-checkout');
    }

    protected function printBody()
    {
        ?>
        <script src="https://checkout.stripe.com/checkout.js"></script>
        <div id="js-payment-target">
        </div>
        <?php
    }

    protected function printStepButtons()
    {
        print '<a href="/checkout/address/" class="btn btn-default">Back</a> ' . $this->leaves['Next'];
    }

    protected function getViewBridgeName()
    {
        return 'CheckoutPaymentViewBridge';
    }

    public function getDeploymentPackage()
    {
        $package = new LeafDeploymentPackage();
        $package->resourcesToDeploy[] = __DIR__ . '/CheckoutPaymentViewBridge.js';
        return $package;
    }
}
