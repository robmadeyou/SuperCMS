<?php

namespace SuperCMS\Leaves\Site\Checkout\Address;

use Stripe\Charge;
use Stripe\Error\Card;
use Stripe\Stripe;
use SuperCMS\Leaves\Site\Checkout\Checkout;
use SuperCMS\Models\Shopping\Basket;
use SuperCMS\Models\Shopping\Order;
use SuperCMS\Settings\SuperCMSSettings;

class CheckoutAddress extends Checkout
{
    /** @var CheckoutAddressModel $model */
    protected $model;

    protected function getViewClass()
    {
        return CheckoutAddressView::class;
    }

    protected function createModel()
    {
        return new CheckoutAddressModel();
    }

    protected function onModelCreated()
    {
        parent::onModelCreated();

        $this->model->requiredFields = [
            'Address',
            'Address2',
        ];

        $settings = SuperCMSSettings::singleton();
        if ($settings->developmentMode) {
            $this->model->stripePubKey = $settings->stripeTestPublish;
        } else {
            $this->model->stripePubKey = $settings->stripeLivePublish;
        }

        $basket = Basket::getCurrentBasket();
        $this->model->basketAmount = $basket->getTotalCost() * 100;

        $this->model->paymentMadeEvent->attachHandler(function ($token) use ($settings, $basket) {
            Stripe::setApiKey($settings->getStripeToken());

            try {
                $charge = Charge::create([
                    'amount' => $basket->getTotalCost() * 100,
                    'currency' => 'gbp',
                    'source' => $token->id,
                    'description' => $settings->websiteName . ' shop',
                ]);

                $order = new  Order();
                $order->BasketID = $basket->UniqueIdentifier;
                $order->save();
            } catch (Card $e) {
                $aj = true;
            }
        } );
    }
}
