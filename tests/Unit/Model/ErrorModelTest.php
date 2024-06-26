<?php

namespace Billwerk\Sdk\Test\Unit\Model;

use Billwerk\Sdk\Enum\TransactionErrorEnum;
use Billwerk\Sdk\Model\ErrorModel;
use Billwerk\Sdk\Test\StubTrait;
use Billwerk\Sdk\Test\TestCase;
use Exception;

class ErrorModelTest extends TestCase
{
    use StubTrait;

    /**
     * @throws Exception
     */
    public function testFromArrayMethodWithRequiredFields()
    {
        $json  = $this::getStubJsonModelWithRequiredFields(ErrorModel::getClassName());
        $model = ErrorModel::fromArray($json);
        $this::assertSame(null, $model->getCode());
        $this::assertSame(null, $model->getError());
        $this::assertSame(null, $model->getMessage());
        $this::assertSame(null, $model->getPath());
        $this::assertSame(null, $model->getTimestamp());
        $this::assertSame(null, $model->getHttpStatus());
        $this::assertSame(null, $model->getHttpReason());
        $this::assertSame(null, $model->getRequestId());
        $this::assertSame(null, $model->getTransactionError());
    }

    /**
     * @throws Exception
     */
    public function testFromArrayMethodWithAllFields()
    {
        $json  = $this::getStubJsonModelWithAllFields(ErrorModel::getClassName());
        $model = ErrorModel::fromArray($json);
        $this::assertSame(12, $model->getCode());
        $this::assertSame('Subscription not found', $model->getError());
        $this::assertSame('string', $model->getMessage());
        $this::assertSame('/v1/subscription/sub0019', $model->getPath());
        $this::assertSame('2024-04-28T13:28:06.440Z', $model->getTimestamp());
        $this::assertSame(404, $model->getHttpStatus());
        $this::assertSame('Not Found', $model->getHttpReason());
        $this::assertSame('f1988fc2374b4a26a51ebd876b478428', $model->getRequestId());
        $this::assertSame(TransactionErrorEnum::CREDIT_CARD_EXPIRED, $model->getTransactionError());
    }
}
