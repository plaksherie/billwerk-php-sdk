<?php

namespace Billwerk\Sdk\Model\Charge;

use Billwerk\Sdk\Model\AbstractModel;
use Billwerk\Sdk\Model\HasRequestApiInterface;
use Exception;

class ChargeSettleModel extends AbstractModel implements HasRequestApiInterface
{
    /**
     * Charge handle
     *
     * @var string $handle
     */
    protected string $handle;

    /**
     * Optional idempotency key. Only one authorization or settle can be performed for the same
     * handle. If two create attempts are attempted and the first succeeds the second will fail
     * because charge is already settled or authorized. An idempotency key identifies uniquely
     * the request and multiple requests with the same key and handle will yield the same result.
     * In case of networking errors the same request with same key can safely be retried
     *
     * @var string|null $key
     */
    protected ?string $key = null;

    /**
     * Amount in the smallest unit. Either amount or order_lines must be provided if charge/invoice
     * does not already exists
     *
     * @var int|null $amount
     */
    protected ?int $amount = null;

    /**
     * Optional alternative order text to use in conjunction with amount. Ignored if order_lines is provided.
     * If new amount is provided either ordertext or order_lines must be provided, otherwise order lines will
     * default to a single empty line
     *
     * @var string|null $ordertext
     */
    protected ?string $ordertext = null;

    /**
     * Optional new order lines to replace old order lines for the charge. The order lines controls the amount.
     * The new amount must be less than or equal to the authorized amount. See amount
     *
     * @var OrderLineModel[]|null $orderLines
     */
    protected ?array $orderLines = null;

    /**
     * Optional reference for the transaction at the acquirer. Notice the following about this argument:
     *
     * 1. It only works for some acquirers.
     *
     * 2. Acquirers may have rigid rules on the content of the acquirer reference.
     * Not complying to these rules can result in declined payments.
     *
     * 3. It is already possible to define custom acquirer reference using templating in the Reepay Administration.
     * Contact support for help. We highly recommend to only supply this argument if absolutely necessary,
     * and the templated default acquirer reference is not sufficient. Maximum length is 128,
     * but most acquirers require a maximum length of 22 characters.
     * Truncating will be applied if too long for specific acquirer.
     * Characters must match regex [\x20-\x7F]
     *
     * @var string|null $acquirerReference
     */
    protected ?string $acquirerReference = null;

    /**
     *  Optional alternative order text to use in conjunction with amount. Ignored if order_lines is provided.
     *  If new amount is provided either ordertext or order_lines must be provided, otherwise order lines will
     *  default to a single empty line
     *
     * @return string|null
     */
    public function getOrdertext(): ?string
    {
        return $this->ordertext;
    }

    /**
     *  Amount in the smallest unit. Either amount or order_lines must be provided if charge/invoice
     *  does not already exists
     *
     * @return int|null
     */
    public function getAmount(): ?int
    {
        return $this->amount;
    }

    /**
     * Charge handle
     *
     * @return string
     */
    public function getHandle(): string
    {
        return $this->handle;
    }

    /**
     *  Optional idempotency key. Only one authorization or settle can be performed for the same
     *  handle. If two create attempts are attempted and the first succeeds the second will fail
     *  because charge is already settled or authorized. An idempotency key identifies uniquely
     *  the request and multiple requests with the same key and handle will yield the same result.
     *  In case of networking errors the same request with same key can safely be retried
     *
     * @return string|null
     */
    public function getKey(): ?string
    {
        return $this->key;
    }
    /**
     *  Optional new order lines to replace old order lines for the charge. The order lines controls the amount.
     *  The new amount must be less than or equal to the authorized amount. See amount
     *
     * @return array|null
     */
    public function getOrderLines(): ?array
    {
        return $this->orderLines;
    }

    /**
     *  Optional reference for the transaction at the acquirer. Notice the following about this argument:
     *
     *  1. It only works for some acquirers.
     *
     *  2. Acquirers may have rigid rules on the content of the acquirer reference.
     *  Not complying to these rules can result in declined payments.
     *
     *  3. It is already possible to define custom acquirer reference using templating in the Reepay Administration.
     *  Contact support for help. We highly recommend to only supply this argument if absolutely necessary,
     *  and the templated default acquirer reference is not sufficient. Maximum length is 128,
     *  but most acquirers require a maximum length of 22 characters.
     *  Truncating will be applied if too long for specific acquirer.
     *  Characters must match regex [\x20-\x7F]
     *
     * @return string|null
     */
    public function getAcquirerReference(): ?string
    {
        return $this->acquirerReference;
    }

