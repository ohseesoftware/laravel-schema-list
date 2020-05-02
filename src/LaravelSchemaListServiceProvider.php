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
    private $connections = [
        MySqlConnection::class    => MySQLSchema::class,
        PostgresConnection::class => PostgresSchema::class,
    ];

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
                $connectionClass = get_class($connection);
                $schema = $this->connections[$connectionClass] ?? UnsupportedSchema::class;
                
                return new $schema($connection);
            });
        }
    }
}
