<?php

namespace Gurmesoft\MarketplaceIntegration\Services\Trendyol;

use Gurmesoft\MarketplaceIntegration\Services\Trendyol\TrendyolService;

class ProductService extends TrendyolService
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
        $response = $this->client->get("https://api.trendyol.com/sapigw/suppliers/{$this->merchantId}/addresses");

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
     * @param bool $approved
     * @param string $barcode
     * @param int $page
     * @param int $size
     * @param int $dateQueryType
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
            'approved'      => $approved,
            'barcode'       => $barcode,
            'page'          => $page,
            'dateQueryType' => $dateQueryType,
            'size'          => $size,
        ];

        if ($startDate) {
            $query["startDate"] = $startDate;
        }

        if ($endDate) {
            $query["endDate"] = $endDate;
        }

        $response = $this->client->get("https://api.trendyol.com/sapigw/suppliers/{$this->merchantId}/products", $query);

        return $response;
    }

    /**
     * Trenyol'a ürünlerini ekler
     * @param array $products
     * @return object
     */
    public function createProducts($products)
    {
        $body = json_encode([
            "items" => $products
        ]);
        
        $response = $this->client->post("https://api.trendyol.com/sapigw/suppliers/{$this->merchantId}/v2/products", $body);

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
        $response = $this->client->put("https://api.trendyol.com/sapigw/suppliers/{$this->merchantId}/products", $products);

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
        $body = json_encode([
            "items" => $products
        ]);
        $response = $this->client
            ->post("https://api.trendyol.com/sapigw/suppliers/{$this->merchantId}/products/price-and-inventory", $body);

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
            ->get("https://api.trendyol.com/sapigw/suppliers/{$this->merchantId}/products/batch-requests/{$batchRequestId}");

        return $response;
    }
}
