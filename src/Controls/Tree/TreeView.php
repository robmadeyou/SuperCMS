<?php

namespace SuperCMS\Controls\Tree;

use Rhubarb\Leaf\Leaves\LeafDeploymentPackage;
use Rhubarb\Leaf\Views\View;

class TreeView extends View
{
    protected function getViewBridgeName()
    {
        return 'TreeViewBridge';
    }

    public function getDeploymentPackage()
    {
        return new LeafDeploymentPackage(
            __DIR__ . '/' . $this->getViewBridgeName() . '.js'
        );
    }
}
