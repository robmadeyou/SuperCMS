<?php

namespace SuperCMS\Leaves\Site\Checkout;

use Rhubarb\Crown\Events\Event;
use Rhubarb\Crown\Settings\HtmlPageSettings;
use Rhubarb\Leaf\Leaves\LeafModel;
use SuperCMS\Models\Shopping\Basket;

class CheckoutModel extends LeafModel
{
    /** @var Basket */
    public $basket;

    public $previousEvent;
    public $nextEvent;

    public $requiredFields;

    public function __construct()
    {
        parent::__construct();

        $this->requiredFields = [];

        $this->previousEvent = new Event();
        $this->nextEvent = new Event();

        $htmlSettings = HtmlPageSettings::singleton();
        $htmlSettings->pageTitle = 'Checkout';
    }

    protected function getExposableModelProperties()
    {
        return array_merge(
            parent::getExposableModelProperties(),
            [
                'requiredFields'
            ]
        );
    }
}
