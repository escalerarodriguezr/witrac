<?php
declare(strict_types=1);

namespace PHPUnit\Tests\Acceptance;

use Symfony\Bundle\FrameworkBundle\KernelBrowser;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class AcceptanceTestBase extends WebTestCase
{
    public function setUp():void
    {
        parent::setUp();
    }

    protected function getBaseClient(): KernelBrowser
    {
        $baseClient = static::createClient();
        $baseClient->setServerParameters([
            'CONTENT_TYPE' => 'application/json',
            'HTTP_ACCEPT' => 'application/json',
        ]);

        return $baseClient;
    }

}