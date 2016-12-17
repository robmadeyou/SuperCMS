<?php

namespace SuperCMS\Leaves\Site\Register;

use Rhubarb\Crown\Settings\HtmlPageSettings;
use Rhubarb\Leaf\Controls\Common\Text\TextBox;
use Rhubarb\Leaf\Views\View;
use SuperCMS\Settings\SuperCmsPageSettings;
use SuperCMS\Views\BootstrapViewTrait;

class RegisterView extends View
{
    use BootstrapViewTrait;

    protected function createSubLeaves()
    {
        parent::createSubLeaves();

        $settings = HtmlPageSettings::singleton();
        $settings->pageTitle = 'Register now!';

        $this->registerSubLeaf(
            $firstName = new TextBox('FirstName'),
            $middleName = new TextBox('MiddleName'),
            $lastName = new TextBox('LastName'),
            new TextBox('Username'),
            $email = new TextBox('Email'),
            $address1 = new TextBox('Address'),
            $address2 = new TextBox('Address2'),
            $postCode = new TextBox('PostCode')
        );

        $settings = SuperCmsPageSettings::singleton();
        $settings->hideBanner = true;

        $firstName->setPlaceholderText('Forename');
        $middleName->setPlaceholderText('Middle Name');
        $lastName->setPlaceholderText('Last Name');

        $email->setPlaceholderText('Email Address');

        $address1->setPlaceholderText('Address Line 1');
        $address2->setPlaceholderText('Address Line 2');

        $postCode->setPlaceholderText('Post Code');

        $this->bootstrapInputs();
    }

    protected function printViewContent()
    {
        ?>
        <div class="row" style="margin-top:30px">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading"><h3 class="panel-title"><strong>Sign up</strong></h3>
                        <div style="float:right; font-size: 80%; position: relative; top:-10px"><a href="#">Forgot password?</a></div>
                    </div>

                    <div class="panel-body">
                        <form role="form">
                            <div class="row">
                                <div class="col-xs-12 col-sm-4 col-md-4">
                                    <div class="form-group">
                                        <?= $this->leaves['FirstName'] ?>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-4 col-md-4">
                                    <div class="form-group">
                                        <?= $this->leaves['MiddleName'] ?>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-4 col-md-4">
                                    <div class="form-group">
                                        <?= $this->leaves['LastName'] ?>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <?= $this->leaves['Email'] ?>
                            </div>
                            <div class="form-group">
                                <?= $this->leaves['Address'] ?>
                            </div>
                            <div class="form-group">
                                <?= $this->leaves['Address2'] ?>
                            </div>
                            <div class="row">
                                <div class="col-xs-4">
                                    <div class="form-group">
                                        <?= $this->leaves['PostCode'] ?>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-xs-12 col-sm-6 col-md-6">
                                    <div class="form-group">
                                        <input type="password" name="password" id="password" class="form-control " placeholder="Password" tabindex="5">
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-6 col-md-6">
                                    <div class="form-group">
                                        <input type="password" name="password_confirmation" id="password_confirmation" class="form-control " placeholder="Confirm Password" tabindex="6">
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-success">Register</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <?php
    }
}
