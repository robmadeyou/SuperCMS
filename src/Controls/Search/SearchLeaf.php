<?php

namespace SuperCMS\Controls\Search;

use Rhubarb\Leaf\Leaves\Leaf;
use Rhubarb\Stem\Filters\AndGroup;
use Rhubarb\Stem\Filters\Contains;
use Rhubarb\Stem\Filters\Equals;
use SuperCMS\Models\Product\Category;
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
            $filters = new AndGroup(
                [
                    new Contains('Name', $query),
                    new Equals('Live', true),
                ]
            );

            $links = [];
            $categories = Category::find(new Contains('Name', $query))->setRange(0,10);
            $products = Product::find($filters)->setRange(0,40);

            foreach($categories as $category) {
                /** @var Category $category */
                $p = new \stdClass();
                $p->Name = $category->Name;
                $p->Thumbnail = $category->getThumbnailUrl();
                $p->Href = $category->getPublicUrl();

                $links[] = $p;
            }

            foreach($products as $product) {
                /** @var Product $product */
                $p = new \stdClass();
                $p->Name = $product->Name;
                $p->Thumbnail = $product->getDefaultThumbnail();
                $p->Href = $product->getPublicUrl();

                $links[] = $p;
            }

            return $links;
        });

        return $model;
    }
}
