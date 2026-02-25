<?php

namespace Tests;

use Camara\Core\Util;
use Http\Discovery\Psr17FactoryDiscovery;
use Http\Mock\Client;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 *
 * @coversNothing
 */
class ClientTest extends TestCase
{
    public function testDefaultHeaders(): void
    {
        $transporter = new Client;
        $mockRsp = Psr17FactoryDiscovery::findResponseFactory()
            ->createResponse()
            ->withStatus(200)
            ->withHeader('Content-Type', 'application/json')
            ->withBody(Psr17FactoryDiscovery::findStreamFactory()->createStream(json_encode([], flags: Util::JSON_ENCODE_FLAGS) ?: ''))
        ;

        $transporter->setDefaultResponse($mockRsp);

        $client = new \Camara\Client(
            baseUrl: 'http://localhost',
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
            requestOptions: ['transporter' => $transporter],
        );

        $client->customerinsights->scoring->retrieve();

        $this->assertNotFalse($requested = $transporter->getRequests()[0] ?? false);

        foreach (['accept', 'content-type'] as $header) {
            $sent = $requested->getHeaderLine($header);
            $this->assertNotEmpty($sent);
        }
    }
}
