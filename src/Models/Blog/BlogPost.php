<?php

namespace SuperCMS\Models\Blog;

use Rhubarb\Crown\DateTime\RhubarbDateTime;
use Rhubarb\Crown\Logging\Log;
use Rhubarb\Crown\LoginProviders\Exceptions\NotLoggedInException;
use Rhubarb\Stem\Models\Model;
use Rhubarb\Stem\Schema\Columns\AutoIncrementColumn;
use Rhubarb\Stem\Schema\Columns\DateTimeColumn;
use Rhubarb\Stem\Schema\Columns\ForeignKeyColumn;
use Rhubarb\Stem\Schema\Columns\IntegerColumn;
use Rhubarb\Stem\Schema\Columns\LongStringColumn;
use Rhubarb\Stem\Schema\Columns\StringColumn;
use Rhubarb\Stem\Schema\ModelSchema;
use SuperCMS\LoginProviders\AdminLoginProvider;

/**
 *
 *
 * @property int $BlogPostID Repository field
 * @property string $Title Repository field
 * @property string $Content Repository field
 * @property int $CreatedByID Repository field
 * @property RhubarbDateTime $CreatedAt Repository field
 * @property-read \Rhubarb\Scaffolds\Authentication\User $CreatedBy Relationship
 * @property-read BlogPostTag[]|\Rhubarb\Stem\Collections\RepositoryCollection $Tags Relationship
 * @property string $CoverPhotoSrc Repository field
 * @property int $Weight Repository field
 * @property int $CoverImageID Repository field
 * @property-read \SuperCMS\Models\Image\Image $CoverImage Relationship
 */
class BlogPost extends Model
{
    const VERSION = 6;

    protected function createSchema()
    {
        $schema = new ModelSchema('tblBlogPost');

        $schema->addColumn(
            new AutoIncrementColumn('BlogPostID'),
            new StringColumn('Title', 100),
            new LongStringColumn('Content'),
            new ForeignKeyColumn('CreatedByID'),
            new DateTimeColumn('CreatedAt'),
            new ForeignKeyColumn('CoverImageID'),
            new IntegerColumn('Weight', 1)
        );

        $schema->labelColumnName = 'Title';

        return $schema;
    }

    protected function beforeSave()
    {
        if ($this->isNewRecord()) {
            $this->CreatedAt = new RhubarbDateTime('now');
            try {
                $this->CreatedByID = AdminLoginProvider::getLoggedInUser()->UniqueIdentifier;
            } catch (NotLoggedInException $ex) {
                Log::createEntry(Log::WARNING_LEVEL, 'Blog post [' . $this->UniqueIdentifier. '] created without a logged in user');
            }
        }
    }

    public function getPostUrl()
    {
        //TODO write a URL handler for SEOiness
        $safeName = urlencode($this->Title);
        return "/posts/{$this->UniqueIdentifier}/{$safeName}/";
    }
}
