<?php

namespace SuperCMS\Controls\Chosen\Dropdown;

use Rhubarb\Leaf\Controls\Common\SelectionControls\DropDown\DropDownView;

class ChosenDropdownView extends DropDownView
{
    protected function getViewBridgeName()
    {
        return 'ChosenDropdownViewBridge';
    }

    public function getDeploymentPackage()
    {
        $package = parent::getDeploymentPackage();
        $package->resourcesToDeploy[] = __DIR__ . '/../../../../static/js/jquery.js';
        $package->resourcesToDeploy[] = __DIR__ . '/../../../../static/chosen/chosen.jquery.min.js';
        $package->resourcesToDeploy[] = __DIR__ . '/' . $this->getViewBridgeName() . '.js';
        return $package;
    }

    protected function getAdditionalResourceUrls()
    {
        return [
            '/files/css/chosen/chosen.min.css'
        ];
    }
}
