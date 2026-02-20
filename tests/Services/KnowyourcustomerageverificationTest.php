<?php

namespace Tests\Services;

use Camara\Client;
use Camara\Core\Util;
use Camara\Knowyourcustomerageverification\KnowyourcustomerageverificationVerifyResponse;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Tests\UnsupportedMockTests;

/**
 * @internal
 */
#[CoversNothing]
final class KnowyourcustomerageverificationTest extends TestCase
{
    protected Client $client;

    protected function setUp(): void
    {
        parent::setUp();

        $testUrl = Util::getenv('TEST_API_BASE_URL') ?: 'http://127.0.0.1:4010';
        $client = new Client(
            deviceLocationNotificationsAPIKey: 'My Device Location Notifications API Key',
            notificationsAPIKey: 'My Notifications API Key',
            populationDensityDataNotificationsAPIKey: 'My Population Density Data Notifications API Key',
            regionDeviceCountNotificationsAPIKey: 'My Region Device Count Notifications API Key',
            connectivityInsightsNotificationsAPIKey: 'My Connectivity Insights Notifications API Key',
            simSwapNotificationsAPIKey: 'My Sim Swap Notifications API Key',
            deviceRoamingStatusNotificationsAPIKey: 'My Device Roaming Status Notifications API Key',
            deviceReachabilityStatusNotificationsAPIKey: 'My Device Reachability Status Notifications API Key',
            connectedNetworkTypeNotificationsAPIKey: 'My Connected Network Type Notifications API Key',
            baseUrl: $testUrl,
        );

        $this->client = $client;
    }

    #[Test]
    public function testVerify(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->knowyourcustomerageverification->verify(
            ageThreshold: 18
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(
            KnowyourcustomerageverificationVerifyResponse::class,
            $result
        );
    }

    #[Test]
    public function testVerifyWithOptionalParams(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->knowyourcustomerageverification->verify(
            ageThreshold: 18,
            birthdate: '1978-08-22',
            email: 'federicaSanchez.Arjona@example.com',
            familyName: 'Sanchez Arjona',
            familyNameAtBirth: 'YYYY',
            givenName: 'Federica',
            idDocument: '66666666q',
            includeContentLock: true,
            includeParentalControl: true,
            middleNames: 'Sanchez',
            name: 'Federica Sanchez Arjona',
            phoneNumber: '+34629255833',
            xCorrelator: 'b4333c46-49c0-4f62-80d7-f0ef930f1c46',
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(
            KnowyourcustomerageverificationVerifyResponse::class,
            $result
        );
    }
}
