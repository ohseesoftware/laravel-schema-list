<?php

namespace OhSeeSoftware\LaravelSchemaList\Schemas;

use Illuminate\Support\Facades\DB;

class MySQLSchema extends Schema
{
    public function getTables(): array
    {
        $output = $this->connection->select(DB::raw('SHOW TABLES'));

        return array_map(function ($value) {
            return array_values((array) $value);
        }, $output);
    }

    public function getColumns(string $table): array
    {
        $output = $this->connection->select("DESCRIBE {$table}");

        return array_map(function ($value) {
            return array_values((array) $value);
        }, $output);
    }
}
