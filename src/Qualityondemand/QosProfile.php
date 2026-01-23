<?php

declare(strict_types=1);

namespace Camara\Qualityondemand;

use Camara\Core\Attributes\Optional;
use Camara\Core\Attributes\Required;
use Camara\Core\Concerns\SdkModel;
use Camara\Core\Contracts\BaseModel;
use Camara\Qualityondemand\QosProfile\CountryAvailability;
use Camara\Qualityondemand\QosProfile\L4sQueueType;
use Camara\Qualityondemand\QosProfile\ServiceClass;

/**
 * Data type with attributes of a QosProfile.
 *
 * @phpstan-import-type CountryAvailabilityShape from \Camara\Qualityondemand\QosProfile\CountryAvailability
 * @phpstan-import-type DurationShape from \Camara\Qualityondemand\Duration
 * @phpstan-import-type RateShape from \Camara\Qualityondemand\Rate
 *
 * @phpstan-type QosProfileShape = array{
 *   name: string,
 *   status: QosProfileStatus|value-of<QosProfileStatus>,
 *   countryAvailability?: list<CountryAvailability|CountryAvailabilityShape>|null,
 *   description?: string|null,
 *   jitter?: null|Duration|DurationShape,
 *   l4sQueueType?: null|L4sQueueType|value-of<L4sQueueType>,
 *   maxDownstreamBurstRate?: null|Rate|RateShape,
 *   maxDownstreamRate?: null|Rate|RateShape,
 *   maxDuration?: null|Duration|DurationShape,
 *   maxUpstreamBurstRate?: null|Rate|RateShape,
 *   maxUpstreamRate?: null|Rate|RateShape,
 *   minDuration?: null|Duration|DurationShape,
 *   packetDelayBudget?: null|Duration|DurationShape,
 *   packetErrorLossRate?: int|null,
 *   priority?: int|null,
 *   serviceClass?: null|ServiceClass|value-of<ServiceClass>,
 *   targetMinDownstreamRate?: null|Rate|RateShape,
 *   targetMinUpstreamRate?: null|Rate|RateShape,
 * }
 */
final class QosProfile implements BaseModel
{
    /** @use SdkModel<QosProfileShape> */
    use SdkModel;

    /**
     * A unique name for identifying a specific QoS profile.
     * This may follow different formats depending on the service providers implementation.
     * Some options addresses:
     *   - A UUID style string
     *   - Support for predefined profile names like `QOS_E`, `QOS_S`, `QOS_M`, and `QOS_L`
     *   - A searchable descriptive name.
     */
    #[Required]
    public string $name;

    /**
     * The current status of the QoS Profile
     * - `ACTIVE`- QoS Profile is available to be used
     * - `INACTIVE`- QoS Profile is not currently available to be deployed
     * - `DEPRECATED`- QoS profile is actively being used in a QoD session, but can not be deployed in new QoD sessions.
     *
     * @var value-of<QosProfileStatus> $status
     */
    #[Required(enum: QosProfileStatus::class)]
    public string $status;

    /**
     * A list of countries, and optionally networks, for which the API provider makes the profile available.
     *
     * @var list<CountryAvailability>|null $countryAvailability
     */
    #[Optional(list: CountryAvailability::class)]
    public ?array $countryAvailability;

    /**
     * A description of the QoS profile.
     */
    #[Optional]
    public ?string $description;

    /**
     * Specification of duration.
     */
    #[Optional]
    public ?Duration $jitter;

    /**
     * **NOTE**: l4sQueueType is experimental and could change or be removed in a future release.
     *
     * Specifies the type of queue for L4S (Low Latency, Low Loss, Scalable Throughput) traffic management. L4S is an advanced queue management approach designed to provide ultra-low latency and high throughput for internet traffic, particularly beneficial for interactive applications such as gaming, video conferencing, and virtual reality.
     *
     * **Queue Type Descriptions:**
     *
     * - **non-l4s-queue**:
     *   A traditional queue used for legacy internet traffic that does not utilize L4S enhancements. It provides standard latency and throughput levels.
     *
     * - **l4s-queue**:
     *   A dedicated queue optimized for L4S traffic, delivering ultra-low latency, low loss, and scalable throughput to support latency-sensitive applications.
     *
     * - **mixed-queue**:
     *   A shared queue that can handle both L4S and traditional traffic, offering a balance between ultra-low latency for L4S flows and compatibility with non-L4S flows.
     *
     * @var value-of<L4sQueueType>|null $l4sQueueType
     */
    #[Optional(enum: L4sQueueType::class)]
    public ?string $l4sQueueType;

