<?php

namespace SuperCMS\Leaves\Admin\Products;

use Rhubarb\Leaf\Controls\Common\FileUpload\SimpleFileUpload;
use Rhubarb\Leaf\Controls\Common\Text\TextArea;
use SuperCMS\Controls\Category\CategoryDropdown;
use SuperCMS\Models\Product\Product;
use SuperCMS\Models\Product\ProductImage;
use SuperCMS\Views\SuperCMSCrudView;

class ProductsEditView extends SuperCMSCrudView
{
    protected function createSubLeaves()
    {
        parent::createSubLeaves();

        $this->registerSubLeaf(
            'Name',
            new TextArea('Description'),
            'Cost',
            'AmountAvailable',
            new CategoryDropdown('CategoryID'),
            $imageUpload = new SimpleFileUpload('ImageUpload')
        );

        $imageUpload->fileUploadedEvent->attachHandler(function ($data) {
            ProductImage::createImageForProduct($this->model->restModel, $data);
        });

        $this->bootstrapInputs();
    }

    protected function printBody()
    {
        $this->printFieldset(
            'Cool',
            [
                'Name',
                'Description',
                'Cost',
                'AmountAvailable',
                'Category' => 'CategoryID',
                'ImageUpload'
            ]
        );
    }

    protected function printLeftButtons()
    {
        print '<a href="../../" class="btn btn-default">Back</a>';
    }
}
