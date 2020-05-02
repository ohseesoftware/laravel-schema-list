<?php

namespace OhSeeSoftware\LaravelSchemaList\Commands;

use Illuminate\Console\Command;
use OhSeeSoftware\LaravelSchemaList\Schemas\SchemaContract;

class ListTablesCommand extends Command
{
    /** @var string */
    protected $signature = 'schema:tables';

    /** @var string */
    protected $description = 'Lists the tables in the default database.';

    public function handle(SchemaContract $schema)
    {
        $headers = ['Tables', 'Columns'];
        $rows = $schema->getTables();

        $rows = collect($rows)
            ->map(function ($row) use ($schema) {
                return array_merge($row, [count($schema->getColumns($row[0]))]);
            })->toArray();

        $this->table($headers, $rows);
    }
}
