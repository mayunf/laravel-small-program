<?php
/**
 * Created by PhpStorm.
 * User: hl
 * Date: 2019/4/26
 * Time: 15:08
 */

namespace Ganodermaking\LaravelSmallProgram;

use Illuminate\Support\ServiceProvider;

class SmallProgramServiceProvider extends ServiceProvider
{
    /**
     * 在注册后进行服务的启动。
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__ . '/../config/small-program.php' => config_path('small-program.php'),
        ]);
    }

    /**
     * 在容器中注册绑定
     *
     * @return void
     */
    public function register() {
        $this->mergeConfigFrom(
            __DIR__ . '/../config/small-program.php', 'small-program'
        );
        $this->app->singleton('small-program', function () {
            return new SmallProgramService(config('small-program'));
        });
    }
}