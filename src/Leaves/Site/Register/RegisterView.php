<?php

namespace SuperCMS\Leaves\Site\Register;

use Rhubarb\Crown\Settings\HtmlPageSettings;
use Rhubarb\Leaf\Controls\Common\Text\TextBox;
use Rhubarb\Leaf\Crud\Leaves\CrudView;
use SuperCMS\Controls\LocationPicker\LocationPicker;
use SuperCMS\Controls\PasswordTextBox\PasswordTextBox;
use SuperCMS\Settings\SuperCmsPageSettings;
use SuperCMS\Views\BootstrapViewTrait;

class RegisterView extends CrudView
{
    use BootstrapViewTrait;

    protected function createSubLeaves()
    {
        parent::createSubLeaves();

        $settings = HtmlPageSettings::singleton();
        $settings->pageTitle = 'Register now!';

        $this->registerSubLeaf(
            $firstName = new TextBox('Forename'),
            $middleName = new TextBox('MiddleName'),
            $lastName = new TextBox('Surname'),
            $email = new TextBox('Email'),
            $address1 = new TextBox('Address'),
            $address2 = new TextBox('Address2'),
            $postCode = new TextBox('PostCode'),
            $password = new PasswordTextBox('Password'),
            $repeatPassword = new PasswordTextBox('PasswordRepeat'),
            $locationPicker = new LocationPicker('Location')
        );

        $settings = SuperCmsPageSettings::singleton();
        $settings->hideBanner = true;

        $firstName->setPlaceholderText( 'Forename' );
        $middleName->setPlaceholderText( 'Middle Name' );
        $lastName->setPlaceholderText( 'Last Name' );

        $email->setPlaceholderText( 'Email Address' );

        $address1->setPlaceholderText( 'Address Line 1' );
        $address2->setPlaceholderText( 'Address Line 2' );

        $postCode->setPlaceholderText( 'Post Code' );

        $password->setPlaceholderText( 'Password' );
        $repeatPassword->setPlaceholderText( 'Confirm Password' );

        $this->leaves[ 'Save' ]->addCssClassNames( 'btn-success' );

        $this->bootstrapInputs();
    }

    protected function printViewContent()
    {
        ?>
        <div class="row" style="margin-top:30px; margin-bottom:30px">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading"><h3 class="panel-title"><strong>Account details</strong></h3>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-xs-12 col-sm-4 col-md-4">
                                <div class="form-group">
                                    <?= $this->leaves[ 'Forename' ] ?>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-4 col-md-4">
                                <div class="form-group">
                                    <?= $this->leaves[ 'MiddleName' ] ?>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-4 col-md-4">
                                <div class="form-group">
                                    <?= $this->leaves[ 'Surname' ] ?>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <?= $this->leaves[ 'Email' ] ?>
                        </div>
                        <div class="row">
                            <div class="col-xs-12 col-sm-6 col-md-6">
                                <div class="form-group">
                                    <?= $this->leaves[ 'Password' ] ?>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-6 col-md-6">
                                <div class="form-group">
                                    <?= $this->leaves[ 'PasswordRepeat' ] ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <?= $this->leaves['Location'] ?>
                <button type="button" class="btn btn-primary js-add-location" data-toggle="modal" data-target=".modal-location-edit">Add a new Location</button>
                <div class="c-register-bottom">
                    <?= $this->leaves[ 'Save' ] . $this->leaves[ 'Cancel' ] ?>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
        <?php
    }
}
