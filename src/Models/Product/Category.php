<?php

namespace SuperCMS\Models\Product;

use Rhubarb\Stem\Models\Model;
use Rhubarb\Stem\Repositories\MySql\Schema\MySqlModelSchema;
use Rhubarb\Stem\Schema\Columns\AutoIncrementColumn;
use Rhubarb\Stem\Schema\Columns\ForeignKeyColumn;
use Rhubarb\Stem\Schema\Columns\StringColumn;

/**
 *
 *
 * @property int $CategoryID Repository field
 * @property int $ParentCategoryID Repository field
 * @property string $Name Repository field
 * @property-read Product[]|\Rhubarb\Stem\Collections\Collection $Products Relationship
 * @property-read Category[]|\Rhubarb\Stem\Collections\Collection $ChildCategories Relationship
 * @property-read Category $ParentCategory Relationship
 */
class Category extends Model
{
    protected function createSchema()
    {
        $model = new MySqlModelSchema('tblCategory');

        $model->addColumn(
            new AutoIncrementColumn('CategoryID'),
            new ForeignKeyColumn('ParentCategoryID'),
            new StringColumn('Name', 50)
        );

        return $model;
    }
}
