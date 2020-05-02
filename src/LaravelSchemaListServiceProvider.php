<?php

namespace OhSeeSoftware\LaravelSchemaList;

use Exception;
use Illuminate\Database\ConnectionInterface;
use Illuminate\Database\MySqlConnection;
use Illuminate\Database\PostgresConnection;
use Illuminate\Support\ServiceProvider;
use OhSeeSoftware\LaravelSchemaList\Commands\ListColumnsCommand;
use OhSeeSoftware\LaravelSchemaList\Commands\ListTablesCommand;
use OhSeeSoftware\LaravelSchemaList\Schemas\MySQLSchema;
use OhSeeSoftware\LaravelSchemaList\Schemas\PostgresSchema;
use OhSeeSoftware\LaravelSchemaList\Schemas\SchemaContract;
use OhSeeSoftware\LaravelSchemaList\Schemas\UnsupportedSchema;

class LaravelSchemaListServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     */
    public function boot()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                ListTablesCommand::class,
                ListColumnsCommand::class
            ]);

            $this->app->bind(SchemaContract::class, function () {
                $connection = resolve(ConnectionInterface::class);

                if ($connection instanceof MySqlConnection) {
                    return new MySQLSchema($connection);
                } elseif ($connection instanceof PostgresConnection) {
                    return new PostgresSchema($connection);
                }

                return new UnsupportedSchema($connection);
            });
        }
    }
}
