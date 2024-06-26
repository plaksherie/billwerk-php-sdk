<?php

namespace Billwerk\Sdk\Model\Charge;

use Billwerk\Sdk\Model\AbstractModel;
use Billwerk\Sdk\Model\AccountFundingInformationModel;
use Billwerk\Sdk\Model\AddressModel;
use Billwerk\Sdk\Model\HasRequestApiInterface;
use Billwerk\Sdk\Model\MetaDataModel;

class ChargeCreateModel extends AbstractModel implements HasRequestApiInterface
{
    /**
     * Per account unique reference to charge/invoice. E.g. order id from own system. Multiple
     * payments can be attempted for the same handle but only one authorized or settled charge
     * can exist per handle. Max length 255 with allowable characters [a-zA-Z0-9_.-@]. It is
     * recommended to use a maximum of 20 characters as this will allow for the use of handle
     * as reference on bank statements without truncation
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
     * Optional currency in ISO 4217 three letter alpha code. If not provided the account default
     * currency will be used. The currency of an existing charge or invoice cannot be changed
     *
     * @var string|null $currency
     */
    protected ?string $currency = null;

    /**
     * Create customer and subscription in an atomic operation
     *
     * @var CustomerModel|null
     */
    protected ?CustomerModel $customer = null;

    /**
     * Custom metadata
     *
     * @var MetaDataModel[]|null $metadata
     */
    protected ?array $metadata = null;

    /**
     * The source for the payment. Either an existing payment method for the customer or a card token
     * ct_.... The existing payment method can either be referenced directly with id, e.g. ca_..., or
     * the keyword auto can be given to indicate that the newest active customer payment method should be used.
     *
     * @var string $source
     */
    protected string $source;

    /**
     * Whether or not to immediately settle the charge. If not settled immediately the charge will be authorized
     * and can later be settled. Normally this have to be done within 7 days. The default is not to settle the
     * charge immediately. Note that not all payment methods support immediate settle
     *
     * @var bool|null $settle
     */
    protected ?bool $settle = null;

    /**
     * If set and the source is a token for a payment method that supports recurring charging (e.g. credit card),
     * a recurring payment method is stored for the customer and a reference returned
     *
     * @var bool|null $recurring
     */
    protected ?bool $recurring = null;

    /**
     * Extra optional parameters that may be added for specific payment methods
     *
     * @var ParametersModel|null $parameters
     */
    protected ?ParametersModel $parameters = null;

    /**
     * Optional order text. Used in conjunction with amount. Ignored if order_lines is provided
     *
     * @var string|null $ordertext
     */
    protected ?string $ordertext = null;

    /**
     * Order lines for the charge. The order lines controls the amount. Only required if charge/invoice does not
     * already exist. If given for existing charge the order lines and amount are adjusted. A maximum of 100
     * order lines is allowed
     *
     * @var OrderLineModel[]|null $orderLines
     */
    protected ?array $orderLines = null;

    /**
     * Customer reference. If charge does not already exist either this reference must be provided, a create
     * customer object must be provided or the source must be a payment method reference (e.g. ca_..) identifying
     * customer. Notice that customer cannot be changed for existing charge/invoice so if handle is provided it
     * must match the customer handle for existing customer
     *
     * @var string|null $customerHandle
     */
    protected ?string $customerHandle = null;

    /**
     * Optional billing address
     *
     * @var AddressModel|null $billingAddress
     */
    protected ?AddressModel $billingAddress = null;

    /**
     * Optional shipping address
     *
     * @var AddressModel|null $shippingAddress
     */
    protected ?AddressModel $shippingAddress = null;

    /**
     * When used with a subscription invoice the subscription payment method will be updated. If the subscription
     * is pending the subscription will be activated with the payment method. The recurring argument is set to true
     *
     * @var bool|null $usePmForSubscription
     */
    protected ?bool $usePmForSubscription = null;

    /**
     * Optional argument to define the text on bank statement. Notice the following about this argument: 1. It only
     * works for some acquirers. 2. Acquirers may have rigid rules on the content of the text on statement. Not
     * complying to these rules will result in declined payments. 3) It is already possible to define custom text
     * on statement using templating in the Reepay Administration. Contact support for help. We highly recommend
     * to only supply this argument if absolutely necessary, and the templated default text on statement is not
     * sufficient. Maximum length is 128, but most acquirers require a maximum length of 22 characters. Truncating
     * will be applied if too long for specific acquirer. Characters must match regex [\x20-\x7F]
     *
     * @var string|null $textOnStatement
     */
    protected ?string $textOnStatement = null;

