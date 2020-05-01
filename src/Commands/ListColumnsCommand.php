<?php

namespace Ohseesoftware\LaravelSchemaList\Commands;

use Illuminate\Console\Command;
use Illuminate\Database\ConnectionResolverInterface;
use Ohseesoftware\LaravelSchemaList\Schemas\SchemaContract;

class ListColumnsCommand extends Command
{
    /** @var string */
    protected $signature = 'schema:columns {table}';

    /** @var string */
    protected $description = 'Lists the columns in the given table.';

    public function handle(ConnectionResolverInterface $connections, SchemaContract $schema)
    {
        $headers = ['Field', 'Type', 'Nullable', 'Key', 'Default Value', 'Extra'];
        $rows = $schema->getColumns($connections->connection(), $this->argument('table'));

        $this->table($headers, $rows);
    }
}
