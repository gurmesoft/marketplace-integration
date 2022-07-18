<?php

namespace Gurmesoft\MarketplaceIntegration\Helpers;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;

class HttpClient
{
    public function __construct($token, $merchantId='')
    {
        $this->client = new Client([
            'headers' => [
                'User-Agent' => "{$merchantId} - SelfIntegration",
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
                "body" => json_decode($response->getBody()->getContents())
            ];
        } catch (ClientException $e) {
            if ($e->getResponse()) {
                return (object)[
                    "statusCode" => $e->getResponse()->getStatusCode(),
                    "success" => false,
                    "body" => json_decode($e->getResponse()->getBody()->getContents())
                ];
            } else {
                return (object)[
                    "statusCode" => 500,
                    "success" => false,
                    "body" => 'Lütfen daha sonra tekrar deneyiniz. Sorun devam ederse firma ile iletişime geçiniz.'
                ];
            }
        }
    }

    /**
     * @param string $url
     * @param mixed $body
     * @return object
     */
    public function post($url, $body)
    {
        try {
            $response = $this->client->post($url, [
                "body" => $body
            ]);

            return (object)[
                "statusCode" => 200,
                "success" => true,
                "body" => json_decode($response->getBody()->getContents())
            ];
        } catch (ClientException $e) {
            if ($e->getResponse()) {
                return (object)[
                    "statusCode" => $e->getResponse()->getStatusCode(),
                    "success" => false,
                    "body" => json_decode($e->getResponse()->getBody()->getContents())
                ];
            } else {
                return (object)[
                    "statusCode" => 500,
                    "success" => false,
                    "body" => 'Lütfen daha sonra tekrar deneyiniz. Sorun devam ederse firma ile iletişime geçiniz.'
                ];
            }
        }
    }

    /**
     * @param string $url
     * @param mixed $body
     * @return object
     */
    public function put($url, $body)
    {
        try {
            $response = $this->client->put($url, [
                "body" => $body
            ]);

            return (object)[
                "statusCode" => 200,
                "success" => true,
                "body" => json_decode($response->getBody()->getContents())
            ];
        } catch (ClientException $e) {
            if ($e->getResponse()) {
                return (object)[
                    "statusCode" => $e->getResponse()->getStatusCode(),
                    "success" => false,
                    "body" => json_decode($e->getResponse()->getBody()->getContents())
                ];
            } else {
                return (object)[
                    "statusCode" => 500,
                    "success" => false,
                    "body" => 'Lütfen daha sonra tekrar deneyiniz. Sorun devam ederse firma ile iletişime geçiniz.'
                ];
            }
        }
    }

     /**
     * @param string $url
     * @return object
     */
    public function delete($url)
    {
        try {
            $response = $this->client->delete($url);

            return (object)[
                "statusCode" => 200,
                "success" => true,
                "body" => json_decode($response->getBody()->getContents())
            ];
        } catch (ClientException $e) {
            if ($e->getResponse()) {
                return (object)[
                    "statusCode" => $e->getResponse()->getStatusCode(),
                    "success" => false,
                    "body" => json_decode($e->getResponse()->getBody()->getContents())
                ];
            } else {
                return (object)[
                    "statusCode" => 500,
                    "success" => false,
                    "body" => 'Lütfen daha sonra tekrar deneyiniz. Sorun devam ederse firma ile iletişime geçiniz.'
                ];
            }
        }
    }
}