    /**
     * Specification of rate.
     */
    #[Optional]
    public ?Rate $maxDownstreamBurstRate;

    /**
     * Specification of rate.
     */
    #[Optional]
    public ?Rate $maxDownstreamRate;

    /**
     * Specification of duration.
     */
    #[Optional]
    public ?Duration $maxDuration;

    /**
     * Specification of rate.
     */
    #[Optional]
    public ?Rate $maxUpstreamBurstRate;

    /**
     * Specification of rate.
     */
    #[Optional]
    public ?Rate $maxUpstreamRate;

    /**
     * Specification of duration.
     */
    #[Optional]
    public ?Duration $minDuration;

    /**
     * Specification of duration.
     */
    #[Optional]
    public ?Duration $packetDelayBudget;

    /**
     * This field specifies the acceptable level of data loss during transmission.
     * The value is an exponent of 10, so a value of 3 means that up to 10⁻³, or 0.1%, of the
     * data packets may be lost. This setting is part of a broader system that categorizes
     * different types of network traffic (like phone calls, video streams, or data transfers)
     * to ensure they perform reliably on the network.
     */
    #[Optional]
    public ?int $packetErrorLossRate;

    /**
     * Priority levels allow efficient resource allocation and ensure optimal performance
     * for various services in each technology, with the highest priority traffic receiving
     * preferential treatment.
     * The lower value the higher priority.
     * Not all access networks use the same priority range, so this priority will be
     * scaled to the access network's priority range.
     */
    #[Optional]
    public ?int $priority;

    /**
     * **NOTE**: serviceClass is experimental and could change or be removed in a future release.
     *
     * The name of a Service Class, representing a QoS Profile designed to provide optimized behavior for a specific application type. While DSCP values are commonly associated with Service Classes, their use may vary across network segments and may not be applied throughout the entire end-to-end QoS session. This aligns with the serviceClass concept used in HomeDevicesQoQ for consistent terminology.
     *
     * Service classes define specific QoS behaviors that map to DSCP (Differentiated Services Code Point) values or Microsoft QoS traffic types.
     *
     * The supported mappings are:
     * 1. Values aligned with the [RFC4594](https://datatracker.ietf.org/doc/html/rfc4594) guidelines for differentiated traffic classes.
     * 2. Microsoft [QOS_TRAFFIC_TYPE](https://learn.microsoft.com/en-us/windows/win32/api/qos2/ne-qos2-qos_traffic_type) values for Windows developers.
     *
     * **Supported Service Classes**:
     *
     * | Service Class Name    | DSCP Name | DSCP value (decimal) | DCSP value (binary) | Microsoft Value | Application Examples                                                 |
     * |-----------------------|-----------|----------------------|---------------------|-----------------|----------------------------------------------------------------------|
     * | Microsoft Voice       |    CS7    |          56          |        111000       |       4,5       | Microsoft QOSTrafficTypeVoice and QOSTrafficTypeControl              |
     * | Microsoft Audio/Video |    CS5    |          40          |        101000       |       2,3       | Microsoft QOSTrafficTypeExcellentEffort and QOSTrafficTypeAudioVideo |
     * | Real-Time Interactive |    CS4    |          32          |        100000       |                 | Video conferencing and Interactive gaming                            |
     * | Multimedia Streaming  |    AF31   |          26          |        011010       |                 | Streaming video and audio on demand                                  |
     * | Broadcast Video       |    CS3    |          24          |        011000       |                 | Broadcast TV & live events                                           |
     * | Low-Latency Data      |    AF21   |          18          |        010010       |                 | Client/server transactions Web-based ordering                        |
     * | High-Throughput Data  |    AF11   |          10          |        001010       |                 | Store and forward applications                                       |
     * | Low-Priority Data     |    CS1    |           8          |        001000       |        1        | Any flow that has no BW assurance - also:                            |
     * |                       |           |                      |                     |                 | Microsoft QOSTrafficTypeBackground                                   |
     * | Standard              |  DF(CS0)  |           0          |        000000       |        0        | Undifferentiated applications - also:                                |
     * |                       |           |                      |                     |                 | Microsoft QOSTrafficTypeBestEffort                                   |
     *
     * @var value-of<ServiceClass>|null $serviceClass
     */
    #[Optional(enum: ServiceClass::class)]
    public ?string $serviceClass;

    /**
     * Specification of rate.
     */
    #[Optional]
    public ?Rate $targetMinDownstreamRate;

