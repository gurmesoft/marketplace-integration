<?php

namespace Gurmesoft\MarketplaceIntegration\Services;

use Gurmesoft\MarketplaceIntegration\Helpers\HttpClient;

class BaseService
{
    public $sellerId;
    public $apiKey;
    public $apiKeySecret;

    public $client;

    public function __construct($userInfo)
    {
        $this->sellerId = $userInfo->sellerId;
        $this->apiKey = $userInfo->apiKey;
        $this->apiKeySecret = $userInfo->apiKeySecret;

        $credentials = base64_encode("{$this->apiKey}:{$this->apiKeySecret}");

        $this->client = new HttpClient($credentials, $this->sellerId);
    }
}