    /**
     * Optional reference given to the created payment method in case recurring argument is used to save payment
     * method. Max length 64 with allowable characters [a-zA-Z0-9_.-@]
     *
     * @var string|null $paymentMethodReference
     */
    protected ?string $paymentMethodReference = null;

    /**
     * For payment methods that supports both synchronous and asynchronous handling this parameter can be used
     * force a specific handling. Asynchronous handling means that a pending state will be returned. The subsequent
     * state change can be registered by using webhooks. The default depends on the payment method
     *
     * @var bool|null $async
     */
    protected ?bool $async = null;

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
     * Optional sender information required for Account Funding Transaction (AFT).
     * If not provided when requesting account funding transaction with account_funding=true,
     * information will be gathered from invoice billing address and customer
     *
     * @var AccountFundingInformationModel|null $accountFundingInformation
     */
    protected ?AccountFundingInformationModel $accountFundingInformation = null;

    /**
     * Indicates that Account Funding Transaction (AFT) is requested.
     * It only can be used for instant settle (i.e. 'settle' = true)
     *
     * @var bool|null $accountFunding
     */
    protected ?bool $accountFunding = null;

    /**
     * Optional order text. Used in conjunction with amount. Ignored if order_lines is provided
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
     * Custom metadata
     *
     * @return array|null
     */
    public function getMetadata(): ?array
    {
        return $this->metadata;
    }

    /**
     *  Per account unique reference to charge/invoice. E.g. order id from own system. Multiple
     *  payments can be attempted for the same handle but only one authorized or settled charge
     *  can exist per handle. Max length 255 with allowable characters [a-zA-Z0-9_.-@]. It is
     *  recommended to use a maximum of 20 characters as this will allow for the use of handle
     *  as reference on bank statements without truncation
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
     *  The source for the payment. Either an existing payment method for the customer or a card token
     *  ct_.... The existing payment method can either be referenced directly with id, e.g. ca_..., or
     *  the keyword auto can be given to indicate that the newest active customer payment method should be used.
     *
     * @return string
     */
    public function getSource(): string
    {
        return $this->source;
    }

    /**
     * Optional billing address
     *
     * @return AddressModel|null
     */
    public function getBillingAddress(): ?AddressModel
    {
        return $this->billingAddress;
    }

    /**
     *  Order lines for the charge. The order lines controls the amount. Only required if charge/invoice does not
     *  already exist. If given for existing charge the order lines and amount are adjusted. A maximum of 100
     *  order lines is allowed
     *
     * @return array|null
     */
    public function getOrderLines(): ?array
    {
        return $this->orderLines;
    }

    /**
     * Optional shipping address
     *
     * @return AddressModel|null
     */
    public function getShippingAddress(): ?AddressModel
    {
        return $this->shippingAddress;
    }

    /**
     * Create customer and subscription in an atomic operation
     *
     * @return CustomerModel|null
     */
    public function getCustomer(): ?CustomerModel
    {
        return $this->customer;
    }

    /**
     *  Optional currency in ISO 4217 three letter alpha code. If not provided the account default
     *  currency will be used. The currency of an existing charge or invoice cannot be changed
     *
     * @return string|null
     */
    public function getCurrency(): ?string
    {
        return $this->currency;
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
     *  Optional argument to define the text on bank statement. Notice the following about this argument: 1. It only
     *  works for some acquirers. 2. Acquirers may have rigid rules on the content of the text on statement. Not
     *  complying to these rules will result in declined payments. 3) It is already possible to define custom text
     *  on statement using templating in the Reepay Administration. Contact support for help. We highly recommend
     *  to only supply this argument if absolutely necessary, and the templated default text on statement is not
     *  sufficient. Maximum length is 128, but most acquirers require a maximum length of 22 characters. Truncating
     *  will be applied if too long for specific acquirer. Characters must match regex [\x20-\x7F]
     *
     * @return string|null
     */
    public function getTextOnStatement(): ?string
    {
        return $this->textOnStatement;
    }