    /**
     * Specification of rate.
     */
    #[Optional]
    public ?Rate $targetMinUpstreamRate;

    /**
     * `new QosProfile()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * QosProfile::with(name: ..., status: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new QosProfile)->withName(...)->withStatus(...)
     * ```
     */
    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param QosProfileStatus|value-of<QosProfileStatus> $status
     * @param list<CountryAvailability|CountryAvailabilityShape>|null $countryAvailability
     * @param Duration|DurationShape|null $jitter
     * @param L4sQueueType|value-of<L4sQueueType>|null $l4sQueueType
     * @param Rate|RateShape|null $maxDownstreamBurstRate
     * @param Rate|RateShape|null $maxDownstreamRate
     * @param Duration|DurationShape|null $maxDuration
     * @param Rate|RateShape|null $maxUpstreamBurstRate
     * @param Rate|RateShape|null $maxUpstreamRate
     * @param Duration|DurationShape|null $minDuration
     * @param Duration|DurationShape|null $packetDelayBudget
     * @param ServiceClass|value-of<ServiceClass>|null $serviceClass
     * @param Rate|RateShape|null $targetMinDownstreamRate
     * @param Rate|RateShape|null $targetMinUpstreamRate
     */
    public static function with(
        string $name,
        QosProfileStatus|string $status,
        ?array $countryAvailability = null,
        ?string $description = null,
        Duration|array|null $jitter = null,
        L4sQueueType|string|null $l4sQueueType = null,
        Rate|array|null $maxDownstreamBurstRate = null,
        Rate|array|null $maxDownstreamRate = null,
        Duration|array|null $maxDuration = null,
        Rate|array|null $maxUpstreamBurstRate = null,
        Rate|array|null $maxUpstreamRate = null,
        Duration|array|null $minDuration = null,
        Duration|array|null $packetDelayBudget = null,
        ?int $packetErrorLossRate = null,
        ?int $priority = null,
        ServiceClass|string|null $serviceClass = null,
        Rate|array|null $targetMinDownstreamRate = null,
        Rate|array|null $targetMinUpstreamRate = null,
    ): self {
        $self = new self;

        $self['name'] = $name;
        $self['status'] = $status;

        null !== $countryAvailability && $self['countryAvailability'] = $countryAvailability;
        null !== $description && $self['description'] = $description;
        null !== $jitter && $self['jitter'] = $jitter;
        null !== $l4sQueueType && $self['l4sQueueType'] = $l4sQueueType;
        null !== $maxDownstreamBurstRate && $self['maxDownstreamBurstRate'] = $maxDownstreamBurstRate;
        null !== $maxDownstreamRate && $self['maxDownstreamRate'] = $maxDownstreamRate;
        null !== $maxDuration && $self['maxDuration'] = $maxDuration;
        null !== $maxUpstreamBurstRate && $self['maxUpstreamBurstRate'] = $maxUpstreamBurstRate;
        null !== $maxUpstreamRate && $self['maxUpstreamRate'] = $maxUpstreamRate;
        null !== $minDuration && $self['minDuration'] = $minDuration;
        null !== $packetDelayBudget && $self['packetDelayBudget'] = $packetDelayBudget;
        null !== $packetErrorLossRate && $self['packetErrorLossRate'] = $packetErrorLossRate;
        null !== $priority && $self['priority'] = $priority;
        null !== $serviceClass && $self['serviceClass'] = $serviceClass;
        null !== $targetMinDownstreamRate && $self['targetMinDownstreamRate'] = $targetMinDownstreamRate;
        null !== $targetMinUpstreamRate && $self['targetMinUpstreamRate'] = $targetMinUpstreamRate;

        return $self;
    }

    /**
     * A unique name for identifying a specific QoS profile.
     * This may follow different formats depending on the service providers implementation.
     * Some options addresses:
     *   - A UUID style string
     *   - Support for predefined profile names like `QOS_E`, `QOS_S`, `QOS_M`, and `QOS_L`
     *   - A searchable descriptive name.
     */
    public function withName(string $name): self
    {
        $self = clone $this;
        $self['name'] = $name;

        return $self;
    }

    /**
     * The current status of the QoS Profile
     * - `ACTIVE`- QoS Profile is available to be used
     * - `INACTIVE`- QoS Profile is not currently available to be deployed
     * - `DEPRECATED`- QoS profile is actively being used in a QoD session, but can not be deployed in new QoD sessions.
     *
     * @param QosProfileStatus|value-of<QosProfileStatus> $status
     */
    public function withStatus(QosProfileStatus|string $status): self
    {
        $self = clone $this;
        $self['status'] = $status;

        return $self;
    }

