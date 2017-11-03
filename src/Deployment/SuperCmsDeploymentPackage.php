<?php

namespace SuperCMS\Deployment;

use Rhubarb\Leaf\Leaves\LeafDeploymentPackage;

class SuperCmsDeploymentPackage extends LeafDeploymentPackage
{
    public function __construct(...$localFileToDeploy)
    {
        $this->resourcesToDeploy[] = VENDOR_DIR."/rhubarbphp/module-jsvalidation/src/validation.js";
        $this->resourcesToDeploy[] = VENDOR_DIR."/rhubarbphp/module-leaf/src/Views/ViewBridge.js";
        $this->resourcesToDeploy[] = __DIR__."/SuperCmsViewBridge.js";
        $this->resourcesToDeploy = array_merge($this->resourcesToDeploy, $localFileToDeploy);
    }
}
