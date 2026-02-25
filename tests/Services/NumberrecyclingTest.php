<?php

namespace Tests\Services;

use Camara\Client;
use Camara\Core\Util;
use Camara\Numberrecycling\NumberrecyclingCheckSubscriberChangeResponse;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Tests\UnsupportedMockTests;

/**
 * @internal
 */
#[CoversNothing]
final class NumberrecyclingTest extends TestCase
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
    public function testCheckSubscriberChange(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->numberrecycling->checkSubscriberChange(
            specifiedDate: '2024-10-31'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(
            NumberrecyclingCheckSubscriberChangeResponse::class,
            $result
        );
    }

    #[Test]
    public function testCheckSubscriberChangeWithOptionalParams(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->numberrecycling->checkSubscriberChange(
            specifiedDate: '2024-10-31',
            phoneNumber: '+123456789',
            xCorrelator: 'b4333c46-49c0-4f62-80d7-f0ef930f1c46',
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(
            NumberrecyclingCheckSubscriberChangeResponse::class,
            $result
        );
    }
}
