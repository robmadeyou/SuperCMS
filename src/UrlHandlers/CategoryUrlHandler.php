<?php

namespace SuperCMS\UrlHandlers;

use Rhubarb\Crown\Exceptions\ForceResponseException;
use Rhubarb\Crown\Request\Request;
use Rhubarb\Crown\Response\RedirectResponse;
use Rhubarb\Leaf\Crud\UrlHandlers\CrudUrlHandler;
use Rhubarb\Stem\Exceptions\RecordNotFoundException;
use Rhubarb\Stem\Filters\Equals;
use SuperCMS\Models\Product\Category;

class CategoryUrlHandler extends CrudUrlHandler
{

    protected function getMatchingUrlFragment(Request $request, $currentUrlFragment = '')
    {
        $matchingUrlFragment = parent::getMatchingUrlFragment($request, $currentUrlFragment);

        $this->isCollection = false;

        $trimmedFragment = trim(str_replace($matchingUrlFragment, '', $currentUrlFragment), '/');

        $parts = explode('/', $trimmedFragment);

        if (isset( $parts[ 1 ] ) && $parts[ 1 ] != '') {
            $this->urlAction = $parts[ 1 ];
        } else {
            if (isset( $parts[ 0 ] ) && $parts[ 0 ] != '') {
                try {
                    $this->category = Category::findFirst(new Equals('SeoSafeName', $parts[ 0 ]));
                } catch (RecordNotFoundException $ex) {
                }
            } else {
                $this->isCollection = true;
            }
        }

        return $matchingUrlFragment;
    }

    protected function getCategoryFromUrl():Category
    {
        $category = Category::getCategoryFromUrl();
        if ($category) {
            return $category;
        } else {
            throw new ForceResponseException(new RedirectResponse('/404/'));
        }
    }

    public function getModelObject()
    {
        return $this->getCategoryFromUrl();
    }
}
