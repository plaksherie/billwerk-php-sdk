<?php

namespace Billwerk\Sdk\Service;

use Billwerk\Sdk\Exception\BillwerkApiException;
use Billwerk\Sdk\Exception\BillwerkClientException;
use Billwerk\Sdk\Exception\BillwerkNetworkException;
use Billwerk\Sdk\Exception\BillwerkRequestException;
use Billwerk\Sdk\Helper\UrlPathInterface;
use Billwerk\Sdk\Model\Invoice\InvoiceGetModel;
use Billwerk\Sdk\Model\Invoice\InvoiceModel;
use Exception;

class InvoiceService extends AbstractService
{
    /**
     * @throws BillwerkNetworkException
     * @throws BillwerkRequestException
     * @throws BillwerkClientException
     * @throws BillwerkApiException
     * @throws Exception
     */
    public function get(
        InvoiceGetModel $data
    ): InvoiceModel {
        $url      = $this::buildRoute(UrlPathInterface::INVOICE . "/{$data->getId()}");
        $response = $this->getRequest()->get($url);

        return InvoiceModel::fromArray($response);
    }
}
