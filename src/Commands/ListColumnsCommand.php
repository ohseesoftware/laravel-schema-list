<?php

namespace Ohseesoftware\LaravelSchemaList\Commands;

use Illuminate\Console\Command;
use Illuminate\Database\ConnectionResolverInterface;
use Illuminate\Database\MySqlConnection;

class ListColumnsCommand extends Command
{
    /** @var string */
    protected $signature = 'schema:columns {table}';

    /** @var string */
    protected $description = 'Lists the columns in the given table.';

    public function handle(ConnectionResolverInterface $connections)
    {
        $connection = $connections->connection();

        $headers = ['Field', 'Type', 'Nullable', 'Key', 'Default Value', 'Extra'];
        $rows = [];

        if ($connection instanceof MySqlConnection) {
            $output = $connection->select("DESCRIBE {$this->argument('table')}");

            $rows = collect($output)->map(function ($value) {
                return array_values((array) $value);
            })->toArray();
        }

        $this->table($headers, $rows);
    }
}
