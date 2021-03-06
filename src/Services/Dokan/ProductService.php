<?php

namespace Gurmesoft\MarketplaceIntegration\Services\Dokan;

use Gurmesoft\MarketplaceIntegration\Services\BaseService;

class ProductService extends BaseService
{
    protected $http_url;

    public function __construct($userInfo)
    {
        $this->httpUrl = $userInfo->httpUrl;

        parent::__construct($userInfo);
    }

    /**
     * @param array $data
     * @return object
     */
    public function createProduct($data)
    {
        $result = $this->client->post($this->httpUrl . "/wp-json/dokan/v1/products", $data);

        return $result;
    }

    /**
     * @param int $id
     * @return object $result
     */
    public function getSingleOrder($id)
    {
        $result = $this->client->get($this->httpUrl . "/wp-json/dokan/v1/orders/{$id}");

        return $result;
    }

    /**
     * @param int $id
     * @return object $result
     */
    public function getAllOrder()
    {
        $result = $this->client->get($this->httpUrl . "/wp-json/dokan/v1/orders");

        return $result;
    }

    /**
     * @param array $data
     *    $data = [
     *      (bool) $approved,
     *      (string) $barcode,
     *      (int) $page,
     *      (int) $size,
     *      (int) $startDate,
     *      (int) $endDate
     * ]
     * @return object
     */
    public function filterProducts(array $data = [])
    {
        $query = [
            'status'        => $data['approved'] ? 'publish' : 'draft',
            'sku'           => $data['barcode'],
            'page'          => $data['page'] ? $data['page'] + 1 : 1,
            'per_page'      => $data['size'] ?? 50,
        ];

        if ($data['startDate']) {
            $query["after"] = $data['startDate'];
        }

        if ($data['endDate']) {
            $query["before"] = $data['endDate'];
        }

        $result = $this->client->get($this->httpUrl . "/wp-json/dokan/v1/products", $query);

        return $result;
    }

    /**
     * @param int $id
     * @return object
     */
    public function updateProduct($id, $data)
    {
        $result = $this->client->put($this->httpUrl . "/wp-json/dokan/v1/products/{$id}", $data);

        return $result;
    }

    /**
     * @param int $id
     * @return object
     */
    public function deleteProduct($id)
    {
        $result = $this->client->delete($this->httpUrl . "/wp-json/dokan/v1/products/{$id}");

        return $result;
    }

    /**
     * @return object
     */
    public function getProductsSummary()
    {
        $result = $this->client->get($this->httpUrl . "/wp-json/dokan/v1/products/summary");

        return $result;
    }
}
