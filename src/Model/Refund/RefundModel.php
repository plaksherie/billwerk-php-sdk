<?php

namespace Billwerk\Sdk\Model\Refund;

use Billwerk\Sdk\Enum\ErrorStateEnum;
use Billwerk\Sdk\Enum\RefundStateEnum;
use Billwerk\Sdk\Enum\RefundTypeEnum;
use Billwerk\Sdk\Model\AbstractModel;
use Billwerk\Sdk\Model\HasIdInterface;
use DateTime;
use Exception;

/**
 * Refund
 *
 * @see https://optimize-docs.billwerk.com/reference/createrefund
 *
 * @package Billwerk\Sdk\Model
 */
class RefundModel extends AbstractModel implements HasIdInterface
{
    /**
     * Refund id assigned by Reepay
     *
     * @var string $id
     */
    protected string $id;

    /**
     * The refund state either refunded, failed or processing. The processing state can only be returned
     * for asynchronous payment method (not card)
     *
     * @see RefundStateEnum
     *
     * @var string $state
     */
    protected string $state;

    /**
     * Invoice/charge handle
     *
     * @var string $invoice
     */
    protected string $invoice;

    /**
     * Refunded amount
     *
     * @var int $amount
     */
    protected int $amount;

    /**
     * Currency for the account in ISO 4217 three letter alpha code
     *
     * @var string $currency
     */
    protected string $currency;

    /**
     * Transaction id assigned by Reepay
     *
     * @var string $transaction
     */
    protected string $transaction;

    /**
     * Reepay error code if failed
     *
     * @var string|null $error
     */
    protected ?string $error = null;

    /**
     * Type of refund, either card, mpo, mobilepay, vipps, vipps_recurring, swish, viabill, anyday, manual,
     * applepay, googlepay, paypal, klarna_pay_now, klarna_pay_later, klarna_slice_it, klarna_direct_bank_transfer,
     * klarna_direct_debit, resurs, mobilepay_subscriptions, emv_token, bancomatpay, bcmc, blik, pp_blik_oc, giropay,
     * ideal, p24, sepa, trustly, eps, estonia_banks, latvia_banks, lithuania_banks, mb_way, multibanco, mybank,
     * payconiq, paysafecard, paysera, postfinance, satispay, twint, wechatpay, santander, or verkkopankki,
     * offline_cash, offline_bank_transfer, offline_other
     *
     * @see RefundTypeEnum
     * @var string $type
     */
    protected string $type;

    /**
     * When the refund was created, in ISO-8601 extended offset date-time format
     *
     * @var DateTime $created
     */
    protected DateTime $created;

    /**
     * Credit note id for successful refund
     *
     * @var string|null $creditNoteId
     */
    protected ?string $creditNoteId = null;

    /**
     * Id of a possible settled transaction that has been refunded
     *
     * @var string|null $refTransaction
     */
    protected ?string $refTransaction = null;

    /**
     * Reepay error state if failed: hard_declined or processing_error. A hard decline indicates a refund decline
     * by acquirer. A processing error indicates an error processing the refund either at Reepay, the acquirer,
     * or between Reepay and the acquirer
     *
     * @see ErrorStateEnum
     * @var string|null $errorState
     */
    protected ?string $errorState = null;

    /**
     * Acquirer message in case of error
     *
     * @var string|null $acquirerMessage
     */
    protected ?string $acquirerMessage = null;

    /**
     * Invoice accounting number
     *
     * @var string|null $accountingNumber
     */
    protected ?string $accountingNumber = null;

    /**
     * Reepay error code if failed
     *
     * @return string|null
     */
    public function getError(): ?string
    {
        return $this->error;
    }

    /**
     * Invoice accounting number
     *
     * @return string|null
     */
    public function getAccountingNumber(): ?string
    {
        return $this->accountingNumber;
    }

    /**
     * Acquirer message in case of error
     *
     * @return string|null
     */
    public function getAcquirerMessage(): ?string
    {
        return $this->acquirerMessage;
    }

    /**
     * Refunded amount
     *
     * @return int
     */
    public function getAmount(): int
    {
        return $this->amount;
    }

    /**
     * When the refund was created, in ISO-8601 extended offset date-time format
     *
     * @return DateTime
     */
    public function getCreated(): DateTime
    {
        return $this->created;
    }

