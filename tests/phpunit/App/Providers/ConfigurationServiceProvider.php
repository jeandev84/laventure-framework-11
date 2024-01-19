<?php
declare(strict_types=1);

namespace PHPUnitTest\App\Providers;

use Laventure\Component\Container\Container;
use Laventure\Component\Container\Provider\ServiceProvider;
use PHPUnitTest\App\Service\Config;

/**
 * ConfigurationServiceProvider
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  PHPUnitTest\App\Providers
 */
class ConfigurationServiceProvider extends ServiceProvider
{

    /**
     * @inheritDoc
    */
    public function register(): void
    {
        $this->app->singleton(Config::class, function (Container $app) {

        });
    }
}