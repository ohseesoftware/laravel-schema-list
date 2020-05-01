<?php

namespace Ohseesoftware\LaravelSchemaList;

use Illuminate\Support\ServiceProvider;
use Ohseesoftware\LaravelSchemaList\Commands\ListColumnsCommand;
use Ohseesoftware\LaravelSchemaList\Commands\ListTablesCommand;

class LaravelSchemaListServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->app->bind('schema.list:tables', ListTablesCommand::class);
            $this->app->bind('schema.list:columns', ListColumnsCommand::class);

            $this->commands([
                'schema.list:tables',
                'schema.list:columns'
            ]);
        }
    }
}
