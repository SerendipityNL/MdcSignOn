<?php

namespace DALTCORE\MdcSignOn\Tests;

use DALTCORE\MdcSignOn\Facades\MdcSignOn;
use DALTCORE\MdcSignOn\ServiceProvider;
use Orchestra\Testbench\TestCase;

class MdcSignOnTest extends TestCase
{
    protected function getPackageProviders($app)
    {
        return [ServiceProvider::class];
    }

    protected function getPackageAliases($app)
    {
        return [
            'mdc-sign-on' => MdcSignOn::class,
        ];
    }

    public function testExample()
    {
        assertEquals(1, 1);
    }
}
