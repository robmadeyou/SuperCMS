<?php

namespace SuperCMS\Controls\Search;

use Rhubarb\Leaf\Leaves\Leaf;
use Rhubarb\Stem\Filters\AndGroup;
use Rhubarb\Stem\Filters\Contains;
use Rhubarb\Stem\Filters\Equals;
use SuperCMS\Models\Product\Product;
use SuperCMS\Session\SuperCMSSession;

class SearchLeaf extends Leaf
{
    protected function getViewClass()
    {
        return SearchView::class;
    }

    protected function createModel()
    {
        $model = new SearchModel();

        $session = SuperCMSSession::singleton();
        $model->Query = $session->searchQuery;

        $model->searchEvent->attachHandler(function($query) {
            $products = Product::find(
                new AndGroup(
                    [
                        new Contains('Name', $query),
                        new Equals('Live', true),
                    ]
                )
            );
            $productsReturn = [];
            foreach($products as $product) {
                $p = new \stdClass();
                $p->Name = $product->Name;
                $p->Href = $product->getPublicUrl();

                $productsReturn[] = $p;
            }

            return $productsReturn;
        });

        return $model;
    }
}
