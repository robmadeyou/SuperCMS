<?php

namespace SuperCMS\UrlHandlers;

use Rhubarb\Stem\Exceptions\RecordNotFoundException;
use Rhubarb\Stem\Filters\Equals;
use SuperCMS\Models\Product\Product;

class ProductUrlHandler extends CategoryUrlHandler
{
    private $product = null;

    public function generateResponse($request = null, $currentUrlFragment = false)
    {
        $parts = explode('/', $currentUrlFragment);
        if (isset($parts[1]) && $parts[1] == 'product') {
            if (isset($parts[2]) && $parts[2] != '') {
                try {
                    $this->product = Product::findFirst(new Equals('Name', $parts[2]));//TODO change to seo safe name
                    return parent::generateResponse($request, 'product/' . $parts[2]);
                } catch (RecordNotFoundException $ex) {
                }
            } else {
                $this->isCollection = true;
                return parent::generateResponse($request, 'product/');
            }
        } else {
            return false;
        }
    }

    public function getModelObject()
    {
        return $this->product;
    }
}
