<?php

namespace SuperCMS\Leaves\Admin\Settings;

use Rhubarb\Leaf\Controls\Common\Checkbox\Checkbox;
use Rhubarb\Leaf\Controls\Common\Text\TextBox;
use SuperCMS\Controls\ToggleSwitch\ToggleSwitch;
use SuperCMS\Views\SuperCMSCrudView;

class SettingsView extends SuperCMSCrudView
{
    protected function createSubLeaves()
    {
        parent::createSubLeaves();

        $this->registerSubLeaf(
            new Checkbox('EnableStripePayment'),
            new TextBox('StripeTestSecret'),
            new TextBox('StripeTestPublish'),
            new TextBox('StripeLiveSecret'),
            new TextBox('StripeLivePublish'),
            new ToggleSwitch('DeveloperMode'),
            new TextBox('WebsiteName')
        );

        $this->bootstrapInputs();
    }

    protected function printBody()
    {
        $this->printFieldset('',
            [
                'Developer Mode' => 'DeveloperMode',
                'Website Name' => 'WebsiteName',
                'Enable Stripe Payment' => 'EnableStripePayment',
                'Stripe Test Secret' => 'StripeTestSecret',
                'Stripe Test Publishable Key' => 'StripeTestPublish',
                'Stripe Live Secret' => 'StripeLiveSecret',
                'Stripe Live Publishable Key' => 'StripeLivePublish'
            ]);
    }

    protected function getTitle()
    {
        return 'Settings';
    }
}