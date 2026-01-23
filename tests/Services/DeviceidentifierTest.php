<?php

namespace Tests\Services;

use Camara\Client;
use Camara\Deviceidentifier\DeviceidentifierGetIdentifierResponse;
use Camara\Deviceidentifier\DeviceidentifierGetPpidResponse;
use Camara\Deviceidentifier\DeviceidentifierGetTypeResponse;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Tests\UnsupportedMockTests;

/**
 * @internal
 */
#[CoversNothing]
final class DeviceidentifierTest extends TestCase
{
    protected Client $client;

    protected function setUp(): void
    {
        parent::setUp();

        $testUrl = getenv('TEST_API_BASE_URL') ?: 'http://127.0.0.1:4010';
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
    public function testRetrieveIdentifier(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $result = $this->client->deviceidentifier->retrieveIdentifier();

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(
            DeviceidentifierGetIdentifierResponse::class,
            $result
        );
    }

    #[Test]
    public function testRetrievePpid(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $result = $this->client->deviceidentifier->retrievePpid();

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(DeviceidentifierGetPpidResponse::class, $result);
    }

    #[Test]
    public function testRetrieveType(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $result = $this->client->deviceidentifier->retrieveType();

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(DeviceidentifierGetTypeResponse::class, $result);
    }
}
