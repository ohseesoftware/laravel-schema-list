<?php

namespace OhSeeSoftware\LaravelSchemaList\Schemas;

use Illuminate\Database\ConnectionInterface;

interface SchemaContract
{
    public function getTables(): array;

    public function getColumns(string $table): array;
}
