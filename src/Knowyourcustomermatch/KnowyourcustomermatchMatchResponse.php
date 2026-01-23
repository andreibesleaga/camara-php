<?php

declare(strict_types=1);

namespace Camara\Knowyourcustomermatch;

use Camara\Core\Attributes\Optional;
use Camara\Core\Concerns\SdkModel;
use Camara\Core\Contracts\BaseModel;

/**
 * @phpstan-type KnowyourcustomermatchMatchResponseShape = array{
 *   addressMatch?: null|MatchResult|value-of<MatchResult>,
 *   addressMatchScore?: int|null,
 *   birthdateMatch?: null|MatchResult|value-of<MatchResult>,
 *   cityOfBirthMatch?: null|MatchResult|value-of<MatchResult>,
 *   cityOfBirthMatchScore?: int|null,
 *   countryMatch?: null|MatchResult|value-of<MatchResult>,
 *   countryOfBirthMatch?: null|MatchResult|value-of<MatchResult>,
 *   emailMatch?: null|MatchResult|value-of<MatchResult>,
 *   emailMatchScore?: int|null,
 *   familyNameAtBirthMatch?: null|MatchResult|value-of<MatchResult>,
 *   familyNameAtBirthMatchScore?: int|null,
 *   familyNameMatch?: null|MatchResult|value-of<MatchResult>,
 *   familyNameMatchScore?: int|null,
 *   genderMatch?: null|MatchResult|value-of<MatchResult>,
 *   givenNameMatch?: null|MatchResult|value-of<MatchResult>,
 *   givenNameMatchScore?: int|null,
 *   houseNumberExtensionMatch?: null|MatchResult|value-of<MatchResult>,
 *   idDocumentExpiryDateMatch?: null|MatchResult|value-of<MatchResult>,
 *   idDocumentMatch?: null|MatchResult|value-of<MatchResult>,
 *   idDocumentTypeMatch?: null|MatchResult|value-of<MatchResult>,
 *   localityMatch?: null|MatchResult|value-of<MatchResult>,
 *   localityMatchScore?: int|null,
 *   middleNamesMatch?: null|MatchResult|value-of<MatchResult>,
 *   middleNamesMatchScore?: int|null,
 *   nameKanaHankakuMatch?: null|MatchResult|value-of<MatchResult>,
 *   nameKanaHankakuMatchScore?: int|null,
 *   nameKanaZenkakuMatch?: null|MatchResult|value-of<MatchResult>,
 *   nameKanaZenkakuMatchScore?: int|null,
 *   nameMatch?: null|MatchResult|value-of<MatchResult>,
 *   nameMatchScore?: int|null,
 *   nationalityMatch?: null|MatchResult|value-of<MatchResult>,
 *   postalCodeMatch?: null|MatchResult|value-of<MatchResult>,
 *   regionMatch?: null|MatchResult|value-of<MatchResult>,
 *   regionMatchScore?: int|null,
 *   streetNameMatch?: null|MatchResult|value-of<MatchResult>,
 *   streetNameMatchScore?: int|null,
 *   streetNumberMatch?: null|MatchResult|value-of<MatchResult>,
 *   streetNumberMatchScore?: int|null,
 * }
 */
final class KnowyourcustomermatchMatchResponse implements BaseModel
{
    /** @use SdkModel<KnowyourcustomermatchMatchResponseShape> */
    use SdkModel;

    /**
     * true -  the attribute provided matches with the one in the Operator systems, which is equal to a `match_score` of 100.
     * false - the attribute provided does not match with the one in the Operator systems.
     * not_available - the attribute is not available to validate.
     *
     * @var value-of<MatchResult>|null $addressMatch
     */
    #[Optional(enum: MatchResult::class)]
    public ?string $addressMatch;

    /**
     * Indicates the similarity score assigned to the input value when it does not exactly match the value stored in the operator's system.
     * This property shall only be returned when the value of the corresponding match field is `false`.
     * A perfect match with a score of 100 is indicated by `match` being 'true' and no `matchScore` is returned in this case.
     */
    #[Optional]
    public ?int $addressMatchScore;

    /**
     * true -  the attribute provided matches with the one in the Operator systems, which is equal to a `match_score` of 100.
     * false - the attribute provided does not match with the one in the Operator systems.
     * not_available - the attribute is not available to validate.
     *
     * @var value-of<MatchResult>|null $birthdateMatch
     */
    #[Optional(enum: MatchResult::class)]
    public ?string $birthdateMatch;

    /**
     * true -  the attribute provided matches with the one in the Operator systems, which is equal to a `match_score` of 100.
     * false - the attribute provided does not match with the one in the Operator systems.
     * not_available - the attribute is not available to validate.
     *
     * @var value-of<MatchResult>|null $cityOfBirthMatch
     */
    #[Optional(enum: MatchResult::class)]
    public ?string $cityOfBirthMatch;

    /**
     * Indicates the similarity score assigned to the input value when it does not exactly match the value stored in the operator's system.
     * This property shall only be returned when the value of the corresponding match field is `false`.
     * A perfect match with a score of 100 is indicated by `match` being 'true' and no `matchScore` is returned in this case.
     */
    #[Optional]
    public ?int $cityOfBirthMatchScore;

    /**
     * true -  the attribute provided matches with the one in the Operator systems, which is equal to a `match_score` of 100.
     * false - the attribute provided does not match with the one in the Operator systems.
     * not_available - the attribute is not available to validate.
     *
     * @var value-of<MatchResult>|null $countryMatch
     */
    #[Optional(enum: MatchResult::class)]
    public ?string $countryMatch;

