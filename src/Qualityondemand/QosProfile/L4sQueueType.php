<?php

declare(strict_types=1);

namespace Camara\Qualityondemand\QosProfile;

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
 */
enum L4sQueueType: string
{
    case NON_L4S_QUEUE = 'non-l4s-queue';

    case L4S_QUEUE = 'l4s-queue';

    case MIXED_QUEUE = 'mixed-queue';
}
