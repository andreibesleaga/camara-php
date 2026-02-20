<?php

declare(strict_types=1);

namespace Camara\Services;

use Camara\Client;
use Camara\Core\Exceptions\APIException;
use Camara\Core\Util;
use Camara\Knowyourcustomermatch\KnowyourcustomermatchMatchParams\Gender;
use Camara\Knowyourcustomermatch\KnowyourcustomermatchMatchParams\IDDocumentType;
use Camara\Knowyourcustomermatch\KnowyourcustomermatchMatchResponse;
use Camara\RequestOptions;
use Camara\ServiceContracts\KnowyourcustomermatchContract;

/**
 * @phpstan-import-type RequestOpts from \Camara\RequestOptions
 */
final class KnowyourcustomermatchService implements KnowyourcustomermatchContract
{
    /**
     * @api
     */
    public KnowyourcustomermatchRawService $raw;

    /**
     * @internal
     */
    public function __construct(private Client $client)
    {
        $this->raw = new KnowyourcustomermatchRawService($client);
    }

    /**
     * @api
     *
     * Verify matching of a number of attributes related to a customer identity against the verified data bound to their phone number in the Operator systems. Regardless of whether the `phoneNumber` is explicitly stated in the request body, at least one of the other fields must be provided, otherwise a `HTTP 400 - KNOW_YOUR_CUSTOMER.INVALID_PARAM_COMBINATION` error will be returned.
     *
     * The API will return the result of the matching process for each requested attribute. This means that the response will **only** contain the attributes for which validation has been requested. Possible values are:
     *   - **true**: the attribute provided matches with the one in the Operator systems, which is equal to a `match_score` of 100.
     *   - **false**: the attribute provided does not match with the one in the Operator systems.
     *   - **not_available**: the attribute is not available to validate.
     *
     * @param string $address Body param: Complete address of the customer.  For some countries, it is built following the usual concatenation of parameters in a country, but for other countries, this is not the case.  For some countries, it can use streetName, streetNumber and/or houseNumberExtension. For example, in ESP, streetName+streetNumber; in NLD, it can be streetName+streetNumber or streetName+streetNumber+houseNumberExtension.
     * @param string $birthdate body param: The birthdate of the customer, in RFC 3339 / ISO 8601 calendar date format (YYYY-MM-DD)
     * @param string $cityOfBirth body param: City where the customer was born
     * @param string $country Body param: Country of the customer's address. Format ISO 3166-1 alpha-2
     * @param string $countryOfBirth Body param: Country where the customer was born. Format ISO 3166-1 alpha-2.
     * @param string $email body param: Email address of the customer in the RFC specified format (local-part@domain)
     * @param string $familyName body param: Last name, family name, or surname of the customer
     * @param string $familyNameAtBirth body param: Last/family/sur- name at birth of the customer
     * @param Gender|value-of<Gender> $gender body param: Gender of the customer (Male/Female/Other)
     * @param string $givenName body param: First/given name or compound first/given name of the customer
     * @param string $houseNumberExtension Body param: Specific identifier of the house needed depending on the property type. For example, number of apartment in an apartment building.
     * @param string $idDocument Body param: Id number associated to the official identity document in the country. It may contain alphanumeric characters.
     * @param string $idDocumentExpiryDate body param: Expiration date of the identity document (ISO 8601)
     * @param IDDocumentType|value-of<IDDocumentType> $idDocumentType body param: Type of the official identity document provided
     * @param string $locality Body param: Locality of the customer's address
     * @param string $middleNames body param: Middle name/s of the customer
     * @param string $name Body param: Complete name of the customer, usually composed of first/given name and last/family/sur- name in a country.  Depending on the country, the order of first/give name and last/family/sur- name varies, and middle name could be included.  It can use givenName, middleNames, familyName and/or familyNameAtBirth. For example, in ESP, name+familyName; in NLD, it can be name+middleNames+familyName or name+middleNames+familyNameAtBirth, etc.
     * @param string $nameKanaHankaku body param: Complete name of the customer in Hankaku-Kana format (reading of name) for Japan
     * @param string $nameKanaZenkaku body param: Complete name of the customer in Zenkaku-Kana format (reading of name) for Japan
     * @param string $nationality Body param: ISO 3166-1 alpha-2 code of the customer’s nationality. In the case a customer has more than one nationality, it is supposed to be the nationality related to the ID document provided in the match request.
     * @param string $phoneNumber Body param: A public identifier addressing a telephone subscription. In mobile networks it corresponds to the MSISDN (Mobile Station International Subscriber Directory Number). In order to be globally unique it has to be formatted in international format, according to E.164 standard, prefixed with '+'.
     * @param string $postalCode Body param: Zip code or postal code
     * @param string $region Body param: Region/prefecture of the customer's address
     * @param string $streetName Body param: Name of the street of the customer's address. It should not include the type of the street.
     * @param string $streetNumber Body param: The street number of the customer's address.  Number identifying a specific property on the 'streetName'.
     * @param string $xCorrelator Header param: Correlation id for the different services
     * @param RequestOpts|null $requestOptions
     *
     * @throws APIException
     */
    public function match(
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
        ?string $xCorrelator = null,
        RequestOptions|array|null $requestOptions = null,
    ): KnowyourcustomermatchMatchResponse {
        $params = Util::removeNulls(
            [
                'address' => $address,
                'birthdate' => $birthdate,
                'cityOfBirth' => $cityOfBirth,
                'country' => $country,
                'countryOfBirth' => $countryOfBirth,
                'email' => $email,
                'familyName' => $familyName,
                'familyNameAtBirth' => $familyNameAtBirth,
                'gender' => $gender,
                'givenName' => $givenName,
                'houseNumberExtension' => $houseNumberExtension,
                'idDocument' => $idDocument,
                'idDocumentExpiryDate' => $idDocumentExpiryDate,
                'idDocumentType' => $idDocumentType,
                'locality' => $locality,
                'middleNames' => $middleNames,
                'name' => $name,
                'nameKanaHankaku' => $nameKanaHankaku,
                'nameKanaZenkaku' => $nameKanaZenkaku,
                'nationality' => $nationality,
                'phoneNumber' => $phoneNumber,
                'postalCode' => $postalCode,
                'region' => $region,
                'streetName' => $streetName,
                'streetNumber' => $streetNumber,
                'xCorrelator' => $xCorrelator,
            ],
        );

        // @phpstan-ignore-next-line argument.type
        $response = $this->raw->match(params: $params, requestOptions: $requestOptions);

        return $response->parse();
    }
}
