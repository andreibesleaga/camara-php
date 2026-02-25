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
    public string $bearerToken;

    public string $customerInsightsToken;

    public string $deviceSwapToken;

    public string $kycAgeVerificationToken;

    public string $kycFillInToken;

    public string $kycMatchToken;

    public string $tenureToken;

    public string $numberRecyclingToken;

    public string $otpValidationToken;

    public string $callForwardingSignalToken;

    public string $deviceLocationToken;

    public string $populationDensityDataToken;

    public string $regionDeviceCountToken;

    public string $webRtcToken;

    public string $connectivityInsightsToken;

    public string $qualityOnDemandToken;

    public string $deviceIdentifierToken;

    public string $simSwapToken;

    public string $deviceRoamingStatusToken;

    public string $deviceReachabilityStatusToken;

    public string $connectedNetworkTypeToken;

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
        ?string $bearerToken = null,
        ?string $customerInsightsToken = null,
        ?string $deviceSwapToken = null,
        ?string $kycAgeVerificationToken = null,
        ?string $kycFillInToken = null,
        ?string $kycMatchToken = null,
        ?string $tenureToken = null,
        ?string $numberRecyclingToken = null,
        ?string $otpValidationToken = null,
        ?string $callForwardingSignalToken = null,
        ?string $deviceLocationToken = null,
        ?string $populationDensityDataToken = null,
        ?string $regionDeviceCountToken = null,
        ?string $webRtcToken = null,
        ?string $connectivityInsightsToken = null,
        ?string $qualityOnDemandToken = null,
        ?string $deviceIdentifierToken = null,
        ?string $simSwapToken = null,
        ?string $deviceRoamingStatusToken = null,
        ?string $deviceReachabilityStatusToken = null,
        ?string $connectedNetworkTypeToken = null,
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
        $this->bearerToken = (string) ($bearerToken ?? Util::getenv(
            'CAMARA_BEARER_TOKEN'
        ));
        $this->customerInsightsToken = (string) ($customerInsightsToken ?? Util::getenv(
            'CAMARA_BEARER_TOKEN'
        ));
        $this->deviceSwapToken = (string) ($deviceSwapToken ?? Util::getenv(
            'CAMARA_BEARER_TOKEN'
        ));
        $this->kycAgeVerificationToken = (string) ($kycAgeVerificationToken ?? Util::getenv(
            'CAMARA_BEARER_TOKEN'
        ));
        $this->kycFillInToken = (string) ($kycFillInToken ?? Util::getenv(
            'CAMARA_BEARER_TOKEN'
        ));
        $this->kycMatchToken = (string) ($kycMatchToken ?? Util::getenv(
            'CAMARA_BEARER_TOKEN'
        ));
        $this->tenureToken = (string) ($tenureToken ?? Util::getenv(
            'CAMARA_BEARER_TOKEN'
        ));
        $this->numberRecyclingToken = (string) ($numberRecyclingToken ?? Util::getenv(
            'CAMARA_BEARER_TOKEN'
        ));
        $this->otpValidationToken = (string) ($otpValidationToken ?? Util::getenv(
            'CAMARA_BEARER_TOKEN'
        ));
        $this->callForwardingSignalToken = (string) ($callForwardingSignalToken ?? Util::getenv(
            'CAMARA_BEARER_TOKEN'
        ));
        $this->deviceLocationToken = (string) ($deviceLocationToken ?? Util::getenv(
            'CAMARA_BEARER_TOKEN'
        ));
        $this->populationDensityDataToken = (string) ($populationDensityDataToken ?? Util::getenv(
            'CAMARA_BEARER_TOKEN'
        ));
        $this->regionDeviceCountToken = (string) ($regionDeviceCountToken ?? Util::getenv(
            'CAMARA_BEARER_TOKEN'
        ));
        $this->webRtcToken = (string) ($webRtcToken ?? Util::getenv(
            'CAMARA_BEARER_TOKEN'
        ));
        $this->connectivityInsightsToken = (string) ($connectivityInsightsToken ?? Util::getenv(
            'CAMARA_BEARER_TOKEN'
        ));
        $this->qualityOnDemandToken = (string) ($qualityOnDemandToken ?? Util::getenv(
            'CAMARA_BEARER_TOKEN'
        ));
        $this->deviceIdentifierToken = (string) ($deviceIdentifierToken ?? Util::getenv(
            'CAMARA_BEARER_TOKEN'
        ));
        $this->simSwapToken = (string) ($simSwapToken ?? Util::getenv(
            'CAMARA_BEARER_TOKEN'
        ));
        $this->deviceRoamingStatusToken = (string) ($deviceRoamingStatusToken ?? Util::getenv(
            'CAMARA_BEARER_TOKEN'
        ));
        $this->deviceReachabilityStatusToken = (string) ($deviceReachabilityStatusToken ?? Util::getenv(
            'CAMARA_BEARER_TOKEN'
        ));
        $this->connectedNetworkTypeToken = (string) ($connectedNetworkTypeToken ?? Util::getenv(
            'CAMARA_BEARER_TOKEN'
        ));
        $this->deviceLocationNotificationsAPIKey = (string) ($deviceLocationNotificationsAPIKey ?? Util::getenv(
            'CAMARA_DEVICE_LOCATION_NOTIFICATIONS_API_KEY'
        ));
        $this->notificationsAPIKey = (string) ($notificationsAPIKey ?? Util::getenv(
            'CAMARA_NOTIFICATIONS_API_KEY'
        ));
        $this->populationDensityDataNotificationsAPIKey = (string) ($populationDensityDataNotificationsAPIKey ?? Util::getenv(
            'CAMARA_POPULATION_DENSITY_DATA_NOTIFICATIONS_API_KEY'
        ));
        $this->regionDeviceCountNotificationsAPIKey = (string) ($regionDeviceCountNotificationsAPIKey ?? Util::getenv(
            'CAMARA_REGION_DEVICE_COUNT_NOTIFICATIONS_API_KEY'
        ));
        $this->connectivityInsightsNotificationsAPIKey = (string) ($connectivityInsightsNotificationsAPIKey ?? Util::getenv(
            'CAMARA_CONNECTIVITY_INSIGHTS_NOTIFICATIONS_API_KEY'
        ));
        $this->simSwapNotificationsAPIKey = (string) ($simSwapNotificationsAPIKey ?? Util::getenv(
            'CAMARA_SIM_SWAP_NOTIFICATIONS_API_KEY'
        ));
        $this->deviceRoamingStatusNotificationsAPIKey = (string) ($deviceRoamingStatusNotificationsAPIKey ?? Util::getenv(
            'CAMARA_DEVICE_ROAMING_STATUS_NOTIFICATIONS_API_KEY'
        ));
        $this->deviceReachabilityStatusNotificationsAPIKey = (string) ($deviceReachabilityStatusNotificationsAPIKey ?? Util::getenv(
            'CAMARA_DEVICE_REACHABILITY_STATUS_NOTIFICATIONS_API_KEY'
        ));
        $this->connectedNetworkTypeNotificationsAPIKey = (string) ($connectedNetworkTypeNotificationsAPIKey ?? Util::getenv(
            'CAMARA_CONNECTED_NETWORK_TYPE_NOTIFICATIONS_API_KEY'
        ));

        $baseUrl ??= Util::getenv(
            'CAMARA_BASE_URL'
        ) ?: 'https://api.example.com/camara';

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
                'X-Stainless-Package-Version' => '0.0.1',
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
            ...$this->customerInsightsopenID(),
            ...$this->openID(),
            ...$this->deviceSwapopenID(),
            ...$this->knowYourCustomerAgeVerificationopenID(),
            ...$this->knowYourCustomerFillInopenID(),
            ...$this->knowYourCustomerMatchopenID(),
            ...$this->tenureopenID(),
            ...$this->numberRecyclingopenID(),
            ...$this->otpValidationopenID(),
            ...$this->callForwardingSignalopenID(),
            ...$this->deviceLocationopenID(),
            ...$this->deviceLocationnotificationsBearerAuth(),
            ...$this->notificationsBearerAuth(),
            ...$this->populationDensityDataopenID(),
            ...$this->populationDensityDatanotificationsBearerAuth(),
            ...$this->regionDeviceCountopenID(),
            ...$this->regionDeviceCountnotificationsBearerAuth(),
            ...$this->webRtCopenID(),
            ...$this->connectivityInsightsopenID(),
            ...$this->connectivityInsightsnotificationsBearerAuth(),
            ...$this->qualityOnDemandopenID(),
            ...$this->deviceIdentifieropenID(),
            ...$this->simSwapopenID(),
            ...$this->simSwapnotificationsBearerAuth(),
            ...$this->deviceRoamingStatusopenID(),
            ...$this->deviceRoamingStatusnotificationsBearerAuth(),
            ...$this->deviceReachabilityStatusopenID(),
            ...$this->deviceReachabilityStatusnotificationsBearerAuth(),
            ...$this->connectedNetworkTypeopenID(),
            ...$this->connectedNetworkTypenotificationsBearerAuth(),
        ];
    }

    /** @return array<string,string> */
    protected function customerInsightsopenID(): array
    {
        return $this->customerInsightsToken ? [
            'Authorization' => "Bearer {$this->customerInsightsToken}",
        ] : [];
    }

    /** @return array<string,string> */
    protected function openID(): array
    {
        return $this->bearerToken ? [
            'Authorization' => "Bearer {$this->bearerToken}",
        ] : [];
    }

    /** @return array<string,string> */
    protected function deviceSwapopenID(): array
    {
        return $this->deviceSwapToken ? [
            'Authorization' => "Bearer {$this->deviceSwapToken}",
        ] : [];
    }

    /** @return array<string,string> */
    protected function knowYourCustomerAgeVerificationopenID(): array
    {
        return $this->kycAgeVerificationToken ? [
            'Authorization' => "Bearer {$this->kycAgeVerificationToken}",
        ] : [];
    }

    /** @return array<string,string> */
    protected function knowYourCustomerFillInopenID(): array
    {
        return $this->kycFillInToken ? [
            'Authorization' => "Bearer {$this->kycFillInToken}",
        ] : [];
    }

    /** @return array<string,string> */
    protected function knowYourCustomerMatchopenID(): array
    {
        return $this->kycMatchToken ? [
            'Authorization' => "Bearer {$this->kycMatchToken}",
        ] : [];
    }

    /** @return array<string,string> */
    protected function tenureopenID(): array
    {
        return $this->tenureToken ? [
            'Authorization' => "Bearer {$this->tenureToken}",
        ] : [];
    }

    /** @return array<string,string> */
    protected function numberRecyclingopenID(): array
    {
        return $this->numberRecyclingToken ? [
            'Authorization' => "Bearer {$this->numberRecyclingToken}",
        ] : [];
    }

    /** @return array<string,string> */
    protected function otpValidationopenID(): array
    {
        return $this->otpValidationToken ? [
            'Authorization' => "Bearer {$this->otpValidationToken}",
        ] : [];
    }

    /** @return array<string,string> */
    protected function callForwardingSignalopenID(): array
    {
        return $this->callForwardingSignalToken ? [
            'Authorization' => "Bearer {$this->callForwardingSignalToken}",
        ] : [];
    }

    /** @return array<string,string> */
    protected function deviceLocationopenID(): array
    {
        return $this->deviceLocationToken ? [
            'Authorization' => "Bearer {$this->deviceLocationToken}",
        ] : [];
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
    protected function populationDensityDataopenID(): array
    {
        return $this->populationDensityDataToken ? [
            'Authorization' => "Bearer {$this->populationDensityDataToken}",
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
    protected function regionDeviceCountopenID(): array
    {
        return $this->regionDeviceCountToken ? [
            'Authorization' => "Bearer {$this->regionDeviceCountToken}",
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
    protected function webRtCopenID(): array
    {
        return $this->webRtcToken ? [
            'Authorization' => "Bearer {$this->webRtcToken}",
        ] : [];
    }

    /** @return array<string,string> */
    protected function connectivityInsightsopenID(): array
    {
        return $this->connectivityInsightsToken ? [
            'Authorization' => "Bearer {$this->connectivityInsightsToken}",
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
    protected function qualityOnDemandopenID(): array
    {
        return $this->qualityOnDemandToken ? [
            'Authorization' => "Bearer {$this->qualityOnDemandToken}",
        ] : [];
    }

    /** @return array<string,string> */
    protected function deviceIdentifieropenID(): array
    {
        return $this->deviceIdentifierToken ? [
            'Authorization' => "Bearer {$this->deviceIdentifierToken}",
        ] : [];
    }

    /** @return array<string,string> */
    protected function simSwapopenID(): array
    {
        return $this->simSwapToken ? [
            'Authorization' => "Bearer {$this->simSwapToken}",
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
    protected function deviceRoamingStatusopenID(): array
    {
        return $this->deviceRoamingStatusToken ? [
            'Authorization' => "Bearer {$this->deviceRoamingStatusToken}",
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
    protected function deviceReachabilityStatusopenID(): array
    {
        return $this->deviceReachabilityStatusToken ? [
            'Authorization' => "Bearer {$this->deviceReachabilityStatusToken}",
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
    protected function connectedNetworkTypeopenID(): array
    {
        return $this->connectedNetworkTypeToken ? [
            'Authorization' => "Bearer {$this->connectedNetworkTypeToken}",
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
