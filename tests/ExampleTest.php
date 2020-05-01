<?php

namespace Ohseesoftware\LaravelSchemaList\Tests;

use Orchestra\Testbench\TestCase;
use Ohseesoftware\LaravelSchemaList\LaravelSchemaListServiceProvider;

class ExampleTest extends TestCase
{

    protected function getPackageProviders($app)
    {
        return [LaravelSchemaListServiceProvider::class];
    }
    
    /** @test */
    public function true_is_true()
    {
        $this->assertTrue(true);
    }
}
