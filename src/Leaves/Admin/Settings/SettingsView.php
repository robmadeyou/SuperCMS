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
            new Checkbox('enableStripePayment'),
            new TextBox('stripeTestSecret'),
            new TextBox('stripeTestPublish'),
            new TextBox('stripeLiveSecret'),
            new TextBox('stripeLivePublish'),
            new Checkbox('developmentMode'),
            new TextBox('websiteName'),
            new Checkbox('enableBlog'),
            new TextBox('blogSubdomain')
        );

        $this->bootstrapInputs();
    }

    protected function printBody()
    {
        $this->printFieldset('',
            [
                'Developer Mode' => 'developmentMode',
                'Website Name' => 'websiteName',
                'Enable Stripe Payment' => 'enableStripePayment',
                'Stripe Test Secret' => 'stripeTestSecret',
                'Stripe Test Publishable Key' => 'stripeTestPublish',
                'Stripe Live Secret' => 'stripeLiveSecret',
                'Stripe Live Publishable Key' => 'stripeLivePublish',
                'Enable Blog' => 'enableBlog',
                'Blog Subdomain' => 'blogSubdomain',
            ]);
    }

    protected function getTitle()
    {
        return 'Settings';
    }
}