    /**
     * Credit note id for successful refund
     *
     * @return string|null
     */
    public function getCreditNoteId(): ?string
    {
        return $this->creditNoteId;
    }

    /**
     * Currency for the account in ISO 4217 three letter alpha code
     *
     * @return string
     */
    public function getCurrency(): string
    {
        return $this->currency;
    }

    /**
     * Reepay error state if failed: hard_declined or processing_error. A hard decline indicates a refund decline
     *  by acquirer. A processing error indicates an error processing the refund either at Reepay, the acquirer,
     *  or between Reepay and the acquirer
     *
     * @see ErrorStateEnum
     * @return string|null
     */
    public function getErrorState(): ?string
    {
        return $this->errorState;
    }

    /**
     * Refund id assigned by Reepay
     *
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * Invoice/charge handle
     *
     * @return string
     */
    public function getInvoice(): string
    {
        return $this->invoice;
    }

    /**
     * Id of a possible settled transaction that has been refunded
     *
     * @return string|null
     */
    public function getRefTransaction(): ?string
    {
        return $this->refTransaction;
    }

    /**
     * The refund state either refunded, failed or processing. The processing state can only be returned
     *  for asynchronous payment method (not card)
     *
     * @see RefundStateEnum
     * @return string
     */
    public function getState(): string
    {
        return $this->state;
    }

    /**
     * Transaction id assigned by Reepay
     *
     * @return string
     */
    public function getTransaction(): string
    {
        return $this->transaction;
    }

    /**
     * Type of refund, either card, mpo, mobilepay, vipps, vipps_recurring, swish, viabill, anyday, manual,
     *  applepay, googlepay, paypal, klarna_pay_now, klarna_pay_later, klarna_slice_it, klarna_direct_bank_transfer,
     *  klarna_direct_debit, resurs, mobilepay_subscriptions, emv_token, bancomatpay, bcmc, blik, pp_blik_oc, giropay,
     *  ideal, p24, sepa, trustly, eps, estonia_banks, latvia_banks, lithuania_banks, mb_way, multibanco, mybank,
     *  payconiq, paysafecard, paysera, postfinance, satispay, twint, wechatpay, santander, or verkkopankki,
     *  offline_cash, offline_bank_transfer, offline_other
     *
     * @see RefundTypeEnum
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * Invoice accounting number
     *
     * @param string|null $accountingNumber
     *
     * @return RefundModel
     */
    public function setAccountingNumber(?string $accountingNumber): self
    {
        $this->accountingNumber = $accountingNumber;

        return $this;
    }

    /**
     * Acquirer message in case of error
     *
     * @param string|null $acquirerMessage
     *
     * @return RefundModel
     */
    public function setAcquirerMessage(?string $acquirerMessage): self
    {
        $this->acquirerMessage = $acquirerMessage;

        return $this;
    }

    /**
     * Refunded amount
     *
     * @param int $amount
     *
     * @return RefundModel
     */
    public function setAmount(int $amount): self
    {
        $this->amount = $amount;

        return $this;
    }

    /**
     * When the refund was created, in ISO-8601 extended offset date-time format
     *
     * @param DateTime $created
     *
     * @return RefundModel
     */
    public function setCreated(DateTime $created): self
    {
        $this->created = $created;

        return $this;
    }

    /**
     * Credit note id for successful refund
     *
     * @param string|null $creditNoteId
     *
     * @return RefundModel
     */
    public function setCreditNoteId(?string $creditNoteId): self
    {
        $this->creditNoteId = $creditNoteId;

        return $this;
    }

    /**
     * Currency for the account in ISO 4217 three letter alpha code
     *
     * @param string $currency
     *
     * @return RefundModel
     */
    public function setCurrency(string $currency): self
    {
        $this->currency = $currency;

        return $this;
    }

    /**
     * Reepay error code if failed
     *
     * @param string|null $error
     *
     * @return RefundModel
     */
    public function setError(?string $error): self
    {
        $this->error = $error;

        return $this;
    }

