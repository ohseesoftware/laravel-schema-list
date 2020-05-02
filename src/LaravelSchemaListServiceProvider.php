<?php

namespace OhSeeSoftware\LaravelSchemaList;

use Exception;
use Illuminate\Database\ConnectionInterface;
use Illuminate\Database\MySqlConnection;
use Illuminate\Support\ServiceProvider;
use OhSeeSoftware\LaravelSchemaList\Commands\ListColumnsCommand;
use OhSeeSoftware\LaravelSchemaList\Commands\ListTablesCommand;
use OhSeeSoftware\LaravelSchemaList\Schemas\MySQLSchema;
use OhSeeSoftware\LaravelSchemaList\Schemas\SchemaContract;

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
                    return new MySQLSchema($connection);
                }
                
                throw new Exception('Connection type is not supported!');
            });
        }
    }
}
