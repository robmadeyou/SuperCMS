<?php

namespace SuperCMS\Controls\Dropzone;

use Rhubarb\Leaf\Leaves\Controls\ControlModel;

class DropzoneModel extends ControlModel
{
    public $postUrl;
    protected function getExposableModelProperties()
    {
        $properties = parent::getExposableModelProperties();

        $properties[] = 'postUrl';

        return $properties;
    }
}
