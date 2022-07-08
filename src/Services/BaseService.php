<?php

namespace Gurmesoft\MarketplaceIntegration\Services;

use Gurmesoft\MarketplaceIntegration\Helpers\HttpClient;

class BaseService
{
    public $merchantId;
    public $apiKey;
    public $apiSecret;

    public $client;

    public function __construct($userInfo)
    {
        $this->merchantId = !empty($userInfo->merchantId) ? $userInfo->merchantId : '';
        $this->apiKey = $userInfo->apiKey;
        $this->apiSecret = $userInfo->apiSecret;

        $credentials = base64_encode("{$this->apiKey}:{$this->apiSecret}");

        $this->client = new HttpClient($credentials, $this->merchantId);
    }
}
