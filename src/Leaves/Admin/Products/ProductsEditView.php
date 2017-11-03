<?php

namespace SuperCMS\Leaves\Admin\Products;

use Rhubarb\Crown\Settings\HtmlPageSettings;
use Rhubarb\Leaf\Controls\Common\Text\TextBox;
use Rhubarb\Leaf\Leaves\LeafDeploymentPackage;
use Rhubarb\Stem\Filters\Equals;
use SuperCMS\Controls\Category\CategoryDropdown;
use SuperCMS\Controls\Chosen\MultiSelect\ChosenMultiSelect;
use SuperCMS\Controls\Dropzone\Dropzone;
use SuperCMS\Controls\Dropzone\DropzoneUploadedFileDetails;
use SuperCMS\Controls\HtmlEditor\HtmlEditor;
use SuperCMS\Controls\KeyValue\KeyValue;
use SuperCMS\Controls\Shipping\ShippingMultiSelection;
use SuperCMS\Controls\ToggleSwitch\ToggleSwitch;
use SuperCMS\Leaves\Admin\Products\ProductVariations\ProductVariations;
use SuperCMS\Models\Product\ProductImage;
use SuperCMS\Models\Product\ProductVariation;
use SuperCMS\Views\SuperCMSCrudView;

class ProductsEditView extends SuperCMSCrudView
{
    /**
     * @var ProductsEditModel $model
     */
    protected $model;

    protected function createSubLeaves()
    {
        parent::createSubLeaves();

        $this->registerSubLeaf(
            new TextBox('Name'),
            new HtmlEditor('Description'),
            new CategoryDropdown('CategoryID'),
            $relatedProducts = new ChosenMultiSelect('RelatedProductIDs'),
            $properties = new KeyValue('Properties'),
            new ShippingMultiSelection('ShippingTypes'),
            $toggleSwitch = new ToggleSwitch('Live'),
            $variationsEdit = new ProductVariations($this->model->restModel, 'Variations')
        );

        $toggleSwitch->addHtmlAttribute('tooltip', 'Set the Product live or not');

        $properties->setInputClasses(['form-control']);

        $this->bootstrapInputs();
    }

    protected function printBody()
    {
        $settings = HtmlPageSettings::singleton();
        $settings->pageTitle = 'Editing Product';

        $this->printFieldset(
            '',
            [
                'Name',
                'Description',
                'ShippingTypes',
                'Properties',
                'CategoryID',
            ]
        );
        ?>
        <div class="input-group-breaker"></div>
        <?php
        print $this->leaves['Variations'];
    }

    protected function printLeftButtons()
    {
        print '<a href="../../" class="btn btn-default"><i class="fa fa-arrow-circle-left" aria-hidden="true"></i> Back</a>';
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
