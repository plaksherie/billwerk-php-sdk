<?php

namespace Billwerk\Sdk\Model\Transaction;

use Billwerk\Sdk\Model\OfflineMandateModel;
use Exception;

class OfflineTransactionModel extends AbstractTransactionModel
{
    /**
     * Offline agreement handle
     *
     * @var OfflineMandateModel|null $offlineMandate
     */
    protected ?OfflineMandateModel $offlineMandate = null;

    /**
     * Offline agreement handle used to initiate transaction. Only set when offline_mandate is not set
     *
     * @var string|null $offlineAgreementHandle
     */
    protected ?string $offlineAgreementHandle = null;

    /**
     * Offline payment instructions, either default from agreement or overriding from charge parameters
     *
     * @var string $offlinePaymentInstructions
     */
    protected string $offlinePaymentInstructions;

    /**
     * Offline agreement handle
     *
     * @return OfflineMandateModel|null
     */
    public function getOfflineMandate(): ?OfflineMandateModel
    {
        return $this->offlineMandate;
    }

    /**
     * Offline agreement handle used to initiate transaction. Only set when offline_mandate is not set
     *
     * @return string|null
     */
    public function getOfflineAgreementHandle(): ?string
    {
        return $this->offlineAgreementHandle;
    }

    /**
     * Offline payment instructions, either default from agreement or overriding from charge parameters
     *
     * @return string
     */
    public function getOfflinePaymentInstructions(): string
    {
        return $this->offlinePaymentInstructions;
    }

    /**
     * Offline agreement handle
     *
     * @param OfflineMandateModel|null $offlineMandate
     *
     * @return self
     */
    public function setOfflineMandate(?OfflineMandateModel $offlineMandate): self
    {
        $this->offlineMandate = $offlineMandate;

        return $this;
    }

    /**
     * Offline agreement handle used to initiate transaction. Only set when offline_mandate is not set
     *
     * @param string|null $offlineAgreementHandle
     *
     * @return self
     */
    public function setOfflineAgreementHandle(?string $offlineAgreementHandle): self
    {
        $this->offlineAgreementHandle = $offlineAgreementHandle;

        return $this;
    }

    /**
     * Offline payment instructions, either default from agreement or overriding from charge parameters
     *
     * @param string $offlinePaymentInstructions
     *
     * @return self
     */
    public function setOfflinePaymentInstructions(string $offlinePaymentInstructions): self
    {
        $this->offlinePaymentInstructions = $offlinePaymentInstructions;

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
        $model = new static();

        $model->fromArrayDefault($response);

        $model->setOfflinePaymentInstructions($response['offline_payment_instructions']);

        if (isset($response['offline_agreement_handle'])) {
            $model->setOfflineAgreementHandle($response['offline_agreement_handle']);
        }

        if (isset($response['offline_mandate'])) {
            $model->setOfflineMandate(OfflineMandateModel::fromArray($response['offline_mandate']));
        }

        return $model;
    }

    public function toArray(): array
    {
        return array_filter(array_merge($this->toArrayDefault(), [
            'offline_payment_instructions' => $this->getOfflinePaymentInstructions(),
            'offline_agreement_handle' => $this->getOfflineAgreementHandle(),
            'offline_mandate' => $this->getOfflineMandate()->toArray(),
        ]), function ($value) {
            return $value !== null;
        });
    }
}
