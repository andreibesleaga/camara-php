<?php

declare(strict_types=1);

namespace Camara;

use Camara\Core\BaseClient;
use Camara\Core\Util;
use Camara\Services\CallforwardingsignalService;
use Camara\Services\ConnectednetworktypeService;
use Camara\Services\ConnectivityinsightsService;
use Camara\Services\CustomerinsightsService;
use Camara\Services\DeviceidentifierService;
use Camara\Services\DevicelocationService;
use Camara\Services\DevicereachabilitystatusService;
use Camara\Services\DeviceroamingstatusService;
use Camara\Services\DeviceswapService;
use Camara\Services\KnowyourcustomerageverificationService;
use Camara\Services\KnowyourcustomerfillInService;
use Camara\Services\KnowyourcustomermatchService;
use Camara\Services\NumberrecyclingService;
use Camara\Services\OtpvalidationService;
use Camara\Services\PopulationdensitydataService;
use Camara\Services\QualityondemandService;
use Camara\Services\RegiondevicecountService;
use Camara\Services\SimswapService;
use Camara\Services\TenureService;
use Camara\Services\WebrtcService;
use Http\Discovery\Psr17FactoryDiscovery;
use Http\Discovery\Psr18ClientDiscovery;

/**
 * @phpstan-import-type NormalizedRequest from \Camara\Core\BaseClient
 * @phpstan-import-type RequestOpts from \Camara\RequestOptions
 */
class Client extends BaseClient
{
    public string $deviceLocationNotificationsAPIKey;

    public string $notificationsAPIKey;

    public string $populationDensityDataNotificationsAPIKey;

    public string $regionDeviceCountNotificationsAPIKey;

    public string $connectivityInsightsNotificationsAPIKey;

    public string $simSwapNotificationsAPIKey;

    public string $deviceRoamingStatusNotificationsAPIKey;

    public string $deviceReachabilityStatusNotificationsAPIKey;

    public string $connectedNetworkTypeNotificationsAPIKey;

    /**
     * @api
     */
    public CustomerinsightsService $customerinsights;

    /**
     * @api
     */
    public DeviceswapService $deviceswap;

    /**
     * @api
     */
    public KnowyourcustomerageverificationService $knowyourcustomerageverification;

    /**
     * @api
     */
    public KnowyourcustomerfillInService $knowyourcustomerfillIn;

    /**
     * @api
     */
    public KnowyourcustomermatchService $knowyourcustomermatch;

    /**
     * @api
     */
    public TenureService $tenure;

    /**
     * @api
     */
    public NumberrecyclingService $numberrecycling;

    /**
     * @api
     */
    public OtpvalidationService $otpvalidation;

    /**
     * @api
     */
    public CallforwardingsignalService $callforwardingsignal;

    /**
     * @api
     */
    public DevicelocationService $devicelocation;

    /**
     * @api
     */
    public PopulationdensitydataService $populationdensitydata;

    /**
     * @api
     */
    public RegiondevicecountService $regiondevicecount;

    /**
     * @api
     */
    public WebrtcService $webrtc;

    /**
     * @api
     */
    public ConnectivityinsightsService $connectivityinsights;

    /**
     * @api
     */
    public QualityondemandService $qualityondemand;

    /**
     * @api
     */
    public DeviceidentifierService $deviceidentifier;

    /**
     * @api
     */
    public SimswapService $simswap;

    /**
     * @api
     */
    public DeviceroamingstatusService $deviceroamingstatus;

    /**
     * @api
     */
    public DevicereachabilitystatusService $devicereachabilitystatus;

    /**
     * @api
     */
    public ConnectednetworktypeService $connectednetworktype;

