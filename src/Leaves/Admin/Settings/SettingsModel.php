<?php

namespace SuperCMS\Leaves\Admin\Settings;

use Rhubarb\Leaf\Crud\Leaves\CrudModel;

class SettingsModel extends CrudModel
{
    public $EnableStripePayment;

    public $DeveloperMode;
    public $WebsiteName;
    public $StripeTestSecret;
    public $StripeTestPublish;
    public $StripeLiveSecret;
    public $StripeLivePublish;
}
