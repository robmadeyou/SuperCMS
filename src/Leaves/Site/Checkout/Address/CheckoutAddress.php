<?php

namespace SuperCMS\Leaves\Site\Checkout\Address;

use Rhubarb\Crown\Exceptions\ForceResponseException;
use Rhubarb\Crown\Response\RedirectResponse;
use Stripe\Charge;
use Stripe\Error\Card;
use Stripe\Stripe;
use SuperCMS\Leaves\Site\Checkout\Checkout;
use SuperCMS\Models\Shopping\Basket;
use SuperCMS\Models\Shopping\Order;
use SuperCMS\Models\Shopping\OrderItem;
use SuperCMS\Models\User\SuperCMSUser;
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

        $loggedIn = SuperCMSUser::getLoggedInUser();

        $this->model->Address = $loggedIn->Address;
        $this->model->Address2 = $loggedIn->Address2;
        $this->model->PostCode = $loggedIn->PostCode;

        $this->model->email = $loggedIn->Email;

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

            $data = new \stdClass();
            try {
                $charge = Charge::create([
                    'amount' => $basket->getTotalCost() * 100,
                    'currency' => 'gbp',
                    'sourcee' => $token->id,
                    'description' => $settings->websiteName . ' shop',
                ]);

                $order = new Order();
                $order->BasketID = $basket->UniqueIdentifier;
                $order->save();

                foreach ($basket->BasketItems as $item) {
                    $orderItem = new OrderItem();
                    $orderItem->OrderID = $order->UniqueIdentifier;
                    $orderItem->BasketItemID = $item->UniqueIdentifier;
                    $orderItem->save();
                }

                $basket->markPaid();

                $data->url = '/checkout/success/?uq=' . $order->UniqueReference;
                $data->success = true;
            } catch (\Exception $e) {
                $data->success = false;
                $data->error = 'Receiving payment failed!';
            }

            return $data;
        } );
    }
}
