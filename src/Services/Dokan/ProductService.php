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
    public function createProduct($data) {
        $result = $this->client->post($this->httpUrl . "/wp-json/dokan/v1/products", $data);

        return $result;
    }

    /**
     * @param int $id
     * @return object $result
     */
    public function getSingleProduct($id) {
        $result = $this->client->get($this->httpUrl . "/wp-json/dokan/v1/products/{$id}");

        return $result;
    } 

     /**
     * @param bool $approved
     * @param string $barcode
     * @param int $page
     * @param int $size
     * @param int $startDate
     * @param int $endDate
     * @return object
     */
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

        $result = $this->client->get($this->httpUrl . "/wp-json/dokan/v1/products", $query);

        return $result;
    }
    
     /**
     * @param int $id
     * @return object
     */
    public function updateProduct($id, $data) {
        $result = $this->client->put($this->httpUrl . "/wp-json/dokan/v1/products/{$id}", $data);

        return $result;
    } 

     /**
     * @param int $id
     * @return object
     */
    public function deleteProduct($id) {
        $result = $this->client->delete($this->httpUrl . "/wp-json/dokan/v1/products/{$id}");

        return $result;
    } 

     /**
      * @return object
     */
    public function getProductsSummary() {
        $result = $this->client->get($this->httpUrl . "/wp-json/dokan/v1/products/summary");

        return $result;
    } 
}
