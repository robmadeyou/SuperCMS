<?php

namespace SuperCMS\Leaves\Admin\BlogPosts;

use Rhubarb\Leaf\Controls\Common\Text\TextBox;
use Rhubarb\Leaf\Leaves\LeafDeploymentPackage;
use SuperCMS\Controls\HtmlEditor\HtmlEditor;
use SuperCMS\Views\SuperCMSCrudView;

class BlogPostsItemView extends SuperCMSCrudView
{
    /** @var BlogPostsItemModel $model **/
    protected $model;

    protected function createSubLeaves()
    {
        parent::createSubLeaves();

        $this->registerSubLeaf(
            new TextBox('Title'),
            new HtmlEditor('Content')
        );

        $this->bootstrapInputs();
    }

    protected function printBody()
    {
        $this->printFieldset('Adding a new blog post',
            [
                'Title',
                'Content'
            ]
        );
    }

    public function getDeploymentPackage()
    {
        return new LeafDeploymentPackage(__DIR__ . '/BlogPostsItemViewBridge.js');
    }

    protected function getViewBridgeName()
    {
        return 'BlogPostsItemViewBridge';
    }
}
