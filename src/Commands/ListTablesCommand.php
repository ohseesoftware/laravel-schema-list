<?php

namespace OhSeeSoftware\LaravelSchemaList\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use OhSeeSoftware\LaravelSchemaList\Schemas\SchemaContract;

class ListTablesCommand extends Command
{
    /** @var string */
    protected $signature = 'schema:tables';

    /** @var string */
    protected $description = 'Lists the tables in the default database.';

    public function handle(SchemaContract $schema)
    {
        $headers = ['Tables', 'Columns', 'Rows'];
        $rows = $schema->getTables();

        $rows = collect($rows)
            ->map(function ($row) use ($schema) {
                return array_merge($row, [
                    count($schema->getColumns($row[0])),
                    DB::table($row[0])->count(),
                ]);
            })->toArray();

        $this->table($headers, $rows);
    }
}
