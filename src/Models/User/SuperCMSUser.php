<?php

namespace SuperCMS\Models\User;

use Rhubarb\Scaffolds\Authentication\User;
use Rhubarb\Stem\Schema\Columns\ForeignKeyColumn;
use Rhubarb\Stem\Schema\Columns\IntegerColumn;
use Rhubarb\Stem\Schema\Columns\StringColumn;
use Rhubarb\Stem\Schema\ModelSchema;

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
}
