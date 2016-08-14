<?php

namespace SuperCMS\Views;

use Rhubarb\Leaf\Controls\Common\Buttons\Button;
use Rhubarb\Leaf\Controls\Common\Text\TextBox;
use Rhubarb\Leaf\Crud\Leaves\CrudView;

abstract class SuperCMSCrudView extends CrudView
{

    protected function createSubLeaves()
    {
        parent::createSubLeaves();

        $this->leaves[ 'Save' ]->addCssClassNames('btn-success');
        $this->leaves[ 'Cancel' ]->addCssClassNames('btn-default');
    }

    protected function bootstrapInputs()
    {
        foreach ($this->leaves as $leaf) {
            if ($leaf instanceof Button) {
                $leaf->addCssClassNames('btn');
            } else if ($leaf instanceof TextBox) {
                $leaf->addCssClassNames('form-control');
            }
        }
    }

    protected function printViewContent()
    {
        ?>
        <div>
            <?php $this->getTopFunctionBar() ?>
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <?php $this->printBody() ?>
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

    protected function getTopFunctionBar()
    {
        ?>
        <div class="row">
            <div class="col-md-2">
                <?php $this->printLeftButtons() ?>
            </div>
            <div class="col-md-8">
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

    protected function printFormButtons()
    {
        print $this->leaves[ 'Save' ] . $this->leaves[ 'Cancel' ];
    }

    protected function printFieldset($title, $items)
    {
        ?>
        <form>
            <?php
            print $title;
            foreach ($items as $label => $item) {
                $label = !is_numeric($label) ? $label : $item;
                $itemObject = $this->leaves[ $item ];
                print <<<HTML
                    <div class="form-group">
                        <label>{$label}</label>
                        {$itemObject}
                    </div>
HTML;
            }
            ?>
        </form>
        <?php
    }

    abstract protected function printBody();
}
