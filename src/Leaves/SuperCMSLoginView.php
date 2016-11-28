<?php

namespace SuperCMS\Leaves;

use Rhubarb\Scaffolds\Authentication\Leaves\LoginView;

class SuperCMSLoginView extends LoginView
{
    public function createSubLeaves()
    {
        parent::createSubLeaves();

        $this->leaves['username']->addCssClassNames('form-control');
        $this->leaves['password']->addCssClassNames('form-control');
        $this->leaves['Login']->addCssClassNames('btn btn-default');

        $this->leaves['username']->addHtmlAttribute('placeholder', 'Username');
    }

    public function printViewContent()
    {
        print <<<HTML
        <div id="login-container" class=" row">
            <div class="col-md-4 col-md-offset-4">
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
HTML;
    }
}