    /**
     *  Indicates that Account Funding Transaction (AFT) is requested.
     *  It only can be used for instant settle (i.e. 'settle' = true)
     *
     * @return bool|null
     */
    public function getAccountFunding(): ?bool
    {
        return $this->accountFunding;
    }

    /**
     *  Optional sender information required for Account Funding Transaction (AFT).
     *  If not provided when requesting account funding transaction with account_funding=true,
     *  information will be gathered from invoice billing address and customer
     *
     * @return AccountFundingInformationModel|null
     */
    public function getAccountFundingInformation(): ?AccountFundingInformationModel
    {
        return $this->accountFundingInformation;
    }

    /**
     *  For payment methods that supports both synchronous and asynchronous handling this parameter can be used
     *  force a specific handling. Asynchronous handling means that a pending state will be returned. The subsequent
     *  state change can be registered by using webhooks. The default depends on the payment method
     *
     * @return bool|null
     */
    public function getAsync(): ?bool
    {
        return $this->async;
    }

    /**
     *  Customer reference. If charge does not already exist either this reference must be provided, a create
     *  customer object must be provided or the source must be a payment method reference (e.g. ca_..) identifying
     *  customer. Notice that customer cannot be changed for existing charge/invoice so if handle is provided it
     *  must match the customer handle for existing customer
     *
     * @return string|null
     */
    public function getCustomerHandle(): ?string
    {
        return $this->customerHandle;
    }

    /**
     * @return ParametersModel|null
     */
    public function getParameters(): ?ParametersModel
    {
        return $this->parameters;
    }

    /**
     * Optional reference given to the created payment method in case recurring argument is used to save payment
     * method. Max length 64 with allowable characters [a-zA-Z0-9_.-@]
     *
     * @return string|null
     */
    public function getPaymentMethodReference(): ?string
    {
        return $this->paymentMethodReference;
    }

    /**
     *  If set and the source is a token for a payment method that supports recurring charging (e.g. credit card),
     *  a recurring payment method is stored for the customer and a reference returned
     *
     * @return bool|null
     */
    public function getRecurring(): ?bool
    {
        return $this->recurring;
    }

    /**
     *  Whether or not to immediately settle the charge. If not settled immediately the charge will be authorized
     *  and can later be settled. Normally this have to be done within 7 days. The default is not to settle the
     *  charge immediately. Note that not all payment methods support immediate settle
     *
     * @return bool|null
     */
    public function getSettle(): ?bool
    {
        return $this->settle;
    }

    /**
     *  When used with a subscription invoice the subscription payment method will be updated. If the subscription
     *  is pending the subscription will be activated with the payment method. The recurring argument is set to true
     *
     * @return bool|null
     */
    public function getUsePmForSubscription(): ?bool
    {
        return $this->usePmForSubscription;
    }

    /**
     * Optional order text. Used in conjunction with amount. Ignored if order_lines is provided
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
     * Custom metadata
     *
     * @param array|null $metadata
     *
     * @return self
     */
    public function setMetadata(?array $metadata): self
    {
        $this->metadata = $metadata;

        return $this;
    }

    /**
     *  Per account unique reference to charge/invoice. E.g. order id from own system. Multiple
     *  payments can be attempted for the same handle but only one authorized or settled charge
     *  can exist per handle. Max length 255 with allowable characters [a-zA-Z0-9_.-@]. It is
     *  recommended to use a maximum of 20 characters as this will allow for the use of handle
     *  as reference on bank statements without truncation
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
     *  The source for the payment. Either an existing payment method for the customer or a card token
     *  ct_.... The existing payment method can either be referenced directly with id, e.g. ca_..., or
     *  the keyword auto can be given to indicate that the newest active customer payment method should be used.
     *
     * @param string $source
     *
     * @return self
     */
    public function setSource(string $source): self
    {
        $this->source = $source;

        return $this;
    }

    /**
     * Optional billing address
     *
     * @param AddressModel|null $billingAddress
     *
     * @return self
     */
    public function setBillingAddress(?AddressModel $billingAddress): self
    {
        $this->billingAddress = $billingAddress;

        return $this;
    }

    /**
     *  Order lines for the charge. The order lines controls the amount. Only required if charge/invoice does not
     *  already exist. If given for existing charge the order lines and amount are adjusted. A maximum of 100
     *  order lines is allowed
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
     * Optional shipping address
     *
     * @param AddressModel|null $shippingAddress
     *
     * @return self
     */
    public function setShippingAddress(?AddressModel $shippingAddress): self
    {
        $this->shippingAddress = $shippingAddress;

        return $this;
    }

