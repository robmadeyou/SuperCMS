<?php

namespace SuperCMS\Leaves\Admin\Login;

use Rhubarb\Scaffolds\Authentication\Leaves\LoginView;

class AdminLoginView extends LoginView
{
    public function createSubLeaves()
    {
        parent::createSubLeaves();

        $this->leaves['username']->addCssClassNames('form-control');
        $this->leaves['password']->addCssClassNames('form-control');
        $this->leaves['Login']->addCssClassNames('btn btn-lg btn-success btn-block');
    }

    public function printViewContent()
    {
        print <<<HTML
        <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Please Sign In</h3>
                    </div>
                    <div class="panel-body">
                        <form role="form">
                            <fieldset>
                                <div class="form-group">
                                    {$this->leaves['username']}
                                </div>
                                <div class="form-group">
                                    {$this->leaves['password']}
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input name="remember" type="checkbox" value="Remember Me">Remember Me
                                    </label>
                                </div>
                                {$this->leaves['Login']}
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
HTML;

    }
}