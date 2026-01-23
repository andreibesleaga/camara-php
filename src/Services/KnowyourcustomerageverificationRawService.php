<?php

declare(strict_types=1);

namespace Camara\Services;

use Camara\Client;
use Camara\Core\Contracts\BaseResponse;
use Camara\Core\Exceptions\APIException;
use Camara\Core\Util;
use Camara\Knowyourcustomerageverification\KnowyourcustomerageverificationVerifyParams;
use Camara\Knowyourcustomerageverification\KnowyourcustomerageverificationVerifyResponse;
use Camara\RequestOptions;
use Camara\ServiceContracts\KnowyourcustomerageverificationRawContract;

/**
 * @phpstan-import-type RequestOpts from \Camara\RequestOptions
 */
final class KnowyourcustomerageverificationRawService implements KnowyourcustomerageverificationRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Verify that the age of the subscriber associated with a phone number is equal to or greater than the specified age threshold value.
     *
     * As it is possible that the person holding the contract and the end-user of the subscription may not be the same, the endpoint also admits a list of optional properties to be included in the request to improve the identification. The response may optionally include the `identityMatchScore` property with a value that indicates how certain it is that the information returned relates to the person that the API Client is requesting. To increase the reliability of the information returned, the API Provider may include in the response the `verifiedStatus` property, indicating whether the identity information in its possession has been verified against an identification document legally accepted as an age verification document (Note). Note: Depending on the country, credit-check or other mechanism can be used instead of official identification for Age Verification. For details, please contact API Provider.
     *
     * If the API Client indicates request properties `includeContentLock` or `includeParentalControl` with value `true` and the API Provider implements this functionality, then the response will also include `contentLock` and `parentalControl` properties to indicate if the subscription has any kind of content filtering enabled. On the other hand, if the request properties are not included or the API Client specifies value `false`, then the response properties will not be returned. If the API Provider doesn't implement this functionality, request properties will be ignored and response properties won't be returned in any case.
     *
     * @param array{
     *   ageThreshold: int,
     *   birthdate?: string,
     *   email?: string,
     *   familyName?: string,
     *   familyNameAtBirth?: string,
     *   givenName?: string,
     *   idDocument?: string,
     *   includeContentLock?: bool,
     *   includeParentalControl?: bool,
     *   middleNames?: string,
     *   name?: string,
     *   phoneNumber?: string,
     *   xCorrelator?: string,
     * }|KnowyourcustomerageverificationVerifyParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<KnowyourcustomerageverificationVerifyResponse>
     *
     * @throws APIException
     */
    public function verify(
        array|KnowyourcustomerageverificationVerifyParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = KnowyourcustomerageverificationVerifyParams::parseRequest(
            $params,
            $requestOptions,
        );
        $header_params = ['xCorrelator' => 'x-correlator'];

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: 'knowyourcustomerageverification/verify',
            headers: Util::array_transform_keys(
                array_intersect_key($parsed, array_flip(array_keys($header_params))),
                $header_params,
            ),
            body: (object) array_diff_key(
                $parsed,
                array_flip(array_keys($header_params))
            ),
            options: $options,
            convert: KnowyourcustomerageverificationVerifyResponse::class,
        );
    }
}
