<?php

namespace Billwerk\Sdk\Model\Refund;

use Billwerk\Sdk\Model\AbstractModel;
use Billwerk\Sdk\Model\HasRequestApiInterface;

/**
 * Create refund
 *
 * @see https://optimize-docs.billwerk.com/reference/createrefund
 *
 * @package Billwerk\Sdk\Model
 */
class RefundCreateModel extends AbstractModel implements HasRequestApiInterface
{
    /**
     * Handle or id for invoice/charge to refund
     *
     * @var string $invoice
     */
    protected string $invoice;
    /**
     * Optional idempotency key. Only one refund can be performed for the same key. An idempotency key
     * identifies uniquely the request and multiple requests with the same key and invoice will yield
     * the same result. In case of networking errors the same request with same key can safely be retried
     *
     * @var string|null $key
     */
    protected ?string $key = null;
    /**
     * Optional amount in the smallest unit for the account currency. Either amount or note_lines can
     * be provided, if neither is provided the full refundable amount is refunded
     *
     * @var int|null $amount
     */
    protected ?int $amount = null;
    /**
     * Optional vat for this refund
     *
     * @var float|null $vat
     */
    protected ?float $vat = null;
    /**
     * Optional refund text to use on credit note. Used in conjunction with amount. Ignored
     * if note_lines is provided
     *
     * @var string|null $text
     */
    protected ?string $text = null;

    /**
     * Whether the amount is including VAT. Default true
     *
     * @var bool|null $amountInclVat
     */
    protected ?bool $amountInclVat = null;

    /**
     * Refund credit note lines to give detailed information for credit note. Alternative to amount
     *
     * @var NoteLineModel[] $noteLines
     */
    protected ?array $noteLines = null;

    /**
     * Optional manual transfer. If given no refund will be performed on potential online settled
     * transaction like card transaction
     *
     * @var ManualTransferModel|null $manualTransfer
     */
    protected ?ManualTransferModel $manualTransfer = null;

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
     * Optional vat for this refund
     *
     * @return float|null
     */
    public function getVat(): ?float
    {
        return $this->vat;
    }

    /**
     * Optional refund text to use on credit note. Used in conjunction with amount. Ignored
     *  if note_lines is provided
     *
     * @return string|null
     */
    public function getText(): ?string
    {
        return $this->text;
    }

    /**
     * Whether the amount is including VAT. Default true
     *
     * @return bool|null
     */
    public function getAmountInclVat(): ?bool
    {
        return $this->amountInclVat;
    }

    /**
     * Optional amount in the smallest unit for the account currency. Either amount or note_lines can
     *  be provided, if neither is provided the full refundable amount is refunded
     *
     * @return int|null
     */
    public function getAmount(): ?int
    {
        return $this->amount;
    }

    /**
     * Handle or id for invoice/charge to refund
     *
     * @return string
     */
    public function getInvoice(): string
    {
        return $this->invoice;
    }

    /**
     * Optional reference for the transaction at the acquirer. Notice the following about this argument:
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
     * Optional idempotency key. Only one refund can be performed for the same key. An idempotency key
     *  identifies uniquely the request and multiple requests with the same key and invoice will yield
     *  the same result. In case of networking errors the same request with same key can safely be retried
     *
     * @return string|null
     */
    public function getKey(): ?string
    {
        return $this->key;
    }

    /**
     * Optional manual transfer. If given no refund will be performed on potential online settled
     *  transaction like card transaction
     *
     * @return ManualTransferModel|null
     */
    public function getManualTransfer(): ?ManualTransferModel
    {
        return $this->manualTransfer;
    }

    /**
     * Refund credit note lines to give detailed information for credit note. Alternative to amount
     *
     * @return array|null
     */
    public function getNoteLines(): ?array
    {
        return $this->noteLines;
    }

    /**
     * Optional vat for this refund
     *
     * @param float|null $vat
     *
     * @return RefundCreateModel
     */
    public function setVat(?float $vat): self
    {
        $this->vat = $vat;

        return $this;
    }

    /**
     * Optional refund text to use on credit note. Used in conjunction with amount. Ignored
     *  if note_lines is provided
     *
     * @param string|null $text
     *
     * @return RefundCreateModel
     */
    public function setText(?string $text): self
    {
        $this->text = $text;

        return $this;
    }

