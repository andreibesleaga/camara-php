<?php

declare(strict_types=1);

namespace Camara\KnowyourcustomerfillIn;

use Camara\Core\Attributes\Optional;
use Camara\Core\Concerns\SdkModel;
use Camara\Core\Contracts\BaseModel;
use Camara\KnowyourcustomerfillIn\KnowyourcustomerfillInNewResponse\Gender;
use Camara\KnowyourcustomerfillIn\KnowyourcustomerfillInNewResponse\IDDocumentType;

/**
 * @phpstan-type KnowyourcustomerfillInNewResponseShape = array{
 *   address?: string|null,
 *   birthdate?: string|null,
 *   cityOfBirth?: string|null,
 *   country?: string|null,
 *   countryOfBirth?: string|null,
 *   email?: string|null,
 *   familyName?: string|null,
 *   familyNameAtBirth?: string|null,
 *   gender?: null|Gender|value-of<Gender>,
 *   givenName?: string|null,
 *   houseNumberExtension?: string|null,
 *   idDocument?: string|null,
 *   idDocumentExpiryDate?: string|null,
 *   idDocumentType?: null|IDDocumentType|value-of<IDDocumentType>,
 *   locality?: string|null,
 *   middleNames?: string|null,
 *   name?: string|null,
 *   nameKanaHankaku?: string|null,
 *   nameKanaZenkaku?: string|null,
 *   nationality?: string|null,
 *   phoneNumber?: string|null,
 *   postalCode?: string|null,
 *   region?: string|null,
 *   streetName?: string|null,
 *   streetNumber?: string|null,
 * }
 */
final class KnowyourcustomerfillInNewResponse implements BaseModel
{
    /** @use SdkModel<KnowyourcustomerfillInNewResponseShape> */
    use SdkModel;

    /**
     * Complete address of the customer stored on the Operator's system.  For some countries, it is built following the usual concatenation of parameters in a country, but for other countries, this is not the case.  For some countries, it can use streetName, streetNumber and/or houseNumberExtension. For example, in ESP, streetName+streetNumber; in NLD, it can be streetName+streetNumber or streetName+streetNumber+houseNumberExtension.
     */
    #[Optional]
    public ?string $address;

    /**
     * Birthdate of the customer, in ISO 8601 calendar date format (YYYY-MM-DD), stored on the Operator's system.
     */
    #[Optional]
    public ?string $birthdate;

    /**
     * City where the customer was born.
     */
    #[Optional]
    public ?string $cityOfBirth;

    /**
     * Country of the customer's address stored on the Operator's system. Format ISO 3166-1 alpha-2.
     */
    #[Optional]
    public ?string $country;

    /**
     * Country where the customer was born. Format ISO 3166-1 alpha-2.
     */
    #[Optional]
    public ?string $countryOfBirth;

    /**
     * Email address of the customer in the RFC specified format (local-part@domain), stored on the Operator's system.
     */
    #[Optional]
    public ?string $email;

    /**
     * Last name, family name, or surname of the customer stored on the Operator's system.
     */
    #[Optional]
    public ?string $familyName;

    /**
     * Last/family/sur- name at birth of the customer stored on the Operator's system.
     */
    #[Optional]
    public ?string $familyNameAtBirth;

    /**
     * Gender of the customer stored on the Operator's system (Male/Female/Other).
     *
     * @var value-of<Gender>|null $gender
     */
    #[Optional(enum: Gender::class)]
    public ?string $gender;

    /**
     * First/given name or compound first/given name of the customer on the Operator's system.
     */
    #[Optional]
    public ?string $givenName;

    /**
     * House number extension of the customer stored on the Operator's system.  Specific identifier of the house needed depending on the property type. For example, number of apartment in an apartment building.
     */
    #[Optional]
    public ?string $houseNumberExtension;

    /**
     * Id number associated to the id_document of the customer stored on the Operator's system.
     */
    #[Optional]
    public ?string $idDocument;

    /**
     * Expiration date of the identity document (ISO 8601).
     */
    #[Optional]
    public ?string $idDocumentExpiryDate;

