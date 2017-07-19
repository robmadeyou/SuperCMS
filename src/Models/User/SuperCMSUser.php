<?php

namespace SuperCMS\Models\User;

use Rhubarb\Crown\LoginProviders\Exceptions\NotLoggedInException;
use Rhubarb\Crown\LoginProviders\LoginProvider;
use Rhubarb\Scaffolds\Authentication\User;
use Rhubarb\Stem\Collections\RepositoryCollection;
use Rhubarb\Stem\Filters\Equals;
use Rhubarb\Stem\Filters\OrGroup;
use Rhubarb\Stem\Schema\Columns\ForeignKeyColumn;
use Rhubarb\Stem\Schema\Columns\IntegerColumn;
use Rhubarb\Stem\Schema\Columns\StringColumn;
use Rhubarb\Stem\Schema\ModelSchema;
use SuperCMS\LoginProviders\SCmsLoginProvider;
use SuperCMS\Models\Shopping\Basket;
use SuperCMS\Session\SuperCMSSession;

/**
 *
 *
 * @property int $UserID Repository field
 * @property string $Username Repository field
 * @property string $Password Repository field
 * @property string $Forename Repository field
 * @property string $Surname Repository field
 * @property string $Email Repository field
 * @property string $Token Repository field
 * @property \Rhubarb\Crown\DateTime\RhubarbDateTime $TokenExpiry Repository field
 * @property bool $Enabled Repository field
 * @property string $PasswordResetHash Repository field
 * @property \Rhubarb\Crown\DateTime\RhubarbDateTime $PasswordResetDate Repository field
 * @property int $RoleID Repository field
 * @property-read \SuperCMS\Models\Shopping\Basket[]|\Rhubarb\Stem\Collections\RepositoryCollection $Baskets Relationship
 * @property string $MiddleName Repository field
 * @property string $Address Repository field
 * @property string $Address2 Repository field
 * @property string $PostCode Repository field
 * @property int $PrimaryLocationID Repository field
 * @property-read Location $PrimaryLocation Relationship
 * @property-read Location[]|\Rhubarb\Stem\Collections\RepositoryCollection $Locations Relationship
 */
class SuperCMSUser extends User
{
    protected function extendSchema(ModelSchema $schema)
    {
        $schema->addColumn(
            new IntegerColumn('RoleID'),
            new StringColumn('MiddleName', 50),
            new ForeignKeyColumn('PrimaryLocationID')
        );
    }

    /**
     * @return SuperCMSUser
     */
    public static function getLoggedInUser()
    {
        return parent::getLoggedInUser();
    }

    public static function getUserLocations()
    {
        $filters = new OrGroup();
        $filters->addFilters(new Equals('BasketID', Basket::getCurrentBasket()->UniqueIdentifier));

        try {
            $filters->addFilters(new Equals('UserID', SCmsLoginProvider::getLoggedInUser()->UniqueIdentifier));
        } catch (NotLoggedInException $ex) {
        }

        return Location::find($filters);
    }

    /**
     * First tries to load a location from the user, setting primary location if one isn't set
     * And then attempts to load from basket.
     * @return mixed|null|Location
     */
    public static function getUserDefaultLocation()
    {
        try {
            $user = self::getLoggedInUser();
            if ($user->PrimaryLocation) {
                return $user->PrimaryLocation;
            }

            if ($user->Locations && $user->Locations->count()) {
                $user->PrimaryLocationID = $user->Locations[0]->UniqueIdentifier;
                $user->save();
                return $user->PrimaryLocation;
            }
        } catch (NotLoggedInException $ex) {
        }

        $basket = Basket::getCurrentBasket();
        if ($basket->Locations && $basket->Locations->count()) {
            if (isset($user)) {
                $user->PrimaryLocationID = $basket->Locations[0];
                $user->save();
                return $user->PrimaryLocation;
            }
            return $basket->Locations[0];
        }
        return null;
    }
}
