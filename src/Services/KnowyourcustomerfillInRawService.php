<?php

declare(strict_types=1);

namespace Camara\Services;

use Camara\Client;
use Camara\Core\Contracts\BaseResponse;
use Camara\Core\Exceptions\APIException;
use Camara\Core\Util;
use Camara\KnowyourcustomerfillIn\KnowyourcustomerfillInCreateParams;
use Camara\KnowyourcustomerfillIn\KnowyourcustomerfillInNewResponse;
use Camara\RequestOptions;
use Camara\ServiceContracts\KnowyourcustomerfillInRawContract;

/**
 * @phpstan-import-type RequestOpts from \Camara\RequestOptions
 */
final class KnowyourcustomerfillInRawService implements KnowyourcustomerfillInRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Providing information related to a customer identity stored the account data bound to the customer's phone number.
     *
     * @param array{
     *   phoneNumber?: string, xCorrelator?: string
     * }|KnowyourcustomerfillInCreateParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<KnowyourcustomerfillInNewResponse>
     *
     * @throws APIException
     */
    public function create(
        array|KnowyourcustomerfillInCreateParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = KnowyourcustomerfillInCreateParams::parseRequest(
            $params,
            $requestOptions,
        );
        $header_params = ['xCorrelator' => 'x-correlator'];

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: 'knowyourcustomerfill-in/fill-in',
            headers: Util::array_transform_keys(
                array_intersect_key($parsed, array_flip(array_keys($header_params))),
                $header_params,
            ),
            body: (object) array_diff_key(
                $parsed,
                array_flip(array_keys($header_params))
            ),
            options: $options,
            convert: KnowyourcustomerfillInNewResponse::class,
        );
    }
}
