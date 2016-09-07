<?php

namespace SuperCMS\Leaves\Admin\Products;

use Rhubarb\Leaf\Controls\Common\FileUpload\SimpleFileUpload;
use Rhubarb\Leaf\Controls\Common\Text\TextArea;
use Rhubarb\Leaf\Controls\Common\Text\TextBox;
use Rhubarb\Leaf\Leaves\LeafDeploymentPackage;
use SuperCMS\Controls\Category\CategoryDropdown;
use SuperCMS\Controls\Dropzone\Dropzone;
use SuperCMS\Controls\HtmlEditor\HtmlEditor;
use SuperCMS\Controls\KeyValue\KeyValue;
use SuperCMS\Controls\Shipping\ShippingMultiSelection;
use SuperCMS\Controls\ToggleSwitch\ToggleSwitch;
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
            new HtmlEditor('Description'),
            new TextBox('Price'),
            new TextBox('AmountAvailable'),
            new CategoryDropdown('CategoryID'),
            $imageUpload = new Dropzone('ImageUpload'),
            $properties = new KeyValue('Properties'),
            new ShippingMultiSelection('ShippingTypes'),
            $toggleSwitch = new ToggleSwitch('Live')
        );

        $toggleSwitch->addHtmlAttribute('tooltip', 'Set the Product live or not');

        $properties->setInputClasses(['form-control']);

        $imageUpload->fileUploadedEvent->attachHandler(function ($data) {
            ProductImage::createImageForProduct($this->model->restModel->getDefaultProductVariation(), $data);
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
                'Category'      => 'CategoryID',
                'Upload Images' => 'ImageUpload',
                'ShippingTypes',
                'Properties'
            ]
        );

        ?>
        <ul class="nav nav-tabs">
            <?php
            $first = true;
            foreach ($this->model->restModel->Variations as $variation) {
                print '<li role="presentation" ' . ( $first ? 'class="active"' : '' ) . ' ><a href="#" class="product-variation-tab" data-id="' . $variation->UniqueIdentifier . '">' . $variation->Name . '</a></li>';
                $first = false;
            }
            ?>
        </ul>
        <?php
    }

    protected function printLeftButtons()
    {
        print '<a href="../../" class="btn btn-default"><span class="glyphicon glyphicon-circle-arrow-left"></span> Back</a>';
    }

    protected function printRightButtons()
    {
        print $this->leaves[ 'Live' ];
    }

    public function getDeploymentPackage()
    {
        $package = new LeafDeploymentPackage();
        $package->resourcesToDeploy[] = __DIR__ . '/' . $this->getViewBridgeName() . '.js';
        return $package;
    }

    protected function getViewBridgeName()
    {
        return 'ProductsEditViewBridge';
    }
}
