<?php

namespace SuperCMS\Leaves;

use Rhubarb\Crown\Request\Request;
use Rhubarb\Scaffolds\Authentication\Leaves\LoginView;
use SuperCMS\Settings\SuperCmsPageSettings;

class SuperCMSLoginView extends LoginView
{
    public function createSubLeaves()
    {
        parent::createSubLeaves();

        $this->leaves['username']->addCssClassNames('form-control');
        $this->leaves['password']->addCssClassNames('form-control');
        $this->leaves['Login']->addCssClassNames('btn btn-default');

        $this->leaves['username']->addHtmlAttribute('placeholder', 'Username');

        $settings = SuperCmsPageSettings::singleton();
        $settings->hideBanner = true;
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
                            <img src="/static/favicon/favicon-128.png" class="img-responsive" alt="" />
                            <div class="form-group">
                                {$this->leaves['username']}
                            </div>
                            <div class="form-group">
                                {$this->leaves['password']}
                            </div>
                            <label>
                                {$this->leaves['rememberMe']}Remember Me
                            </label>
                            <div>
                                {$this->leaves['Login']}
                            </div>
                            <div>
                              <a href="/login/register/{$redirect}">Create account</a> or <a href="#">reset password</a>
                            </div>
                        </form>
                    </section>  
                </div>
            </div>
HTML;
    }
}
