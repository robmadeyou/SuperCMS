<?php

namespace SuperCMS\Controls\HtmlEditor;

use Rhubarb\Leaf\Controls\Common\Text\TextAreaView;

class HtmlEditorView extends TextAreaView
{
    public function getDeploymentPackage()
    {
        $resource = parent::getDeploymentPackage();
        $resource->resourcesToDeploy[] = __DIR__ . '/' . $this->getViewBridgeName() . '.js';
        return $resource;
    }

    protected function getAdditionalResourceUrls()
    {
        return [
            '/files/js/tinymce/tinymce.min.js'
        ];
    }

    protected function getViewBridgeName()
    {
        return 'HtmlEditorViewBridge';
    }
}
