<?php

namespace SuperCMS\Controls\HtmlEditor;

use Rhubarb\Leaf\Controls\Common\Text\TextAreaView;

class HtmlEditorView extends TextAreaView
{
    public function getDeploymentPackage()
    {
        $resource = parent::getDeploymentPackage();
        $resource->resourcesToDeploy[] = APPLICATION_ROOT_DIR . '/static/js/tinymce.min.js';
        $resource->resourcesToDeploy[] = __DIR__ . '/' . $this->getViewBridgeName() . '.js';
        return $resource;
    }

    protected function getViewBridgeName()
    {
        return 'HtmlEditorViewBridge';
    }
}
