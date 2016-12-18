<?php

namespace SuperCMS\Custard;

use Rhubarb\Stem\Custard\DemoDataSeederInterface;
use SuperCMS\Models\User\SuperCMSUser;
use Symfony\Component\Console\Output\OutputInterface;

class ApplicationDemoDataSeeder implements DemoDataSeederInterface
{

    protected static $roleUser;
    protected static $roleAdmin;

    public function seedData(OutputInterface $output)
    {
        $this->createRoles();
        $this->createUsers();
    }

    public function createRoles()
    {
    }

    public function createUsers()
    {
        $admin = new SuperCMSUser();
        $admin->Forename = 'admin';
        $admin->Email = 'admin@test.com';
        $admin->Username = 'admin@test.com';
        $admin->Enabled = true;
        $admin->RoleID = 2;
        $admin->setNewPassword('test');
        $admin->save();
    }
}
