<?php

namespace SuperCMS\Leaves\Site\Checkout;

use Rhubarb\Crown\Settings\HtmlPageSettings;
use Rhubarb\Leaf\Views\View;
use SuperCMS\Views\BootstrapViewTrait;

abstract class CheckoutView extends View
{
    use BootstrapViewTrait;

    //use SearchPanelTrait;

    /** @var CheckoutModel */
    protected $model;

    protected function beforeRender()
    {
        parent::beforeRender();
        $this->bootstrapInputs();

        if (isset($this->model->requiredFields)) {
            foreach ($this->model->requiredFields as $requiredField) {
                if (isset($this->model->$requiredField) && $this->model->$requiredField == '') {
                    $this->leaves[ $requiredField ]->error = true;
                }
            }
        }

        $htmlSettings = HtmlPageSettings::singleton();
        $htmlSettings->pageTitle = 'Checkout: your basket';
    }

    protected function printViewContent()
    {
        ?>
        <div class="c-checkout-body">
            <h1 class="c-title"><?= $this->getTitle() ?></h1>
            <div class="c-checkout-content">
                <?php $this->printBody() ?>
            </div>
            <div class="row">
                <div class="col-md-4 col-md-offset-4">
                    <div class="c-checkout-buttons">
                        <?php $this->printStepButtons() ?>
                    </div>
                </div>
            </div>
        </div>

        <?php
    }

    abstract protected function getTitle();
    abstract protected function printBody();
    abstract protected function printStepButtons();
}