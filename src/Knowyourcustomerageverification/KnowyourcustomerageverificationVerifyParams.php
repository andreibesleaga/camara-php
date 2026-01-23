<?php

declare(strict_types=1);

namespace Camara\Knowyourcustomerageverification;

use Camara\Core\Attributes\Optional;
use Camara\Core\Attributes\Required;
use Camara\Core\Concerns\SdkModel;
use Camara\Core\Concerns\SdkParams;
use Camara\Core\Contracts\BaseModel;

/**
 * Verify that the age of the subscriber associated with a phone number is equal to or greater than the specified age threshold value.
 *
 * As it is possible that the person holding the contract and the end-user of the subscription may not be the same, the endpoint also admits a list of optional properties to be included in the request to improve the identification. The response may optionally include the `identityMatchScore` property with a value that indicates how certain it is that the information returned relates to the person that the API Client is requesting. To increase the reliability of the information returned, the API Provider may include in the response the `verifiedStatus` property, indicating whether the identity information in its possession has been verified against an identification document legally accepted as an age verification document (Note). Note: Depending on the country, credit-check or other mechanism can be used instead of official identification for Age Verification. For details, please contact API Provider.
 *
 * If the API Client indicates request properties `includeContentLock` or `includeParentalControl` with value `true` and the API Provider implements this functionality, then the response will also include `contentLock` and `parentalControl` properties to indicate if the subscription has any kind of content filtering enabled. On the other hand, if the request properties are not included or the API Client specifies value `false`, then the response properties will not be returned. If the API Provider doesn't implement this functionality, request properties will be ignored and response properties won't be returned in any case.
 *
 * @see Camara\Services\KnowyourcustomerageverificationService::verify()
 *
 * @phpstan-type KnowyourcustomerageverificationVerifyParamsShape = array{
 *   ageThreshold: int,
 *   birthdate?: string|null,
 *   email?: string|null,
 *   familyName?: string|null,
 *   familyNameAtBirth?: string|null,
 *   givenName?: string|null,
 *   idDocument?: string|null,
 *   includeContentLock?: bool|null,
 *   includeParentalControl?: bool|null,
 *   middleNames?: string|null,
 *   name?: string|null,
 *   phoneNumber?: string|null,
 *   xCorrelator?: string|null,
 * }
 */
final class KnowyourcustomerageverificationVerifyParams implements BaseModel
{
    /** @use SdkModel<KnowyourcustomerageverificationVerifyParamsShape> */
    use SdkModel;
    use SdkParams;

    /**
     * The age to be verified. The indicated range is a global definition of maximum and minimum values allowed to be requested. It is important to note that this range might be more restrictive in some implementations due to local regulations of a country i.e. A country does not allow to request for an age under 18. This limitation must be informed during the onboarding process.
     */
    #[Required]
    public int $ageThreshold;

    /**
     * The birthdate of the customer, in RFC 3339 / ISO 8601 calendar date format (YYYY-MM-DD).
     */
    #[Optional]
    public ?string $birthdate;

    /**
     * Email address of the customer in the RFC specified format (local-part@domain).
     */
    #[Optional]
    public ?string $email;

    /**
     * Last name, family name, or surname of the customer.
     */
    #[Optional]
    public ?string $familyName;

    /**
     * Last/family/sur- name at birth of the customer.
     */
    #[Optional]
    public ?string $familyNameAtBirth;

    /**
     * First/given name or compound first/given name of the customer.
     */
    #[Optional]
    public ?string $givenName;

    /**
     * Id number associated to the official identity document in the country. It may contain alphanumeric characters.
     */
    #[Optional]
    public ?string $idDocument;

    /**
     * If this parameter is included in the request with value `true`, the response property `contentLock` will be returned. If it is not included or its value is `false`, the response property will not be returned.
     */
    #[Optional]
    public ?bool $includeContentLock;

    /**
     * If this parameter is included in the request with value `true`, the response property `parentalControl` will be returned. If it is not included or its value is `false`, the response property will not be returned.
     */
    #[Optional]
    public ?bool $includeParentalControl;

    /**
     * Middle name/s of the customer.
     */
    #[Optional]
    public ?string $middleNames;

    /**
     * Complete name of the customer, usually composed of first/given name and last/family/sur- name in a country.  Depending on the country, the order of first/give name and last/family/sur- name varies, and middle name could be included.  It can use givenName, middleNames, familyName and/or familyNameAtBirth. For example, in ESP, name+familyName; in NLD, it can be name+middleNames+familyName or name+middleNames+familyNameAtBirth, etc.
     */
    #[Optional]
    public ?string $name;

    /**
     * A public identifier addressing a telephone subscription. In mobile networks it corresponds to the MSISDN (Mobile Station International Subscriber Directory Number). In order to be globally unique it has to be formatted in international format, according to E.164 standard, prefixed with '+'.
     */
    #[Optional]
    public ?string $phoneNumber;

    #[Optional]
    public ?string $xCorrelator;