    /**
     * Type of the official identity document provided.
     *
     * @var value-of<IDDocumentType>|null $idDocumentType
     */
    #[Optional(enum: IDDocumentType::class)]
    public ?string $idDocumentType;

    /**
     * Locality of the customer's address, stored on the Operator's system.
     */
    #[Optional]
    public ?string $locality;

    /**
     * Middle name/s of the customer stored on the Operator's system.
     */
    #[Optional]
    public ?string $middleNames;

    /**
     * Complete name of the customer stored on the Operator's system.  It is usually composed of first/given name and last/family/sur- name in a country.  Depending on the country, the order of first/give name and last/family/sur- name varies, and middle name could be included.  It can use givenName, middleNames, familyName and/or familyNameAtBirth. For example, in ESP, name+familyName; in NLD, it can be name+middleNames+familyName or name+middleNames+familyNameAtBirth, etc.
     */
    #[Optional]
    public ?string $name;

    /**
     * Complete name of the customer in Hankaku-Kana format (reading of name) for Japan, stored on the Operator's system.
     */
    #[Optional]
    public ?string $nameKanaHankaku;

    /**
     * Complete name of the customer in Zenkaku-Kana format (reading of name) for Japan, stored on the Operator's system.
     */
    #[Optional]
    public ?string $nameKanaZenkaku;

    /**
     * ISO 3166-1 alpha-2 code of the customer’s nationality. In the case a customer has more than one nationality, it is supposed to be the nationality related to the ID document provided in the match request.
     */
    #[Optional]
    public ?string $nationality;

    /**
     * A public identifier addressing a telephone subscription. In mobile networks it corresponds to the MSISDN (Mobile Station International Subscriber Directory Number). In order to be globally unique it has to be formatted in international format, according to E.164 standard, prefixed with '+'.
     */
    #[Optional]
    public ?string $phoneNumber;

    /**
     * The postal code or Zip code of the customer's address, stored on the Operator's system.
     */
    #[Optional]
    public ?string $postalCode;

    /**
     * Region/prefecture of the customer's address, stored on the Operator's system.
     */
    #[Optional]
    public ?string $region;

    /**
     * Name of the street of the customer's address on the Operator's system.  It should not include the type of the street.
     */
    #[Optional]
    public ?string $streetName;

    /**
     * The street number of the customer's address on the Operator's system.  Number identifying a specific property on the 'streetName'.
     */
    #[Optional]
    public ?string $streetNumber;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param Gender|value-of<Gender>|null $gender
     * @param IDDocumentType|value-of<IDDocumentType>|null $idDocumentType
     */
    public static function with(
        ?string $address = null,
        ?string $birthdate = null,
        ?string $cityOfBirth = null,
        ?string $country = null,
        ?string $countryOfBirth = null,
        ?string $email = null,
        ?string $familyName = null,
        ?string $familyNameAtBirth = null,
        Gender|string|null $gender = null,
        ?string $givenName = null,
        ?string $houseNumberExtension = null,
        ?string $idDocument = null,
        ?string $idDocumentExpiryDate = null,
        IDDocumentType|string|null $idDocumentType = null,
        ?string $locality = null,
        ?string $middleNames = null,
        ?string $name = null,
        ?string $nameKanaHankaku = null,
        ?string $nameKanaZenkaku = null,
        ?string $nationality = null,
        ?string $phoneNumber = null,
        ?string $postalCode = null,
        ?string $region = null,
        ?string $streetName = null,
        ?string $streetNumber = null,
    ): self {
        $self = new self;

        null !== $address && $self['address'] = $address;
        null !== $birthdate && $self['birthdate'] = $birthdate;
        null !== $cityOfBirth && $self['cityOfBirth'] = $cityOfBirth;
        null !== $country && $self['country'] = $country;
        null !== $countryOfBirth && $self['countryOfBirth'] = $countryOfBirth;
        null !== $email && $self['email'] = $email;
        null !== $familyName && $self['familyName'] = $familyName;
        null !== $familyNameAtBirth && $self['familyNameAtBirth'] = $familyNameAtBirth;
        null !== $gender && $self['gender'] = $gender;
        null !== $givenName && $self['givenName'] = $givenName;
        null !== $houseNumberExtension && $self['houseNumberExtension'] = $houseNumberExtension;
        null !== $idDocument && $self['idDocument'] = $idDocument;
        null !== $idDocumentExpiryDate && $self['idDocumentExpiryDate'] = $idDocumentExpiryDate;
        null !== $idDocumentType && $self['idDocumentType'] = $idDocumentType;
        null !== $locality && $self['locality'] = $locality;
        null !== $middleNames && $self['middleNames'] = $middleNames;
        null !== $name && $self['name'] = $name;
        null !== $nameKanaHankaku && $self['nameKanaHankaku'] = $nameKanaHankaku;
        null !== $nameKanaZenkaku && $self['nameKanaZenkaku'] = $nameKanaZenkaku;
        null !== $nationality && $self['nationality'] = $nationality;
        null !== $phoneNumber && $self['phoneNumber'] = $phoneNumber;
        null !== $postalCode && $self['postalCode'] = $postalCode;
        null !== $region && $self['region'] = $region;
        null !== $streetName && $self['streetName'] = $streetName;
        null !== $streetNumber && $self['streetNumber'] = $streetNumber;

        return $self;
    }

