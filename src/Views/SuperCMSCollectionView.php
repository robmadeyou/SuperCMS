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
            <div class="col-lg-12">
                <?php $this->printSearchPanel() ?>
            </div>
        </div>
        <?php
    }

    protected function printTitle()
    {
        print '';
    }

    protected function printSearchPanel()
    {
    }

    protected function printRightButtons()
    {
    }

    abstract public function printBody();
}
