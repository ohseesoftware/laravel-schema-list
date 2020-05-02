<?php

namespace OhSeeSoftware\LaravelSchemaList\Commands;

use Illuminate\Console\Command;
use Illuminate\Database\ConnectionResolverInterface;
use OhSeeSoftware\LaravelSchemaList\Schemas\SchemaContract;

class ListTablesCommand extends Command
{
    /** @var string */
    protected $signature = 'schema:tables';

    /** @var string */
    protected $description = 'Lists the tables in the default database.';

    public function handle(ConnectionResolverInterface $connections, SchemaContract $schema)
    {
        $headers = ['Tables'];
        $rows = $schema->getTables($connections->connection());

        $this->table($headers, $rows);
    }
}