    /**
     * Complete address of the customer stored on the Operator's system.  For some countries, it is built following the usual concatenation of parameters in a country, but for other countries, this is not the case.  For some countries, it can use streetName, streetNumber and/or houseNumberExtension. For example, in ESP, streetName+streetNumber; in NLD, it can be streetName+streetNumber or streetName+streetNumber+houseNumberExtension.
     */
    public function withAddress(string $address): self
    {
        $self = clone $this;
        $self['address'] = $address;

        return $self;
    }

    /**
     * Birthdate of the customer, in ISO 8601 calendar date format (YYYY-MM-DD), stored on the Operator's system.
     */
    public function withBirthdate(string $birthdate): self
    {
        $self = clone $this;
        $self['birthdate'] = $birthdate;

        return $self;
    }

    /**
     * City where the customer was born.
     */
    public function withCityOfBirth(string $cityOfBirth): self
    {
        $self = clone $this;
        $self['cityOfBirth'] = $cityOfBirth;

        return $self;
    }

    /**
     * Country of the customer's address stored on the Operator's system. Format ISO 3166-1 alpha-2.
     */
    public function withCountry(string $country): self
    {
        $self = clone $this;
        $self['country'] = $country;

        return $self;
    }

    /**
     * Country where the customer was born. Format ISO 3166-1 alpha-2.
     */
    public function withCountryOfBirth(string $countryOfBirth): self
    {
        $self = clone $this;
        $self['countryOfBirth'] = $countryOfBirth;

        return $self;
    }

    /**
     * Email address of the customer in the RFC specified format (local-part@domain), stored on the Operator's system.
     */
    public function withEmail(string $email): self
    {
        $self = clone $this;
        $self['email'] = $email;

        return $self;
    }

    /**
     * Last name, family name, or surname of the customer stored on the Operator's system.
     */
    public function withFamilyName(string $familyName): self
    {
        $self = clone $this;
        $self['familyName'] = $familyName;

        return $self;
    }

    /**
     * Last/family/sur- name at birth of the customer stored on the Operator's system.
     */
    public function withFamilyNameAtBirth(string $familyNameAtBirth): self
    {
        $self = clone $this;
        $self['familyNameAtBirth'] = $familyNameAtBirth;

        return $self;
    }

    /**
     * Gender of the customer stored on the Operator's system (Male/Female/Other).
     *
     * @param Gender|value-of<Gender> $gender
     */
    public function withGender(Gender|string $gender): self
    {
        $self = clone $this;
        $self['gender'] = $gender;

        return $self;
    }

    /**
     * First/given name or compound first/given name of the customer on the Operator's system.
     */
    public function withGivenName(string $givenName): self
    {
        $self = clone $this;
        $self['givenName'] = $givenName;

        return $self;
    }

