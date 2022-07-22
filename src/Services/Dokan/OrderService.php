<?php

namespace Gurmesoft\MarketplaceIntegration\Services\Dokan;

use Gurmesoft\MarketplaceIntegration\Services\BaseService;

class OrderService extends BaseService
{
    protected $http_url;

    public function __construct($userInfo)
    {
        $this->httpUrl = $userInfo->httpUrl;

        parent::__construct($userInfo);
    }


    /**
     * @param int $id
     * @return object $result
     */
    public function getSingleOrders($id)
    {
        $result = $this->client->get($this->httpUrl . "/wp-json/dokan/v1/orders/{$id}");

        return $result;
    }

    /**
     * Siparişleri döndürür
     *  $data = [
     *      (string) status => Created, Picking, Invoiced, Shipped, Cancelled, Delivered, UnDelivered, Returned, Repack, UnPacked, UnSupplied,
     *      (string) => orderNumber,
     *      (int) => shipmentPackageIds,
     *      (int) page,
     *      (int) size => (max) 200,
     *      (string) orderByField => PackageLastModifiedDate, CreatedDate,
     *      (string) orderByDirection => DESC, ASC,
     *      (int) startDate => Tarih aralığı max 2 hafta,
     *      (int) endDate => Tarih aralığı max 2 hafta
     * ]
     * @return object $response
     */
    public function getShipmentPackages(array $data = [])
    {

        if ($data['orderNumber'] !== '') {
            return $this->getSingleOrders($data['orderNumber']);
        }

        $query = [
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

        $response = $this->client->get("https://stageapi.trendyol.com/stagesapigw/suppliers/{$this->merchantId}/orders", $query);

        return $response;
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
