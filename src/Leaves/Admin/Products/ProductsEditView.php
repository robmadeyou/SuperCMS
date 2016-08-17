<?php

namespace SuperCMS\Leaves\Admin\Products;

use Rhubarb\Leaf\Controls\Common\FileUpload\SimpleFileUpload;
use Rhubarb\Leaf\Controls\Common\Text\TextArea;
use Rhubarb\Leaf\Controls\Common\Text\TextBox;
use SuperCMS\Controls\Category\CategoryDropdown;
use SuperCMS\Controls\KeyValue\KeyValue;
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
            new TextBox('Price'),
            'AmountAvailable',
            new CategoryDropdown('CategoryID'),
            $imageUpload = new SimpleFileUpload('ImageUpload'),
            $properties = new KeyValue('Properties')
        );

        $properties->setInputClasses(['form-control']);

        $imageUpload->fileUploadedEvent->attachHandler(function ($data) {
            ProductImage::createImageForProduct($this->model->restModel, $data);
        });

        $this->bootstrapInputs();
    }

    protected function printBody()
    {
        $this->printFieldset(
            '',
            [
                'Name',
                'Description',
                'Price',
                'AmountAvailable',
                'Category' => 'CategoryID',
                'ImageUpload',
                'Properties'
            ]
        );

    }

    protected function printLeftButtons()
    {
        print '<a href="../../" class="btn btn-default"><span class="glyphicon glyphicon-circle-arrow-left"></span> Back</a>';
    }
}
