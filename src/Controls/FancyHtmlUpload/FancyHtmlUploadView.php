<?php

namespace SuperCMS\Controls\FancyHtmlUpload;

use Rhubarb\Leaf\Controls\Common\FileUpload\SimpleFileUploadView;
use SuperCMS\Deployment\SuperCmsDeploymentPackage;

class FancyHtmlUploadView extends SimpleFileUploadView
{
    /** @var FancyHtmlUploadModel $model * */
    protected $model;

    protected function printViewContent()
    {
        $accepts = "";

        if (sizeof($this->model->acceptFileTypes) > 0) {
            $accepts = " accept=\"" . implode(",", $this->model->acceptFileTypes) . "\"";
        }

        ?>
        <div class="upload">
            <input type="file" name="<?= $this->model->leafPath; ?>" id="<?= $this->model->leafPath; ?>"
                   leaf-name="<?= $this->model->leafName ?>"<?= $accepts . $this->model->getHtmlAttributes() . $this->model->getClassAttribute() ?>/>

            <label for="<?= $this->model->leafPath ?>" data-input-value="" data-select-text="Select file" data-remove-text="Remove file"
                   data-drag-text="...or drag file here">
            </label>
        </div>

        <?php
    }

    public function getDeploymentPackage()
    {
        $scmsDeploy = new SuperCmsDeploymentPackage();
        $scmsDeploy->resourcesToDeploy[] = VENDOR_DIR . '/rhubarbphp/module-leaf-common-controls/src/FileUpload/SimpleFileUploadViewBridge.js';
        $scmsDeploy->resourcesToDeploy[] = __DIR__ . '/FancyHtmlUploadViewBridge.js';

        return $scmsDeploy;
    }

    protected function getViewBridgeName()
    {
        return 'FancyHtmlUploadViewBridge';
    }
}
