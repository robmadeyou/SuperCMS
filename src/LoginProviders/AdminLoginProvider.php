<?php

namespace SuperCMS\LoginProviders;

class AdminLoginProvider extends SCmsLoginProvider
{
    protected function isModelActive($model)
    {
        return parent::isModelActive($model) && $model->RoleID == 2;
    }
}
