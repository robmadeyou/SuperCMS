<?php

namespace SuperCMS\Controls\FancyHtmlUpload;

use Rhubarb\Leaf\Controls\Common\FileUpload\SimpleFileUpload;

class FancyHtmlUpload extends SimpleFileUpload
{
    /** @var FancyHtmlUploadModel $model **/
    protected $model;

    protected function getViewClass()
    {
        return FancyHtmlUploadView::class;
    }

    protected function createModel()
    {
        return new FancyHtmlUploadModel();
    }
}
