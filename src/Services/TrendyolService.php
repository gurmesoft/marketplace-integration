<?php

namespace Gurmesoft\MarketplaceIntegration\Services;

use Gurmesoft\MarketplaceIntegration\Services\BaseService;

class TrendyolService extends BaseService
{
    public function __construct($userInfo)
    {
        parent::__construct($userInfo);
    }

    /**
     * Kayıtlı olan adresleri döndürür
     *
     * @return object
     */
    public function getAddresses()
    {
        $response = $this->client->get("https://api.trendyol.com/sapigw/suppliers/{$this->sellerId}/addresses");

        return $response;
    }

    /**
     * Tüm kargo şirkerlerini döndürür
     *
     * @return object
     */
    public function getProviders()
    {
        $response = $this->client->get("https://api.trendyol.com/sapigw/shipment-providers");

        return $response;
    }

    /**
     * Tüm kayıtlı markaları döndürür
     *
     * @return object $response
     */
    public function getBrands()
    {
        $response = $this->client->get("https://api.trendyol.com/sapigw/brands");

        return $response;
    }

    /**
     * Tüm kayıtlı kategorileri döndürür
     *
     * @return object $response
     */
    public function getCategoryTree()
    {
        $response = $this->client->get("https://api.trendyol.com/sapigw/product-categories");

        return $response;
    }

    /**
     * Seçilen kategorinin özelliklerini döndürür
     *
     * @param int $categoriId
     * @return object
     */
    public function getCategoryAttributes($categoriId)
    {
        $response = $this->client->get("https://api.trendyol.com/sapigw/product-categories/{$categoriId}/attributes");

        return $response;
    }

    /**
     * Satıcının ürünlerini döndürür
     *
     * @param array $query2
     * @return object
     */
    public function filterProducts($query2 = [])
    {
        $query = [
            'approved'      => true,
            // 'barcode'       => '',
            // 'startDate'     => array('format' => 'unixTime'),
            // 'endDate'       => array('format' => 'unixTime'),
            'page'          => 0,
            // 'dateQueryType' => array('required' => array('CREATED_DATE', 'LAST_MODIFIED_DATE')),
            'size'          => 50
        ];

        $response = $this->client->get("https://api.trendyol.com/sapigw/suppliers/{$this->sellerId}/products", $query);

        return $response;
    }

    /**
     * Trenyol'a ürünlerini ekler
     * @param array $products
     * @return object
     */
    public function createProducts($products)
    {
        $response = $this->client->post("https://api.trendyol.com/sapigw/suppliers/{$this->sellerId}/v2/products", $products);

        return $response;
    }

    /**
     * Ürün bilgilerini günceller - Stok ve Fiyat dahil edeğil
     *
     * @param array $products
     * @return object
     */
    public function updateProducts($products)
    {
        $response = $this->client->put("https://api.trendyol.com/sapigw/suppliers/{$this->sellerId}/products", $products);

        return $response;
    }

    /**
     * Ürünün stok miktarını ve fiyatını günceller
     *
     * @param array $products
     * @return object
     */
    public function updatePriceAndInventor($products)
    {
        $response = $this->client
            ->post("https://api.trendyol.com/sapigw/suppliers/{$this->sellerId}/products/price-and-inventory", $products);

        return $response;
    }

    /**
     * Ürünün stok miktarını ve fiyatını günceller
     *
     * @param string $batchRequestId
     * @return object
     */
    public function getBatchRequestResult($batchRequestId)
    {
        $response = $this->client
            ->get("https://api.trendyol.com/sapigw/suppliers/{$this->sellerId}/products/batch-requests/{$batchRequestId}");

        return $response;
    }
}
