<?php

include_once('./simple_html_dom.php');

class ProductDef {
    public $Name;
    public $Description;
    public $MainImage;
    public $Live;
    public $ExternalUrl;
    public $SortOrder;
    public $PrepayRequired;
    public $FeatureAsOffer;
    public $FeaturedProduct;
    public $MetaTitle;
    public $MetaDescription;
    public $MetaKeywords;
    public $ProductListDefaultOption;
    public $DisplayAsStoreOption;
    public $Category;
    public $Variations;
}

class VariationDef {
    public $Title;
    public $Price;
    public $StockLevel;
    public $ShippingProfile;
    public $Quantity;
    public $Order;
}

$products = [];

foreach( scandir('./') as $item) {
    $extension = pathinfo($item, PATHINFO_EXTENSION);
    if(!is_dir($item) && $extension == 'html') {
        $html = file_get_html($item);
        if ($html instanceof simple_html_dom) {
            $product = new ProductDef();
            $product->Name = $html->find('.formrow270 div[style="width: 800px;"]',0)->plaintext;
            $product->Description = $html->find('.formrow271 div[style="width: 700px;"]',0)->plaintext;
            $product->MainImage = $html->find('.formrow274 img[style="max-width: 700px; max-height: 300px;"]',0)->src;
            $product->Live = $html->find('.formrow275 td[style="width: 810px;"] img', 1)->alt != 'No';
            $product->ExternalUrl = $html->find('.formrow380 div[style="width: 800px;"]', 0)->plaintext;
            $product->SortOrder = $html->find('.formrow276 td[style="width: 810px;"] div', 1)->plaintext;
            $product->PrepayRequired = $html->find('.formrow660 td[style="width: 810px;"] img', 1)->alt != 'No';
            $product->FeatureAsOffer = $html->find('.formrow400 td[style="width: 810px;"] img', 1)->alt != 'No';
            $product->FeaturedProduct = $html->find('.formrow355 td[style="width: 810px;"] img', 1)->alt != 'No';
            $product->MetaTitle = $html->find('.formrow454 div[style="width: 800px;"]', 0)->plaintext;
            $product->MetaDescription = $html->find('.formrow403 div[style="width: 700px;"]', 0)->plaintext;
            $product->MetaKeywords = $html->find('.formrow404 div[style="width: 700px;"]', 0)->plaintext;
            $product->Category = $html->find('#lookup_social_project_product_category tr td', 1)->plaintext;

            foreach($html->find('#child_social_project_product_item tr') as $row) {
                $name = $row->find('td div',0);
                $productVariation = new VariationDef();
                if ($name) {
                    $productVariation->Title = $name->plaintext;
                    $productVariation->Price = $row->find('td div',1)->plaintext;
                    $productVariation->StockLevel = $row->find('td div', 2)->plaintext;
                    $productVariation->ShippingProfile = $row->find('td div', 3)->plaintext;
                    $productVariation->Quantity = $row->find('td div', 4)->plaintext;
                    $productVariation->Order = $row->find('td div', 5)->plaintext;

                    $product->Variations[] = $productVariation;
                }
            }

            $products[] = $product;
        } else {
            print 'Failed loading file' . $item . "\n";
        }
    }
}

file_put_contents('exportedProducts.json', json_encode($products));