    /**
     * true -  the attribute provided matches with the one in the Operator systems, which is equal to a `match_score` of 100.
     * false - the attribute provided does not match with the one in the Operator systems.
     * not_available - the attribute is not available to validate.
     *
     * @var value-of<MatchResult>|null $countryOfBirthMatch
     */
    #[Optional(enum: MatchResult::class)]
    public ?string $countryOfBirthMatch;

    /**
     * true -  the attribute provided matches with the one in the Operator systems, which is equal to a `match_score` of 100.
     * false - the attribute provided does not match with the one in the Operator systems.
     * not_available - the attribute is not available to validate.
     *
     * @var value-of<MatchResult>|null $emailMatch
     */
    #[Optional(enum: MatchResult::class)]
    public ?string $emailMatch;

    /**
     * Indicates the similarity score assigned to the input value when it does not exactly match the value stored in the operator's system.
     * This property shall only be returned when the value of the corresponding match field is `false`.
     * A perfect match with a score of 100 is indicated by `match` being 'true' and no `matchScore` is returned in this case.
     */
    #[Optional]
    public ?int $emailMatchScore;

    /**
     * true -  the attribute provided matches with the one in the Operator systems, which is equal to a `match_score` of 100.
     * false - the attribute provided does not match with the one in the Operator systems.
     * not_available - the attribute is not available to validate.
     *
     * @var value-of<MatchResult>|null $familyNameAtBirthMatch
     */
    #[Optional(enum: MatchResult::class)]
    public ?string $familyNameAtBirthMatch;

    /**
     * Indicates the similarity score assigned to the input value when it does not exactly match the value stored in the operator's system.
     * This property shall only be returned when the value of the corresponding match field is `false`.
     * A perfect match with a score of 100 is indicated by `match` being 'true' and no `matchScore` is returned in this case.
     */
    #[Optional]
    public ?int $familyNameAtBirthMatchScore;

    /**
     * true -  the attribute provided matches with the one in the Operator systems, which is equal to a `match_score` of 100.
     * false - the attribute provided does not match with the one in the Operator systems.
     * not_available - the attribute is not available to validate.
     *
     * @var value-of<MatchResult>|null $familyNameMatch
     */
    #[Optional(enum: MatchResult::class)]
    public ?string $familyNameMatch;

    /**
     * Indicates the similarity score assigned to the input value when it does not exactly match the value stored in the operator's system.
     * This property shall only be returned when the value of the corresponding match field is `false`.
     * A perfect match with a score of 100 is indicated by `match` being 'true' and no `matchScore` is returned in this case.
     */
    #[Optional]
    public ?int $familyNameMatchScore;

    /**
     * true -  the attribute provided matches with the one in the Operator systems, which is equal to a `match_score` of 100.
     * false - the attribute provided does not match with the one in the Operator systems.
     * not_available - the attribute is not available to validate.
     *
     * @var value-of<MatchResult>|null $genderMatch
     */
    #[Optional(enum: MatchResult::class)]
    public ?string $genderMatch;

    /**
     * true -  the attribute provided matches with the one in the Operator systems, which is equal to a `match_score` of 100.
     * false - the attribute provided does not match with the one in the Operator systems.
     * not_available - the attribute is not available to validate.
     *
     * @var value-of<MatchResult>|null $givenNameMatch
     */
    #[Optional(enum: MatchResult::class)]
    public ?string $givenNameMatch;

    /**
     * Indicates the similarity score assigned to the input value when it does not exactly match the value stored in the operator's system.
     * This property shall only be returned when the value of the corresponding match field is `false`.
     * A perfect match with a score of 100 is indicated by `match` being 'true' and no `matchScore` is returned in this case.
     */
    #[Optional]
    public ?int $givenNameMatchScore;

    /**
     * true -  the attribute provided matches with the one in the Operator systems, which is equal to a `match_score` of 100.
     * false - the attribute provided does not match with the one in the Operator systems.
     * not_available - the attribute is not available to validate.
     *
     * @var value-of<MatchResult>|null $houseNumberExtensionMatch
     */
    #[Optional(enum: MatchResult::class)]
    public ?string $houseNumberExtensionMatch;

    /**
     * true -  the attribute provided matches with the one in the Operator systems, which is equal to a `match_score` of 100.
     * false - the attribute provided does not match with the one in the Operator systems.
     * not_available - the attribute is not available to validate.
     *
     * @var value-of<MatchResult>|null $idDocumentExpiryDateMatch
     */
    #[Optional(enum: MatchResult::class)]
    public ?string $idDocumentExpiryDateMatch;

    /**
     * true -  the attribute provided matches with the one in the Operator systems, which is equal to a `match_score` of 100.
     * false - the attribute provided does not match with the one in the Operator systems.
     * not_available - the attribute is not available to validate.
     *
     * @var value-of<MatchResult>|null $idDocumentMatch
     */
    #[Optional(enum: MatchResult::class)]
    public ?string $idDocumentMatch;

    /**
     * true -  the attribute provided matches with the one in the Operator systems, which is equal to a `match_score` of 100.
     * false - the attribute provided does not match with the one in the Operator systems.
     * not_available - the attribute is not available to validate.
     *
     * @var value-of<MatchResult>|null $idDocumentTypeMatch
     */
    #[Optional(enum: MatchResult::class)]
    public ?string $idDocumentTypeMatch;

    /**
     * true -  the attribute provided matches with the one in the Operator systems, which is equal to a `match_score` of 100.
     * false - the attribute provided does not match with the one in the Operator systems.
     * not_available - the attribute is not available to validate.
     *
     * @var value-of<MatchResult>|null $localityMatch
     */
    #[Optional(enum: MatchResult::class)]
    public ?string $localityMatch;

