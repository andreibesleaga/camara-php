<?php

namespace Tests\Services\Devicelocation;

use Camara\Client;
use Camara\Devicelocation\Subscriptions\DeviceLocationProtocol;
use Camara\Devicelocation\Subscriptions\DeviceLocationSubscription;
use Camara\Devicelocation\Subscriptions\DeviceLocationSubscriptionEventType;
use Camara\Devicelocation\Subscriptions\SubscriptionDeleteResponse;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Tests\UnsupportedMockTests;

/**
 * @internal
 */
#[CoversNothing]
final class SubscriptionsTest extends TestCase
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
    public function testCreate(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism doesn\'t support callbacks yet');
        }

        $result = $this->client->devicelocation->subscriptions->create(
            config: ['subscriptionDetail' => ['area' => ['areaType' => 'CIRCLE']]],
            protocol: DeviceLocationProtocol::HTTP,
            sink: 'https://notificationSendServer12.supertelco.com',
            types: [
                DeviceLocationSubscriptionEventType::ORG_CAMARAPROJECT_GEOFENCING_SUBSCRIPTIONS_V0_AREA_ENTERED,
            ],
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(DeviceLocationSubscription::class, $result);
    }

    #[Test]
    public function testCreateWithOptionalParams(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism doesn\'t support callbacks yet');
        }

        $result = $this->client->devicelocation->subscriptions->create(
            config: [
                'initialEvent' => true,
                'subscriptionExpireTime' => new \DateTimeImmutable(
                    '2024-03-22T05:40:58.469Z'
                ),
                'subscriptionMaxEvents' => 10,
                'subscriptionDetail' => [
                    'area' => ['areaType' => 'CIRCLE'],
                    'device' => [
                        'ipv4Address' => [
                            'privateAddress' => '84.125.93.10',
                            'publicAddress' => '84.125.93.10',
                            'publicPort' => 59765,
                        ],
                        'ipv6Address' => '2001:db8:85a3:8d3:1319:8a2e:370:7344',
                        'networkAccessIdentifier' => '123456789@domain.com',
                        'phoneNumber' => '+12345678912',
                    ],
                ],
            ],
            protocol: DeviceLocationProtocol::HTTP,
            sink: 'https://notificationSendServer12.supertelco.com',
            types: [
                DeviceLocationSubscriptionEventType::ORG_CAMARAPROJECT_GEOFENCING_SUBSCRIPTIONS_V0_AREA_ENTERED,
            ],
            sinkCredential: ['credentialType' => 'PLAIN'],
            xCorrelator: 'b4333c46-49c0-4f62-80d7-f0ef930f1c46',
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(DeviceLocationSubscription::class, $result);
    }

    #[Test]
    public function testRetrieve(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $result = $this->client->devicelocation->subscriptions->retrieve(
            'qs15-h556-rt89-1298'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(DeviceLocationSubscription::class, $result);
    }

    #[Test]
    public function testList(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $result = $this->client->devicelocation->subscriptions->list();

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertIsList($result);
    }

    #[Test]
    public function testDelete(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $result = $this->client->devicelocation->subscriptions->delete(
            'qs15-h556-rt89-1298'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(SubscriptionDeleteResponse::class, $result);
    }
}
