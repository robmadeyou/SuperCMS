<?php

namespace SuperCMS\Custard;

use Rhubarb\Scaffolds\AuthenticationWithRoles\Role;
use Rhubarb\Stem\Custard\DemoDataSeederInterface;
use SuperCMS\Models\User\CmsUser;
use Symfony\Component\Console\Output\OutputInterface;

class ApplicationDemoDataSeeder implements DemoDataSeederInterface
{

    protected static $ROLE_USER;
    protected static $ROLE_ADMIN;

    public function seedData(OutputInterface $output)
    {
        $this->createRoles();
        $this->createUsers();
    }

    public function createRoles()
    {
        $role = self::$ROLE_USER = new Role();
        $role->RoleName = 'User';
        $role->save();

        $role = self::$ROLE_ADMIN = new Role();
        $role->RoleName = 'Admin';
        $role->save();
    }

    public function createUsers()
    {
        $admin = new CmsUser();
        $admin->Forename = 'admin';
        $admin->Email = 'admin@test.com';
        $admin->Username = 'admin@test.com';
        $admin->Enabled = true;
        $admin->setNewPassword('test');
        $admin->addToRole(self::$ROLE_ADMIN);
        $admin->save();
    }
}
