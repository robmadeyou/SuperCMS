<?php

namespace SuperCMS\Leaves\Admin\Settings;

use Rhubarb\Crown\Exceptions\ForceResponseException;
use Rhubarb\Crown\Response\RedirectResponse;
use Rhubarb\Leaf\Leaves\Leaf;
use SuperCMS\Settings\SuperCMSSettings;

class SettingsLeaf extends Leaf
{
    /** @var SettingsModel */
    protected $model;

    protected function getViewClass()
    {
        return SettingsView::class;
    }

    protected function createModel()
    {
        $model = new SettingsModel();
        return $model;
    }

    protected function onModelCreated()
    {
        parent::onModelCreated();

        $settings = SuperCMSSettings::singleton();

        $this->model->savePressedEvent->attachHandler(function () use ($settings) {
            $settings->stripeLiveSecret = $this->model->StripeLiveSecret;
            $settings->stripeTestSecret = $this->model->StripeTestSecret;
            $settings->stripeLivePublish = $this->model->StripeLivePublish;
            $settings->stripeTestPublish = $this->model->StripeTestPublish;
            $settings->websiteName = $this->model->WebsiteName;
            $settings->developmentMode = $this->model->DeveloperMode;
            $settings->enableStripePayment = $this->model->EnableStripePayment;
        });

        $this->model->cancelPressedEvent->attachHandler(function () {
            throw new ForceResponseException(new RedirectResponse('/admin/dashboard/'));
        });

        $this->model->StripeLiveSecret = $settings->stripeLiveSecret;
        $this->model->StripeTestSecret = $settings->stripeTestSecret;
        $this->model->StripeLivePublish = $settings->stripeLivePublish;
        $this->model->StripeTestPublish = $settings->stripeTestPublish;
        $this->model->DeveloperMode = $settings->developmentMode;
        $this->model->WebsiteName = $settings->websiteName;
        $this->model->EnableStripePayment = $settings->enableStripePayment;
    }
}
