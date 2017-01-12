<?php

namespace SuperCMS\UrlHandlers;

use Rhubarb\Crown\Exceptions\ForceResponseException;
use Rhubarb\Crown\Response\RedirectResponse;
use Rhubarb\Stem\Exceptions\RecordNotFoundException;
use Rhubarb\Stem\Filters\AndGroup;
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
                    $this->product = Product::findFirst(new AndGroup([new Equals('SeoSafeName', $parts[2]), new Equals('CategoryID', $this->getCategoryFromUrl()->UniqueIdentifier)]));
                    return parent::generateResponse($request, 'product/' . $parts[2]);
                } catch (RecordNotFoundException $ex) {
                    throw new ForceResponseException(new RedirectResponse('/404/'));
                }
            } else {
                $this->isCollection = true;
                return parent::generateResponse($request, 'product/');
            }
        }
        return false;
    }

    public function getModelObject()
    {
        return $this->product;
    }

    public function getModelCollection()
    {
        return $this->getCategoryFromUrl()->getProducts();
    }
}
