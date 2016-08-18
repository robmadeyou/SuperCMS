<?php

namespace SuperCMS\Leaves\Admin;

use Rhubarb\Crown\Exceptions\ForceResponseException;
use Rhubarb\Crown\Response\RedirectResponse;
use Rhubarb\Leaf\Crud\Leaves\CrudLeaf;

abstract class AdminCrudLeaf extends CrudLeaf
{
    protected $wasNewRecord = false;

    protected function saveRestModel()
    {
        $this->wasNewRecord = $this->model->restModel->isNewRecord();
        return parent::saveRestModel();
    }

    protected function redirectAfterCancel()
    {
        if ($this->wasNewRecord) {
            $redirect = '../';
        } else {
            $redirect = '../../';
        }

        throw new ForceResponseException(new RedirectResponse($redirect));
    }
}
