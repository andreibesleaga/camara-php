<?php

declare(strict_types=1);

namespace Camara\Services;

use Camara\Client;
use Camara\Core\Contracts\BaseResponse;
use Camara\Core\Exceptions\APIException;
use Camara\Core\Util;
use Camara\RequestOptions;
use Camara\ServiceContracts\TenureRawContract;
use Camara\Tenure\TenureVerifyParams;
use Camara\Tenure\TenureVerifyResponse;

/**
 * @phpstan-import-type RequestOpts from \Camara\RequestOptions
 */
final class TenureRawService implements TenureRawContract
{
    // @phpstan-ignore-next-line
    /**
     * @internal
     */
    public function __construct(private Client $client) {}

    /**
     * @api
     *
     * Verifies a specified length of tenure, based on a provided date, for a network subscriber to establish a level of trust for the network subscription identifier.
     *
     * @param array{
     *   tenureDate: string, phoneNumber?: string, xCorrelator?: string
     * }|TenureVerifyParams $params
     * @param RequestOpts|null $requestOptions
     *
     * @return BaseResponse<TenureVerifyResponse>
     *
     * @throws APIException
     */
    public function verify(
        array|TenureVerifyParams $params,
        RequestOptions|array|null $requestOptions = null,
    ): BaseResponse {
        [$parsed, $options] = TenureVerifyParams::parseRequest(
            $params,
            $requestOptions,
        );
        $header_params = ['xCorrelator' => 'x-correlator'];

        // @phpstan-ignore-next-line return.type
        return $this->client->request(
            method: 'post',
            path: 'tenure/check-tenure',
            headers: Util::array_transform_keys(
                array_intersect_key($parsed, array_flip(array_keys($header_params))),
                $header_params,
            ),
            body: (object) array_diff_key(
                $parsed,
                array_flip(array_keys($header_params))
            ),
            options: $options,
            convert: TenureVerifyResponse::class,
        );
    }
}
