<?php

namespace SuperCMS\Controls\DateRangePicker;

use Rhubarb\Crown\Request\WebRequest;
use Rhubarb\Leaf\Controls\Common\DateTime\DateView;
use Rhubarb\Leaf\Controls\Common\Text\TextBoxView;

class DateRangePickerView extends DateView
{
    protected $requiresContainerDiv = true;

    public function getDeploymentPackage()
    {
        $package = parent::getDeploymentPackage();

        $package->resourcesToDeploy[] = __DIR__ . '/../../../static/js/jquery.js';
        $package->resourcesToDeploy[] = __DIR__ . '/../../../static/js/moment.min.js';
        $package->resourcesToDeploy[] = __DIR__ . '/../../../static/js/daterangepicker.min.js';
        $package->resourcesToDeploy[] = __DIR__ . '/' . $this->getViewBridgeName() . '.js';

        return $package;
    }

    protected function parseRequest(WebRequest $request)
    {
        $path = $this->model->leafPath;
        $this->model->setValue($request->post($path));
    }

    protected function printViewContent()
    {
        ?>
            <input type="daterange" <?=$this->getNameValueClassAndAttributeString();?> class="form-control"/>
        <?php
    }

    protected function getAdditionalResourceUrls()
    {
        $urls = parent::getAdditionalResourceUrls();
        $urls[] = '/files/css/daterangepicker.min.css';
        return $urls;
    }

    protected function getViewBridgeName()
    {
        return 'DateRangePickerViewBridge';
    }
}