    /**
     * Whether the amount is including VAT. Default true
     *
     * @param bool|null $amountInclVat
     *
     * @return RefundCreateModel
     */
    public function setAmountInclVat(?bool $amountInclVat): self
    {
        $this->amountInclVat = $amountInclVat;

        return $this;
    }

    /**
     * Optional amount in the smallest unit for the account currency. Either amount or note_lines can
     *  be provided, if neither is provided the full refundable amount is refunded
     *
     * @param int|null $amount
     *
     * @return RefundCreateModel
     */
    public function setAmount(?int $amount): self
    {
        $this->amount = $amount;

        return $this;
    }

    /**
     * Handle or id for invoice/charge to refund
     *
     * @param string $invoice
     *
     * @return RefundCreateModel
     */
    public function setInvoice(string $invoice): self
    {
        $this->invoice = $invoice;

        return $this;
    }

    /**
     * Optional reference for the transaction at the acquirer. Notice the following about this argument:
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
     * @return RefundCreateModel
     */
    public function setAcquirerReference(?string $acquirerReference): self
    {
        $this->acquirerReference = $acquirerReference;

        return $this;
    }

    /**
     * Optional idempotency key. Only one refund can be performed for the same key. An idempotency key
     *  identifies uniquely the request and multiple requests with the same key and invoice will yield
     *  the same result. In case of networking errors the same request with same key can safely be retried
     *
     * @param string|null $key
     *
     * @return RefundCreateModel
     */
    public function setKey(?string $key): self
    {
        $this->key = $key;

        return $this;
    }

    /**
     * Optional manual transfer. If given no refund will be performed on potential online settled
     *  transaction like card transaction
     *
     * @param ManualTransferModel|null $manualTransfer
     *
     * @return RefundCreateModel
     */
    public function setManualTransfer(?ManualTransferModel $manualTransfer): self
    {
        $this->manualTransfer = $manualTransfer;

        return $this;
    }

    /**
     * Refund credit note lines to give detailed information for credit note. Alternative to amount
     *
     * @param NoteLineModel[]|null $noteLines
     *
     * @return RefundCreateModel
     */
    public function setNoteLines(?array $noteLines): self
    {
        $this->noteLines = $noteLines;

        return $this;
    }

    public function toApi(): array
    {
        return $this->toArray();
    }

    public static function fromArray(array $response): self
    {
        $model = new self();

        $model->setInvoice($response['invoice']);

        if (isset($response['key'])) {
            $model->setKey($response['key']);
        }

        if (isset($response['amount'])) {
            $model->setAmount($response['amount']);
        }

        if (isset($response['vat'])) {
            $model->setVat($response['vat']);
        }

        if (isset($response['text'])) {
            $model->setText($response['text']);
        }

        if (isset($response['amount_incl_vat'])) {
            $model->setAmountInclVat($response['amount_incl_vat']);
        }

        if (isset($response['note_lines']) && is_array($response['note_lines'])) {
            $noteLines = [];
            foreach ($response['note_lines'] as $noteLine) {
                $noteLines[] = NoteLineModel::fromArray($noteLine);
            }
            if (count($noteLines) > 0) {
                $model->setNoteLines($noteLines);
            }
        }

        if (isset($response['manual_transfer'])) {
            $model->setManualTransfer(ManualTransferModel::fromArray($response['manual_transfer']));
        }

        if (isset($response['acquirer_reference'])) {
            $model->setAcquirerReference($response['acquirer_reference']);
        }

        return $model;
    }

    public function toArray(): array
    {
        return array_filter([
            'invoice' => $this->getInvoice(),
            'key' => $this->getKey(),
            'amount' => $this->getAmount(),
            'vat' => $this->getVat(),
            'text' => $this->getText(),
            'amount_incl_vat' => $this->getAmountInclVat(),
            'note_lines' =>
                $this->getNoteLines() ? array_map(fn($noteLine) => $noteLine->toArray(), $this->getNoteLines()) : null,
            'manual_transfer' => $this->getManualTransfer() ? $this->getManualTransfer()->toArray() : null,
            'acquirer_reference' => $this->getAcquirerReference(),
        ], function ($value) {
            return $value !== null;
        });
    }
}
