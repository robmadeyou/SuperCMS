<?php

namespace SuperCMS\Models\Product;

use Rhubarb\Stem\Models\Model;
use Rhubarb\Stem\Repositories\MySql\Schema\Columns\MySqlMediumTextColumn;
use Rhubarb\Stem\Repositories\MySql\Schema\MySqlModelSchema;
use Rhubarb\Stem\Schema\Columns\AutoIncrementColumn;
use Rhubarb\Stem\Schema\Columns\ForeignKeyColumn;

/**
 *
 *
 * @property int $CommentID Repository field
 * @property int $ProductID Repository field
 * @property int $UserID Repository field
 * @property string $Text Repository field
 * @property int $ParentCommentID Repository field
 * @property-read Product $Product Relationship
 * @property-read Comment[]|\Rhubarb\Stem\Collections\Collection $ChildComments Relationship
 * @property-read Comment $ParentComment Relationship
 */
class Comment extends Model
{
    protected function createSchema()
    {
        $model = new MySqlModelSchema('tblComment');

        $model->addColumn(
            new AutoIncrementColumn('CommentID'),
            new ForeignKeyColumn('ProductID'),
            new ForeignKeyColumn('UserID'),
            new MySqlMediumTextColumn('Text'),
            new ForeignKeyColumn('ParentCommentID')
        );

        return $model;
    }
}
