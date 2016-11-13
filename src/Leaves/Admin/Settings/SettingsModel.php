<?php

namespace SuperCMS\Leaves\Admin\Settings;

use Rhubarb\Leaf\Crud\Leaves\CrudModel;

class SettingsModel extends CrudModel
{
    public $EnableStripePayment;
    public $StripeTestToken;
    public $StripeLiveToken;
}