    /**
     * Indicates the similarity score assigned to the input value when it does not exactly match the value stored in the operator's system.
     * This property shall only be returned when the value of the corresponding match field is `false`.
     * A perfect match with a score of 100 is indicated by `match` being 'true' and no `matchScore` is returned in this case.
     */
    #[Optional]
    public ?int $localityMatchScore;

    /**
     * true -  the attribute provided matches with the one in the Operator systems, which is equal to a `match_score` of 100.
     * false - the attribute provided does not match with the one in the Operator systems.
     * not_available - the attribute is not available to validate.
     *
     * @var value-of<MatchResult>|null $middleNamesMatch
     */
    #[Optional(enum: MatchResult::class)]
    public ?string $middleNamesMatch;

    /**
     * Indicates the similarity score assigned to the input value when it does not exactly match the value stored in the operator's system.
     * This property shall only be returned when the value of the corresponding match field is `false`.
     * A perfect match with a score of 100 is indicated by `match` being 'true' and no `matchScore` is returned in this case.
     */
    #[Optional]
    public ?int $middleNamesMatchScore;

    /**
     * true -  the attribute provided matches with the one in the Operator systems, which is equal to a `match_score` of 100.
     * false - the attribute provided does not match with the one in the Operator systems.
     * not_available - the attribute is not available to validate.
     *
     * @var value-of<MatchResult>|null $nameKanaHankakuMatch
     */
    #[Optional(enum: MatchResult::class)]
    public ?string $nameKanaHankakuMatch;

    /**
     * Indicates the similarity score assigned to the input value when it does not exactly match the value stored in the operator's system.
     * This property shall only be returned when the value of the corresponding match field is `false`.
     * A perfect match with a score of 100 is indicated by `match` being 'true' and no `matchScore` is returned in this case.
     */
    #[Optional]
    public ?int $nameKanaHankakuMatchScore;

    /**
     * true -  the attribute provided matches with the one in the Operator systems, which is equal to a `match_score` of 100.
     * false - the attribute provided does not match with the one in the Operator systems.
     * not_available - the attribute is not available to validate.
     *
     * @var value-of<MatchResult>|null $nameKanaZenkakuMatch
     */
    #[Optional(enum: MatchResult::class)]
    public ?string $nameKanaZenkakuMatch;

    /**
     * Indicates the similarity score assigned to the input value when it does not exactly match the value stored in the operator's system.
     * This property shall only be returned when the value of the corresponding match field is `false`.
     * A perfect match with a score of 100 is indicated by `match` being 'true' and no `matchScore` is returned in this case.
     */
    #[Optional]
    public ?int $nameKanaZenkakuMatchScore;

    /**
     * true -  the attribute provided matches with the one in the Operator systems, which is equal to a `match_score` of 100.
     * false - the attribute provided does not match with the one in the Operator systems.
     * not_available - the attribute is not available to validate.
     *
     * @var value-of<MatchResult>|null $nameMatch
     */
    #[Optional(enum: MatchResult::class)]
    public ?string $nameMatch;

    /**
     * Indicates the similarity score assigned to the input value when it does not exactly match the value stored in the operator's system.
     * This property shall only be returned when the value of the corresponding match field is `false`.
     * A perfect match with a score of 100 is indicated by `match` being 'true' and no `matchScore` is returned in this case.
     */
    #[Optional]
    public ?int $nameMatchScore;

    /**
     * true -  the attribute provided matches with the one in the Operator systems, which is equal to a `match_score` of 100.
     * false - the attribute provided does not match with the one in the Operator systems.
     * not_available - the attribute is not available to validate.
     *
     * @var value-of<MatchResult>|null $nationalityMatch
     */
    #[Optional(enum: MatchResult::class)]
    public ?string $nationalityMatch;

    /**
     * true -  the attribute provided matches with the one in the Operator systems, which is equal to a `match_score` of 100.
     * false - the attribute provided does not match with the one in the Operator systems.
     * not_available - the attribute is not available to validate.
     *
     * @var value-of<MatchResult>|null $postalCodeMatch
     */
    #[Optional(enum: MatchResult::class)]
    public ?string $postalCodeMatch;

    /**
     * true -  the attribute provided matches with the one in the Operator systems, which is equal to a `match_score` of 100.
     * false - the attribute provided does not match with the one in the Operator systems.
     * not_available - the attribute is not available to validate.
     *
     * @var value-of<MatchResult>|null $regionMatch
     */
    #[Optional(enum: MatchResult::class)]
    public ?string $regionMatch;

    /**
     * Indicates the similarity score assigned to the input value when it does not exactly match the value stored in the operator's system.
     * This property shall only be returned when the value of the corresponding match field is `false`.
     * A perfect match with a score of 100 is indicated by `match` being 'true' and no `matchScore` is returned in this case.
     */
    #[Optional]
    public ?int $regionMatchScore;

    /**
     * true -  the attribute provided matches with the one in the Operator systems, which is equal to a `match_score` of 100.
     * false - the attribute provided does not match with the one in the Operator systems.
     * not_available - the attribute is not available to validate.
     *
     * @var value-of<MatchResult>|null $streetNameMatch
     */
    #[Optional(enum: MatchResult::class)]
    public ?string $streetNameMatch;

    /**
     * Indicates the similarity score assigned to the input value when it does not exactly match the value stored in the operator's system.
     * This property shall only be returned when the value of the corresponding match field is `false`.
     * A perfect match with a score of 100 is indicated by `match` being 'true' and no `matchScore` is returned in this case.
     */
    #[Optional]
    public ?int $streetNameMatchScore;