    /**
     *  Optional currency in ISO 4217 three letter alpha code. If not provided the account default
     *  currency will be used. The currency of an existing charge or invoice cannot be changed
     *
     * @param string|null $currency
     *
     * @return self
     */
    public function setCurrency(?string $currency): self
    {
        $this->currency = $currency;

        return $this;
    }

    /**
     * Create customer and subscription in an atomic operation
     *
     * @param CustomerModel|null $customer
     *
     * @return self
     */
    public function setCustomer(?CustomerModel $customer): self
    {
        $this->customer = $customer;

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
     *  Whether or not to immediately settle the charge. If not settled immediately the charge will be authorized
     *  and can later be settled. Normally this have to be done within 7 days. The default is not to settle the
     *  charge immediately. Note that not all payment methods support immediate settle
     *
     * @param bool|null $settle
     *
     * @return self
     */
    public function setSettle(?bool $settle): self
    {
        $this->settle = $settle;

        return $this;
    }

    /**
     *  Optional argument to define the text on bank statement. Notice the following about this argument: 1. It only
     *  works for some acquirers. 2. Acquirers may have rigid rules on the content of the text on statement. Not
     *  complying to these rules will result in declined payments. 3) It is already possible to define custom text
     *  on statement using templating in the Reepay Administration. Contact support for help. We highly recommend
     *  to only supply this argument if absolutely necessary, and the templated default text on statement is not
     *  sufficient. Maximum length is 128, but most acquirers require a maximum length of 22 characters. Truncating
     *  will be applied if too long for specific acquirer. Characters must match regex [\x20-\x7F]
     *
     * @param string|null $textOnStatement
     *
     * @return self
     */
    public function setTextOnStatement(?string $textOnStatement): self
    {
        $this->textOnStatement = $textOnStatement;

        return $this;
    }

    /**
     *  Indicates that Account Funding Transaction (AFT) is requested.
     *  It only can be used for instant settle (i.e. 'settle' = true)
     *
     * @param bool|null $accountFunding
     *
     * @return self
     */
    public function setAccountFunding(?bool $accountFunding): self
    {
        $this->accountFunding = $accountFunding;

        return $this;
    }

    /**
     *  Optional sender information required for Account Funding Transaction (AFT).
     *  If not provided when requesting account funding transaction with account_funding=true,
     *  information will be gathered from invoice billing address and customer
     *
     * @param AccountFundingInformationModel|null $accountFundingInformation
     *
     * @return self
     */
    public function setAccountFundingInformation(?AccountFundingInformationModel $accountFundingInformation): self
    {
        $this->accountFundingInformation = $accountFundingInformation;

        return $this;
    }

    /**
     *  For payment methods that supports both synchronous and asynchronous handling this parameter can be used
     *  force a specific handling. Asynchronous handling means that a pending state will be returned. The subsequent
     *  state change can be registered by using webhooks. The default depends on the payment method
     *
     * @param bool|null $async
     *
     * @return self
     */
    public function setAsync(?bool $async): self
    {
        $this->async = $async;

        return $this;
    }

    /**
     *  Customer reference. If charge does not already exist either this reference must be provided, a create
     *  customer object must be provided or the source must be a payment method reference (e.g. ca_..) identifying
     *  customer. Notice that customer cannot be changed for existing charge/invoice so if handle is provided it
     *  must match the customer handle for existing customer
     *
     * @param string|null $customerHandle
     *
     * @return self
     */
    public function setCustomerHandle(?string $customerHandle): self
    {
        $this->customerHandle = $customerHandle;

        return $this;
    }

    /**
     * Extra optional parameters that may be added for specific payment methods
     *
     * @param ParametersModel|null $parameters
     *
     * @return self
     */
    public function setParameters(?ParametersModel $parameters): self
    {
        $this->parameters = $parameters;

        return $this;
    }

    /**
     *  Optional reference given to the created payment method in case recurring argument is used to save payment
     *  method. Max length 64 with allowable characters [a-zA-Z0-9_.-@]
     *
     * @param string|null $paymentMethodReference
     *
     * @return self
     */
    public function setPaymentMethodReference(?string $paymentMethodReference): self
    {
        $this->paymentMethodReference = $paymentMethodReference;

        return $this;
    }

    /**
     *  If set and the source is a token for a payment method that supports recurring charging (e.g. credit card),
     *  a recurring payment method is stored for the customer and a reference returned
     *
     * @param bool|null $recurring
     *
     * @return self
     */
    public function setRecurring(?bool $recurring): self
    {
        $this->recurring = $recurring;

        return $this;
    }

    /**
     *  When used with a subscription invoice the subscription payment method will be updated. If the subscription
     *  is pending the subscription will be activated with the payment method. The recurring argument is set to true
     *
     * @param bool|null $usePmForSubscription
     *
     * @return self
     */
    public function setUsePmForSubscription(?bool $usePmForSubscription): self
    {
        $this->usePmForSubscription = $usePmForSubscription;

        return $this;
    }

    /**
     * @inheritDoc
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

        if (isset($response['currency'])) {
            $model->setCurrency($response['currency']);
        }

        if (isset($response['customer'])) {
            $model->setCustomer(CustomerModel::fromArray($response['customer']));
        }

        if (isset($response['metadata'])) {
            $metadata = [];
            foreach ($response['metadata'] as $key => $object) {
                $metadata[] = MetaDataModel::fromObject($key, $object);
            }
            $model->setMetadata($metadata);
        }

        $model->setSource($response['source']);

        if (isset($response['settle'])) {
            $model->setSettle($response['settle']);
        }

        if (isset($response['recurring'])) {
            $model->setRecurring($response['recurring']);
        }

        if (isset($response['parameters'])) {
            $model->setParameters(ParametersModel::fromArray($response['parameters']));
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

        if (isset($response['customer_handle'])) {
            $model->setCustomerHandle($response['customer_handle']);
        }

        if (isset($response['billing_address'])) {
            $model->setBillingAddress(AddressModel::fromArray($response['billing_address']));
        }

        if (isset($response['shipping_address'])) {
            $model->setShippingAddress(AddressModel::fromArray($response['shipping_address']));
        }

        if (isset($response['use_pm_for_subscription'])) {
            $model->setUsePmForSubscription($response['use_pm_for_subscription']);
        }

        if (isset($response['text_on_statement'])) {
            $model->setTextOnStatement($response['text_on_statement']);
        }

        if (isset($response['payment_method_reference'])) {
            $model->setPaymentMethodReference($response['payment_method_reference']);
        }

        if (isset($response['async'])) {
            $model->setAsync($response['async']);
        }

        if (isset($response['acquirer_reference'])) {
            $model->setAcquirerReference($response['acquirer_reference']);
        }

        if (isset($response['account_funding_information'])) {
            $model->setAccountFundingInformation(
                AccountFundingInformationModel::fromArray($response['account_funding_information'])
            );
        }

        if (isset($response['account_funding'])) {
            $model->setAccountFunding($response['account_funding']);
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
            'handle' => $this->getHandle(),
            'state' => $this->getSource(),
            'key' => $this->getKey(),
            'amount' => $this->getAmount(),
            'currency' => $this->getCurrency(),
            'customer' => $this->getCustomer(),
            'metadata' => $this->getMetadata() ? MetaDataModel::fromObjects($this->getMetadata()) : null,
            'settle' => $this->getSettle(),
            'recurring' => $this->getRecurring(),
            'parameters' => $this->getParameters(),
            'ordertext' => $this->getOrdertext(),
            'order_lines' => $this->getOrderLines() ? array_map(fn($orderLine) => $orderLine->toArray(), $this->getOrderLines()) : null,
            'customer_handle' => $this->getCustomerHandle(),
            'billing_address' => $this->getBillingAddress() ? $this->getBillingAddress()->toArray() : null,
            'shipping_address' => $this->getShippingAddress() ? $this->getShippingAddress()->toArray() : null,
            'use_pm_for_subscription' => $this->getUsePmForSubscription(),
            'text_on_statement' => $this->getTextOnStatement(),
            'payment_method_reference' => $this->getPaymentMethodReference(),
            'async' => $this->getAsync(),
            'acquirer_reference' => $this->getAcquirerReference(),
            'account_funding_information' => $this->getAccountFundingInformation() ? $this->getAccountFundingInformation()->toArray() : null,
            'account_funding' => $this->getAccountFunding(),
        ], function ($value) {
            return $value !== null;
        });
    }
}
