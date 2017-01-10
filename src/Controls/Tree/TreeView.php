<?php

namespace SuperCMS\Controls\Tree;

use Rhubarb\Leaf\Leaves\LeafDeploymentPackage;
use Rhubarb\Leaf\Views\View;

class TreeView extends View
{
    protected function printViewContent()
    {

    }

    protected function getDataGroup($data)
    {
        $html = '';
        foreach ($data as $item) {

        }
        return $html;
    }

    protected function getViewBridgeName()
    {
        return 'TreeViewBridge';
    }

    public function getDeploymentPackage()
    {
        return new LeafDeploymentPackage(
            VENDOR_DIR . '/vakata/jstree/dist/jstree.min.js',
            __DIR__ . '/' . $this->getViewBridgeName() . '.js'
        );
    }
}
