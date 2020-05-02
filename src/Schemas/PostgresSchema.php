<?php

namespace OhSeeSoftware\LaravelSchemaList\Schemas;

use Illuminate\Support\Facades\DB;

class PostgresSchema extends Schema
{
    public function getTables(): array
    {
        $output = $this->connection->table('pg_catalog.pg_tables')
                             ->select('tablename')
                             ->whereNotIn('schemaname', ['pg_catalog', 'information_schema'])
                             ->get();

        return array_map(function ($value) {
            return array_values((array) $value);
        }, $output);
    }

    public function getColumns(string $table): array
    {
        $output = $this->connection->table('information_schema.columns', 'c')
                             ->select(['c.column_name as Field', 'c.data_type as Type', 'c.is_nullable as Nullable', 'tc.constraint_type as Key', 'c.column_default as "Default Value"', 'c.ordinal_position'])
                             ->join('information_schema.key_column_usage AS kcu', 'kcu.column_name', '=', 'c.column_name', 'full')
                             ->leftJoin('information_schema.table_constraints AS tc', 'tc.constraint_name', '=', 'kcu.constraint_name')
                             ->where('c.table_name', $table)
                             ->orderBy('c.ordinal_position', 'asc')
                             ->distinct()
                             ->get();

        return array_map(function ($value) {
            unset($value->ordinal_position);
            return array_values((array) $value);
        }, $output);
    }
}
