<?php

declare(strict_types=1);

namespace Camara\Knowyourcustomerageverification;

use Camara\Core\Attributes\Optional;
use Camara\Core\Attributes\Required;
use Camara\Core\Concerns\SdkModel;
use Camara\Core\Contracts\BaseModel;
use Camara\Knowyourcustomerageverification\KnowyourcustomerageverificationVerifyResponse\AgeCheck;
use Camara\Knowyourcustomerageverification\KnowyourcustomerageverificationVerifyResponse\ContentLock;
use Camara\Knowyourcustomerageverification\KnowyourcustomerageverificationVerifyResponse\ParentalControl;

/**
 * Response to an age verification request.
 *
 * @phpstan-type KnowyourcustomerageverificationVerifyResponseShape = array{
 *   ageCheck: AgeCheck|value-of<AgeCheck>,
 *   contentLock?: null|ContentLock|value-of<ContentLock>,
 *   identityMatchScore?: int|null,
 *   parentalControl?: null|ParentalControl|value-of<ParentalControl>,
 *   verifiedStatus?: bool|null,
 * }
 */
final class KnowyourcustomerageverificationVerifyResponse implements BaseModel
{
    /** @use SdkModel<KnowyourcustomerageverificationVerifyResponseShape> */
    use SdkModel;

    /**
     * Indicate `"true"` when the age of the user is the same age or older than the age threshold (age >= age threshold), and `"false"` if not (age < age threshold). If the API Provider doesn't have enough information to perform the validation, a `not_available` can be returned.
     *
     * @var value-of<AgeCheck> $ageCheck
     */
    #[Required(enum: AgeCheck::class)]
    public string $ageCheck;

    /**
     * Indicate `"true"` if the subscription associated with the phone number has any kind of content lock (i.e certain web content blocked) and `"false"` if not. If the information is not available the value `not_available` can be returned.
     *
     * @var value-of<ContentLock>|null $contentLock
     */
    #[Optional(enum: ContentLock::class)]
    public ?string $contentLock;

    /**
     * The overall score of identity information available in the API Provider, information either provided in the request body comparing it to the one that the API Provider holds or directly using internal API Provider's information. It is optional for the API Provider to return the Identity match score.
     */
    #[Optional]
    public ?int $identityMatchScore;

    /**
     * Indicate `"true"` if the subscription associated with the phone number has any kind of parental control activated and `"false"` if not. If the information is not available the value `not_available` can be returned.
     *
     * @var value-of<ParentalControl>|null $parentalControl
     */
    #[Optional(enum: ParentalControl::class)]
    public ?string $parentalControl;

    /**
     * Indicate `true` if the information provided has been compared against information based on an identification document legally accepted as an age verification document (Note), otherwise indicate `false`.  Note: Depending on the country, credit-check or other mechanism can be used instead of official identification for Age Verification. For details, please contact API Provider.
     */
    #[Optional]
    public ?bool $verifiedStatus;

    /**
     * `new KnowyourcustomerageverificationVerifyResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * KnowyourcustomerageverificationVerifyResponse::with(ageCheck: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new KnowyourcustomerageverificationVerifyResponse)->withAgeCheck(...)
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
     * @param AgeCheck|value-of<AgeCheck> $ageCheck
     * @param ContentLock|value-of<ContentLock>|null $contentLock
     * @param ParentalControl|value-of<ParentalControl>|null $parentalControl
     */
    public static function with(
        AgeCheck|string $ageCheck,
        ContentLock|string|null $contentLock = null,
        ?int $identityMatchScore = null,
        ParentalControl|string|null $parentalControl = null,
        ?bool $verifiedStatus = null,
    ): self {
        $self = new self;

        $self['ageCheck'] = $ageCheck;

        null !== $contentLock && $self['contentLock'] = $contentLock;
        null !== $identityMatchScore && $self['identityMatchScore'] = $identityMatchScore;
        null !== $parentalControl && $self['parentalControl'] = $parentalControl;
        null !== $verifiedStatus && $self['verifiedStatus'] = $verifiedStatus;

        return $self;
    }

    /**
     * Indicate `"true"` when the age of the user is the same age or older than the age threshold (age >= age threshold), and `"false"` if not (age < age threshold). If the API Provider doesn't have enough information to perform the validation, a `not_available` can be returned.
     *
     * @param AgeCheck|value-of<AgeCheck> $ageCheck
     */
    public function withAgeCheck(AgeCheck|string $ageCheck): self
    {
        $self = clone $this;
        $self['ageCheck'] = $ageCheck;

        return $self;
    }

    /**
     * Indicate `"true"` if the subscription associated with the phone number has any kind of content lock (i.e certain web content blocked) and `"false"` if not. If the information is not available the value `not_available` can be returned.
     *
     * @param ContentLock|value-of<ContentLock> $contentLock
     */
    public function withContentLock(ContentLock|string $contentLock): self
    {
        $self = clone $this;
        $self['contentLock'] = $contentLock;

        return $self;
    }

    /**
     * The overall score of identity information available in the API Provider, information either provided in the request body comparing it to the one that the API Provider holds or directly using internal API Provider's information. It is optional for the API Provider to return the Identity match score.
     */
    public function withIdentityMatchScore(int $identityMatchScore): self
    {
        $self = clone $this;
        $self['identityMatchScore'] = $identityMatchScore;

        return $self;
    }

    /**
     * Indicate `"true"` if the subscription associated with the phone number has any kind of parental control activated and `"false"` if not. If the information is not available the value `not_available` can be returned.
     *
     * @param ParentalControl|value-of<ParentalControl> $parentalControl
     */
    public function withParentalControl(
        ParentalControl|string $parentalControl
    ): self {
        $self = clone $this;
        $self['parentalControl'] = $parentalControl;

        return $self;
    }

    /**
     * Indicate `true` if the information provided has been compared against information based on an identification document legally accepted as an age verification document (Note), otherwise indicate `false`.  Note: Depending on the country, credit-check or other mechanism can be used instead of official identification for Age Verification. For details, please contact API Provider.
     */
    public function withVerifiedStatus(bool $verifiedStatus): self
    {
        $self = clone $this;
        $self['verifiedStatus'] = $verifiedStatus;

        return $self;
    }
}