    /**
     * `new KnowyourcustomerageverificationVerifyParams()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * KnowyourcustomerageverificationVerifyParams::with(ageThreshold: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new KnowyourcustomerageverificationVerifyParams)->withAgeThreshold(...)
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
     */
    public static function with(
        int $ageThreshold,
        ?string $birthdate = null,
        ?string $email = null,
        ?string $familyName = null,
        ?string $familyNameAtBirth = null,
        ?string $givenName = null,
        ?string $idDocument = null,
        ?bool $includeContentLock = null,
        ?bool $includeParentalControl = null,
        ?string $middleNames = null,
        ?string $name = null,
        ?string $phoneNumber = null,
        ?string $xCorrelator = null,
    ): self {
        $self = new self;

        $self['ageThreshold'] = $ageThreshold;

        null !== $birthdate && $self['birthdate'] = $birthdate;
        null !== $email && $self['email'] = $email;
        null !== $familyName && $self['familyName'] = $familyName;
        null !== $familyNameAtBirth && $self['familyNameAtBirth'] = $familyNameAtBirth;
        null !== $givenName && $self['givenName'] = $givenName;
        null !== $idDocument && $self['idDocument'] = $idDocument;
        null !== $includeContentLock && $self['includeContentLock'] = $includeContentLock;
        null !== $includeParentalControl && $self['includeParentalControl'] = $includeParentalControl;
        null !== $middleNames && $self['middleNames'] = $middleNames;
        null !== $name && $self['name'] = $name;
        null !== $phoneNumber && $self['phoneNumber'] = $phoneNumber;
        null !== $xCorrelator && $self['xCorrelator'] = $xCorrelator;

        return $self;
    }

    /**
     * The age to be verified. The indicated range is a global definition of maximum and minimum values allowed to be requested. It is important to note that this range might be more restrictive in some implementations due to local regulations of a country i.e. A country does not allow to request for an age under 18. This limitation must be informed during the onboarding process.
     */
    public function withAgeThreshold(int $ageThreshold): self
    {
        $self = clone $this;
        $self['ageThreshold'] = $ageThreshold;

        return $self;
    }

    /**
     * The birthdate of the customer, in RFC 3339 / ISO 8601 calendar date format (YYYY-MM-DD).
     */
    public function withBirthdate(string $birthdate): self
    {
        $self = clone $this;
        $self['birthdate'] = $birthdate;

        return $self;
    }

    /**
     * Email address of the customer in the RFC specified format (local-part@domain).
     */
    public function withEmail(string $email): self
    {
        $self = clone $this;
        $self['email'] = $email;

        return $self;
    }

    /**
     * Last name, family name, or surname of the customer.
     */
    public function withFamilyName(string $familyName): self
    {
        $self = clone $this;
        $self['familyName'] = $familyName;

        return $self;
    }

    /**
     * Last/family/sur- name at birth of the customer.
     */
    public function withFamilyNameAtBirth(string $familyNameAtBirth): self
    {
        $self = clone $this;
        $self['familyNameAtBirth'] = $familyNameAtBirth;

        return $self;
    }

    /**
     * First/given name or compound first/given name of the customer.
     */
    public function withGivenName(string $givenName): self
    {
        $self = clone $this;
        $self['givenName'] = $givenName;

        return $self;
    }

    /**
     * Id number associated to the official identity document in the country. It may contain alphanumeric characters.
     */
    public function withIDDocument(string $idDocument): self
    {
        $self = clone $this;
        $self['idDocument'] = $idDocument;

        return $self;
    }

    /**
     * If this parameter is included in the request with value `true`, the response property `contentLock` will be returned. If it is not included or its value is `false`, the response property will not be returned.
     */
    public function withIncludeContentLock(bool $includeContentLock): self
    {
        $self = clone $this;
        $self['includeContentLock'] = $includeContentLock;

        return $self;
    }

    /**
     * If this parameter is included in the request with value `true`, the response property `parentalControl` will be returned. If it is not included or its value is `false`, the response property will not be returned.
     */
    public function withIncludeParentalControl(
        bool $includeParentalControl
    ): self {
        $self = clone $this;
        $self['includeParentalControl'] = $includeParentalControl;

        return $self;
    }

    /**
     * Middle name/s of the customer.
     */
    public function withMiddleNames(string $middleNames): self
    {
        $self = clone $this;
        $self['middleNames'] = $middleNames;

        return $self;
    }

    /**
     * Complete name of the customer, usually composed of first/given name and last/family/sur- name in a country.  Depending on the country, the order of first/give name and last/family/sur- name varies, and middle name could be included.  It can use givenName, middleNames, familyName and/or familyNameAtBirth. For example, in ESP, name+familyName; in NLD, it can be name+middleNames+familyName or name+middleNames+familyNameAtBirth, etc.
     */
    public function withName(string $name): self
    {
        $self = clone $this;
        $self['name'] = $name;

        return $self;
    }

    /**
     * A public identifier addressing a telephone subscription. In mobile networks it corresponds to the MSISDN (Mobile Station International Subscriber Directory Number). In order to be globally unique it has to be formatted in international format, according to E.164 standard, prefixed with '+'.
     */
    public function withPhoneNumber(string $phoneNumber): self
    {
        $self = clone $this;
        $self['phoneNumber'] = $phoneNumber;

        return $self;
    }

    public function withXCorrelator(string $xCorrelator): self
    {
        $self = clone $this;
        $self['xCorrelator'] = $xCorrelator;

        return $self;
    }
}
