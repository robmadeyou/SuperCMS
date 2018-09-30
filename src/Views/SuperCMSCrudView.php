<?php

namespace SuperCMS\Views;

use Rhubarb\Leaf\Crud\Leaves\CrudView;

abstract class SuperCMSCrudView extends CrudView
{
    use BootstrapViewTrait;

    protected function createSubLeaves()
    {
        parent::createSubLeaves();

        $this->leaves[ 'Save' ]->addCssClassNames('btn-success');
        $this->leaves[ 'Cancel' ]->addCssClassNames('btn-default');
    }

    protected function printViewContent()
    {
        ?>
        <div>
            <div class="row u-margin-bottom">
                <div class="col-xs-2">
                        <?php $this->printLeftButtons() ?>
                </div>
                <div class="col-xs-offset-8 col-xs-2">
                    <div class="pull-right">
                        <?php $this->printRightButtons() ?>
                    </div>
                </div>
            </div>
            <?php $this->printBody() ?>
            <div class="row">
                <div class="col-md-3 col-md-offset-5 ">
                    <?php $this->printFormButtons() ?>
                </div>
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

    protected function printFormButtons()
    {
        print $this->leaves[ 'Save' ] . $this->leaves[ 'Cancel' ];
    }

    abstract protected function printBody();
}