    /**
     * A list of countries, and optionally networks, for which the API provider makes the profile available.
     *
     * @param list<CountryAvailability|CountryAvailabilityShape> $countryAvailability
     */
    public function withCountryAvailability(array $countryAvailability): self
    {
        $self = clone $this;
        $self['countryAvailability'] = $countryAvailability;

        return $self;
    }

    /**
     * A description of the QoS profile.
     */
    public function withDescription(string $description): self
    {
        $self = clone $this;
        $self['description'] = $description;

        return $self;
    }

    /**
     * Specification of duration.
     *
     * @param Duration|DurationShape $jitter
     */
    public function withJitter(Duration|array $jitter): self
    {
        $self = clone $this;
        $self['jitter'] = $jitter;

        return $self;
    }

    /**
     * **NOTE**: l4sQueueType is experimental and could change or be removed in a future release.
     *
     * Specifies the type of queue for L4S (Low Latency, Low Loss, Scalable Throughput) traffic management. L4S is an advanced queue management approach designed to provide ultra-low latency and high throughput for internet traffic, particularly beneficial for interactive applications such as gaming, video conferencing, and virtual reality.
     *
     * **Queue Type Descriptions:**
     *
     * - **non-l4s-queue**:
     *   A traditional queue used for legacy internet traffic that does not utilize L4S enhancements. It provides standard latency and throughput levels.
     *
     * - **l4s-queue**:
     *   A dedicated queue optimized for L4S traffic, delivering ultra-low latency, low loss, and scalable throughput to support latency-sensitive applications.
     *
     * - **mixed-queue**:
     *   A shared queue that can handle both L4S and traditional traffic, offering a balance between ultra-low latency for L4S flows and compatibility with non-L4S flows.
     *
     * @param L4sQueueType|value-of<L4sQueueType> $l4sQueueType
     */
    public function withL4sQueueType(L4sQueueType|string $l4sQueueType): self
    {
        $self = clone $this;
        $self['l4sQueueType'] = $l4sQueueType;

        return $self;
    }

    /**
     * Specification of rate.
     *
     * @param Rate|RateShape $maxDownstreamBurstRate
     */
    public function withMaxDownstreamBurstRate(
        Rate|array $maxDownstreamBurstRate
    ): self {
        $self = clone $this;
        $self['maxDownstreamBurstRate'] = $maxDownstreamBurstRate;

        return $self;
    }

    /**
     * Specification of rate.
     *
     * @param Rate|RateShape $maxDownstreamRate
     */
    public function withMaxDownstreamRate(Rate|array $maxDownstreamRate): self
    {
        $self = clone $this;
        $self['maxDownstreamRate'] = $maxDownstreamRate;

        return $self;
    }

    /**
     * Specification of duration.
     *
     * @param Duration|DurationShape $maxDuration
     */
    public function withMaxDuration(Duration|array $maxDuration): self
    {
        $self = clone $this;
        $self['maxDuration'] = $maxDuration;

        return $self;
    }

    /**
     * Specification of rate.
     *
     * @param Rate|RateShape $maxUpstreamBurstRate
     */
    public function withMaxUpstreamBurstRate(
        Rate|array $maxUpstreamBurstRate
    ): self {
        $self = clone $this;
        $self['maxUpstreamBurstRate'] = $maxUpstreamBurstRate;

        return $self;
    }

    /**
     * Specification of rate.
     *
     * @param Rate|RateShape $maxUpstreamRate
     */
    public function withMaxUpstreamRate(Rate|array $maxUpstreamRate): self
    {
        $self = clone $this;
        $self['maxUpstreamRate'] = $maxUpstreamRate;

        return $self;
    }

    /**
     * Specification of duration.
     *
     * @param Duration|DurationShape $minDuration
     */
    public function withMinDuration(Duration|array $minDuration): self
    {
        $self = clone $this;
        $self['minDuration'] = $minDuration;

        return $self;
    }

    /**
     * Specification of duration.
     *
     * @param Duration|DurationShape $packetDelayBudget
     */
    public function withPacketDelayBudget(
        Duration|array $packetDelayBudget
    ): self {
        $self = clone $this;
        $self['packetDelayBudget'] = $packetDelayBudget;

        return $self;
    }

