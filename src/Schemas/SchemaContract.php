<?php

namespace Ohseesoftware\LaravelSchemaList\Schemas;

use Illuminate\Database\ConnectionInterface;

interface SchemaContract
{
    public function getTables(ConnectionInterface $connection): array;

    public function getColumns(ConnectionInterface $connection, string $table): array;
}
