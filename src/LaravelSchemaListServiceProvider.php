<?php

namespace Ohseesoftware\LaravelSchemaList;

use Exception;
use Illuminate\Database\ConnectionInterface;
use Illuminate\Database\MySqlConnection;
use Illuminate\Support\ServiceProvider;
use Ohseesoftware\LaravelSchemaList\Commands\ListColumnsCommand;
use Ohseesoftware\LaravelSchemaList\Commands\ListTablesCommand;
use Ohseesoftware\LaravelSchemaList\Schemas\MySQLSchema;
use Ohseesoftware\LaravelSchemaList\Schemas\SchemaContract;

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

            $this->app->bind(SchemaContract::class, function () {
                $connection = resolve(ConnectionInterface::class);
                if ($connection instanceof MySqlConnection) {
                    return new MySQLSchema;
                }
                
                throw new Exception('Connection type is not supported!');
            });
        }
    }
}
