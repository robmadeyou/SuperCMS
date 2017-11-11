<?php

namespace SuperCMS\Controls\Tree;

use Rhubarb\Leaf\Leaves\LeafDeploymentPackage;
use Rhubarb\Leaf\Views\View;

class TreeView extends View
{
    /** @var TreeModel $model */
    protected $model;

    protected function printViewContent()
    {
        $schemaHtml = '';

        foreach ($this->model->data as $treeSchema) {
            $schemaHtml .= $this->getHTMLFromSchema($treeSchema);
        }

        print <<<HTML
        <ul>
                {$schemaHtml}
        </ul>
HTML;

    }

    protected function getHTMLFromSchema(TreeSchema $data)
    {
        $html = '';
        $childrenHtml = '';
        if ($data->children) {
            foreach($data->children as $child) {
                $childrenHtml .= $this->getHTMLFromSchema($child);
            }
            $childrenHtml = "<ul>{$childrenHtml}</ul>";
        }
        $html .= <<<HTML
        <li data-jstree='{$data->getDataJsonString()}'><input type="hidden" value="{$data->uniqueID}" class="tree-id"><span class="name">{$data->name}</span> {$childrenHtml}</li>
HTML;

        return $html;
    }

    protected function getAdditionalResourceUrls()
    {
        return [
            'https://cdnjs.cloudflare.com/ajax/libs/jstree/3.2.1/themes/default/style.min.css'
        ];
    }

    protected function getViewBridgeName()
    {
        return 'TreeViewBridge';
    }

    public function getDeploymentPackage()
    {
        return new LeafDeploymentPackage(
            __DIR__ . '/../../../static/js/jquery.js',
            VENDOR_DIR . '/vakata/jstree/dist/jstree.min.js',
            __DIR__ . '/' . $this->getViewBridgeName() . '.js'
        );
    }
}
