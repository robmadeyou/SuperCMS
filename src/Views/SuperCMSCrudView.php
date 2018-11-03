<?php

namespace SuperCMS\Views;

use Rhubarb\Leaf\Crud\Leaves\CrudView;
use SuperCMS\Controls\HtmlButton\HtmlButton;
use SuperCMS\Settings\AdminSuperCMSPageSettings;

abstract class SuperCMSCrudView extends CrudView
{
    /** @var AdminSuperCMSPageSettings $htmlSettings */
    protected $htmlSettings;

    protected function createSubLeaves()
    {
        $this->htmlSettings = AdminSuperCMSPageSettings::singleton();

        $this->registerSubLeaf(
            $save = new HtmlButton("Save", "<i class='fa fa-save'></i> Save", function () {
                $this->model->savePressedEvent->raise();
            }),
            $delete = new HtmlButton("Delete", "<i class='fa fa-trash'></i> Delete", function () {
                $this->model->deletePressedEvent->raise();
            }),
            $cancel = new HtmlButton("Cancel", "<i class='fa fa-ban'></i> Cancel", function () {
                $this->model->cancelPressedEvent->raise();
            })
        );

        $this->htmlSettings->pageTitle = $this->getTitle();
        $this->htmlSettings->titleLink = './';
    }

    protected function printViewContent()
    {
        $backLink = $this->model->restModel->UniqueIdentifier ? './../../' : './../';

        $this->htmlSettings->addActionButton("<a class='c-button --square mc-white pull-left' href='$backLink'><i class='fa fa-arrow-left'></i></a>");
        $this->htmlSettings->addActionButton("<a class='c-button --square mc-green js-clickthrough-link pull-left' href='#' forButton='{$this->model->leafPath}_Save'><i class='fa fa-save'></i></a>");

        if ($this->model->restModel->UniqueIdentifier) {
            $this->htmlSettings->addActionButton("<a class='c-button --square mc-red js-clickthrough-link pull-left' href='#' forButton='{$this->model->leafPath}_Delete'><i class='fa fa-trash'></i></a>");
        }

        ?>
        <div>
            <?php $this->printBody() ?>
        </div>
        <div style="display: none">
            <?php $this->printFormButtons() ?>
        </div>
        <?php
    }

    protected function printFormButtons()
    {
        print $this->leaves['Save'] . $this->leaves['Delete'] . $this->leaves['Cancel'];
    }

    abstract protected function printBody();
}