    /**
     * true -  the attribute provided matches with the one in the Operator systems, which is equal to a `match_score` of 100.
     * false - the attribute provided does not match with the one in the Operator systems.
     * not_available - the attribute is not available to validate.
     *
     * @var value-of<MatchResult>|null $streetNumberMatch
     */
    #[Optional(enum: MatchResult::class)]
    public ?string $streetNumberMatch;

    /**
     * Indicates the similarity score assigned to the input value when it does not exactly match the value stored in the operator's system.
     * This property shall only be returned when the value of the corresponding match field is `false`.
     * A perfect match with a score of 100 is indicated by `match` being 'true' and no `matchScore` is returned in this case.
     */
    #[Optional]
    public ?int $streetNumberMatchScore;

    public function __construct()
    {
        $this->initialize();
    }

    /**
     * Construct an instance from the required parameters.
     *
     * You must use named parameters to construct any parameters with a default value.
     *
     * @param MatchResult|value-of<MatchResult>|null $addressMatch
     * @param MatchResult|value-of<MatchResult>|null $birthdateMatch
     * @param MatchResult|value-of<MatchResult>|null $cityOfBirthMatch
     * @param MatchResult|value-of<MatchResult>|null $countryMatch
     * @param MatchResult|value-of<MatchResult>|null $countryOfBirthMatch
     * @param MatchResult|value-of<MatchResult>|null $emailMatch
     * @param MatchResult|value-of<MatchResult>|null $familyNameAtBirthMatch
     * @param MatchResult|value-of<MatchResult>|null $familyNameMatch
     * @param MatchResult|value-of<MatchResult>|null $genderMatch
     * @param MatchResult|value-of<MatchResult>|null $givenNameMatch
     * @param MatchResult|value-of<MatchResult>|null $houseNumberExtensionMatch
     * @param MatchResult|value-of<MatchResult>|null $idDocumentExpiryDateMatch
     * @param MatchResult|value-of<MatchResult>|null $idDocumentMatch
     * @param MatchResult|value-of<MatchResult>|null $idDocumentTypeMatch
     * @param MatchResult|value-of<MatchResult>|null $localityMatch
     * @param MatchResult|value-of<MatchResult>|null $middleNamesMatch
     * @param MatchResult|value-of<MatchResult>|null $nameKanaHankakuMatch
     * @param MatchResult|value-of<MatchResult>|null $nameKanaZenkakuMatch
     * @param MatchResult|value-of<MatchResult>|null $nameMatch
     * @param MatchResult|value-of<MatchResult>|null $nationalityMatch
     * @param MatchResult|value-of<MatchResult>|null $postalCodeMatch
     * @param MatchResult|value-of<MatchResult>|null $regionMatch
     * @param MatchResult|value-of<MatchResult>|null $streetNameMatch
     * @param MatchResult|value-of<MatchResult>|null $streetNumberMatch
     */
    public static function with(
        MatchResult|string|null $addressMatch = null,
        ?int $addressMatchScore = null,
        MatchResult|string|null $birthdateMatch = null,
        MatchResult|string|null $cityOfBirthMatch = null,
        ?int $cityOfBirthMatchScore = null,
        MatchResult|string|null $countryMatch = null,
        MatchResult|string|null $countryOfBirthMatch = null,
        MatchResult|string|null $emailMatch = null,
        ?int $emailMatchScore = null,
        MatchResult|string|null $familyNameAtBirthMatch = null,
        ?int $familyNameAtBirthMatchScore = null,
        MatchResult|string|null $familyNameMatch = null,
        ?int $familyNameMatchScore = null,
        MatchResult|string|null $genderMatch = null,
        MatchResult|string|null $givenNameMatch = null,
        ?int $givenNameMatchScore = null,
        MatchResult|string|null $houseNumberExtensionMatch = null,
        MatchResult|string|null $idDocumentExpiryDateMatch = null,
        MatchResult|string|null $idDocumentMatch = null,
        MatchResult|string|null $idDocumentTypeMatch = null,
        MatchResult|string|null $localityMatch = null,
        ?int $localityMatchScore = null,
        MatchResult|string|null $middleNamesMatch = null,
        ?int $middleNamesMatchScore = null,
        MatchResult|string|null $nameKanaHankakuMatch = null,
        ?int $nameKanaHankakuMatchScore = null,
        MatchResult|string|null $nameKanaZenkakuMatch = null,
        ?int $nameKanaZenkakuMatchScore = null,
        MatchResult|string|null $nameMatch = null,
        ?int $nameMatchScore = null,
        MatchResult|string|null $nationalityMatch = null,
        MatchResult|string|null $postalCodeMatch = null,
        MatchResult|string|null $regionMatch = null,
        ?int $regionMatchScore = null,
        MatchResult|string|null $streetNameMatch = null,
        ?int $streetNameMatchScore = null,
        MatchResult|string|null $streetNumberMatch = null,
        ?int $streetNumberMatchScore = null,
    ): self {
        $self = new self;

        null !== $addressMatch && $self['addressMatch'] = $addressMatch;
        null !== $addressMatchScore && $self['addressMatchScore'] = $addressMatchScore;
        null !== $birthdateMatch && $self['birthdateMatch'] = $birthdateMatch;
        null !== $cityOfBirthMatch && $self['cityOfBirthMatch'] = $cityOfBirthMatch;
        null !== $cityOfBirthMatchScore && $self['cityOfBirthMatchScore'] = $cityOfBirthMatchScore;
        null !== $countryMatch && $self['countryMatch'] = $countryMatch;
        null !== $countryOfBirthMatch && $self['countryOfBirthMatch'] = $countryOfBirthMatch;
        null !== $emailMatch && $self['emailMatch'] = $emailMatch;
        null !== $emailMatchScore && $self['emailMatchScore'] = $emailMatchScore;
        null !== $familyNameAtBirthMatch && $self['familyNameAtBirthMatch'] = $familyNameAtBirthMatch;
        null !== $familyNameAtBirthMatchScore && $self['familyNameAtBirthMatchScore'] = $familyNameAtBirthMatchScore;
        null !== $familyNameMatch && $self['familyNameMatch'] = $familyNameMatch;
        null !== $familyNameMatchScore && $self['familyNameMatchScore'] = $familyNameMatchScore;
        null !== $genderMatch && $self['genderMatch'] = $genderMatch;
        null !== $givenNameMatch && $self['givenNameMatch'] = $givenNameMatch;
        null !== $givenNameMatchScore && $self['givenNameMatchScore'] = $givenNameMatchScore;
        null !== $houseNumberExtensionMatch && $self['houseNumberExtensionMatch'] = $houseNumberExtensionMatch;
        null !== $idDocumentExpiryDateMatch && $self['idDocumentExpiryDateMatch'] = $idDocumentExpiryDateMatch;
        null !== $idDocumentMatch && $self['idDocumentMatch'] = $idDocumentMatch;
        null !== $idDocumentTypeMatch && $self['idDocumentTypeMatch'] = $idDocumentTypeMatch;
        null !== $localityMatch && $self['localityMatch'] = $localityMatch;
        null !== $localityMatchScore && $self['localityMatchScore'] = $localityMatchScore;
        null !== $middleNamesMatch && $self['middleNamesMatch'] = $middleNamesMatch;
        null !== $middleNamesMatchScore && $self['middleNamesMatchScore'] = $middleNamesMatchScore;
        null !== $nameKanaHankakuMatch && $self['nameKanaHankakuMatch'] = $nameKanaHankakuMatch;
        null !== $nameKanaHankakuMatchScore && $self['nameKanaHankakuMatchScore'] = $nameKanaHankakuMatchScore;
        null !== $nameKanaZenkakuMatch && $self['nameKanaZenkakuMatch'] = $nameKanaZenkakuMatch;
        null !== $nameKanaZenkakuMatchScore && $self['nameKanaZenkakuMatchScore'] = $nameKanaZenkakuMatchScore;
        null !== $nameMatch && $self['nameMatch'] = $nameMatch;
        null !== $nameMatchScore && $self['nameMatchScore'] = $nameMatchScore;
        null !== $nationalityMatch && $self['nationalityMatch'] = $nationalityMatch;
        null !== $postalCodeMatch && $self['postalCodeMatch'] = $postalCodeMatch;
        null !== $regionMatch && $self['regionMatch'] = $regionMatch;
        null !== $regionMatchScore && $self['regionMatchScore'] = $regionMatchScore;
        null !== $streetNameMatch && $self['streetNameMatch'] = $streetNameMatch;
        null !== $streetNameMatchScore && $self['streetNameMatchScore'] = $streetNameMatchScore;
        null !== $streetNumberMatch && $self['streetNumberMatch'] = $streetNumberMatch;
        null !== $streetNumberMatchScore && $self['streetNumberMatchScore'] = $streetNumberMatchScore;

        return $self;
    }

