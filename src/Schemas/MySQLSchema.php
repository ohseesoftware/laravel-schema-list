<?php

namespace OhSeeSoftware\LaravelSchemaList\Schemas;

use Illuminate\Database\ConnectionInterface;
use Illuminate\Support\Facades\DB;

class MySQLSchema extends Schema
{
    public function getTables(): array
    {
        $output = $this->connection->select(DB::raw('SHOW TABLES'));

        return collect($output)->values()->map(function ($value) {
            return array_values((array)$value);
        })->toArray();
    }

    public function getColumns(string $table): array
    {
        $output = $this->connection->select("DESCRIBE {$table}");

        return collect($output)->map(function ($value) {
            return array_values((array) $value);
        })->toArray();
    }
}