    /**
     * House number extension of the customer stored on the Operator's system.  Specific identifier of the house needed depending on the property type. For example, number of apartment in an apartment building.
     */
    public function withHouseNumberExtension(string $houseNumberExtension): self
    {
        $self = clone $this;
        $self['houseNumberExtension'] = $houseNumberExtension;

        return $self;
    }

    /**
     * Id number associated to the id_document of the customer stored on the Operator's system.
     */
    public function withIDDocument(string $idDocument): self
    {
        $self = clone $this;
        $self['idDocument'] = $idDocument;

        return $self;
    }

    /**
     * Expiration date of the identity document (ISO 8601).
     */
    public function withIDDocumentExpiryDate(string $idDocumentExpiryDate): self
    {
        $self = clone $this;
        $self['idDocumentExpiryDate'] = $idDocumentExpiryDate;

        return $self;
    }

    /**
     * Type of the official identity document provided.
     *
     * @param IDDocumentType|value-of<IDDocumentType> $idDocumentType
     */
    public function withIDDocumentType(
        IDDocumentType|string $idDocumentType
    ): self {
        $self = clone $this;
        $self['idDocumentType'] = $idDocumentType;

        return $self;
    }

    /**
     * Locality of the customer's address, stored on the Operator's system.
     */
    public function withLocality(string $locality): self
    {
        $self = clone $this;
        $self['locality'] = $locality;

        return $self;
    }

    /**
     * Middle name/s of the customer stored on the Operator's system.
     */
    public function withMiddleNames(string $middleNames): self
    {
        $self = clone $this;
        $self['middleNames'] = $middleNames;

        return $self;
    }

    /**
     * Complete name of the customer stored on the Operator's system.  It is usually composed of first/given name and last/family/sur- name in a country.  Depending on the country, the order of first/give name and last/family/sur- name varies, and middle name could be included.  It can use givenName, middleNames, familyName and/or familyNameAtBirth. For example, in ESP, name+familyName; in NLD, it can be name+middleNames+familyName or name+middleNames+familyNameAtBirth, etc.
     */
    public function withName(string $name): self
    {
        $self = clone $this;
        $self['name'] = $name;

        return $self;
    }

    /**
     * Complete name of the customer in Hankaku-Kana format (reading of name) for Japan, stored on the Operator's system.
     */
    public function withNameKanaHankaku(string $nameKanaHankaku): self
    {
        $self = clone $this;
        $self['nameKanaHankaku'] = $nameKanaHankaku;

        return $self;
    }

    /**
     * Complete name of the customer in Zenkaku-Kana format (reading of name) for Japan, stored on the Operator's system.
     */
    public function withNameKanaZenkaku(string $nameKanaZenkaku): self
    {
        $self = clone $this;
        $self['nameKanaZenkaku'] = $nameKanaZenkaku;

        return $self;
    }

    /**
     * ISO 3166-1 alpha-2 code of the customer’s nationality. In the case a customer has more than one nationality, it is supposed to be the nationality related to the ID document provided in the match request.
     */
    public function withNationality(string $nationality): self
    {
        $self = clone $this;
        $self['nationality'] = $nationality;

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

    /**
     * The postal code or Zip code of the customer's address, stored on the Operator's system.
     */
    public function withPostalCode(string $postalCode): self
    {
        $self = clone $this;
        $self['postalCode'] = $postalCode;

        return $self;
    }

    /**
     * Region/prefecture of the customer's address, stored on the Operator's system.
     */
    public function withRegion(string $region): self
    {
        $self = clone $this;
        $self['region'] = $region;

        return $self;
    }

    /**
     * Name of the street of the customer's address on the Operator's system.  It should not include the type of the street.
     */
    public function withStreetName(string $streetName): self
    {
        $self = clone $this;
        $self['streetName'] = $streetName;

        return $self;
    }

    /**
     * The street number of the customer's address on the Operator's system.  Number identifying a specific property on the 'streetName'.
     */
    public function withStreetNumber(string $streetNumber): self
    {
        $self = clone $this;
        $self['streetNumber'] = $streetNumber;

        return $self;
    }
}
