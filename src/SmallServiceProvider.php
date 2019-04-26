<?php
/**
 * Created by PhpStorm.
 * User: hl
 * Date: 2019/4/26
 * Time: 15:08
 */

namespace Ganodermaking\SmallProgram;

class SmallServiceProvider
{
    /**
     * 在注册后进行服务的启动。
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../config/small.php' => config_path('small.php'),
        ]);
    }

    /**
     * 在容器中注册绑定
     *
     * @return void
     */
    public function register() {
        $this->mergeConfigFrom(
            __DIR__ . '/../config/small.php', 'small'
        );
        $this->app->singleton('small', function ($app) {
            $config = $app->make('small');
            new SmallService($config);
        });
    }

    public function provides()
    {
        return ['small'];
    }
}