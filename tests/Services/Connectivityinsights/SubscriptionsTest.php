<?php

namespace Tests\Services\Connectivityinsights;

use Camara\Client;
use Camara\Connectivityinsights\Subscriptions\EventType;
use Camara\Connectivityinsights\Subscriptions\Protocol;
use Camara\Connectivityinsights\Subscriptions\Subscription;
use Camara\Connectivityinsights\Subscriptions\SubscriptionDeleteResponse;
use Camara\Core\Util;
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

        $testUrl = Util::getenv('TEST_API_BASE_URL') ?: 'http://127.0.0.1:4010';
        $client = new Client(
            bearerToken: 'My Bearer Token',
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
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->connectivityinsights->subscriptions->create(
            config: [
                'subscriptionDetail' => [
                    'applicationProfileID' => '182bd5e5-6e1a-4fe4-a799-aa6d9a6ab26e',
                    'device' => [],
                ],
            ],
            protocol: Protocol::HTTP,
            sink: 'https://endpoint.example.com/sink',
            types: [
                EventType::ORG_CAMARAPROJECT_CONNECTIVITY_INSIGHTS_SUBSCRIPTIONS_V0_NETWORK_QUALITY,
            ],
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(Subscription::class, $result);
    }

    #[Test]
    public function testCreateWithOptionalParams(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->connectivityinsights->subscriptions->create(
            config: [
                'subscriptionDetail' => [
                    'applicationProfileID' => '182bd5e5-6e1a-4fe4-a799-aa6d9a6ab26e',
                    'device' => [
                        'ipv4Address' => [
                            'privateAddress' => '84.125.93.10',
                            'publicAddress' => '84.125.93.10',
                            'publicPort' => 59765,
                        ],
                        'ipv6Address' => '2001:db8:85a3:8d3:1319:8a2e:370:7344',
                        'networkAccessIdentifier' => '123456789@domain.com',
                        'phoneNumber' => '+123456789',
                    ],
                    'applicationServer' => [
                        'ipv4Address' => '192.168.0.1/24',
                        'ipv6Address' => '2001:db8:85a3:8d3:1319:8a2e:370:7344',
                    ],
                    'applicationServerPorts' => [
                        'ports' => [5060, 5070],
                        'ranges' => [['from' => 5010, 'to' => 5020]],
                    ],
                ],
                'initialEvent' => true,
                'subscriptionExpireTime' => new \DateTimeImmutable(
                    '2023-07-03T12:27:08.312Z'
                ),
                'subscriptionMaxEvents' => 5,
            ],
            protocol: Protocol::HTTP,
            sink: 'https://endpoint.example.com/sink',
            types: [
                EventType::ORG_CAMARAPROJECT_CONNECTIVITY_INSIGHTS_SUBSCRIPTIONS_V0_NETWORK_QUALITY,
            ],
            sinkCredential: ['credentialType' => 'PLAIN'],
            xCorrelator: 'b4333c46-49c0-4f62-80d7-f0ef930f1c46',
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(Subscription::class, $result);
    }

    #[Test]
    public function testRetrieve(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->connectivityinsights->subscriptions->retrieve(
            'qs15-h556-rt89-1298'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(Subscription::class, $result);
    }

    #[Test]
    public function testList(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->connectivityinsights->subscriptions->list();

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertIsList($result);
    }

    #[Test]
    public function testDelete(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->connectivityinsights->subscriptions->delete(
            'qs15-h556-rt89-1298'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(SubscriptionDeleteResponse::class, $result);
    }
}
