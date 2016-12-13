<?php

namespace SuperCMS\Models;

use GuzzleHttp\Exception\CouldNotRewindStreamException;
use Rhubarb\Stem\Schema\SolutionSchema;
use SuperCMS\Models\Coupon\Coupon;
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
use SuperCMS\Models\User\CmsUser;

class SuperCMSSolutionSchema extends SolutionSchema
{
    public function __construct()
    {
        parent::__construct();

        $this->addModel('Product', Product::class, 1.27);
        $this->addModel('ProductImage', ProductImage::class, 1.1);
        $this->addModel('ProductVariation', ProductVariation::class, 1.02);
        $this->addModel('Comment', Comment::class);
        $this->addModel('Category', Category::class, 1.03);
        $this->addModel('User', CmsUser::class, 2);
        $this->addModel('ShippingType', ShippingType::class);
        $this->addModel('Coupon', Coupon::class, 1.01);
        $this->addModel('Basket', Basket::class, 2);
        $this->addModel('BasketItem', BasketItem::class, 1);
        $this->addModel('Order', Order::class, 2);
        $this->addModel('OrderItem', OrderItem::class, 1);
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
                ],
                'Basket' => [
                    'BasketItems' => 'BasketItem.BasketID',
                ],
                'Order' => [
                    'OrderItems' => 'OrderItem.OrderID',
                ],
            ]
        );

        $this->declareOneToOneRelationships(
            [
                'Basket' => [
                    'Order' => 'Order.BookingID'
                ],
                'BasketItem' => [
                    'OrderItem' => 'OrderItem.BasketID',
                ],
            ]
        );
    }
}
