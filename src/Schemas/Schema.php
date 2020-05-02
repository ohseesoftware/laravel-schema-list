<?php

namespace OhSeeSoftware\LaravelSchemaList\Schemas;

use Illuminate\Database\ConnectionInterface;
use Illuminate\Support\Facades\DB;
use LogicException;

abstract class Schema implements SchemaContract
{
    /** @var \Illuminate\Database\ConnectionInterface */
    protected $connection;

    public function __construct(ConnectionInterface $connection)
    {
        $this->connection = $connection;
    }

    public function getTables(): array
    {
        throw new LogicException('This database driver does not support getting all tables.');
    }

    public function getColumns(string $table): array
    {
        throw new LogicException('This database driver does not support getting columns of table.');
    }
}
