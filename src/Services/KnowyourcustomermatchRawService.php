<?php

declare(strict_types=1);

namespace Camara\Services;

use Camara\Client;
use Camara\Core\Contracts\BaseResponse;
use Camara\Core\Exceptions\APIException;
use Camara\Core\Util;
use Camara\Knowyourcustomermatch\KnowyourcustomermatchMatchParams;
use Camara\Knowyourcustomermatch\KnowyourcustomermatchMatchParams\Gender;
use Camara\Knowyourcustomermatch\KnowyourcustomermatchMatchParams\IDDocumentType;
use Camara\Knowyourcustomermatch\KnowyourcustomermatchMatchResponse;
use Camara\RequestOptions;
use Camara\ServiceContracts\KnowyourcustomermatchRawContract;

/**
 * @phpstan-import-type RequestOpts from \Camara\RequestOptions
 */
final class KnowyourcustomermatchRawService implements KnowyourcustomermatchRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Verify matching of a number of attributes related to a customer identity against the verified data bound to their phone number in the Operator systems. Regardless of whether the `phoneNumber` is explicitly stated in the request body, at least one of the other fields must be provided, otherwise a `HTTP 400 - KNOW_YOUR_CUSTOMER.INVALID_PARAM_COMBINATION` error will be returned.
     *
     * In order to proceed with the match check, some Operators may have the requirement to perform an additional level of validation based on the `idDocument` property. This means that, in those cases, the `idDocument` is required and the provided value needs to match the one stored in the Operator system associated with the indicated `phoneNumber`. This validation will be done before proceeding with the match check of the rest of the properties. The following two rules apply only in the cases where the Operator have the requirement to validate the `idDocument`:
     * - If no `idDocument` is provided, then a `HTTP 403 - KNOW_YOUR_CUSTOMER.ID_DOCUMENT_REQUIRED` error will be returned.
     * - If the provided `idDocument` does not match the one stored in the Operator systems, then a `HTTP 403 - KNOW_YOUR_CUSTOMER.ID_DOCUMENT_MISMATCH` error will be returned.
     *
     * The API will return the result of the matching process for each requested attribute. This means that the response will **only** contain the attributes for which validation has been requested. Possible values are:
     *   - **true**: the attribute provided matches with the one in the Operator systems, which is equal to a `match_score` of 100.
     *   - **false**: the attribute provided does not match with the one in the Operator systems.
     *   - **not_available**: the attribute is not available to validate.
     *
     * @param array{
     *   address?: string,
     *   birthdate?: string,
     *   cityOfBirth?: string,
     *   country?: string,
     *   countryOfBirth?: string,
     *   email?: string,
     *   familyName?: string,
     *   familyNameAtBirth?: string,
     *   gender?: Gender|value-of<Gender>,
     *   givenName?: string,
     *   houseNumberExtension?: string,
     *   idDocument?: string,
     *   idDocumentExpiryDate?: string,
     *   idDocumentType?: value-of<IDDocumentType>,
     *   locality?: string,
     *   middleNames?: string,
     *   name?: string,
     *   nameKanaHankaku?: string,
     *   nameKanaZenkaku?: string,
     *   nationality?: string,
     *   phoneNumber?: string,
     *   postalCode?: string,
     *   region?: string,
     *   streetName?: string,
     *   streetNumber?: string,
     *   xCorrelator?: string,
     * }|KnowyourcustomermatchMatchParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<KnowyourcustomermatchMatchResponse>
     *
     * @throws APIException
     */
    public function match(
        array|KnowyourcustomermatchMatchParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = KnowyourcustomermatchMatchParams::parseRequest(
            $params,
            $requestOptions,
        );
        $header_params = ['xCorrelator' => 'x-correlator'];

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: 'knowyourcustomermatch/match',
            headers: Util::array_transform_keys(
                array_intersect_key($parsed, array_flip(array_keys($header_params))),
                $header_params,
            ),
            body: (object) array_diff_key(
                $parsed,
                array_flip(array_keys($header_params))
            ),
            options: $options,
            convert: KnowyourcustomermatchMatchResponse::class,
        );
    }
}
