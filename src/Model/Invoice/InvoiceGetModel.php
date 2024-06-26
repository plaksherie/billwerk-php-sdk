<?php

namespace Billwerk\Sdk\Model\Invoice;

use Billwerk\Sdk\Model\AbstractModel;
use Billwerk\Sdk\Model\HasIdInterface;
use Billwerk\Sdk\Model\HasRequestApiInterface;

class InvoiceGetModel extends AbstractModel implements HasIdInterface, HasRequestApiInterface
{
    /**
     * Invoice id or handle
     *
     * @var string $id
     */
    protected string $id;

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
     * @param array $response
     *
     * @return self
     */
    public static function fromArray(array $response): self
    {
        $model = new self();

        $model
            ->setId($response['id']);

        return $model;
    }

    public function toArray(): array
    {
        return [
            'id' => $this->getId(),
        ];
    }

    public function toApi(): array
    {
        return $this->toArray();
    }
}
