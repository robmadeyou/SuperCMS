<?php

namespace SuperCMS\UrlHandlers;

use Rhubarb\Crown\Request\Request;
use Rhubarb\Leaf\Crud\UrlHandlers\CrudUrlHandler;
use Rhubarb\Stem\Exceptions\RecordNotFoundException;
use Rhubarb\Stem\Filters\Equals;
use SuperCMS\Models\Product\Category;

class CategoryUrlHandler extends CrudUrlHandler
{
    private $category = null;

    protected function getMatchingUrlFragment(Request $request, $currentUrlFragment = '')
    {
        $matchingUrlFragment = parent::getMatchingUrlFragment($request, $currentUrlFragment);

        $this->isCollection = false;

        $trimmedFragment = trim(str_replace($matchingUrlFragment, '', $currentUrlFragment), '/');

        $parts = explode('/', $trimmedFragment);

        if (isset($parts[0]) && $parts[0] == 'category') {
            try {
                $this->category = Category::findFirst(new Equals('SeoSafeName', $parts[1]));
            } catch (RecordNotFoundException $ex) {
            }
        }

        return $matchingUrlFragment;
    }

    public function getModelObject()
    {
        return $this->category;
    }
}
