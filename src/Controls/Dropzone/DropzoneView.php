<?php

namespace SuperCMS\Controls\Dropzone;

use Rhubarb\Crown\Request\Request;
use Rhubarb\Leaf\Controls\Common\FileUpload\SimpleFileUploadView;

class DropzoneView extends SimpleFileUploadView
{
    public $requiresContainerDiv = true;
    public function getDeploymentPackage()
    {
        $package = parent::getDeploymentPackage();

        $package->resourcesToDeploy[] = __DIR__ . '/../../../static/js/dropzone.min.js';
        $package->resourcesToDeploy[] = __DIR__ . '/' . $this->getViewBridgeName(). '.js';

        return $package;
    }

    protected function getViewBridgeName()
    {
        return 'DropzoneViewBridge';
    }

    protected function printViewContent()
    {
        $req = Request::current();
        ?>
        <div action="<?=$req->uriPath?>" class="dropzone">
            <div class="fallback">
                <input name="file" type="file" multiple />
            </div>
        </div>
        <?php
    }
}
