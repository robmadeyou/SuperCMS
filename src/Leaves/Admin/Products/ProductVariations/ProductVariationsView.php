<?php

namespace SuperCMS\Leaves\Admin\Products\ProductVariations;

use Rhubarb\Leaf\Controls\Common\Text\TextBox;
use Rhubarb\Leaf\Views\View;
use Rhubarb\Stem\Filters\Equals;
use SuperCMS\Controls\Dropzone\Dropzone;
use SuperCMS\Controls\Dropzone\DropzoneUploadedFileDetails;
use SuperCMS\Controls\HtmlEditor\HtmlEditor;
use SuperCMS\Deployment\SuperCmsDeploymentPackage;
use SuperCMS\Models\Product\ProductImage;
use SuperCMS\Models\Product\ProductVariation;

class ProductVariationsView extends View
{
    /** @var ProductVariationsModel $model */
    protected $model;

    protected function createSubLeaves()
    {
        parent::createSubLeaves();

        $this->registerSubLeaf(
            new TextBox('Name'),
            new TextBox('Price'),
            new TextBox('AmountAvailable'),
            new HtmlEditor('Description'),
            $imageUpload = new Dropzone('ImageUpload')

        );

        $imageUpload->fileUploadedEvent->attachHandler(function ($data) {
            ProductImage::createImageForProduct(new ProductVariation($_GET['variation']), $data);
        });

        $imageUpload->deleteImageEvent->attachHandler(function ($url) {
            $image = ProductImage::findFirst(new Equals('ImagePath', $url));//todo: this is a horrible way to do this
            $image->delete();
        });
    }

    protected function beforeRender()
    {
        parent::beforeRender();

        $images = [];
        foreach (ProductImage::find(new Equals('ProductVariationID', $this->model->selectedVariationId))->addSort('Priority') as $image) {
            $images[] = new DropzoneUploadedFileDetails($image->ProductImageID, $image->ImagePath, $image->UniqueIdentifier);
        }

        $this->leaves['ImageUpload']->setUploadedFiles($images);
        $this->leaves['ImageUpload']->setPostParams('?variation=' . $this->model->selectedVariationId);
    }

    protected function printViewContent()
    {
        ?>
        <ul class="nav nav-pills">
            <div class="js-tabs-list nav nav-pills">
            <?php
            foreach ($this->model->getVariations() as $variation) {
                $class = ( $variation->UniqueIdentifier == $this->model->selectedVariationId ? 'active nav-bar-tabs-first' : '' );
                print '<li role="presentation" class="' . $class . ' product-list-tabs" ><a class="product-variation-tab" data-id="' . $variation->UniqueIdentifier . '">' . $variation->Name . '  <span class="delete-variation"><i class="fa fa-times fa-1x" aria-hidden="true"></i></span></a></li>';
            }
            ?>
            </div>
            <li role="presentation" class="product-list-tabs" id="tab-add-button"><p>&nbsp;&nbsp;<i class="fa fa-plus" aria-hidden="true"></i></span></p></li>
        </ul>
        <?php

        $variationName = isset($variation) ? $variation->VariationName : 'No Variation Name';

        $this->layoutItemsWithContainer("<span class='js-variation-name'>{$variationName}</span>Variation Information",
            [
                'Name',
                'Price',
                'AmountAvailable',
                'Description',
                'ImageUpload',
            ]
        );
    }

    public function getDeploymentPackage()
    {
        return new SuperCmsDeploymentPackage(__DIR__ .'/ProductVariationsViewBridge.js');
    }

    protected function getViewBridgeName()
    {
        return 'ProductVariationsViewBridge';
    }
}
