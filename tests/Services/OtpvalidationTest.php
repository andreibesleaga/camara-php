<?php

namespace Tests\Services;

use Camara\Client;
use Camara\Core\Util;
use Camara\Otpvalidation\OtpvalidationSendCodeResponse;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Tests\UnsupportedMockTests;

/**
 * @internal
 */
#[CoversNothing]
final class OtpvalidationTest extends TestCase
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
    public function testSendCode(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->otpvalidation->sendCode(
            message: '{{code}} is your short code to authenticate with Cool App via SMS',
            phoneNumber: '+346661113334',
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(OtpvalidationSendCodeResponse::class, $result);
    }

    #[Test]
    public function testSendCodeWithOptionalParams(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->otpvalidation->sendCode(
            message: '{{code}} is your short code to authenticate with Cool App via SMS',
            phoneNumber: '+346661113334',
            xCorrelator: 'b4333c46-49c0-4f62-80d7-f0ef930f1c46',
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(OtpvalidationSendCodeResponse::class, $result);
    }

    #[Test]
    public function testValidateCode(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->otpvalidation->validateCode(
            authenticationID: 'ea0840f3-3663-4149-bd10-c7c6b8912105',
            code: 'AJY3'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertNull($result);
    }

    #[Test]
    public function testValidateCodeWithOptionalParams(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Mock server tests are disabled');
        }

        $result = $this->client->otpvalidation->validateCode(
            authenticationID: 'ea0840f3-3663-4149-bd10-c7c6b8912105',
            code: 'AJY3',
            xCorrelator: 'b4333c46-49c0-4f62-80d7-f0ef930f1c46',
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertNull($result);
    }
}
