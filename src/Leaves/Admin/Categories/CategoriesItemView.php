<?php

namespace SuperCMS\Leaves\Admin\Categories;

use Rhubarb\Crown\Exceptions\ForceResponseException;
use Rhubarb\Crown\Response\RedirectResponse;
use Rhubarb\Leaf\Controls\Common\FileUpload\SimpleFileUpload;
use Rhubarb\Leaf\Controls\Common\FileUpload\UploadedFileDetails;
use SuperCMS\Controls\Category\CategoryDropdown;
use SuperCMS\Controls\Dropzone\Dropzone;
use SuperCMS\Controls\Dropzone\DropzoneUploadedFileDetails;
use SuperCMS\Views\SuperCMSCrudView;

class CategoriesItemView extends SuperCMSCrudView
{
    protected function createSubLeaves()
    {
        parent::createSubLeaves();

        $this->registerSubLeaf(
            'Name',
            $upload = new SimpleFileUpload('Image'),
            new CategoryDropdown('ParentCategoryID')
        );

        $upload->fileUploadedEvent->attachHandler(function(UploadedFileDetails $data) {
            $this->model->restModel->uploadImage($data, true);
        });

        $this->bootstrapInputs();
    }

    protected function printBody()
    {
        if ($this->model->restModel->isNewRecord()) {
            $this->model->restModel->save();
            throw new ForceResponseException(new RedirectResponse('../' . $this->model->restModel->UniqueIdentifier . '/edit/'));
        }

        $this->printFieldset('', [
            'Name',
            'Image' . ($this->model->restModel->Image ? '<br><img width="200px" height="200px" src="' . $this->model->restModel->Image . '">' : '') => 'Image',
            'Parent Category' => 'ParentCategoryID',
        ]);
    }

    protected function printLeftButtons()
    {
        $url = $this->model->restModel->isNewRecord() ? '../' : '../../' ;
        print '<a href="' . $url . '" class="btn btn-default"><i class="fa fa-arrow-circle-left" aria-hidden="true"></i> Back</a>';
    }
}
