<?php

namespace SuperCMS\Leaves;

use Rhubarb\Crown\Request\Request;
use Rhubarb\Scaffolds\Authentication\Leaves\LoginView;
use SuperCMS\Controls\LocationPicker\LocationPicker;
use SuperCMS\Controls\Notification\NotificationPrint;
use SuperCMS\Settings\SuperCmsPageSettings;

class SuperCMSLoginView extends LoginView
{
    public function createSubLeaves()
    {
        parent::createSubLeaves();


        $this->leaves['username']->addCssClassNames('form-control');
        $this->leaves['password']->addCssClassNames('form-control');
        $this->leaves['Login']->addCssClassNames('btn btn-default button');

        $this->leaves['username']->addHtmlAttribute('placeholder', 'Email Address');
        $this->leaves['password']->addHtmlAttribute('placeholder', 'Password');

        $settings = SuperCmsPageSettings::singleton();
        $settings->hideBanner = true;
        $settings->pageTitle = 'Login now';
    }

    public function printViewContent()
    {
        $redirect = '';
        $request = Request::current();
        if ($request->get('rd')) {
            $redirect = '?rd=' . $request->get('rd');
        }

        print <<<HTML
            <div class="row" id="pwd-container">
                <div class="col-md-4 col-md-offset-4">
                    <section class="login-form">
                        <form method="post" action="#" role="login">
                            <div id="js-login-error">
                            </div>
                            <img src="/static/favicon/favicon-128.png" class="img-responsive" alt="" />
                            <div>
                              <a href="/login/register/{$redirect}">Create account</a> or <a href="#">reset password</a>
                            </div>
                            <div class="form-group">
                                {$this->leaves['username']}
                            </div>
                            <div class="form-group">
                                {$this->leaves['password']}
                            </div>
                            <div class="form-group">
                                <label>
                                    {$this->leaves['rememberMe']}&nbsp;Remember Me
                                </label>
                            </div>
                            <div>
                                {$this->leaves['Login']}
                            </div>
                        </form>
                    </section>  
                </div>
            </div>
HTML;

        if ($this->model->failed) {
            $notification = new NotificationPrint('<b>Username</b> or <b>Password</b> is incorrect. <br>Please try again!', NotificationPrint::DANGER, 'js-login-error');
            $notification->setTimeout(0);
            print $notification;
        }
    }
}
