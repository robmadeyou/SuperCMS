<?php

namespace SuperCMS\Leaves\Admin\BlogPosts;

use Rhubarb\Leaf\Table\Leaves\Table;
use SuperCMS\Controls\CustomTable\SCMSCustomTable;
use SuperCMS\Models\Blog\BlogPost;
use SuperCMS\Views\AdminBlogPostTableView;
use SuperCMS\Views\SuperCMSCollectionView;

class BlogPostsCollectionView extends SuperCMSCollectionView
{
    /** @var BlogPostsCollectionModel $model **/
    protected $model;

    protected function createSubLeaves()
    {
        parent::createSubLeaves();

        $this->registerSubLeaf(
            $table = new SCMSCustomTable(AdminBlogPostTableView::class, BlogPost::find(), 25, 'Table')
        );

        $table->columns = [
            'Title',
            '' => '<a href="{postPublicUrl}">View Live</a>',
            ' ' => '<a href="{UniqueIdentifier}/edit/">Edit</a>'
        ];
    }

    public function printBody()
    {
        print $this->leaves['Table'];
    }

    protected function printRightButtons()
    {
        print '<a href="add/" class="btn btn-success"><i class="fa fa-plus" aria-hidden="true"></i> Add a new post</a>';
    }
}
