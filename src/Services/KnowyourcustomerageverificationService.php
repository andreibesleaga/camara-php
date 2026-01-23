<?php

declare(strict_types=1);

namespace Camara\Services;

use Camara\Client;
use Camara\Core\Exceptions\APIException;
use Camara\Core\Util;
use Camara\Knowyourcustomerageverification\KnowyourcustomerageverificationVerifyResponse;
use Camara\RequestOptions;
use Camara\ServiceContracts\KnowyourcustomerageverificationContract;

/**
 * @phpstan-import-type RequestOpts from \Camara\RequestOptions
 */
final class KnowyourcustomerageverificationService implements KnowyourcustomerageverificationContract
{
    /**
     * @api
     */
    public KnowyourcustomerageverificationRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new KnowyourcustomerageverificationRawService($client);
    }

    /**
     * @api
     *
     * Verify that the age of the subscriber associated with a phone number is equal to or greater than the specified age threshold value.
     *
     * As it is possible that the person holding the contract and the end-user of the subscription may not be the same, the endpoint also admits a list of optional properties to be included in the request to improve the identification. The response may optionally include the `identityMatchScore` property with a value that indicates how certain it is that the information returned relates to the person that the API Client is requesting. To increase the reliability of the information returned, the API Provider may include in the response the `verifiedStatus` property, indicating whether the identity information in its possession has been verified against an identification document legally accepted as an age verification document (Note). Note: Depending on the country, credit-check or other mechanism can be used instead of official identification for Age Verification. For details, please contact API Provider.
     *
     * If the API Client indicates request properties `includeContentLock` or `includeParentalControl` with value `true` and the API Provider implements this functionality, then the response will also include `contentLock` and `parentalControl` properties to indicate if the subscription has any kind of content filtering enabled. On the other hand, if the request properties are not included or the API Client specifies value `false`, then the response properties will not be returned. If the API Provider doesn't implement this functionality, request properties will be ignored and response properties won't be returned in any case.
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
    ): KnowyourcustomerageverificationVerifyResponse {
        $params = Util::removeNulls(
            [
                'ageThreshold' => $ageThreshold,
                'birthdate' => $birthdate,
                'email' => $email,
                'familyName' => $familyName,
                'familyNameAtBirth' => $familyNameAtBirth,
                'givenName' => $givenName,
                'idDocument' => $idDocument,
                'includeContentLock' => $includeContentLock,
                'includeParentalControl' => $includeParentalControl,
                'middleNames' => $middleNames,
                'name' => $name,
                'phoneNumber' => $phoneNumber,
                'xCorrelator' => $xCorrelator,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->verify(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }
}
