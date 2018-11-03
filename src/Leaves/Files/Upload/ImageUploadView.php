<?php

namespace SuperCMS\Leaves\Files\Upload;

use Rhubarb\Leaf\Views\View;

class ImageUploadView extends View
{
    protected $requiresContainerDiv = false;
    protected $requiresStateInput = false;

    /** @var ImageUploadModel $model **/
    protected $model;

    protected function createSubLeaves()
    {
        parent::createSubLeaves();
    }

    protected function printViewContent()
    {
        if ($this->model->uploadedImage) {
            print json_encode(['location' => $this->model->uploadedImage->getImageUrl()]);
        } else {
            print json_encode(['error' => 'Image not found']);
        }
    }
}
