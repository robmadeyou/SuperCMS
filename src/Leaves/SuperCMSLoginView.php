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
    }

    public function printViewContent()
    {
        print <<<HTML
        <div id="login-container" class=" row">
            <div class="col-md-4 col-md-offset-4">
                <form class="form-horizontal">
                  <div class="form-group">
                    <label for="inputEmail3" class="col-sm-4 control-label">Email</label>
                    <div class="col-sm-8">
                      {$this->leaves['username']}
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputPassword3" class="col-sm-4 control-label">Password</label>
                    <div class="col-sm-8">
                      {$this->leaves['password']}
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-sm-offset-4 col-sm-10">
                      <div class="checkbox">
                        <label>
                          <input type="checkbox"> Remember me
                        </label>
                      </div>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-sm-offset-4 col-sm-10">
                      {$this->leaves['Login']}
                    </div>
                  </div>
                </form>
            </div>
        </div>
HTML;
    }
}
