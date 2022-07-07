<?php

namespace Gurmesoft\MarketplaceIntegration\Services\Dokan;

use Gurmesoft\MarketplaceIntegration\Services\BaseService;

class DokanService extends BaseService
{
    protected $http_url;

    public function __construct($userInfo)
    {
        $this->httpUrl = $userInfo->httpUrl;

        parent::__construct($userInfo);
    }

    public function filterProducts(
        $approved = true,
        $barcode = '',
        $page = 0,
        $size = 50,
        $dateQueryType = 'CREATED_DATE',
        $startDate = 0,
        $endDate = 0
    ) {

        $query = [
            'status'        => $approved ? 'publish' : 'draft',
            'sku'           => $barcode,
            'page'          => $page + 1,
            'per_page'      => $size,
        ];

        if ($startDate) {
            $query["after"] = $startDate;
        }

        if ($endDate) {
            $query["before"] = $endDate;
        }

        $result = $this->client->get($this->httpUrl . "/wp-json/dokan/v1/products/", $query);

        return $result;
    }
}
