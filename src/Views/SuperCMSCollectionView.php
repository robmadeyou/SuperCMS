<?php

namespace SuperCMS\Views;

use Rhubarb\Leaf\Crud\Leaves\CrudView;
use SuperCMS\Settings\AdminSuperCMSPageSettings;

abstract class SuperCMSCollectionView extends CrudView
{
    use BootstrapViewTrait;

    /** @var AdminSuperCMSPageSettings $htmlSettings */
    protected $htmlSettings;

    protected function createSubLeaves()
    {
        $this->htmlSettings = AdminSuperCMSPageSettings::singleton();

        parent::createSubLeaves();

        $this->htmlSettings->requiresAddButton = true;
        $this->htmlSettings->pageTitle = $this->getTitle();
    }

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
        //TODO make top bar, at the very top for search and some aux inputs.
        ?>
        <div class="row">
            <div class="col-lg-12">
                <?php $this->printSearchPanel() ?>
            </div>
        </div>
        <?php
    }

    protected function printSearchPanel()
    {
    }

    abstract public function printBody();
}
