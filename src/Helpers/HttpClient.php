<?php

namespace Gurmesoft\MarketplaceIntegration\Helpers;

use GuzzleHttp\Client;
use Exception;

class HttpClient
{
    public function __construct($token, $sellerId)
    {
        $this->client = new Client([
            'headers' => [
                'User-Agent' => "{$sellerId} - SelfIntegration",
                'Accept'     => 'application/json',
                'content-type' => 'application/json',
                'Authorization' => 'Basic ' . $token
            ]
        ]);
    }

    /**
     * @param string $url
     * @param array $query
     * @return object
     */
    public function get($url, $query = [])
    {
        try {
            $response = $this->client->get($url, ["query" => $query]);

            return (object)[
                "statusCode" => 200,
                "success" => true,
                "body" => json_decode($response->getBody())
            ];
        } catch (Exception $e) {
            if ($e->getCode() === 401) {
                return (object)[
                    "statusCode" => 401,
                    "success" => false,
                    "message" => "Geçersiz login isteği."
                ];
            } else {
                return (object)[
                    "statusCode" => 500,
                    "success" => false,
                    "message" => $e->getMessage()
                ];
            };
        }
    }

    /**
     * @param string $url
     * @param array $products
     * @return object
     */
    public function post($url, $products = [])
    {
        try {
            $response = $this->client->post($url, [
                "body" => json_encode([
                    "items" => $products
                ])
            ]);

            return json_decode($response->getBody());
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }

    /**
     * @param string $url
     * @param array $products
     * @return object
     */
    public function put($url, $products = [])
    {
        try {
            $response = $this->client->post($url, $products);

            return json_decode($response->getBody());
        } catch (Exception $e) {
            return $e->getMessage();
        }
    }
}
