<?php

namespace SuperCMS\Leaves\Admin\Settings;

use Rhubarb\Leaf\Controls\Common\Checkbox\Checkbox;
use Rhubarb\Leaf\Controls\Common\Text\TextBox;
use SuperCMS\Views\SuperCMSCrudView;

class SettingsView extends SuperCMSCrudView
{
    protected function createSubLeaves()
    {
        parent::createSubLeaves();

        $this->registerSubLeaf(
            new Checkbox('EnableStripePayment'),
            new TextBox('StripeTestToken'),
            new TextBox('StripeLiveToken')
        );

        $this->bootstrapInputs();
    }

    protected function printBody()
    {
        $this->printFieldset('',
            [
                'Enable Stripe Payment' => 'EnableStripePayment',
                'Stripe Test Token' => 'StripeTestToken',
                'Stripe Live Token' => 'StripeLiveToken',
            ]);
    }

    protected function getTitle()
    {
        return 'Settings';
    }
}