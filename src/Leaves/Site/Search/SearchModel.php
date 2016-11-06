<?php

namespace SuperCMS\Leaves\Site\Search;

use Rhubarb\Leaf\Crud\Leaves\ModelBoundModel;
use Rhubarb\Stem\Filters\AnyWordsGroup;
use SuperCMS\Models\Product\Product;
use SuperCMS\Session\SuperCMSSession;

class SearchModel extends ModelBoundModel
{
    public function getProductCollection()
    {
        if ($this->restCollection) {
            $collection = $this->restCollection;
        } else {
            $collection = Product::find();
        }

        $session = SuperCMSSession::singleton();
        return $collection->filter(new AnyWordsGroup(['Name'], $session->searchQuery));
    }
}
