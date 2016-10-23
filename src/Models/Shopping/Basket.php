<?php

namespace SuperCMS\Models\Shopping;

use Rhubarb\Stem\Exceptions\RecordNotFoundException;
use Rhubarb\Stem\Filters\Equals;
use Rhubarb\Stem\Models\Model;
use Rhubarb\Stem\Schema\Columns\AutoIncrementColumn;
use Rhubarb\Stem\Schema\Columns\ForeignKeyColumn;
use Rhubarb\Stem\Schema\Columns\StringColumn;
use Rhubarb\Stem\Schema\ModelSchema;
use SuperCMS\Models\Product\ProductVariation;
use SuperCMS\Session\SuperCMSSession;

/**
 *
 *
 * @property int $BasketID Repository field
 * @property string $Session Repository field
 * @property int $UserID Repository field
 * @property-read \SuperCMS\Models\User\CmsUser $User Relationship
 * @property-read BasketItem[]|\Rhubarb\Stem\Collections\RepositoryCollection $BasketItems Relationship
 */
class Basket extends Model
{
    protected function createSchema()
    {
        $schema = new ModelSchema('tblBasket');

        $schema->addColumn(
            new AutoIncrementColumn('BasketID'),
            new StringColumn('Session', 100),
            new ForeignKeyColumn('UserID')
        );

        return $schema;
    }

    public static function addVariationToBasket(ProductVariation $variation, $quantity = 1)
    {
        $settings = SuperCMSSession::singleton();
        try {
            $basket = new Basket($settings->basketId);
        } catch (RecordNotFoundException $ex) {
            $basket = new Basket();
            $basket->save();

            $settings->basketId = $basket->UniqueIdentifier;
            $settings->storeSession();
        }

        $basketItem = self::hasBasketGotSimilarItem($basket, $variation);
        if ($basketItem) {
            $basketItem->Quantity += $quantity;
            $basketItem->save();
        } else {
            $basketItem = new BasketItem();
            $basketItem->BasketID = $basket->UniqueIdentifier;
            $basketItem->ProductVariationID = $variation;
            $basketItem->Quantity = $quantity;
            $basketItem->save();
        }
    }

    /**
     * @param Basket           $basket
     * @param ProductVariation $variation
     *
     * Tries to find a basket item within the basket that matches particular variation. This works because
     * we won't have multiple items of the same type in a basket.
     *
     * @return BasketItem|bool
     */
    public static function hasBasketGotSimilarItem(self $basket, ProductVariation $variation)
    {
        /** @var BasketItem[] $basketItem */
        $basketItem = $basket->BasketItems->filter(new Equals('ProductVariationID', $variation->UniqueIdentifier));
        if (count($basketItem)) {
            return $basketItem[0];
        }
        return false;
    }
}
