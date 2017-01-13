<?php

namespace SuperCMS\Leaves\Site\Checkout\Success;

use SuperCMS\Leaves\Site\Checkout\CheckoutModel;
use SuperCMS\Models\Shopping\Order;

class CheckoutSuccessModel extends CheckoutModel
{
    /** @var Order $order */
    public $order;
}
