<?php

namespace SuperCMS\Models;

use Rhubarb\Stem\Schema\SolutionSchema;
use SuperCMS\Models\Product\Category;
use SuperCMS\Models\Product\Comment;
use SuperCMS\Models\Product\Product;
use SuperCMS\Models\Product\ProductImage;
use SuperCMS\Models\Product\ProductVariation;
use SuperCMS\Models\Shipping\ShippingType;
use SuperCMS\Models\User\CmsUser;

class SCmsSolutionSchema extends SolutionSchema
{
    public function __construct()
    {
        parent::__construct();

        $this->addModel('Product', Product::class, 1.22);
        $this->addModel('ProductImage', ProductImage::class);
        $this->addModel('ProductVariation', ProductVariation::class, 1.01);
        $this->addModel('Comment', Comment::class);
        $this->addModel('Category', Category::class);
        $this->addModel('User', CmsUser::class);
        $this->addModel('ShippingType', ShippingType::class);
    }

    protected function defineRelationships()
    {
        $this->declareOneToManyRelationships(
            [
                'Product' => [
                    'ChildProduct' => 'Product.ParentProductID:ParentCategory',
                    'Comments' => 'Comment.ProductID',
                    'Variations' => 'ProductVariation.ProductID',
                ],
                'ProductVariation' => [
                    'Images' => 'ProductImage.ProductID',
                ],
                'Category' => [
                    'Products' => 'Product.CategoryID',
                    'ChildCategories' => 'Category.ParentCategoryID:ParentCategory',
                ],
                'Comment' => [
                    'ChildComments' => 'Comment.ParentCommentID:ParentComment',
                ],
            ]
        );
    }
}
