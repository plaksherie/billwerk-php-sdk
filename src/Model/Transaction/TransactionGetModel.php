<?php

namespace Billwerk\Sdk\Model\Transaction;

use Billwerk\Sdk\Model\AbstractModel;
use Billwerk\Sdk\Model\HasIdInterface;

class TransactionGetModel extends AbstractModel implements HasIdInterface
{
    /**
     * Invoice id or handle
     *
     * @var string $id
     */
    protected string $id;

    /**
     * Transaction id
     *
     * @var string $transaction
     */
    protected string $transaction;

    /**
     * Invoice id or handle
     *
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * Transaction id
     *
     * @return string
     */
    public function getTransaction(): string
    {
        return $this->transaction;
    }

    /**
     * Invoice id or handle
     *
     * @param string $id
     *
     * @return self
     */
    public function setId(string $id): self
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Transaction id
     *
     * @param string $transaction
     *
     * @return self
     */
    public function setTransaction(string $transaction): self
    {
        $this->transaction = $transaction;

        return $this;
    }

    /**
     * @param array $response
     *
     * @return self
     */
    public static function fromArray(array $response): self
    {
        $model = new self();

        $model
            ->setId($response['id'])
            ->setTransaction($response['transaction']);

        return $model;
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [];
    }
}