    /**
     * true -  the attribute provided matches with the one in the Operator systems, which is equal to a `match_score` of 100.
     * false - the attribute provided does not match with the one in the Operator systems.
     * not_available - the attribute is not available to validate.
     *
     * @param MatchResult|value-of<MatchResult> $addressMatch
     */
    public function withAddressMatch(MatchResult|string $addressMatch): self
    {
        $self = clone $this;
        $self['addressMatch'] = $addressMatch;

        return $self;
    }

    /**
     * Indicates the similarity score assigned to the input value when it does not exactly match the value stored in the operator's system.
     * This property shall only be returned when the value of the corresponding match field is `false`.
     * A perfect match with a score of 100 is indicated by `match` being 'true' and no `matchScore` is returned in this case.
     */
    public function withAddressMatchScore(int $addressMatchScore): self
    {
        $self = clone $this;
        $self['addressMatchScore'] = $addressMatchScore;

        return $self;
    }

    /**
     * true -  the attribute provided matches with the one in the Operator systems, which is equal to a `match_score` of 100.
     * false - the attribute provided does not match with the one in the Operator systems.
     * not_available - the attribute is not available to validate.
     *
     * @param MatchResult|value-of<MatchResult> $birthdateMatch
     */
    public function withBirthdateMatch(MatchResult|string $birthdateMatch): self
    {
        $self = clone $this;
        $self['birthdateMatch'] = $birthdateMatch;

        return $self;
    }

    /**
     * true -  the attribute provided matches with the one in the Operator systems, which is equal to a `match_score` of 100.
     * false - the attribute provided does not match with the one in the Operator systems.
     * not_available - the attribute is not available to validate.
     *
     * @param MatchResult|value-of<MatchResult> $cityOfBirthMatch
     */
    public function withCityOfBirthMatch(
        MatchResult|string $cityOfBirthMatch
    ): self {
        $self = clone $this;
        $self['cityOfBirthMatch'] = $cityOfBirthMatch;

        return $self;
    }

    /**
     * Indicates the similarity score assigned to the input value when it does not exactly match the value stored in the operator's system.
     * This property shall only be returned when the value of the corresponding match field is `false`.
     * A perfect match with a score of 100 is indicated by `match` being 'true' and no `matchScore` is returned in this case.
     */
    public function withCityOfBirthMatchScore(int $cityOfBirthMatchScore): self
    {
        $self = clone $this;
        $self['cityOfBirthMatchScore'] = $cityOfBirthMatchScore;

        return $self;
    }

