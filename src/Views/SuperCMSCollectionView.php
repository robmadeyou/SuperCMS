<?php

namespace SuperCMS\Views;

use Rhubarb\Leaf\Views\View;

abstract class SuperCMSCollectionView extends View
{
    use BootstrapViewTrait;

    protected function printViewContent()
    {
        ?>
        <div>
            <?php $this->getTopFunctionBar() ?>
            <?php $this->printBody() ?>
        </div>
        <?php
    }

    protected function getTopFunctionBar()
    {
        ?>
        <div class="row">
            <div class="col-md-2">
                <?php $this->printLeftButtons() ?>
            </div>
            <div class="col-md-7">
                <?php $this->printSearchPanel() ?>
            </div>
            <div class="col-md-3 c-admin-right-buttons">
                <?php $this->printRightButtons() ?>
            </div>
        </div>
        <?php
    }

    protected function printSearchPanel()
    {
    }

    protected function printRightButtons()
    {
    }

    protected function printLeftButtons()
    {
    }

    abstract public function printBody();
}
