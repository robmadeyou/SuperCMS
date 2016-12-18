<?php

namespace SuperCMS\Controls\PasswordTextBox;

use Rhubarb\Leaf\Controls\Common\Text\TextBoxView;
use Rhubarb\Leaf\Leaves\LeafDeploymentPackage;

class PasswordTextBoxView extends TextBoxView
{
    protected function printViewContent()
    {
        $viewBridge = ($this->getViewBridgeName()) ? ' leaf-bridge="'.$this->getViewBridgeName().'"' : '';
        print '<div leaf-name="'.$this->model->leafName.'" '.$viewBridge.' id="'.$this->model->leafPath.'"'.'>';
        ?>
        <div class="input-group">
            <?php parent::printViewContent() ?>
            <span class="input-group-btn">
            <button class="btn btn-default reveal" type="button"><i class="fa fa-eye" aria-hidden="true"></i>&nbsp;</button>
          </span>
        </div>
        </div>
        <?php
    }

    public function getDeploymentPackage()
    {
        return new LeafDeploymentPackage(
            __DIR__ . '/' . $this->getViewBridgeName() . '.js'
        );
    }

    protected function getViewBridgeName()
    {
        return 'PasswordTextBoxViewBridge';
    }
}