    /**
     * This field specifies the acceptable level of data loss during transmission.
     * The value is an exponent of 10, so a value of 3 means that up to 10⁻³, or 0.1%, of the
     * data packets may be lost. This setting is part of a broader system that categorizes
     * different types of network traffic (like phone calls, video streams, or data transfers)
     * to ensure they perform reliably on the network.
     */
    public function withPacketErrorLossRate(int $packetErrorLossRate): self
    {
        $self = clone $this;
        $self['packetErrorLossRate'] = $packetErrorLossRate;

        return $self;
    }

    /**
     * Priority levels allow efficient resource allocation and ensure optimal performance
     * for various services in each technology, with the highest priority traffic receiving
     * preferential treatment.
     * The lower value the higher priority.
     * Not all access networks use the same priority range, so this priority will be
     * scaled to the access network's priority range.
     */
    public function withPriority(int $priority): self
    {
        $self = clone $this;
        $self['priority'] = $priority;

        return $self;
    }

    /**
     * **NOTE**: serviceClass is experimental and could change or be removed in a future release.
     *
     * The name of a Service Class, representing a QoS Profile designed to provide optimized behavior for a specific application type. While DSCP values are commonly associated with Service Classes, their use may vary across network segments and may not be applied throughout the entire end-to-end QoS session. This aligns with the serviceClass concept used in HomeDevicesQoQ for consistent terminology.
     *
     * Service classes define specific QoS behaviors that map to DSCP (Differentiated Services Code Point) values or Microsoft QoS traffic types.
     *
     * The supported mappings are:
     * 1. Values aligned with the [RFC4594](https://datatracker.ietf.org/doc/html/rfc4594) guidelines for differentiated traffic classes.
     * 2. Microsoft [QOS_TRAFFIC_TYPE](https://learn.microsoft.com/en-us/windows/win32/api/qos2/ne-qos2-qos_traffic_type) values for Windows developers.
     *
     * **Supported Service Classes**:
     *
     * | Service Class Name    | DSCP Name | DSCP value (decimal) | DCSP value (binary) | Microsoft Value | Application Examples                                                 |
     * |-----------------------|-----------|----------------------|---------------------|-----------------|----------------------------------------------------------------------|
     * | Microsoft Voice       |    CS7    |          56          |        111000       |       4,5       | Microsoft QOSTrafficTypeVoice and QOSTrafficTypeControl              |
     * | Microsoft Audio/Video |    CS5    |          40          |        101000       |       2,3       | Microsoft QOSTrafficTypeExcellentEffort and QOSTrafficTypeAudioVideo |
     * | Real-Time Interactive |    CS4    |          32          |        100000       |                 | Video conferencing and Interactive gaming                            |
     * | Multimedia Streaming  |    AF31   |          26          |        011010       |                 | Streaming video and audio on demand                                  |
     * | Broadcast Video       |    CS3    |          24          |        011000       |                 | Broadcast TV & live events                                           |
     * | Low-Latency Data      |    AF21   |          18          |        010010       |                 | Client/server transactions Web-based ordering                        |
     * | High-Throughput Data  |    AF11   |          10          |        001010       |                 | Store and forward applications                                       |
     * | Low-Priority Data     |    CS1    |           8          |        001000       |        1        | Any flow that has no BW assurance - also:                            |
     * |                       |           |                      |                     |                 | Microsoft QOSTrafficTypeBackground                                   |
     * | Standard              |  DF(CS0)  |           0          |        000000       |        0        | Undifferentiated applications - also:                                |
     * |                       |           |                      |                     |                 | Microsoft QOSTrafficTypeBestEffort                                   |
     *
     * @param ServiceClass|value-of<ServiceClass> $serviceClass
     */
    public function withServiceClass(ServiceClass|string $serviceClass): self
    {
        $self = clone $this;
        $self['serviceClass'] = $serviceClass;

        return $self;
    }

    /**
     * Specification of rate.
     *
     * @param Rate|RateShape $targetMinDownstreamRate
     */
    public function withTargetMinDownstreamRate(
        Rate|array $targetMinDownstreamRate
    ): self {
        $self = clone $this;
        $self['targetMinDownstreamRate'] = $targetMinDownstreamRate;

        return $self;
    }

    /**
     * Specification of rate.
     *
     * @param Rate|RateShape $targetMinUpstreamRate
     */
    public function withTargetMinUpstreamRate(
        Rate|array $targetMinUpstreamRate
    ): self {
        $self = clone $this;
        $self['targetMinUpstreamRate'] = $targetMinUpstreamRate;

        return $self;
    }
}
