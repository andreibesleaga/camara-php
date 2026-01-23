<?php

declare(strict_types=1);

namespace Camara\Qualityondemand\QosProfile;

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
 */
enum ServiceClass: string
{
    case MICROSOFT_VOICE = 'microsoft_voice';

    case MICROSOFT_AUDIO_VIDEO = 'microsoft_audio_video';

    case REAL_TIME_INTERACTIVE = 'real_time_interactive';

    case MULTIMEDIA_STREAMING = 'multimedia_streaming';

    case BROADCAST_VIDEO = 'broadcast_video';

    case LOW_LATENCY_DATA = 'low_latency_data';

    case HIGH_THROUGHPUT_DATA = 'high_throughput_data';

    case LOW_PRIORITY_DATA = 'low_priority_data';

    case STANDARD = 'standard';
}
