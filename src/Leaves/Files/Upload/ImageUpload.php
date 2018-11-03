<?php

namespace SuperCMS\Leaves\Files\Upload;

use Rhubarb\Crown\Layout\Layout;
use Rhubarb\Crown\Layout\LayoutModule;
use Rhubarb\Crown\Request\Request;
use Rhubarb\Crown\Request\WebRequest;
use Rhubarb\Leaf\LayoutProviders\LayoutProvider;
use Rhubarb\Leaf\Leaves\Leaf;
use SuperCMS\Models\Image\Image;

class ImageUpload extends Leaf
{
    /** @var ImageUploadModel $model * */
    protected $model;

    protected function getViewClass()
    {
        LayoutProvider::setProviderClassName(Layout::class);
        LayoutModule::setLayoutClassName(Layout::class);

        return ImageUploadView::class;
    }

    protected function createModel()
    {
        return new ImageUploadModel();
    }

    protected function onModelCreated()
    {
        $request = Request::current();

        if ($request instanceof WebRequest && !empty($request->filesData)) {
            $this->model->uploadedImage = Image::createImageFromFileDate($request->filesData['file']);
        }
    }
}
