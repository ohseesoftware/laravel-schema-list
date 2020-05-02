<?php

namespace OhSeeSoftware\LaravelSchemaList\Schemas;

interface SchemaContract
{
    public function getTables(): array;

    public function getColumns(string $table): array;
}
