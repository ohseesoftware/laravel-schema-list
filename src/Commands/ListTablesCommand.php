<?php

namespace Ohseesoftware\LaravelSchemaList\Commands;

use Illuminate\Console\Command;
use Illuminate\Database\ConnectionResolverInterface;
use Illuminate\Database\MySqlConnection;
use Illuminate\Support\Facades\DB;

class ListTablesCommand extends Command
{
    /** @var string */
    protected $signature = 'schema:tables';

    /** @var string */
    protected $description = 'Lists the tables in the default database.';

    public function handle(ConnectionResolverInterface $connections)
    {
        $connection = $connections->connection();

        $headers = ['Tables'];
        $rows = [];

        if ($connection instanceof MySqlConnection) {
            $output = $connection->select(DB::raw('SHOW TABLES'));

            $rows = collect($output)->values()->map(function ($value) {
                return array_values((array)$value);
            })->toArray();
        }

        $this->table($headers, $rows);
    }
}
