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
        $headers = ['Tables', 'Columns'];
        $rows = $schema->getTables($connections->connection());

        $rows = collect($rows)
            ->map(function ($row) use ($connections, $schema) {
                return array_merge($row, [count($schema->getColumns($connections->connection(), $row[0]))]);
            })->toArray();
        $this->table($headers, $rows);
    }
}
