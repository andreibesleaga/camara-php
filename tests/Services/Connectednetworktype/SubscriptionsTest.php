<?php

namespace Tests\Services\Connectednetworktype;

use Camara\Client;
use Camara\Connectednetworktype\Subscriptions\ConnectedNetworkTypeProtocol;
use Camara\Connectednetworktype\Subscriptions\ConnectedNetworkTypeSubscription;
use Camara\Connectednetworktype\Subscriptions\ConnectedNetworkTypeSubscriptionEventType;
use Camara\Connectednetworktype\Subscriptions\SubscriptionDeleteResponse;
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
            customerInsightsToken: 'My Customer Insights Token',
            deviceSwapToken: 'My Device Swap Token',
            kycAgeVerificationToken: 'My KYC Age Verification Token',
            kycFillInToken: 'My KYC Fill In Token',
            kycMatchToken: 'My KYC Match Token',
            tenureToken: 'My Tenure Token',
            numberRecyclingToken: 'My Number Recycling Token',
            otpValidationToken: 'My Otp Validation Token',
            callForwardingSignalToken: 'My Call Forwarding Signal Token',
            deviceLocationToken: 'My Device Location Token',
            populationDensityDataToken: 'My Population Density Data Token',
            regionDeviceCountToken: 'My Region Device Count Token',
            webRtcToken: 'My Web Rtc Token',
            connectivityInsightsToken: 'My Connectivity Insights Token',
            qualityOnDemandToken: 'My Quality On Demand Token',
            deviceIdentifierToken: 'My Device Identifier Token',
            simSwapToken: 'My Sim Swap Token',
            deviceRoamingStatusToken: 'My Device Roaming Status Token',
            deviceReachabilityStatusToken: 'My Device Reachability Status Token',
            connectedNetworkTypeToken: 'My Connected Network Type Token',
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

        $result = $this->client->connectednetworktype->subscriptions->create(
            config: ['subscriptionDetail' => []],
            protocol: ConnectedNetworkTypeProtocol::HTTP,
            sink: 'https://endpoint.example.com/sink',
            types: [
                ConnectedNetworkTypeSubscriptionEventType::ORG_CAMARAPROJECT_CONNECTED_NETWORK_TYPE_SUBSCRIPTIONS_V0_NETWORK_TYPE_CHANGED,
            ],
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(ConnectedNetworkTypeSubscription::class, $result);
    }

    #[Test]
    public function testCreateWithOptionalParams(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->connectednetworktype->subscriptions->create(
            config: [
                'subscriptionDetail' => [
                    'device' => [
                        'ipv4Address' => [
                            'privateAddress' => '84.125.93.10',
                            'publicAddress' => '84.125.93.10',
                            'publicPort' => 59765,
                        ],
                        'ipv6Address' => '2001:db8:85a3:8d3:1319:8a2e:370:7344',
                        'networkAccessIdentifier' => '123456789@example.com',
                        'phoneNumber' => '+123456789',
                    ],
                ],
                'initialEvent' => true,
                'subscriptionExpireTime' => new \DateTimeImmutable(
                    '2023-01-17T13:18:23.682Z'
                ),
                'subscriptionMaxEvents' => 5,
            ],
            protocol: ConnectedNetworkTypeProtocol::HTTP,
            sink: 'https://endpoint.example.com/sink',
            types: [
                ConnectedNetworkTypeSubscriptionEventType::ORG_CAMARAPROJECT_CONNECTED_NETWORK_TYPE_SUBSCRIPTIONS_V0_NETWORK_TYPE_CHANGED,
            ],
            sinkCredential: ['credentialType' => 'ACCESSTOKEN'],
            xCorrelator: 'b4333c46-49c0-4f62-80d7-f0ef930f1c46',
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(ConnectedNetworkTypeSubscription::class, $result);
    }

    #[Test]
    public function testRetrieve(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->connectednetworktype->subscriptions->retrieve(
            'qs15-h556-rt89-1298'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(ConnectedNetworkTypeSubscription::class, $result);
    }

    #[Test]
    public function testList(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->connectednetworktype->subscriptions->list();

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertIsList($result);
    }

    #[Test]
    public function testDelete(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->connectednetworktype->subscriptions->delete(
            'qs15-h556-rt89-1298'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(SubscriptionDeleteResponse::class, $result);
    }
}
