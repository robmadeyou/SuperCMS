<?php

namespace SuperCMS\Leaves\Admin\Categories;

use Rhubarb\Crown\Exceptions\ForceResponseException;
use Rhubarb\Crown\Response\RedirectResponse;
use SuperCMS\Controls\Category\CategoryDropdown;
use SuperCMS\Controls\Dropzone\Dropzone;
use SuperCMS\Views\SuperCMSCrudView;

class CategoriesItemView extends SuperCMSCrudView
{
    protected function createSubLeaves()
    {
        parent::createSubLeaves();

        $this->registerSubLeaf(
            'Name',
            $dropzone = new Dropzone('Image'),
            new CategoryDropdown('ParentCategoryID')
        );

        $dropzone->fileUploadedEvent->attachHandler(function($fileDetails) {
            $this->model->restModel->uploadImage($fileDetails);
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
            'Image',
            'Parent Category' => 'ParentCategoryID',
        ]);
    }
}
