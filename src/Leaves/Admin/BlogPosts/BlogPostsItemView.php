<?php

namespace SuperCMS\Leaves\Admin\BlogPosts;

use Rhubarb\Leaf\Controls\Common\Text\TextBox;
use SuperCMS\Controls\HtmlEditor\HtmlEditor;
use SuperCMS\Deployment\SuperCmsDeploymentPackage;
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
    }

    protected function printBody()
    {
        $this->layoutItemsWithContainer('',
            [
                'Title' => 'Title',
                'Main Content' => 'Content'
            ]
        );
    }

    public function getDeploymentPackage()
    {
        return new SuperCmsDeploymentPackage(__DIR__ . '/BlogPostsItemViewBridge.js');
    }

    protected function getViewBridgeName()
    {
        return 'BlogPostsItemViewBridge';
    }
}
