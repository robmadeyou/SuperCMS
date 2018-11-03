<?php

namespace SuperCMS\Models;

use Rhubarb\Crown\String\StringTools;
use Rhubarb\Stem\Schema\SolutionSchema;
use SuperCMS\Models\Blog\BlogPost;
use SuperCMS\Models\Blog\BlogPostTag;
use SuperCMS\Models\Coupon\Coupon;
use SuperCMS\Models\Image\Image;
use SuperCMS\Models\Notification\Notification;
use SuperCMS\Models\Product\Category;
use SuperCMS\Models\Product\Comment;
use SuperCMS\Models\Product\Product;
use SuperCMS\Models\Product\ProductImage;
use SuperCMS\Models\Product\ProductVariation;
use SuperCMS\Models\Shipping\ShippingType;
use SuperCMS\Models\Shopping\Basket;
use SuperCMS\Models\Shopping\BasketItem;
use SuperCMS\Models\Shopping\Order;
use SuperCMS\Models\Shopping\OrderItem;
use SuperCMS\Models\User\Location;
use SuperCMS\Models\User\SuperCMSUser;

class SCMSSolutionSchema extends SolutionSchema
{
    public function __construct()
    {
        parent::__construct();

        $models = [
            Product::class,
            ProductImage::class,
            ProductVariation::class,
            Comment::class,
            Category::class,
            SuperCMSUser::class,
            ShippingType::class,
            Coupon::class,
            Basket::class,
            BasketItem::class,
            Order::class,
            OrderItem::class,
            Notification::class,
            Location::class,
            BlogPost::class,
            BlogPostTag::class,
            Image::class,
        ];

        foreach($models as $model) {
            $this->addModel(StringTools::getShortClassNameFromNamespace($model), $model, $model::VERSION);
        }
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
                    'Images' => 'ProductImage.ProductVariationID',
                    'BasketItems' => 'BasketItem.ProductVariationID',
                ],
                'Category' => [
                    'Products' => 'Product.CategoryID',
                    'ChildCategories' => 'Category.ParentCategoryID:ParentCategory',
                ],
                'Comment' => [
                    'ChildComments' => 'Comment.ParentCommentID:ParentComment',
                ],
                'User' => [
                    'Baskets' => 'Basket.UserID',
                    'Locations' => 'Location.UserID',
                    'BlogPosts' => 'BlogPost.CreatedByID:CreatedBy'
                ],
                'Basket' => [
                    'BasketItems' => 'BasketItem.BasketID',
                    'Locations' => 'Location.BasketID',
                ],
                'Order' => [
                    'OrderItems' => 'OrderItem.OrderID',
                ],
                'BlogPost' => [
                    'Tags' => 'BlogPostTag.BlogPostID'
                ]
            ]
        );

        $this->declareOneToOneRelationships(
            [
                'Basket' => [
                    'Order' => 'Order.BasketID'
                ],
                'BasketItem' => [
                    'OrderItem' => 'OrderItem.BasketItemID',
                ],
                'Location' => [
                    'User' => 'User.PrimaryLocationID:PrimaryLocation'
                ]
            ]
        );
    }
}
