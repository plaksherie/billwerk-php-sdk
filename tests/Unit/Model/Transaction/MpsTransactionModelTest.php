<?php

namespace Billwerk\Sdk\Test\Unit\Model\Transaction;

use Billwerk\Sdk\Enum\ErrorStateEnum;
use Billwerk\Sdk\Enum\MpsPaymentTypeEnum;
use Billwerk\Sdk\Enum\TransactionErrorEnum;
use Billwerk\Sdk\Model\Transaction\MpsSubscriptionModel;
use Billwerk\Sdk\Model\Transaction\MpsTransactionModel;
use Billwerk\Sdk\Test\StubTrait;
use Billwerk\Sdk\Test\TestCase;
use Exception;

class MpsTransactionModelTest extends TestCase
{
    use StubTrait;

    /**
     * @throws Exception
     */
    public function testFromArrayMethodWithRequiredFields()
    {
        $json  = $this::getStubJsonModelWithRequiredFields(MpsTransactionModel::getClassName());
        $model = MpsTransactionModel::fromArray($json);
        $this::assertSame(null, $model->getError());
        $this::assertSame(null, $model->getRefTransaction());
        $this::assertSame(null, $model->getErrorState());
        $this::assertSame(null, $model->getAcquirerMessage());
        $this::assertSame('string', $model->getMpsId());
        $this::assertInstanceOf(MpsSubscriptionModel::class, $model->getMpsSubscription());
        $this::assertSame(MpsPaymentTypeEnum::REGULAR, $model->getMpsPaymentType());
    }

    /**
     * @throws Exception
     */
    public function testFromArrayMethodWithAllFields()
    {
        $json  = $this::getStubJsonModelWithAllFields(MpsTransactionModel::getClassName());
        $model = MpsTransactionModel::fromArray($json);
        $this::assertSame(TransactionErrorEnum::CREDIT_CARD_EXPIRED, $model->getError());
        $this::assertSame('a7a7195c54f644369922d0dfe794dd0c', $model->getRefTransaction());
        $this::assertSame(ErrorStateEnum::HARD_DECLINED, $model->getErrorState());
        $this::assertSame('Rejected', $model->getAcquirerMessage());
        $this::assertSame('string', $model->getMpsId());
        $this::assertInstanceOf(MpsSubscriptionModel::class, $model->getMpsSubscription());
        $this::assertSame(MpsPaymentTypeEnum::REGULAR, $model->getMpsPaymentType());
    }
}