    /**
     * true -  the attribute provided matches with the one in the Operator systems, which is equal to a `match_score` of 100.
     * false - the attribute provided does not match with the one in the Operator systems.
     * not_available - the attribute is not available to validate.
     *
     * @param MatchResult|value-of<MatchResult> $countryMatch
     */
    public function withCountryMatch(MatchResult|string $countryMatch): self
    {
        $self = clone $this;
        $self['countryMatch'] = $countryMatch;

        return $self;
    }

    /**
     * true -  the attribute provided matches with the one in the Operator systems, which is equal to a `match_score` of 100.
     * false - the attribute provided does not match with the one in the Operator systems.
     * not_available - the attribute is not available to validate.
     *
     * @param MatchResult|value-of<MatchResult> $countryOfBirthMatch
     */
    public function withCountryOfBirthMatch(
        MatchResult|string $countryOfBirthMatch
    ): self {
        $self = clone $this;
        $self['countryOfBirthMatch'] = $countryOfBirthMatch;

        return $self;
    }

    /**
     * true -  the attribute provided matches with the one in the Operator systems, which is equal to a `match_score` of 100.
     * false - the attribute provided does not match with the one in the Operator systems.
     * not_available - the attribute is not available to validate.
     *
     * @param MatchResult|value-of<MatchResult> $emailMatch
     */
    public function withEmailMatch(MatchResult|string $emailMatch): self
    {
        $self = clone $this;
        $self['emailMatch'] = $emailMatch;

        return $self;
    }

    /**
     * Indicates the similarity score assigned to the input value when it does not exactly match the value stored in the operator's system.
     * This property shall only be returned when the value of the corresponding match field is `false`.
     * A perfect match with a score of 100 is indicated by `match` being 'true' and no `matchScore` is returned in this case.
     */
    public function withEmailMatchScore(int $emailMatchScore): self
    {
        $self = clone $this;
        $self['emailMatchScore'] = $emailMatchScore;

        return $self;
    }

    /**
     * true -  the attribute provided matches with the one in the Operator systems, which is equal to a `match_score` of 100.
     * false - the attribute provided does not match with the one in the Operator systems.
     * not_available - the attribute is not available to validate.
     *
     * @param MatchResult|value-of<MatchResult> $familyNameAtBirthMatch
     */
    public function withFamilyNameAtBirthMatch(
        MatchResult|string $familyNameAtBirthMatch
    ): self {
        $self = clone $this;
        $self['familyNameAtBirthMatch'] = $familyNameAtBirthMatch;

        return $self;
    }

    /**
     * Indicates the similarity score assigned to the input value when it does not exactly match the value stored in the operator's system.
     * This property shall only be returned when the value of the corresponding match field is `false`.
     * A perfect match with a score of 100 is indicated by `match` being 'true' and no `matchScore` is returned in this case.
     */
    public function withFamilyNameAtBirthMatchScore(
        int $familyNameAtBirthMatchScore
    ): self {
        $self = clone $this;
        $self['familyNameAtBirthMatchScore'] = $familyNameAtBirthMatchScore;

        return $self;
    }

    /**
     * true -  the attribute provided matches with the one in the Operator systems, which is equal to a `match_score` of 100.
     * false - the attribute provided does not match with the one in the Operator systems.
     * not_available - the attribute is not available to validate.
     *
     * @param MatchResult|value-of<MatchResult> $familyNameMatch
     */
    public function withFamilyNameMatch(
        MatchResult|string $familyNameMatch
    ): self {
        $self = clone $this;
        $self['familyNameMatch'] = $familyNameMatch;

        return $self;
    }

    /**
     * Indicates the similarity score assigned to the input value when it does not exactly match the value stored in the operator's system.
     * This property shall only be returned when the value of the corresponding match field is `false`.
     * A perfect match with a score of 100 is indicated by `match` being 'true' and no `matchScore` is returned in this case.
     */
    public function withFamilyNameMatchScore(int $familyNameMatchScore): self
    {
        $self = clone $this;
        $self['familyNameMatchScore'] = $familyNameMatchScore;

        return $self;
    }

    /**
     * true -  the attribute provided matches with the one in the Operator systems, which is equal to a `match_score` of 100.
     * false - the attribute provided does not match with the one in the Operator systems.
     * not_available - the attribute is not available to validate.
     *
     * @param MatchResult|value-of<MatchResult> $genderMatch
     */
    public function withGenderMatch(MatchResult|string $genderMatch): self
    {
        $self = clone $this;
        $self['genderMatch'] = $genderMatch;

        return $self;
    }

    /**
     * true -  the attribute provided matches with the one in the Operator systems, which is equal to a `match_score` of 100.
     * false - the attribute provided does not match with the one in the Operator systems.
     * not_available - the attribute is not available to validate.
     *
     * @param MatchResult|value-of<MatchResult> $givenNameMatch
     */
    public function withGivenNameMatch(MatchResult|string $givenNameMatch): self
    {
        $self = clone $this;
        $self['givenNameMatch'] = $givenNameMatch;

        return $self;
    }

    /**
     * Indicates the similarity score assigned to the input value when it does not exactly match the value stored in the operator's system.
     * This property shall only be returned when the value of the corresponding match field is `false`.
     * A perfect match with a score of 100 is indicated by `match` being 'true' and no `matchScore` is returned in this case.
     */
    public function withGivenNameMatchScore(int $givenNameMatchScore): self
    {
        $self = clone $this;
        $self['givenNameMatchScore'] = $givenNameMatchScore;

        return $self;
    }

