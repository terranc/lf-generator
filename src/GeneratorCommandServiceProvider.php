<?php

namespace Lookfeel\Boilerplate;

use Illuminate\Support\ServiceProvider;
use Lookfeel\Boilerplate\Commands\AppModelCommand;
use Lookfeel\Boilerplate\Commands\AppScopeCommand;
use Lookfeel\Boilerplate\Commands\AppAttributeCommand;
use Lookfeel\Boilerplate\Commands\AppRepositoryCommand;
use Lookfeel\Boilerplate\Commands\AppRelationshipCommand;
use Lookfeel\Boilerplate\Commands\AppServiceCommand;

class GeneratorCommandServiceProvider extends ServiceProvider
{

    /**
     * Bootstrap the application services.
     *
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->registerGeneratorCommands();
        }
    }

    /**
     * Register the application services.
     */
    public function register()
    {
        //
    }

    /**
     * Register console commands.
     */
    protected function registerGeneratorCommands()
    {
        $this->commands([
            AppModelCommand::class,
            AppScopeCommand::class,
            AppAttributeCommand::class,
            AppRepositoryCommand::class,
            AppRelationshipCommand::class,
            AppServiceCommand::class,
        ]);
    }
}
