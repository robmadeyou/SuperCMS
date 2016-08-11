<?php

namespace SuperCMS\Leaves;

use Rhubarb\Scaffolds\Authentication\Leaves\LoginView;

class SuperCMSLoginView extends LoginView
{
    public function printViewContent()
    {
        print <<<HTML
        <form class="form-horizontal">
          <div class="form-group">
            <label for="inputEmail3" class="col-sm-2 control-label">Email</label>
            <div class="col-sm-10">
              {$this->leaves['username']}
            </div>
          </div>
          <div class="form-group">
            <label for="inputPassword3" class="col-sm-2 control-label">Password</label>
            <div class="col-sm-10">
              {$this->leaves['password']}
            </div>
          </div>
          <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
              <div class="checkbox">
                <label>
                  <input type="checkbox"> Remember me
                </label>
              </div>
            </div>
          </div>
          <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
              {$this->leaves['Login']}
            </div>
          </div>
        </form>
HTML;
    }
}
