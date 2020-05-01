<?php

namespace Ohseesoftware\LaravelSchemaList\Schemas;

use Illuminate\Database\ConnectionInterface;
use Illuminate\Support\Facades\DB;

class MySQLSchema implements SchemaContract
{
    public function getTables(ConnectionInterface $connection): array
    {
        $output = $connection->select(DB::raw('SHOW TABLES'));

        return collect($output)->values()->map(function ($value) {
            return array_values((array)$value);
        })->toArray();
    }

    public function getColumns(ConnectionInterface $connection, string $table): array
    {
        $output = $connection->select("DESCRIBE {$table}");

        return collect($output)->map(function ($value) {
            return array_values((array) $value);
        })->toArray();
    }
}
