<?php

namespace SuperCMS\Leaves\Site\Product;

use Rhubarb\Crown\Settings\HtmlPageSettings;
use Rhubarb\Leaf\Controls\Common\Buttons\Button;
use Rhubarb\Leaf\Controls\Common\SelectionControls\DropDown\DropDown;
use Rhubarb\Leaf\Leaves\LeafDeploymentPackage;
use Rhubarb\Leaf\Views\View;
use SuperCMS\Deployment\SuperCmsDeploymentPackage;
use SuperCMS\Models\Product\Category;
use SuperCMS\Models\Product\Product;
use SuperCMS\Models\Product\ProductImage;
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
            $variations = new DropDown('Variations')
        );

        $selectableVariations = [];
        foreach ($this->model->restModel->Variations as $variation) {
            $selectableVariations[] = [$variation->UniqueIdentifier, $variation->Name];
        }

        $variations->setSelectionItems($selectableVariations);
        $variations->setSelectedItems($this->model->selectedVariationId);

        $addToBasket->addCssClassNames('c-add-to-basket', 'button', 'c-full-mobile');

        $this->model->getImagesHTMLEvent->attachHandler(function(ProductVariation $variation) {
            return $this->getVariationThumbnails($variation);
        });
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
                <div>
                    <?= $this->leaves['Variations'] ?>
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
        print $this->getVariationThumbnails($this->model->selectedVariation);
    }

    protected function getVariationThumbnails(ProductVariation $productVariation)
    {
        $html = '<div id="thumbnail-container">';
        $selected = true;
        foreach ($productVariation->Images->addSort('Priority') as $image) {
            $html .= $this->getThumbnail($image, $selected);
            $selected = false;
        }
        return $html . '</div>';
    }

    protected function getThumbnail(ProductImage $image, $selected)
    {
        $imagePath = $image->ImagePath;
        if (!$imagePath) {
            return '';
        }

        if ($selected) {
            $selectedClass = 'selected';
        } else {
            $selectedClass = '';
        }

        $imageName = $image->ProductVariation->Name;
        return <<<HTML
        <div class="variation-container {$selectedClass} js-thubmnail" data-id="{$image->UniqueIdentifier}">
            <a class="js-thubmnail-link"><img class="c-variation-thumbnail" title="{$imageName}" src="{$imagePath}" alt="{$imageName}"/></a>
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
        print '<br/>';
        print $this->model->selectedVariation->Description;
    }

    public function getBreadcrumbItems():array
    {
        $category = $this->model->restModel->Category;

        $breadCrumbs = [
            'Home' => '/',
        ];

        $categories = [];
        if ($category && $category instanceof Category) {
            $currentCategory = $category;

            $categories[$currentCategory->Name] = $currentCategory->getPublicUrl();
            while ($currentCategory->ParentCategoryID) {
                $currentCategory = $currentCategory->ParentCategory;
                $categories[$currentCategory->Name] = $currentCategory->getPublicUrl();
            }
        }

        if (!empty($categories)) {
            foreach(array_reverse($categories, true) as $key => $value) {
                $breadCrumbs[$key] = $value;
            }
        }

        $breadCrumbs[$this->model->restModel->Name] = '';

        return $breadCrumbs;
    }

    public function getDeploymentPackage()
    {
        return new SuperCmsDeploymentPackage(__DIR__ . '/ProductItemViewBridge.js');
    }

    protected function getViewBridgeName()
    {
        return 'ProductItemViewBridge';
    }
}
