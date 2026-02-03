<?php

namespace Tests\Services\Webrtc;

use Camara\Client;
use Camara\Core\Util;
use Camara\Webrtc\Sessions\MediaSessionInformation;
use PHPUnit\Framework\Attributes\CoversNothing;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;
use Tests\UnsupportedMockTests;

/**
 * @internal
 */
#[CoversNothing]
final class SessionsTest extends TestCase
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
    public function testCreate(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $result = $this->client->webrtc->sessions->create(
            registrationID: 'registrationId'
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(MediaSessionInformation::class, $result);
    }

    #[Test]
    public function testCreateWithOptionalParams(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $result = $this->client->webrtc->sessions->create(
            registrationID: 'registrationId',
            answer: ['sdp' => 'sdp'],
            callType: 'REGULAR',
            locationDetails: [
                'confidence' => ['pdf' => 'normal', 'value' => 0],
                'coordinates' => ['latitude' => 0, 'longitude' => 0, 'radius' => 0],
                'method' => 'GPS',
                'shape' => 'Circle',
                'timestamp' => new \DateTimeImmutable('2019-12-27T18:11:19.117Z'),
            ],
            mediaSessionID: '0AEE1B58BAEEDA3EABA42B32EBB3DFE07E9CFF402EAF9EED8EF',
            offer: [
                'sdp' => 'v=0\r\no=- 8066321617929821805 2 IN IP4 127.0.0.1\r\ns=-\r\nt=0 0\r\nm=audio 42988 RTP/SAVPF 102 113\r\nc=IN IP6 2001:e0:410:2448:7a05:9b11:66f2:c9e\r\nb=AS:64\r\na=rtcp:9 IN IP4 0.0.0.0\r\na=candidate:1645903805 1 udp 2122262783 2001:e0:410:2448:7a05:9b11:66f2:c9e 42988 typ host generation 0 network-id 3 network-cost 900\r\na=ice-ufrag:4eKp\r\na=ice-pwd:D4sF5Pv9vx9ggaqxBlHbAFMx\r\na=ice-options:trickle renomination\r\na=mid:audio\r\na=extmap:2 http://www.ietf.org/id/draft-holmer-rmcat-transport-wide-cc-extensions-01\r\na=sendrecv\r\na=rtcp-mux\r\na=crypto:1 AES_CM_128_HMAC_SHA1_80 inline:Xm3YciqVIWFNSwy19e9MvfZ2YOdAZil7oT/tHjdf\r\na=rtpmap:102 AMR-WB/16000\r\na=fmtp:102 octet-align=0; mode-set=0,1,2; mode-change-capability=2\r\na=rtpmap:113 telephone-event/16000\r\n',
            ],
            originatorAddress: 'tel:+17085852753',
            originatorName: 'tel:+17085852753',
            receiverAddress: 'tel:+17085854000',
            receiverName: 'tel:+17085854000',
            status: 'Ringing',
            xCorrelator: 'b4333c46-49c0-4f62-80d7-f0ef930f1c46',
        );

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(MediaSessionInformation::class, $result);
    }

    #[Test]
    public function testRetrieve(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $result = $this->client->webrtc->sessions->retrieve('mediaSessionId');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(MediaSessionInformation::class, $result);
    }

    #[Test]
    public function testDelete(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $result = $this->client->webrtc->sessions->delete('mediaSessionId');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertNull($result);
    }

    #[Test]
    public function testUpdateStatus(): void
    {
        if (UnsupportedMockTests::$skip) {
            $this->markTestSkipped('Prism tests are disabled');
        }

        $result = $this->client->webrtc->sessions->updateStatus('mediaSessionId');

        // @phpstan-ignore-next-line method.alreadyNarrowedType
        $this->assertInstanceOf(MediaSessionInformation::class, $result);
    }
}
