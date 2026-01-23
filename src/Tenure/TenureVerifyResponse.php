<?php

declare(strict_types=1);

namespace Camara\Tenure;

use Camara\Core\Attributes\Optional;
use Camara\Core\Attributes\Required;
use Camara\Core\Concerns\SdkModel;
use Camara\Core\Contracts\BaseModel;
use Camara\Tenure\TenureVerifyResponse\ContractType;

/**
 * @phpstan-type TenureVerifyResponseShape = array{
 *   tenureDateCheck: bool, contractType?: null|ContractType|value-of<ContractType>
 * }
 */
final class TenureVerifyResponse implements BaseModel
{
    /** @use SdkModel<TenureVerifyResponseShape> */
    use SdkModel;

    /**
     * `true` when the identified mobile subscription has had valid tenure since `tenureDate`, otherwise `false`.
     */
    #[Required]
    public bool $tenureDateCheck;

    /**
     * If exists, populated with:
     * - `PAYG` - prepaid (pay-as-you-go) account
     * - `PAYM` - contract account
     * - `Business` - Business (enterprise) account
     *
     * This attribute may be omitted from the response set if the information is not available
     *
     * @var value-of<ContractType>|null $contractType
     */
    #[Optional(enum: ContractType::class)]
    public ?string $contractType;

    /**
     * `new TenureVerifyResponse()` is missing required properties by the API.
     *
     * To enforce required parameters use
     * ```
     * TenureVerifyResponse::with(tenureDateCheck: ...)
     * ```
     *
     * Otherwise ensure the following setters are called
     *
     * ```
     * (new TenureVerifyResponse)->withTenureDateCheck(...)
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
     *
     * @param ContractType|value-of<ContractType>|null $contractType
     */
    public static function with(
        bool $tenureDateCheck,
        ContractType|string|null $contractType = null
    ): self {
        $self = new self;

        $self['tenureDateCheck'] = $tenureDateCheck;

        null !== $contractType && $self['contractType'] = $contractType;

        return $self;
    }

    /**
     * `true` when the identified mobile subscription has had valid tenure since `tenureDate`, otherwise `false`.
     */
    public function withTenureDateCheck(bool $tenureDateCheck): self
    {
        $self = clone $this;
        $self['tenureDateCheck'] = $tenureDateCheck;

        return $self;
    }

    /**
     * If exists, populated with:
     * - `PAYG` - prepaid (pay-as-you-go) account
     * - `PAYM` - contract account
     * - `Business` - Business (enterprise) account
     *
     * This attribute may be omitted from the response set if the information is not available
     *
     * @param ContractType|value-of<ContractType> $contractType
     */
    public function withContractType(ContractType|string $contractType): self
    {
        $self = clone $this;
        $self['contractType'] = $contractType;

        return $self;
    }
}
