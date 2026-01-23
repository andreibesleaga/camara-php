<?php

declare(strict_types=1);

namespace Camara\Connectednetworktype\Subscriptions\SubscriptionCreateParams;

use Camara\Connectednetworktype\Subscriptions\SubscriptionCreateParams\SinkCredential\CredentialType;
use Camara\Core\Attributes\Required;
use Camara\Core\Concerns\SdkModel;
use Camara\Core\Contracts\BaseModel;

/**
 * A sink credential provides authentication or authorization information necessary to enable delivery of events to a target.
 *
 * @phpstan-type SinkCredentialShape = array{
 *   credentialType: CredentialType|value-of<CredentialType>
 * }
 */
final class SinkCredential implements BaseModel
{
    /** @use SdkModel<SinkCredentialShape> */
    use SdkModel;

    /**
     * The type of the credential.
     * Note: Type of the credential - MUST be set to ACCESSTOKEN for now.
     *
     * @var value-of<CredentialType> $credentialType
     */
    #[Required(enum: CredentialType::class)]
    public string $credentialType;

    /**
     * `new SinkCredential()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * SinkCredential::with(credentialType: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new SinkCredential)->withCredentialType(...)
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
     * @param CredentialType|value-of<CredentialType> $credentialType
     */
    public static function with(CredentialType|string $credentialType): self
    {
        $self = new self;

        $self['credentialType'] = $credentialType;

        return $self;
    }

    /**
     * The type of the credential.
     * Note: Type of the credential - MUST be set to ACCESSTOKEN for now.
     *
     * @param CredentialType|value-of<CredentialType> $credentialType
     */
    public function withCredentialType(
        CredentialType|string $credentialType
    ): self {
        $self = clone $this;
        $self['credentialType'] = $credentialType;

        return $self;
    }
}