    /**
     * @param RequestOpts|null $requestOptions
     */
    public function __construct(
        ?string $deviceLocationNotificationsAPIKey = null,
        ?string $notificationsAPIKey = null,
        ?string $populationDensityDataNotificationsAPIKey = null,
        ?string $regionDeviceCountNotificationsAPIKey = null,
        ?string $connectivityInsightsNotificationsAPIKey = null,
        ?string $simSwapNotificationsAPIKey = null,
        ?string $deviceRoamingStatusNotificationsAPIKey = null,
        ?string $deviceReachabilityStatusNotificationsAPIKey = null,
        ?string $connectedNetworkTypeNotificationsAPIKey = null,
        ?string $baseUrl = null,
        RequestOptions|array|null $requestOptions = null,
    ) {
        $this->deviceLocationNotificationsAPIKey = (string) ($deviceLocationNotificationsAPIKey ?? getenv('CAMARA_DEVICE_LOCATION_NOTIFICATIONS_API_KEY'));
        $this->notificationsAPIKey = (string) ($notificationsAPIKey ?? getenv('CAMARA_NOTIFICATIONS_API_KEY'));
        $this->populationDensityDataNotificationsAPIKey = (string) ($populationDensityDataNotificationsAPIKey ?? getenv('CAMARA_POPULATION_DENSITY_DATA_NOTIFICATIONS_API_KEY'));
        $this->regionDeviceCountNotificationsAPIKey = (string) ($regionDeviceCountNotificationsAPIKey ?? getenv('CAMARA_REGION_DEVICE_COUNT_NOTIFICATIONS_API_KEY'));
        $this->connectivityInsightsNotificationsAPIKey = (string) ($connectivityInsightsNotificationsAPIKey ?? getenv('CAMARA_CONNECTIVITY_INSIGHTS_NOTIFICATIONS_API_KEY'));
        $this->simSwapNotificationsAPIKey = (string) ($simSwapNotificationsAPIKey ?? getenv('CAMARA_SIM_SWAP_NOTIFICATIONS_API_KEY'));
        $this->deviceRoamingStatusNotificationsAPIKey = (string) ($deviceRoamingStatusNotificationsAPIKey ?? getenv('CAMARA_DEVICE_ROAMING_STATUS_NOTIFICATIONS_API_KEY'));
        $this->deviceReachabilityStatusNotificationsAPIKey = (string) ($deviceReachabilityStatusNotificationsAPIKey ?? getenv('CAMARA_DEVICE_REACHABILITY_STATUS_NOTIFICATIONS_API_KEY'));
        $this->connectedNetworkTypeNotificationsAPIKey = (string) ($connectedNetworkTypeNotificationsAPIKey ?? getenv('CAMARA_CONNECTED_NETWORK_TYPE_NOTIFICATIONS_API_KEY'));

        $baseUrl ??= getenv('CAMARA_BASE_URL') ?: 'https://api.example.com/camara';

        $options = RequestOptions::parse(
            RequestOptions::with(
                uriFactory: Psr17FactoryDiscovery::findUriFactory(),
                streamFactory: Psr17FactoryDiscovery::findStreamFactory(),
                requestFactory: Psr17FactoryDiscovery::findRequestFactory(),
                transporter: Psr18ClientDiscovery::find(),
            ),
            $requestOptions,
        );

        parent::__construct(
            headers: [
                'Content-Type' => 'application/json',
                'Accept' => 'application/json',
                'User-Agent' => sprintf('camara/PHP %s', VERSION),
                'X-Stainless-Lang' => 'php',
                'X-Stainless-Package-Version' => '0.0.2',
                'X-Stainless-Arch' => Util::machtype(),
                'X-Stainless-OS' => Util::ostype(),
                'X-Stainless-Runtime' => php_sapi_name(),
                'X-Stainless-Runtime-Version' => phpversion(),
            ],
            baseUrl: $baseUrl,
            options: $options
        );

        $this->customerinsights = new CustomerinsightsService($this);
        $this->deviceswap = new DeviceswapService($this);
        $this->knowyourcustomerageverification = new KnowyourcustomerageverificationService($this);
        $this->knowyourcustomerfillIn = new KnowyourcustomerfillInService($this);
        $this->knowyourcustomermatch = new KnowyourcustomermatchService($this);
        $this->tenure = new TenureService($this);
        $this->numberrecycling = new NumberrecyclingService($this);
        $this->otpvalidation = new OtpvalidationService($this);
        $this->callforwardingsignal = new CallforwardingsignalService($this);
        $this->devicelocation = new DevicelocationService($this);
        $this->populationdensitydata = new PopulationdensitydataService($this);
        $this->regiondevicecount = new RegiondevicecountService($this);
        $this->webrtc = new WebrtcService($this);
        $this->connectivityinsights = new ConnectivityinsightsService($this);
        $this->qualityondemand = new QualityondemandService($this);
        $this->deviceidentifier = new DeviceidentifierService($this);
        $this->simswap = new SimswapService($this);
        $this->deviceroamingstatus = new DeviceroamingstatusService($this);
        $this->devicereachabilitystatus = new DevicereachabilitystatusService($this);
        $this->connectednetworktype = new ConnectednetworktypeService($this);
    }

