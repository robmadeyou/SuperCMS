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

        $values = [
            'stripeLiveSecret',
            'stripeTestSecret',
            'stripeLivePublish',
            'stripeTestPublish',
            'websiteName',
            'developmentMode',
            'enableStripePayment',
            'blogSubdomain',
            'enableBlog',
        ];

        $this->model->savePressedEvent->attachHandler(function () use ($settings, $values) {
            foreach ($values as $value) {
                $settings->{$value} = $this->model->{$value};
            }
        });

        $this->model->cancelPressedEvent->attachHandler(function () {
            throw new ForceResponseException(new RedirectResponse('/admin/dashboard/'));
        });

        foreach ($values as $value) {
            $this->model->{$value} = $settings->{$value};
        }
    }
}
