<?php

namespace SuperCMS\Views;

use Rhubarb\Leaf\Table\Leaves\TableView;
use SuperCMS\Models\Blog\BlogPost;

class AdminBlogPostTableView extends TableView
{
    public function createSubLeaves()
    {
        parent::createSubLeaves();

        $this->model->addCssClassNames('c-blog-post');
    }

    public function printViewContent()
    {
        $suppressPagerContent = false;

        if ($this->model->unsearchedHtml && !$this->model->searched) {
            print $this->model->unsearchedHtml;
            $suppressPagerContent = true;
        } elseif (count($this->model->collection) == 0 && $this->model->noDataHtml) {
            print $this->model->noDataHtml;
            $suppressPagerContent = true;
        }

        //Always print the pager so we get javaScript loading
        print $this->leaves["EventPager"];

        if ($suppressPagerContent) {
            return;
        }

        ?>
        <div class="list">
            <div <?= $this->model->getClassAttribute(); ?>>
                <?php
                foreach ($this->model->collection as $post) {
                    $this->printRow($post);
                }
                ?>
            </div>
        </div>
        <?php

        if ($this->model->repeatPagerAtBottom) {
            $this->leaves["EventPager"]->printWithIndex("bottom");
        }
    }

    public function printRow(BlogPost $post)
    {
        $createdBy = ($post->CreatedBy ? $post->CreatedBy->getFullName() : 'Unknown');
        print <<<HTML
<div class="c-blog-post--individual --compact">
    <div class="blog-content">
        <div class="blog-content--title">
            {$post->Title}
        </div>
        <div class="blog-content--inner">
            {$post->Content}
        </div>
        <div class="blog-content--date">
            {$post->CreatedAt->format('d/m/Y H:i')} By {$createdBy}
        </div>
        <div class="link"><a href="./{$post->UniqueIdentifier}/edit/"></a></div>
    </div>
</div>
HTML;
    }
}