    /**
     * true -  the attribute provided matches with the one in the Operator systems, which is equal to a `match_score` of 100.
     * false - the attribute provided does not match with the one in the Operator systems.
     * not_available - the attribute is not available to validate.
     *
     * @param MatchResult|value-of<MatchResult> $houseNumberExtensionMatch
     */
    public function withHouseNumberExtensionMatch(
        MatchResult|string $houseNumberExtensionMatch
    ): self {
        $self = clone $this;
        $self['houseNumberExtensionMatch'] = $houseNumberExtensionMatch;

        return $self;
    }

    /**
     * true -  the attribute provided matches with the one in the Operator systems, which is equal to a `match_score` of 100.
     * false - the attribute provided does not match with the one in the Operator systems.
     * not_available - the attribute is not available to validate.
     *
     * @param MatchResult|value-of<MatchResult> $idDocumentExpiryDateMatch
     */
    public function withIDDocumentExpiryDateMatch(
        MatchResult|string $idDocumentExpiryDateMatch
    ): self {
        $self = clone $this;
        $self['idDocumentExpiryDateMatch'] = $idDocumentExpiryDateMatch;

        return $self;
    }

    /**
     * true -  the attribute provided matches with the one in the Operator systems, which is equal to a `match_score` of 100.
     * false - the attribute provided does not match with the one in the Operator systems.
     * not_available - the attribute is not available to validate.
     *
     * @param MatchResult|value-of<MatchResult> $idDocumentMatch
     */
    public function withIDDocumentMatch(
        MatchResult|string $idDocumentMatch
    ): self {
        $self = clone $this;
        $self['idDocumentMatch'] = $idDocumentMatch;

        return $self;
    }

    /**
     * true -  the attribute provided matches with the one in the Operator systems, which is equal to a `match_score` of 100.
     * false - the attribute provided does not match with the one in the Operator systems.
     * not_available - the attribute is not available to validate.
     *
     * @param MatchResult|value-of<MatchResult> $idDocumentTypeMatch
     */
    public function withIDDocumentTypeMatch(
        MatchResult|string $idDocumentTypeMatch
    ): self {
        $self = clone $this;
        $self['idDocumentTypeMatch'] = $idDocumentTypeMatch;

        return $self;
    }

    /**
     * true -  the attribute provided matches with the one in the Operator systems, which is equal to a `match_score` of 100.
     * false - the attribute provided does not match with the one in the Operator systems.
     * not_available - the attribute is not available to validate.
     *
     * @param MatchResult|value-of<MatchResult> $localityMatch
     */
    public function withLocalityMatch(MatchResult|string $localityMatch): self
    {
        $self = clone $this;
        $self['localityMatch'] = $localityMatch;

        return $self;
    }

    /**
     * Indicates the similarity score assigned to the input value when it does not exactly match the value stored in the operator's system.
     * This property shall only be returned when the value of the corresponding match field is `false`.
     * A perfect match with a score of 100 is indicated by `match` being 'true' and no `matchScore` is returned in this case.
     */
    public function withLocalityMatchScore(int $localityMatchScore): self
    {
        $self = clone $this;
        $self['localityMatchScore'] = $localityMatchScore;

        return $self;
    }

    /**
     * true -  the attribute provided matches with the one in the Operator systems, which is equal to a `match_score` of 100.
     * false - the attribute provided does not match with the one in the Operator systems.
     * not_available - the attribute is not available to validate.
     *
     * @param MatchResult|value-of<MatchResult> $middleNamesMatch
     */
    public function withMiddleNamesMatch(
        MatchResult|string $middleNamesMatch
    ): self {
        $self = clone $this;
        $self['middleNamesMatch'] = $middleNamesMatch;

        return $self;
    }

    /**
     * Indicates the similarity score assigned to the input value when it does not exactly match the value stored in the operator's system.
     * This property shall only be returned when the value of the corresponding match field is `false`.
     * A perfect match with a score of 100 is indicated by `match` being 'true' and no `matchScore` is returned in this case.
     */
    public function withMiddleNamesMatchScore(int $middleNamesMatchScore): self
    {
        $self = clone $this;
        $self['middleNamesMatchScore'] = $middleNamesMatchScore;

        return $self;
    }

    /**
     * true -  the attribute provided matches with the one in the Operator systems, which is equal to a `match_score` of 100.
     * false - the attribute provided does not match with the one in the Operator systems.
     * not_available - the attribute is not available to validate.
     *
     * @param MatchResult|value-of<MatchResult> $nameKanaHankakuMatch
     */
    public function withNameKanaHankakuMatch(
        MatchResult|string $nameKanaHankakuMatch
    ): self {
        $self = clone $this;
        $self['nameKanaHankakuMatch'] = $nameKanaHankakuMatch;

        return $self;
    }

    /**
     * Indicates the similarity score assigned to the input value when it does not exactly match the value stored in the operator's system.
     * This property shall only be returned when the value of the corresponding match field is `false`.
     * A perfect match with a score of 100 is indicated by `match` being 'true' and no `matchScore` is returned in this case.
     */
    public function withNameKanaHankakuMatchScore(
        int $nameKanaHankakuMatchScore
    ): self {
        $self = clone $this;
        $self['nameKanaHankakuMatchScore'] = $nameKanaHankakuMatchScore;

        return $self;
    }

    /**
     * true -  the attribute provided matches with the one in the Operator systems, which is equal to a `match_score` of 100.
     * false - the attribute provided does not match with the one in the Operator systems.
     * not_available - the attribute is not available to validate.
     *
     * @param MatchResult|value-of<MatchResult> $nameKanaZenkakuMatch
     */
    public function withNameKanaZenkakuMatch(
        MatchResult|string $nameKanaZenkakuMatch
    ): self {
        $self = clone $this;
        $self['nameKanaZenkakuMatch'] = $nameKanaZenkakuMatch;

        return $self;
    }

