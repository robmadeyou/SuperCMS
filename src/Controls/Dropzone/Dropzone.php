<?php

namespace SuperCMS\Controls\Dropzone;

use Rhubarb\Leaf\Controls\Common\FileUpload\SimpleFileUpload;

class Dropzone extends SimpleFileUpload
{
    protected function getViewClass()
    {
        return DropzoneView::class;
    }
}
