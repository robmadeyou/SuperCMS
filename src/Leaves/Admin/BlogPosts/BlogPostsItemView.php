<?php

namespace SuperCMS\Leaves\Admin\BlogPosts;

use Rhubarb\Leaf\Controls\Common\Text\TextBox;
use SuperCMS\Controls\FancyHtmlUpload\FancyHtmlUpload;
use SuperCMS\Controls\HtmlEditor\HtmlEditor;
use SuperCMS\Deployment\SuperCmsDeploymentPackage;
use SuperCMS\Models\Image\Image;
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
            $fileUpload = new FancyHtmlUpload('CoverImage'),
            new HtmlEditor('Content')
        );

        $fileUpload->fileUploadedEvent->attachHandler(function ($a) {
            $image = Image::createImageFromNameAndPath($a->originalFilename, $a->tempFilename);

            $this->model->restModel->CoverImageID = $image->UniqueIdentifier;
        });
    }

    protected function printBody()
    {
        $imageSrc = $this->model->restModel->CoverImage ? '<img src="' . $this->model->restModel->CoverImage->getImageUrl(200, 200) . '">' : '';

        $this->layoutItemsWithContainer('',
            [
                'Title' => 'Title',
                'Cover Image' => '<div class="c-image-uploader">' . $imageSrc . '{CoverImage}</div>',
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
