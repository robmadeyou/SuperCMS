<?php

namespace SuperCMS\Views;

use Rhubarb\Leaf\Controls\Common\Buttons\Button;
use Rhubarb\Leaf\Controls\Common\Checkbox\Checkbox;
use Rhubarb\Leaf\Controls\Common\SelectionControls\DropDown\DropDown;
use Rhubarb\Leaf\Controls\Common\SelectionControls\DropDown\DropDownView;
use Rhubarb\Leaf\Controls\Common\Text\TextBox;
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
                <div class="col-xs-8">
                </div>
                <div class="col-xs-2">
                    <div class="pull-right">
                        <?php $this->printRightButtons() ?>
                    </div>
                </div>
            </div>
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <?= $this->getTitle() ?>
                </div>
                <div class="panel-body">
                    <div class="form-body">
                        <?php $this->printBody() ?>
                    </div>
                </div>
            </div>
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
