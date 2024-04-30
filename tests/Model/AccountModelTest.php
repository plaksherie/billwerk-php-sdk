<?php

namespace Billwerk\Sdk\Test\Model;

use Billwerk\Sdk\Enum\StateAccountEnum;
use Billwerk\Sdk\Model\AccountModel;
use Billwerk\Sdk\Test\StubTrait;
use Billwerk\Sdk\Test\TestCase;
use DateTime;
use Exception;

class AccountModelTest extends TestCase
{
    use StubTrait;
    
    /**
     * @throws Exception
     */
    public function testFromArrayMethodWithRequiredFields()
    {
        $json  = $this::getStubJsonModelWithRequiredFields(AccountModel::getClassName());
        $model = AccountModel::fromArray($json);
        $this::assertSame('test_account', $model->getHandle());
        $this::assertSame('DKK', $model->getCurrency());
        $this::assertSame('DK Account', $model->getName());
        $this::assertSame('da_DK', $model->getLocale());
        $this::assertSame('Europe/Copenhagen', $model->getTimezone());
        $this::assertSame('DK', $model->getCountry());
        $this::assertSame('dafba2016614418f969fa5697383e47c', $model->getId());
        $this::assertSame('Reepay', $model->getOrganisation());
        $this::assertEquals(new DateTime('2015-04-04T12:40:56.656Z'), $model->getCreated());
        $this::assertSame(StateAccountEnum::LIVE, $model->getState());
        $this::assertSame(0.25, $model->getDefaultVat());
    }
    
    /**
     * @throws Exception
     */
    public function testFromArrayMethodWithAllFields()
    {
        $json  = $this::getStubJsonModelWithAllFields(AccountModel::getClassName());
        $model = AccountModel::fromArray($json);
        $this::assertSame('test_account', $model->getHandle());
        $this::assertSame('DKK', $model->getCurrency());
        $this::assertSame('DK Account', $model->getName());
        $this::assertSame('Amagerfaellevej 56', $model->getAddress());
        $this::assertSame('Room 1.0.1', $model->getAddress2());
        $this::assertSame('Copenhagen', $model->getCity());
        $this::assertSame('da_DK', $model->getLocale());
        $this::assertSame('Europe/Copenhagen', $model->getTimezone());
        $this::assertSame('DK', $model->getCountry());
        $this::assertSame('robert@reepay.com', $model->getEmail());
        $this::assertSame('26777008', $model->getPhone());
        $this::assertSame('DK23123121', $model->getVat());
        $this::assertSame('http://www.example.com', $model->getWebsite());
        $this::assertSame('http://reepay.com/images/logo.svg', $model->getLogo());
        $this::assertSame('dafba2016614418f969fa5697383e47c', $model->getId());
        $this::assertSame('Reepay', $model->getOrganisation());
        $this::assertEquals(new DateTime('2015-04-04T12:40:56.656Z'), $model->getCreated());
        $this::assertSame(StateAccountEnum::LIVE, $model->getState());
        $this::assertSame('2300', $model->getPostalCode());
        $this::assertSame(0.25, $model->getDefaultVat());
        $this::assertSame('inv', $model->getSubscriptionInvoicePrefix());
    }
}