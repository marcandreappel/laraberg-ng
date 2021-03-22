<?php

namespace MarcAndreAppel\LarabergNG\Test;

use Illuminate\Foundation\Application;
use MarcAndreAppel\LarabergNG\LarabergNGServiceProvider;
use Orchestra\Testbench\Testcase as OrchestraTestCase;

class TestCase extends OrchestraTestCase
{
    /**
     * Load package service provider
     * @param  Application $app
     * @return MarcAndreAppel\LarabergNG\LarabergServiceProvider
     */
    protected function getPackageProviders($app)
    {
        return [LarabergNGServiceProvider::class];
    }
}

