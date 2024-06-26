<?php

namespace Billwerk\Sdk\Model\Transaction;

class BancomatpayTransactionModel extends AbstractTransactionModel
{
    /**
     * Bancomat Pay id
     *
     * @var string|null $bancomatpayId
     */
    protected ?string $bancomatpayId = null;

    /**
     * Bancomat Pay id
     *
     * @return string|null
     */
    public function getBancomatpayId(): ?string
    {
        return $this->bancomatpayId;
    }

    /**
     * Bancomat Pay id
     *
     * @param string|null $bancomatpayId
     *
     * @return self
     */
    public function setBancomatpayId(?string $bancomatpayId): self
    {
        $this->bancomatpayId = $bancomatpayId;

        return $this;
    }

    /**
     * @param array $response
     *
     * @return self
     */
    public static function fromArray(array $response): self
    {
        $model = new static();

        $model->fromArrayDefault($response);

        if (isset($response['bancomatpay_id'])) {
            $model->setBancomatpayId($response['bancomatpay_id']);
        }

        return $model;
    }

    public function toArray(): array
    {
        return array_filter(array_merge($this->toArrayDefault(), [
            'bancomatpay_id' => $this->getBancomatpayId(),
        ]), function ($value) {
            return $value !== null;
        });
    }
}
