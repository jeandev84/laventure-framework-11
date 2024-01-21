<?php
declare(strict_types=1);

namespace PHPUnitTest\App\Provider;

use Laventure\Component\Container\Provider\ServiceProvider;
use PHPUnitTest\App\Config\ConfigService;
use PHPUnitTest\App\Config\ConfigServiceInterface;

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

    protected array $provides = [
        ConfigService::class => [
            'config.php',
            ConfigServiceInterface::class
        ]
    ];


    /**
     * @inheritDoc
     */
    public function register(): void
    {
        $this->app->singleton(ConfigService::class, function () {
            return $this->app->make(ConfigService::class, ['env' => $_ENV]);
        });
    }
}