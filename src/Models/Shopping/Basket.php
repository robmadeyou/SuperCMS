<?php

namespace SuperCMS\Models\Shopping;

use Rhubarb\Crown\LoginProviders\Exceptions\NotLoggedInException;
use Rhubarb\Stem\Aggregates\Sum;
use Rhubarb\Stem\Exceptions\RecordNotFoundException;
use Rhubarb\Stem\Filters\AndGroup;
use Rhubarb\Stem\Filters\Equals;
use Rhubarb\Stem\Filters\Not;
use Rhubarb\Stem\Models\Model;
use Rhubarb\Stem\Repositories\MySql\Schema\Columns\MySqlEnumColumn;
use Rhubarb\Stem\Schema\Columns\AutoIncrementColumn;
use Rhubarb\Stem\Schema\Columns\ForeignKeyColumn;
use Rhubarb\Stem\Schema\Columns\StringColumn;
use Rhubarb\Stem\Schema\ModelSchema;
use SuperCMS\Controls\GlobalBasket\GlobalBasket;
use SuperCMS\LoginProviders\SCmsLoginProvider;
use SuperCMS\Models\Product\ProductVariation;
use SuperCMS\Session\SuperCMSSession;

/**
 *
 *
 * @property int                                                              $BasketID Repository field
 * @property string                                                           $Session Repository field
 * @property int                                                              $UserID Repository field
 * @property-read \SuperCMS\Models\User\SuperCMSUser                          $User Relationship
 * @property-read BasketItem[]|\Rhubarb\Stem\Collections\RepositoryCollection $BasketItems Relationship
 * @property string                                                           $Status Repository field
 * @property-read mixed                                                       $TotalCost {@link getTotalCost()}
 * @property-read Order                                                       $Order Relationship
 * @property-read mixed                                                       $TotalQuantity {@link getTotalQuantity()}
 * @property-read \SuperCMS\Models\User\Location[]|\Rhubarb\Stem\Collections\RepositoryCollection $Locations Relationship
 */
class Basket extends Model
{

    const STATUS_NEW = 'New';
    const STATUS_COMPLETED = 'Completed';

    protected function createSchema()
    {
        $schema = new ModelSchema('tblBasket');

        $schema->addColumn(
            new AutoIncrementColumn('BasketID'),
            new StringColumn('Session', 100),
            new ForeignKeyColumn('UserID'),
            new MySqlEnumColumn('Status', self::STATUS_NEW, [self::STATUS_NEW, self::STATUS_COMPLETED])
        );

        return $schema;
    }

    public function getTotalCost()
    {
        $total = 0;
        foreach($this->BasketItems as $basketItem) {
            $total += $basketItem->ProductVariation->Price * $basketItem->Quantity;
        }
        return $total;
    }

    public function getTotalQuantity()
    {
        list($quantity) = $this->BasketItems->calculateAggregates(new Sum('Quantity'));
        return $quantity;
    }

    public static function addVariationToBasket(ProductVariation $variation, $quantity = 1)
    {
        $basket = self::getCurrentBasket();

        $basketItem = self::hasBasketGotSimilarItem($basket, $variation);
        if ($basketItem) {
            $basketItem->Quantity += $quantity;
            $basketItem->save();
        } else {
            $basketItem = new BasketItem();
            $basketItem->BasketID = $basket->UniqueIdentifier;
            $basketItem->ProductVariationID = $variation->UniqueIdentifier;
            $basketItem->Quantity = $quantity;
            $basketItem->save();
        }

        GlobalBasket::getInstance()->replace();
    }

    /**
     * Creates an instance of the basket, and reloads the object.
     * @return Basket
     */
    public static function getCurrentBasket()
    {
        $settings = SuperCMSSession::singleton();

        try {
            $user = SCmsLoginProvider::getLoggedInUser();
            try {
                $basket = Basket::findLast(new AndGroup(
                    [
                        new Equals('UserID', $user->UniqueIdentifier),
                        new Not(new Equals('Status', self::STATUS_COMPLETED))
                    ]
                ));
            } catch (RecordNotFoundException $ex) {
                $basket = new Basket();
                $basket->UserID = $user->UniqueIdentifier;
                $basket->save();
            }

            if ($settings->basketId != $basket->UniqueIdentifier) {
                self::joinAnonymousBasketItemsToUserBasket($basket);
                self::updateSession($basket);
            }
        } catch (NotLoggedInException $ex) {
            try {
                $basket = new Basket($settings->basketId);
            } catch (RecordNotFoundException $ex) {
                $basket = new Basket();
                $basket->save();
                self::updateSession($basket);
            }
        }

        return $basket;
    }

    private static function updateSession(Basket $basket)
    {
        $settings = SuperCMSSession::singleton();
        $settings->basketId = $basket->UniqueIdentifier;
        $settings->storeSession();
        GlobalBasket::getInstance()->reLoadBasket();
    }

    private static function joinAnonymousBasketItemsToUserBasket(Basket $userBasket)
    {
        $settings = SuperCMSSession::singleton();
        try {
            $sessionBasket = new Basket($settings->basketId);
            foreach ($sessionBasket->BasketItems as $basketItem) {
                if (!self::hasBasketGotSimilarItem($userBasket, $basketItem->ProductVariation)) {
                    $basketItem->BasketID = $userBasket->UniqueIdentifier;
                    $basketItem->save();
                }
            }
        } catch (RecordNotFoundException $ex)
        {}
    }

    public function markPaid()
    {
        self::markBasketPaid($this);
    }

    /**
     * Marks existing basket as paid and reloads all the settings
     * for a new basket
     * @param Basket $basket
     */
    public static function markBasketPaid(Basket $basket)
    {
        $basket->Status = Basket::STATUS_COMPLETED;
        $basket->save();
        $session = SuperCMSSession::singleton();
        $session->basketId = 0;
        $session->storeSession();
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
