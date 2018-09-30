<?php

namespace SuperCMS\Models\Blog;

use Rhubarb\Stem\Models\Model;
use Rhubarb\Stem\Schema\Columns\AutoIncrementColumn;
use Rhubarb\Stem\Schema\Columns\ForeignKeyColumn;
use Rhubarb\Stem\Schema\Columns\StringColumn;
use Rhubarb\Stem\Schema\ModelSchema;

/**
 *
 *
 * @property int $BlogPostTagID Repository field
 * @property int $BlogPostID Repository field
 * @property string $Tag Repository field
 * @property-read BlogPost $BlogPost Relationship
 */
class BlogPostTag extends Model
{
    const VERSION = 1;

    protected function createSchema()
    {
        $schema = new ModelSchema('tblBlogPostTag');

        $schema->addColumn(
            new AutoIncrementColumn('BlogPostTagID'),
            new ForeignKeyColumn('BlogPostID'),
            new StringColumn("Tag", 25)
        );

        return $schema;
    }
}