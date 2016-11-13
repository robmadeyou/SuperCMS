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
            $settings->stripeLiveToken = $this->model->StripeLiveToken;
            $settings->stripeTestToken = $this->model->StripeTestToken;
            $settings->enableStripePayment = $this->model->EnableStripePayment;
        });

        $this->model->cancelPressedEvent->attachHandler(function () {
            throw new ForceResponseException(new RedirectResponse('/admin/dashboard/'));
        });

        $this->model->StripeLiveToken = $settings->stripeLiveToken;
        $this->model->StripeTestToken = $settings->stripeTestToken;
        $this->model->EnableStripePayment = $settings->enableStripePayment;
    }
}
