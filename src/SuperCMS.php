<?php

namespace SuperCMS;

use Rhubarb\Crown\DependencyInjection\Container;
use Rhubarb\Crown\Encryption\HashProvider;
use Rhubarb\Crown\Encryption\Sha512HashProvider;
use Rhubarb\Crown\Layout\LayoutModule;
use Rhubarb\Crown\LoginProviders\LoginProvider;
use Rhubarb\Crown\Module;
use Rhubarb\Crown\String\StringTools;
use Rhubarb\Crown\UrlHandlers\ClassMappedUrlHandler;
use Rhubarb\Crown\UrlHandlers\StaticResourceUrlHandler;
use Rhubarb\Leaf\LeafModule;
use Rhubarb\Leaf\Paging\Leaves\EventPagerView;
use Rhubarb\Scaffolds\Authentication\Leaves\Login;
use Rhubarb\Scaffolds\Authentication\Leaves\LoginView;
use Rhubarb\Scaffolds\Authentication\Settings\ProtectedUrl;
use Rhubarb\Scaffolds\AuthenticationWithRoles\AuthenticationWithRolesModule;
use Rhubarb\Stem\Custard\SeedDemoDataCommand;
use Rhubarb\Stem\Repositories\MySql\MySql;
use Rhubarb\Stem\Repositories\Repository;
use Rhubarb\Stem\Schema\SolutionSchema;
use Rhubarb\Stem\StemModule;
use SuperCMS\Controls\GlobalBasket\GlobalBasket;
use SuperCMS\Custard\ApplicationDemoDataSeeder;
use SuperCMS\Layouts\DefaultLayout;
use SuperCMS\Leaves\Admin\AdminIndex;
use SuperCMS\Leaves\Admin\Categories\CategoriesCollection;
use SuperCMS\Leaves\Admin\Coupons\CouponsCollection;
use SuperCMS\Leaves\Admin\Dashboard\AdminDashboard;
use SuperCMS\Leaves\Admin\Login\AdminLogin;
use SuperCMS\Leaves\Admin\Products\ProductsCollection;
use SuperCMS\Leaves\Admin\ShippingType\ShippingTypeCollection;
use SuperCMS\Leaves\Errors\Error403;
use SuperCMS\Leaves\Errors\Error404;
use SuperCMS\Leaves\Index;
use SuperCMS\Leaves\Site\Basket\BasketPage;
use SuperCMS\Leaves\Site\Category\CategoryCollection;
use SuperCMS\Leaves\Site\Checkout\Checkout;
use SuperCMS\Leaves\Site\Product\ProductCollection;
use SuperCMS\Leaves\Site\Search\SearchLeaf;
use SuperCMS\Leaves\SuperCMSLoginView;
use SuperCMS\LoginProviders\AdminLoginProvider;
use SuperCMS\LoginProviders\SCmsLoginProvider;
use SuperCMS\Models\Coupon\Coupon;
use SuperCMS\Models\Product\Category;
use SuperCMS\Models\Product\Product;
use SuperCMS\Models\SCmsSolutionSchema;
use SuperCMS\Models\Shipping\ShippingType;
use SuperCMS\UrlHandlers\AdminClassMappedUrlHandler;
use SuperCMS\UrlHandlers\AdminCrudUrlHandler;
use SuperCMS\UrlHandlers\CategoryUrlHandler;
use SuperCMS\UrlHandlers\ProductUrlHandler;
use SuperCMS\Views\SuperCMSEventPagerView;

/**
 * Class SuperCMS
 * @package SuperCMS
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects)
 */
class SuperCMS extends Module
{
    /**
     * @var Container
     */
    protected $container;
    protected $basketClass = GlobalBasket::class;

    public static $currencySymbol = '&pound;';

    /**
     * @param Container $container
     */
    public function __construct(Container $container)
    {
        parent::__construct();

        $this->container = $container;
    }

    protected function initialise()
    {
        parent::initialise();

        Repository::setDefaultRepositoryClassName(MySql::class);

        SolutionSchema::registerSchema('CmsDatabase', SCmsSolutionSchema::class);

        LoginProvider::setProviderClassName(SCmsLoginProvider::class);

        HashProvider::setProviderClassName(Sha512HashProvider::class);

        $this->container->registerClass(LoginView::class, SuperCMSLoginView::class);
        $this->container->registerClass(EventPagerView::class, SuperCMSEventPagerView::class);
    }

    protected function registerUrlHandlers()
    {

        parent::registerUrlHandlers();

        try {
            new $this->basketClass();
        } catch (\Exception $ex) {
        }

        $staticResources = new StaticResourceUrlHandler(__DIR__ . '/../static/');
        $staticResources->setPriority('100');

        $this->addUrlHandlers(
            [
                "/" => new ClassMappedUrlHandler(Index::class, [
                    'admin/' => new AdminClassMappedUrlHandler(AdminIndex::class, [
                        'dashboard/' => new AdminClassMappedUrlHandler(AdminDashboard::class),
                        'products/' => new AdminCrudUrlHandler(Product::class, StringTools::getNamespaceFromClass(ProductsCollection::class)),
                        'categories/' => new AdminCrudUrlHandler(Category::class, StringTools::getNamespaceFromClass(CategoriesCollection::class)),
                        'shipping-types/' => new AdminCrudUrlHandler(ShippingType::class, StringTools::getNamespaceFromClass(ShippingTypeCollection::class)),
                        'coupons/' => new AdminCrudUrlHandler(Coupon::class, StringTools::getNamespaceFromClass(CouponsCollection::class))
                    ]),
                    'category/' => new CategoryUrlHandler(Category::class, StringTools::getNamespaceFromClass(CategoryCollection::class), [], [
                        'product/' => new ProductUrlHandler(Product::class, StringTools::getNamespaceFromClass(ProductCollection::class))
                    ]),
                    'search/' => new ClassMappedUrlHandler(SearchLeaf::class),
                    'basket/' => new ClassMappedUrlHandler(BasketPage::class),
                    'checkout/' => new ClassMappedUrlHandler(Checkout::class),
                    '404/' => new ClassMappedUrlHandler(Error404::class),
                    '403/' => new ClassMappedUrlHandler(Error403::class)
                ]),
                '/files/' => $staticResources,
            ]
        );
    }

    protected function getModules()
    {
        $auth = new AuthenticationWithRolesModule();

        $adminUrl = new ProtectedUrl('/admin/', AdminLoginProvider::class, '/admin/login/');
        $adminUrl->loginLeafClassName = AdminLogin::class;
        $auth->registerProtectedUrl($adminUrl);

        $userUrl = new ProtectedUrl('/checkout/', SCmsLoginProvider::class, '/login/');
        $userUrl->loginLeafClassName = Login::class;
        $auth->registerProtectedUrl($userUrl);

        return [
            new LayoutModule(DefaultLayout::class),
            new StemModule(),
            $auth,
            new LeafModule(),
        ];
    }

    public function getCustardCommands()
    {
        SeedDemoDataCommand::registerDemoDataSeeder(new ApplicationDemoDataSeeder());

        return parent::getCustardCommands();
    }
}
