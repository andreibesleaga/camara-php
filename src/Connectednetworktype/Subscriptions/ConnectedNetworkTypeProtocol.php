<?php

declare(strict_types=1);

namespace Camara\Connectednetworktype\Subscriptions;

/**
 * Identifier of a delivery protocol. Only HTTP is allowed for now.
 */
enum ConnectedNetworkTypeProtocol: string
{
    case HTTP = 'HTTP';

    case MQTT3 = 'MQTT3';

    case MQTT5 = 'MQTT5';

    case AMQP = 'AMQP';

    case NATS = 'NATS';

    case KAFKA = 'KAFKA';
}
