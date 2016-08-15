<?php

namespace SuperCMS\Views;

use Rhubarb\Leaf\Views\View;

abstract class SuperCMSCollectionView extends View
{
    protected function printViewContent()
    {
        ?>
        <div>
            <?php $this->getTopFunctionBar() ?>
            <div class="row">
                <div class="col-md-2"></div>
                <div class="col-md-8">
                    <?php $this->printBody() ?>
                </div>
                <div class="col-md-2"></div>
            </div>
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
            <div class="col-md-8">
                <?php $this->printSearchPanel() ?>
            </div>
            <div class="col-md-2">
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