    /**
     *  Optional alternative order text to use in conjunction with amount. Ignored if order_lines is provided.
     *  If new amount is provided either ordertext or order_lines must be provided, otherwise order lines will
     *  default to a single empty line
     *
     * @param string|null $ordertext
     *
     * @return self
     */
    public function setOrdertext(?string $ordertext): self
    {
        $this->ordertext = $ordertext;

        return $this;
    }

    /**
     *  Amount in the smallest unit. Either amount or order_lines must be provided if charge/invoice
     *  does not already exists
     *
     * @param int|null $amount
     *
     * @return self
     */
    public function setAmount(?int $amount): self
    {
        $this->amount = $amount;

        return $this;
    }

    /**
     * Charge handle
     *
     * @param string $handle
     *
     * @return self
     */
    public function setHandle(string $handle): self
    {
        $this->handle = $handle;

        return $this;
    }

    /**
     *  Optional idempotency key. Only one authorization or settle can be performed for the same
     *  handle. If two create attempts are attempted and the first succeeds the second will fail
     *  because charge is already settled or authorized. An idempotency key identifies uniquely
     *  the request and multiple requests with the same key and handle will yield the same result.
     *  In case of networking errors the same request with same key can safely be retried
     *
     * @param string|null $key
     *
     * @return self
     */
    public function setKey(?string $key): self
    {
        $this->key = $key;

        return $this;
    }

    /**
     *  Optional new order lines to replace old order lines for the charge. The order lines controls the amount.
     *  The new amount must be less than or equal to the authorized amount. See amount
     *
     * @param array|null $orderLines
     *
     * @return self
     */
    public function setOrderLines(?array $orderLines): self
    {
        $this->orderLines = $orderLines;

        return $this;
    }

    /**
     *  Optional reference for the transaction at the acquirer. Notice the following about this argument:
     *
     *  1. It only works for some acquirers.
     *
     *  2. Acquirers may have rigid rules on the content of the acquirer reference.
     *  Not complying to these rules can result in declined payments.
     *
     *  3. It is already possible to define custom acquirer reference using templating in the Reepay Administration.
     *  Contact support for help. We highly recommend to only supply this argument if absolutely necessary,
     *  and the templated default acquirer reference is not sufficient. Maximum length is 128,
     *  but most acquirers require a maximum length of 22 characters.
     *  Truncating will be applied if too long for specific acquirer.
     *  Characters must match regex [\x20-\x7F]
     *
     * @param string|null $acquirerReference
     *
     * @return self
     */
    public function setAcquirerReference(?string $acquirerReference): self
    {
        $this->acquirerReference = $acquirerReference;

        return $this;
    }

    /**
     * @param array $response
     *
     * @return self
     * @throws Exception
     */
    public static function fromArray(array $response): self
    {
        $model = new self();

        $model->setHandle($response['handle']);

        if (isset($response['key'])) {
            $model->setKey($response['key']);
        }

        if (isset($response['amount'])) {
            $model->setAmount($response['amount']);
        }

        if (isset($response['ordertext'])) {
            $model->setOrdertext($response['ordertext']);
        }

        if (isset($response['order_lines'])) {
            $orderLines = [];
            foreach ($response['order_lines'] as $orderLine) {
                $orderLines[] = OrderLineModel::fromArray($orderLine);
            }
            $model->setOrderLines($orderLines);
        }

        if (isset($response['acquirer_reference'])) {
            $model->setAcquirerReference($response['acquirer_reference']);
        }

        return $model;
    }

    public function toApi(): array
    {
        return $this->toArray();
    }

    public function toArray(): array
    {
        return array_filter([
            'key' => $this->getKey(),
            'amount' => $this->getAmount(),
            'ordertext' => $this->getOrdertext(),
            'acquirer_reference' => $this->getAcquirerReference(),
            'order_lines' =>
                $this->getOrderLines() ? array_map(fn($orderLine) => $orderLine->toApi(), $this->getOrderLines()) : null
        ], function ($value) {
            return $value !== null;
        });
    }
}
