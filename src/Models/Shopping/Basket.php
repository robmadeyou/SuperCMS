<?php

namespace SuperCMS\Models\Shopping;

use Rhubarb\Stem\Models\Model;
use Rhubarb\Stem\Schema\Columns\AutoIncrementColumn;
use Rhubarb\Stem\Schema\Columns\ForeignKeyColumn;
use Rhubarb\Stem\Schema\Columns\StringColumn;
use Rhubarb\Stem\Schema\ModelSchema;

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
}
