<?php

namespace OhSeeSoftware\LaravelSchemaList\Schemas;

use Illuminate\Database\ConnectionInterface;
use LogicException;

abstract class Schema
{
    /** @var \Illuminate\Database\ConnectionInterface */
    protected $connection;

    public function __construct(ConnectionInterface $connection)
    {
        $this->connection = $connection;
    }

    public function getTables(): array
    {
        throw new LogicException('This database driver does not support listing schema tables.');
    }

    public function getColumns(string $table): array
    {
        throw new LogicException('This database driver does not support listing columns of a table.');
    }
}
