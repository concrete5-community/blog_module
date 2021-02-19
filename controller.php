<?php

namespace Concrete\Package\BlogModule;

use A3020\BlogModule\Installer\Installer;
use A3020\BlogModule\Installer\Uninstaller;
use A3020\BlogModule\Provider\ServiceProvider;
use Concrete\Core\Package\Package;

final class Controller extends Package
{
    protected $pkgHandle = 'blog_module';
    protected $appVersionRequired = '8.0';
    protected $pkgVersion = '1.1.2';
    protected $pkgAutoloaderRegistries = [
        'src/BlogModule' => '\A3020\BlogModule',
    ];

    public function getPackageName()
    {
        return t('Blog Module');
    }

    public function getPackageDescription()
    {
        return t('Quickly set up a blog section.');
    }

    public function on_start()
    {
        $provider = $this->app->make(ServiceProvider::class);
        $provider->register();
    }

    /**
     * @return void
     *
     * @throws \Exception
     */
    public function install()
    {
        parent::install();

        /** @var Installer $installer */
        $installer = $this->app->make(Installer::class);
        $installer->install();
    }

    public function uninstall()
    {
        /** @var Uninstaller $installer */
        $installer = $this->app->make(Uninstaller::class);
        $installer->uninstall();

        parent::uninstall();
    }
}
