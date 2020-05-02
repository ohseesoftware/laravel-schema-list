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
        $headers = ['Tables'];
        $rows = $schema->getTables();

        $this->table($headers, $rows);
    }
}
