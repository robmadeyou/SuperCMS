<?php

namespace SuperCMS\Leaves\Site\Register;

use Rhubarb\Leaf\Crud\Leaves\CrudModel;

class RegisterModel extends CrudModel
{
    public $errors = [];
    public $PasswordRepeat;
}
