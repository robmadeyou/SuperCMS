<?php

namespace SuperCMS\Models\User;

use Rhubarb\Stem\Models\Model;
use Rhubarb\Stem\Schema\Columns\AutoIncrementColumn;
use Rhubarb\Stem\Schema\Columns\ForeignKeyColumn;
use Rhubarb\Stem\Schema\Columns\StringColumn;
use Rhubarb\Stem\Schema\ModelSchema;

/**
 *
 *
 * @property int $LocationID Repository field
 * @property int $UserID Repository field
 * @property string $AddressLine1 Repository field
 * @property string $AddressLine2 Repository field
 * @property string $PostCode Repository field
 * @property-read SuperCMSUser $User Relationship
 * @property string $Recipient Repository field
 * @property string $Town Repository field
 * @property string $PhoneNumber Repository field
 * @property string $Country Repository field
 * @property int $BasketID Repository field
 * @property-read \SuperCMS\Models\Shopping\Basket $Basket Relationship
 */
class Location extends Model
{
    protected function createSchema()
    {
        $schema = new ModelSchema('tblLocation');
        $schema->addColumn(
            new AutoIncrementColumn('LocationID'),
            new ForeignKeyColumn('UserID'),
            new ForeignKeyColumn('BasketID'),
            new StringColumn('AddressLine1', 50),
            new StringColumn('AddressLine2', 50),
            new StringColumn('Town', 50),
            new StringColumn('PostCode', 7),
            new StringColumn('PhoneNumber', 20),
            new StringColumn('Country', 50)
        );
        return $schema;
    }
}
