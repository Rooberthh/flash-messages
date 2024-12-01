<?php

namespace Rooberthh\FlashMessage\Tests;

use Illuminate\Foundation\Application;
use Orchestra\Testbench\TestCase;
use Rooberthh\FlashMessage\Infrastructure\Providers\FlashMessageServiceProvider;

abstract class FlashMessageTestCase extends TestCase
{
    protected function getPackageProviders($app): array
    {
        return [FlashMessageServiceProvider::class];
    }

    /**
     * Define environment setup.
     *
     * @param  Application  $app
     * @return void
     */
    protected function getEnvironmentSetUp($app)
    {
        $app['config']->set('database.default', 'testbench');
        $app['config']->set('database.connections.testbench', [
            'driver'   => 'sqlite',
            'database' => ':memory:',
            'prefix'   => '',
        ]);
    }
}
