<?php

namespace SuperCMS\Controls\Dropzone;

use Rhubarb\Crown\Events\Event;
use Rhubarb\Leaf\Leaves\Controls\ControlModel;

class DropzoneModel extends ControlModel
{
    public $postUrl;

    /**
     * @var Event
     */
    public $FilesUploadedEvent = null;

    public $uploadedFiles = null;

    public function __construct()
    {
        parent::__construct();

        $this->FilesUploadedEvent = new Event();
        $this->uploadedFiles = [];
    }

    protected function getExposableModelProperties()
    {
        $properties = parent::getExposableModelProperties();

        $properties[] = 'postUrl';

        return $properties;
    }
}
