<?php

namespace SuperCMS;

use Rhubarb\Crown\Application;
use Rhubarb\Crown\Encryption\HashProvider;
use Rhubarb\Crown\Encryption\Sha512HashProvider;
use Rhubarb\Crown\Layout\LayoutModule;
use Rhubarb\Crown\LoginProviders\LoginProvider;
use Rhubarb\Crown\UrlHandlers\ClassMappedUrlHandler;
use Rhubarb\Leaf\LeafModule;
use Rhubarb\Scaffolds\Authentication\Leaves\LoginView;
use Rhubarb\Scaffolds\AuthenticationWithRoles\AuthenticationWithRolesModule;
use Rhubarb\Scaffolds\NavigationMenu\NavigationMenuModule;
use Rhubarb\Stem\Custard\SeedDemoDataCommand;
use Rhubarb\Stem\Repositories\MySql\MySql;
use Rhubarb\Stem\Repositories\Repository;
use Rhubarb\Stem\Schema\SolutionSchema;
use Rhubarb\Stem\StemModule;
use SuperCMS\Custard\ApplicationDemoDataSeeder;
use SuperCMS\Layouts\DefaultLayout;
use SuperCMS\Leaves\Admin\AdminIndex;
use SuperCMS\Leaves\Admin\AdminIndexView;
use SuperCMS\Leaves\Index;
use SuperCMS\Leaves\SuperCMSLoginView;
use SuperCMS\LoginProviders\SCmsLoginProvider;
use SuperCMS\Models\SCmsSolutionSchema;
use SuperCMS\UrlHandlers\AdminClassMappedUrlHandler;

/**
 * Class SuperCMS
 * @package SuperCMS
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects)
 */
class SuperCMS extends Application
{
    protected function initialise()
    {
        parent::initialise();

        if (file_exists(APPLICATION_ROOT_DIR . "/settings/site.config.php")) {
            include_once(APPLICATION_ROOT_DIR . "/settings/site.config.php");
        }

        $this->developerMode = true;

        Repository::setDefaultRepositoryClassName(MySql::class);

        SolutionSchema::registerSchema('CmsDatabase', SCmsSolutionSchema::class);

        LoginProvider::setProviderClassName(SCmsLoginProvider::class);

        HashProvider::setProviderClassName(Sha512HashProvider::class);

        $this->container()->registerClass(LoginView::class, SuperCMSLoginView::class);
    }

    protected function registerUrlHandlers()
    {
        parent::registerUrlHandlers();

        $this->addUrlHandlers(
            [
                "/" => new ClassMappedUrlHandler(Index::class, [
                    'admin/' => new AdminClassMappedUrlHandler(AdminIndex::class)
                ])
            ]
        );
    }

    protected function getModules()
    {
        return [
            new LayoutModule(DefaultLayout::class),
            new StemModule(),
            new AuthenticationWithRolesModule(SCmsLoginProvider::class, '/admin/'),
            new LeafModule(),
            new NavigationMenuModule()
        ];
    }

    public function getCustardCommands()
    {
        SeedDemoDataCommand::registerDemoDataSeeder(new ApplicationDemoDataSeeder());

        return parent::getCustardCommands();
    }
}
