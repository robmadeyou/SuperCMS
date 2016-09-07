<?php

namespace SuperCMS\Controls\Dropzone;

use Rhubarb\Crown\Request\Request;
use Rhubarb\Leaf\Controls\Common\FileUpload\SimpleFileUpload;

class Dropzone extends SimpleFileUpload
{
    protected function getViewClass()
    {
        return DropzoneView::class;
    }

    protected function createModel()
    {
        $req = Request::current();

        $model = new DropzoneModel();
        $model->postUrl = 'lol';
        return $model;
    }
}
