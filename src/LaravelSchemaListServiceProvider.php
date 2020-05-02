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
            $this->app->bind('schema.list:tables', ListTablesCommand::class);
            $this->app->bind('schema.list:columns', ListColumnsCommand::class);

            $this->commands([
                'schema.list:tables',
                'schema.list:columns',
            ]);

            $this->app->bind(SchemaContract::class, function () {
                $connection = resolve(ConnectionInterface::class);

                if (in_array($connectionType = get_class($connection), array_keys($this->connections))) {
                    return new $this->connections[$connectionType];
                }
                throw new Exception('Connection type is not supported!');
            });
        }
    }
}
