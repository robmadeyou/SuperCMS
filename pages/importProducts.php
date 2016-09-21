<?php

include_once(__DIR__ . '/../vendor/rhubarbphp/rhubarb/platform/execute-cli.php');
$products = json_decode(file_get_contents('./exportedProducts.json'));

$categories = [];

foreach($products as $product) {
    $pObj = new \SuperCMS\Models\Product\Product();
    $pObj->Name = $product->Name;
    $pObj->Live = $product->Live;
    $pObj->CategoryID = getCategory($product->Category);
    $pObj->Description = $product->Description;
    $pObj->Importing = true;
    $pObj->save();

    foreach($product->Variations as $variation) {
        $vObj = new \SuperCMS\Models\Product\ProductVariation();
        $vObj->Name = $variation->Title;
        $vObj->Price = $variation->Price;
        $vObj->AmountAvailable = $variation->StockLevel;
        $vObj->Quantity = $variation->Quantity;
        $vObj->Order = $variation->Order;
        $vObj->ProductID = $pObj->ProductID;
        $vObj->save();
    }

    $iObj = new \SuperCMS\Models\Product\ProductImage();
    $iObj->ImagePath = $product->MainImage;
    $iObj->ProductVariationID = $pObj->getDefaultProductVariation()->ProductVariationID;
    $iObj->save();
}

function getCategory($name) {
    global $categories;
    if(isset($categories[$name])) {
        return $categories[$name];
    }

    try {
        $category = \SuperCMS\Models\Product\Category::findFirst(new \Rhubarb\Stem\Filters\Equals('Name', $name));
    } catch( \Rhubarb\Stem\Exceptions\RecordNotFoundException $ex ) {
        $category = new \SuperCMS\Models\Product\Category();
        $category->Name = $name;
        $category->save();
    }

    $categories[$name] = $category->UniqueIdentifier;

    return $category->UniqueIdentifier;
}