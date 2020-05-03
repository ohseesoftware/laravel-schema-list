<?php

namespace OhSeeSoftware\LaravelSchemaList\Commands;

use Illuminate\Console\Command;
use OhSeeSoftware\LaravelSchemaList\Schemas\Schema;

class ListColumnsCommand extends Command
{
    /** @var string */
    protected $signature = 'schema:columns {table}';

    /** @var string */
    protected $description = 'Lists the columns in the given table.';

    public function handle(Schema $schema)
    {
        $headers = ['Field', 'Type', 'Nullable', 'Key', 'Default Value', 'Extra'];
        $rows = $schema->getColumns($this->argument('table'));

        $this->table($headers, $rows);
    }
}