    /**
     * Reepay error state if failed: hard_declined or processing_error. A hard decline indicates a refund decline
     *  by acquirer. A processing error indicates an error processing the refund either at Reepay, the acquirer,
     *  or between Reepay and the acquirer
     *
     * @see ErrorStateEnum
     *
     * @param string|null $errorState
     *
     * @return RefundModel
     */
    public function setErrorState(?string $errorState): self
    {
        $this->errorState = $errorState;

        return $this;
    }

    /**
     * Refund id assigned by Reepay
     *
     * @param string $id
     *
     * @return RefundModel
     */
    public function setId(string $id): self
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Invoice/charge handle
     *
     * @param string $invoice
     *
     * @return RefundModel
     */
    public function setInvoice(string $invoice): self
    {
        $this->invoice = $invoice;

        return $this;
    }

    /**
     * Id of a possible settled transaction that has been refunded
     *
     * @param string|null $refTransaction
     *
     * @return RefundModel
     */
    public function setRefTransaction(?string $refTransaction): self
    {
        $this->refTransaction = $refTransaction;

        return $this;
    }

    /**
     * @param string $state
     *
     * @return RefundModel
     */
    public function setState(string $state): self
    {
        $this->state = $state;

        return $this;
    }

    /**
     * Transaction id assigned by Reepay
     *
     * @param string $transaction
     *
     * @return RefundModel
     */
    public function setTransaction(string $transaction): self
    {
        $this->transaction = $transaction;

        return $this;
    }

    /**
     * Type of refund, either card, mpo, mobilepay, vipps, vipps_recurring, swish, viabill, anyday, manual,
     *  applepay, googlepay, paypal, klarna_pay_now, klarna_pay_later, klarna_slice_it, klarna_direct_bank_transfer,
     *  klarna_direct_debit, resurs, mobilepay_subscriptions, emv_token, bancomatpay, bcmc, blik, pp_blik_oc, giropay,
     *  ideal, p24, sepa, trustly, eps, estonia_banks, latvia_banks, lithuania_banks, mb_way, multibanco, mybank,
     *  payconiq, paysafecard, paysera, postfinance, satispay, twint, wechatpay, santander, or verkkopankki,
     *  offline_cash, offline_bank_transfer, offline_other
     *
     * @see RefundTypeEnum
     *
     * @param string $type
     *
     * @return RefundModel
     */
    public function setType(string $type): self
    {
        $this->type = $type;

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

        $model->setId($response['id'])
              ->setInvoice($response['invoice'])
              ->setAmount($response['amount'])
              ->setCurrency($response['currency'])
              ->setTransaction($response['transaction'])
              ->setCreated(new DateTime($response['created']));

        if (in_array($response['type'], RefundTypeEnum::getAll())) {
            $model->setType($response['type']);
        }

        if (in_array($response['state'], RefundStateEnum::getAll())) {
            $model->setState($response['state']);
        }

        if (isset($response['error'])) {
            $model->setError($response['error']);
        }

        if (isset($response['credit_note_id'])) {
            $model->setCreditNoteId($response['credit_note_id']);
        }

        if (isset($response['ref_transaction'])) {
            $model->setRefTransaction($response['ref_transaction']);
        }

        if (isset($response['error_state']) && in_array($response['error_state'], ErrorStateEnum::getAll())) {
            $model->setErrorState($response['error_state']);
        }

        if (isset($response['acquirer_message'])) {
            $model->setAcquirerMessage($response['acquirer_message']);
        }

        if (isset($response['accounting_number'])) {
            $model->setAccountingNumber($response['accounting_number']);
        }

        return $model;
    }

    public function toArray(): array
    {
        return array_filter([
            'id' => $this->getId(),
            'invoice' => $this->getInvoice(),
            'amount' => $this->getAmount(),
            'currency' => $this->getCurrency(),
            'transaction' => $this->getTransaction(),
            'created' => $this->getCreated() ? $this->getCreated()->format('Y-m-d\TH:i:s.v') : null,
            'type' => $this->getType(),
            'state' => $this->getState(),
            'error' => $this->getError(),
            'credit_note_id' => $this->getCreditNoteId(),
            'ref_transaction' => $this->getRefTransaction(),
            'error_state' => $this->getErrorState(),
            'acquirer_message' => $this->getAcquirerMessage(),
            'accounting_number' => $this->getAccountingNumber(),
        ], function ($value) {
            return $value !== null;
        });
    }
}
