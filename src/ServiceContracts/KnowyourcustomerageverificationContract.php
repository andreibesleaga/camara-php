<?php

declare(strict_types=1);

namespace Camara\ServiceContracts;

use Camara\Core\Exceptions\APIException;
use Camara\Knowyourcustomerageverification\KnowyourcustomerageverificationVerifyResponse;
use Camara\RequestOptions;

/**
 * @phpstan-import-type RequestOpts from \Camara\RequestOptions
 */
interface KnowyourcustomerageverificationContract
{
    /**
     * @api
     *
     * @param int $ageThreshold Body param: The age to be verified. The indicated range is a global definition of maximum and minimum values allowed to be requested. It is important to note that this range might be more restrictive in some implementations due to local regulations of a country i.e. A country does not allow to request for an age under 18. This limitation must be informed during the onboarding process.
     * @param string $birthdate body param: The birthdate of the customer, in RFC 3339 / ISO 8601 calendar date format (YYYY-MM-DD)
     * @param string $email body param: Email address of the customer in the RFC specified format (local-part@domain)
     * @param string $familyName body param: Last name, family name, or surname of the customer
     * @param string $familyNameAtBirth body param: Last/family/sur- name at birth of the customer
     * @param string $givenName body param: First/given name or compound first/given name of the customer
     * @param string $idDocument Body param: Id number associated to the official identity document in the country. It may contain alphanumeric characters.
     * @param bool $includeContentLock Body param: If this parameter is included in the request with value `true`, the response property `contentLock` will be returned. If it is not included or its value is `false`, the response property will not be returned.
     * @param bool $includeParentalControl Body param: If this parameter is included in the request with value `true`, the response property `parentalControl` will be returned. If it is not included or its value is `false`, the response property will not be returned.
     * @param string $middleNames body param: Middle name/s of the customer
     * @param string $name Body param: Complete name of the customer, usually composed of first/given name and last/family/sur- name in a country.  Depending on the country, the order of first/give name and last/family/sur- name varies, and middle name could be included.  It can use givenName, middleNames, familyName and/or familyNameAtBirth. For example, in ESP, name+familyName; in NLD, it can be name+middleNames+familyName or name+middleNames+familyNameAtBirth, etc.
     * @param string $phoneNumber Body param: A public identifier addressing a telephone subscription. In mobile networks it corresponds to the MSISDN (Mobile Station International Subscriber Directory Number). In order to be globally unique it has to be formatted in international format, according to E.164 standard, prefixed with '+'.
     * @param string $xCorrelator Header param: Correlation id for the different services
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function verify(
        int $ageThreshold,
        ?string $birthdate = null,
        ?string $email = null,
        ?string $familyName = null,
        ?string $familyNameAtBirth = null,
        ?string $givenName = null,
        ?string $idDocument = null,
        bool $includeContentLock = false,
        bool $includeParentalControl = false,
        ?string $middleNames = null,
        ?string $name = null,
        ?string $phoneNumber = null,
        ?string $xCorrelator = null,
        RequestOptions|array|null $requestOptions = null,
    ): KnowyourcustomerageverificationVerifyResponse;
}
