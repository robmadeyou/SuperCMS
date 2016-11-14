<?php

namespace SuperCMS\Leaves\Site\Product;

use Rhubarb\Crown\Settings\HtmlPageSettings;
use Rhubarb\Leaf\Controls\Common\Buttons\Button;
use Rhubarb\Leaf\Controls\Common\SelectionControls\DropDown\DropDown;
use Rhubarb\Leaf\Leaves\LeafDeploymentPackage;
use Rhubarb\Leaf\Views\View;
use SuperCMS\Models\Product\Product;
use SuperCMS\Models\Product\ProductVariation;
use SuperCMS\Views\BreadcrumbTrait;

class ProductItemView extends View
{
    use BreadcrumbTrait;

    /** @var ProductItemModel */
    protected $model;

    protected function createSubLeaves()
    {
        $this->registerSubLeaf(
            $addToBasket = new Button('AddToBasket', 'Add To Basket'),
            new DropDown()
        );

        $addToBasket->addCssClassNames('c-add-to-basket', 'button');
    }

    protected function printViewContent()
    {
        $product = $this->model->restModel;
        $settings = HtmlPageSettings::singleton();
        $settings->pageTitle = $product->Name . ' - ' . $this->model->selectedVariation->Name;

        $this->printBreadcrumbs();
        ?>
        <div class="row product-page">
            <div class="col-sm-5 c-product-image-section">
                <?php $this->printProductImages($product); ?>
                <div class="clearfix"></div>
            </div>
            <div class="col-sm-7">
                <div class="c-product-title">
                    <?php $this->printProductTitle($product); ?>
                </div>
                <div class="c-product-description">
                    <?php $this->printProductDescription($product); ?>
                </div>
                <div class="c-product-add-to-cart">
                    <?php $this->printAddToCartButton($product) ?>
                </div>
            </div>
        </div>
        <?php
    }

    protected function printProductTitle(Product $product)
    {
        print '<h1>' . $product->Name . '</h1>';
        print '<h3 class="c-product-variation-title">' . $this->model->selectedVariation->Name . '</h3>';
    }

    protected function printProductImages(Product $product)
    {
        $imagePath = $this->model->selectedVariation->getPrimaryImage();
        ?>
        <div class="c-main-product-image-outer">
            <a href="<?= $imagePath ?>" class="product-image-view"><img class="c-main-product-image" src="<?= $imagePath ?>"></a>
        </div>
        <?php
        $this->printProductVariations();
    }

    protected function printProductVariations()
    {
        print '<div>';
        foreach ($this->model->restModel->Variations as $variation) {
            $this->printProductVariation($variation);
        }
        print '</div>';
    }

    protected function printProductVariation(ProductVariation $variation)
    {
        $imagePath = $variation->getPrimaryImage();
        if (!$imagePath) {
            return;
        }

        $selectedVariationClass = '';
        if ($this->model->selectedVariation->UniqueIdentifier == $variation->UniqueIdentifier) {
            $selectedVariationClass = 'selected';
        }

        $imageName = $variation->Name;
        print <<<HTML
        <div class="variation-container {$selectedVariationClass}" data-id="{$variation->UniqueIdentifier}">
            <a href="#" ><img class="variation-thumbnail" title="{$imageName}" src="{$imagePath}" alt="{$imageName}"/></a>
        </div>
HTML;
    }

    protected function printAddToCartButton(Product $product)
    {
        print $this->leaves['AddToBasket'];
    }

    protected function printProductDescription(Product $product)
    {
        print $product->Description;
    }

    public function getBreadcrumbItems():array
    {
        $category = $this->model->restModel->Category;
        return [
            'Home' => '/',
            $category->Name => $category->getPublicUrl(),
            $this->model->restModel->Name => '',
        ];
    }

    public function getDeploymentPackage()
    {
        $package = new LeafDeploymentPackage();

        $package->resourcesToDeploy[] = __DIR__ . '/../../../../static/js/jquery.js';
        $package->resourcesToDeploy[] = __DIR__ . '/../../../../static/js/magnific.min.js';
        $package->resourcesToDeploy[] = __DIR__ . '/' . $this->getViewBridgeName() . '.js';

        return $package;
    }

    protected function getViewBridgeName()
    {
        return 'ProductItemViewBridge';
    }
}
