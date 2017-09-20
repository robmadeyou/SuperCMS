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
    public $fileUploadedEvent = null;

    public $uploadedFiles = null;

    /** @var Event */
    public $deleteImageEvent = null;

    /** @var Event */
    public $imageReorderEvent = null;

    public function __construct()
    {
        parent::__construct();

        $this->fileUploadedEvent = new Event();
        $this->deleteImageEvent = new Event();
        $this->imageReorderEvent = new Event();
        $this->uploadedFiles = [];
    }

    protected function getExposableModelProperties()
    {
        $properties = parent::getExposableModelProperties();

        $properties[] = 'postUrl';

        return $properties;
    }
}
