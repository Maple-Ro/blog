<?php
/**
 * Created by PhpStorm.
 * User: stanley
 * Date: 2017/4/18 0018
 * Time: 21:23
 */

namespace App\Providers;


use App\Model\Security\EndlessCrypt;
use Illuminate\Support\ServiceProvider;

/**
 * 使用SHA256实现的一个HASH加密服务
 * Class Sha256HashServiceProvider
 * @package App\Providers
 */
class Sha256HashServiceProvider extends ServiceProvider
{
    /**
     * Indicates if loading of the provider is deferred.
     *
     * @var bool
     */
    protected $defer = true;

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('hash', function () {
            return new EndlessCrypt;
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['hash'];
    }
}