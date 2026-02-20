<?php

namespace Tests\Services;

use Camara\Client;
use Camara\Core\Util;
use Camara\Populationdensitydata\PopulationdensitydataGetResponse;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Tests\UnsupportedMockTests;

/**
 * @internal
 */
#[CoversNothing]
final class PopulationdensitydataTest extends TestCase
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
    public function testRetrieve(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server doesn\'t support callbacks yet');
        }

        $result = $this->client->populationdensitydata->retrieve(
            area: ['areaType' => 'POLYGON'],
            endTime: new \DateTimeImmutable('2024-04-23T14:44:18.165Z'),
            startTime: new \DateTimeImmutable('2024-04-23T14:44:18.165Z'),
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(PopulationdensitydataGetResponse::class, $result);
    }

    #[Test]
    public function testRetrieveWithOptionalParams(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server doesn\'t support callbacks yet');
        }

        $result = $this->client->populationdensitydata->retrieve(
            area: ['areaType' => 'POLYGON'],
            endTime: new \DateTimeImmutable('2024-04-23T14:44:18.165Z'),
            startTime: new \DateTimeImmutable('2024-04-23T14:44:18.165Z'),
            precision: 7,
            sink: 'https://endpoint.example.com/sink',
            sinkCredential: ['credentialType' => 'PLAIN'],
            xCorrelator: 'b4333c46-49c0-4f62-80d7-f0ef930f1c46',
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(PopulationdensitydataGetResponse::class, $result);
    }
}
