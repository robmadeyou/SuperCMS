<?php

namespace SuperCMS\Leaves\Blog;

use Rhubarb\Leaf\Views\View;
use Rhubarb\Leaf\Leaves\LeafDeploymentPackage;
use SuperCMS\Models\Blog\BlogPost;

class BlogIndexPageView extends View
{

    protected function createSubLeaves()
    {
        parent::createSubLeaves();
    }

    protected function printViewContent()
    {
        foreach (BlogPost::find() as $post) {
            print $post->Content;
            print $post->CreatedAt->format('d/m/Y');
        }
    }

    public function getDeploymentPackage()
    {
        return new LeafDeploymentPackage(__DIR__ . '/BlogIndexPageViewBridge.js');
    }

    protected function getViewBridgeName()
    {
        return 'BlogIndexPageViewBridge';
    }
}