    /** @return array<string,string> */
    protected function authHeaders(): array
    {
        return [
            ...$this->deviceLocationnotificationsBearerAuth(),
            ...$this->notificationsBearerAuth(),
            ...$this->populationDensityDatanotificationsBearerAuth(),
            ...$this->regionDeviceCountnotificationsBearerAuth(),
            ...$this->connectivityInsightsnotificationsBearerAuth(),
            ...$this->simSwapnotificationsBearerAuth(),
            ...$this->deviceRoamingStatusnotificationsBearerAuth(),
            ...$this->deviceReachabilityStatusnotificationsBearerAuth(),
            ...$this->connectedNetworkTypenotificationsBearerAuth(),
        ];
    }

    /** @return array<string,string> */
    protected function deviceLocationnotificationsBearerAuth(): array
    {
        return $this->deviceLocationNotificationsAPIKey ? [
            'Authorization' => "Bearer {$this->deviceLocationNotificationsAPIKey}",
        ] : [];
    }

    /** @return array<string,string> */
    protected function notificationsBearerAuth(): array
    {
        return $this->notificationsAPIKey ? [
            'Authorization' => "Bearer {$this->notificationsAPIKey}",
        ] : [];
    }

    /** @return array<string,string> */
    protected function populationDensityDatanotificationsBearerAuth(): array
    {
        return $this->populationDensityDataNotificationsAPIKey ? [
            'Authorization' => "Bearer {
        {$this->populationDensityDataNotificationsAPIKey}
      }",
        ] : [];
    }

    /** @return array<string,string> */
    protected function regionDeviceCountnotificationsBearerAuth(): array
    {
        return $this->regionDeviceCountNotificationsAPIKey ? [
            'Authorization' => "Bearer {$this->regionDeviceCountNotificationsAPIKey}",
        ] : [];
    }

    /** @return array<string,string> */
    protected function connectivityInsightsnotificationsBearerAuth(): array
    {
        return $this->connectivityInsightsNotificationsAPIKey ? [
            'Authorization' => "Bearer {
        {$this->connectivityInsightsNotificationsAPIKey}
      }",
        ] : [];
    }

    /** @return array<string,string> */
    protected function simSwapnotificationsBearerAuth(): array
    {
        return $this->simSwapNotificationsAPIKey ? [
            'Authorization' => "Bearer {$this->simSwapNotificationsAPIKey}",
        ] : [];
    }

    /** @return array<string,string> */
    protected function deviceRoamingStatusnotificationsBearerAuth(): array
    {
        return $this->deviceRoamingStatusNotificationsAPIKey ? [
            'Authorization' => "Bearer {
        {$this->deviceRoamingStatusNotificationsAPIKey}
      }",
        ] : [];
    }

    /** @return array<string,string> */
    protected function deviceReachabilityStatusnotificationsBearerAuth(): array
    {
        return $this->deviceReachabilityStatusNotificationsAPIKey ? [
            'Authorization' => "Bearer {
        {$this->deviceReachabilityStatusNotificationsAPIKey}
      }",
        ] : [];
    }

    /** @return array<string,string> */
    protected function connectedNetworkTypenotificationsBearerAuth(): array
    {
        return $this->connectedNetworkTypeNotificationsAPIKey ? [
            'Authorization' => "Bearer {
        {$this->connectedNetworkTypeNotificationsAPIKey}
      }",
        ] : [];
    }

    /**
     * @internal
     *
     * @param string|list<string> $path
     * @param array<string,mixed> $query
     * @param array<string,string|int|list<string|int>|null> $headers
     * @param RequestOpts|null $opts
     *
     * @return array{NormalizedRequest, RequestOptions}
     */
    protected function buildRequest(
        string $method,
        string|array $path,
        array $query,
        array $headers,
        mixed $body,
        RequestOptions|array|null $opts,
    ): array {
        return parent::buildRequest(
            method: $method,
            path: $path,
            query: $query,
            headers: [...$this->authHeaders(), ...$headers],
            body: $body,
            opts: $opts,
        );
    }
}