    /**
     * Indicates the similarity score assigned to the input value when it does not exactly match the value stored in the operator's system.
     * This property shall only be returned when the value of the corresponding match field is `false`.
     * A perfect match with a score of 100 is indicated by `match` being 'true' and no `matchScore` is returned in this case.
     */
    public function withNameKanaZenkakuMatchScore(
        int $nameKanaZenkakuMatchScore
    ): self {
        $self = clone $this;
        $self['nameKanaZenkakuMatchScore'] = $nameKanaZenkakuMatchScore;

        return $self;
    }

    /**
     * true -  the attribute provided matches with the one in the Operator systems, which is equal to a `match_score` of 100.
     * false - the attribute provided does not match with the one in the Operator systems.
     * not_available - the attribute is not available to validate.
     *
     * @param MatchResult|value-of<MatchResult> $nameMatch
     */
    public function withNameMatch(MatchResult|string $nameMatch): self
    {
        $self = clone $this;
        $self['nameMatch'] = $nameMatch;

        return $self;
    }

    /**
     * Indicates the similarity score assigned to the input value when it does not exactly match the value stored in the operator's system.
     * This property shall only be returned when the value of the corresponding match field is `false`.
     * A perfect match with a score of 100 is indicated by `match` being 'true' and no `matchScore` is returned in this case.
     */
    public function withNameMatchScore(int $nameMatchScore): self
    {
        $self = clone $this;
        $self['nameMatchScore'] = $nameMatchScore;

        return $self;
    }

    /**
     * true -  the attribute provided matches with the one in the Operator systems, which is equal to a `match_score` of 100.
     * false - the attribute provided does not match with the one in the Operator systems.
     * not_available - the attribute is not available to validate.
     *
     * @param MatchResult|value-of<MatchResult> $nationalityMatch
     */
    public function withNationalityMatch(
        MatchResult|string $nationalityMatch
    ): self {
        $self = clone $this;
        $self['nationalityMatch'] = $nationalityMatch;

        return $self;
    }

    /**
     * true -  the attribute provided matches with the one in the Operator systems, which is equal to a `match_score` of 100.
     * false - the attribute provided does not match with the one in the Operator systems.
     * not_available - the attribute is not available to validate.
     *
     * @param MatchResult|value-of<MatchResult> $postalCodeMatch
     */
    public function withPostalCodeMatch(
        MatchResult|string $postalCodeMatch
    ): self {
        $self = clone $this;
        $self['postalCodeMatch'] = $postalCodeMatch;

        return $self;
    }

    /**
     * true -  the attribute provided matches with the one in the Operator systems, which is equal to a `match_score` of 100.
     * false - the attribute provided does not match with the one in the Operator systems.
     * not_available - the attribute is not available to validate.
     *
     * @param MatchResult|value-of<MatchResult> $regionMatch
     */
    public function withRegionMatch(MatchResult|string $regionMatch): self
    {
        $self = clone $this;
        $self['regionMatch'] = $regionMatch;

        return $self;
    }

    /**
     * Indicates the similarity score assigned to the input value when it does not exactly match the value stored in the operator's system.
     * This property shall only be returned when the value of the corresponding match field is `false`.
     * A perfect match with a score of 100 is indicated by `match` being 'true' and no `matchScore` is returned in this case.
     */
    public function withRegionMatchScore(int $regionMatchScore): self
    {
        $self = clone $this;
        $self['regionMatchScore'] = $regionMatchScore;

        return $self;
    }

    /**
     * true -  the attribute provided matches with the one in the Operator systems, which is equal to a `match_score` of 100.
     * false - the attribute provided does not match with the one in the Operator systems.
     * not_available - the attribute is not available to validate.
     *
     * @param MatchResult|value-of<MatchResult> $streetNameMatch
     */
    public function withStreetNameMatch(
        MatchResult|string $streetNameMatch
    ): self {
        $self = clone $this;
        $self['streetNameMatch'] = $streetNameMatch;

        return $self;
    }

    /**
     * Indicates the similarity score assigned to the input value when it does not exactly match the value stored in the operator's system.
     * This property shall only be returned when the value of the corresponding match field is `false`.
     * A perfect match with a score of 100 is indicated by `match` being 'true' and no `matchScore` is returned in this case.
     */
    public function withStreetNameMatchScore(int $streetNameMatchScore): self
    {
        $self = clone $this;
        $self['streetNameMatchScore'] = $streetNameMatchScore;

        return $self;
    }

    /**
     * true -  the attribute provided matches with the one in the Operator systems, which is equal to a `match_score` of 100.
     * false - the attribute provided does not match with the one in the Operator systems.
     * not_available - the attribute is not available to validate.
     *
     * @param MatchResult|value-of<MatchResult> $streetNumberMatch
     */
    public function withStreetNumberMatch(
        MatchResult|string $streetNumberMatch
    ): self {
        $self = clone $this;
        $self['streetNumberMatch'] = $streetNumberMatch;

        return $self;
    }

    /**
     * Indicates the similarity score assigned to the input value when it does not exactly match the value stored in the operator's system.
     * This property shall only be returned when the value of the corresponding match field is `false`.
     * A perfect match with a score of 100 is indicated by `match` being 'true' and no `matchScore` is returned in this case.
     */
    public function withStreetNumberMatchScore(
        int $streetNumberMatchScore
    ): self {
        $self = clone $this;
        $self['streetNumberMatchScore'] = $streetNumberMatchScore;

        return $self;
    }
}
