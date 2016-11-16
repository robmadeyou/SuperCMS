<?php

namespace SuperCMS\Models\User;

use Rhubarb\Scaffolds\Authentication\User;
use Rhubarb\Stem\Schema\Columns\IntegerColumn;
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
 */
class CmsUser extends User
{
    protected function extendSchema(ModelSchema $schema)
    {
        $schema->addColumn(
            new IntegerColumn('RoleID')
        );
    }
}
