<?php

namespace Gurmesoft\MarketplaceIntegration\Services\Trendyol;

use Gurmesoft\MarketplaceIntegration\Services\Trendyol\TrendyolService;

class OrderService extends TrendyolService
{
    public function __construct($userInfo)
    {
        parent::__construct($userInfo);
    }


    // public function createOrder($order)
    // {
    //     $response = $this->client->post("https://stageapi.trendyol.com/integration/oms/instant", $order);

    //     return $response;
    // }

    /**
     * Siparişleri döndürür
     *
     * @param string $status Created, Picking, Invoiced, Shipped, Cancelled, Delivered, UnDelivered, Returned, Repack, UnPacked, UnSupplied
     * @param string $orderNumber
     * @param int $shipmentPackageIds
     * @param int $page
     * @param int $size max 200
     * @param string $orderByField PackageLastModifiedDate, CreatedDate
     * @param string $orderByDirection DESC, ASC
     * @param int $startDate Tarih aralığı max 2 hafta
     * @param int $endDate Tarih aralığı max 2 hafta
     * @return object $response
     */
    public function getShipmentPackages(
        $status = '',
        $orderNumber = '',
        $shipmentPackageIds = '',
        $page = 0,
        $size = 50,
        $orderByDirection = 'DESC',
        $orderByField = 'PackageLastModifiedDate',
        $startDate = 0,
        $endDate = 0
    ) {

        $query = [
            'status'             => $status,
            'page'               => $page,
            'size'               => $size,
            'orderByDirection'   => $orderByDirection,
            'orderByField'       => $orderByField,
            'startDate'          => $startDate,
            'endDate'            => $endDate,
        ];

        if ($orderNumber != '') {
            $query["orderNumber"] = $orderNumber;
        }

        if ($shipmentPackageIds != '') {
            $query["shipmentPackageIds"] = $shipmentPackageIds;
        }

        $response = $this->client->get("https://stageapi.trendyol.com/stagesapigw/suppliers/{$this->merchantId}/orders", $query);

        return $response;
    }

    /**
     * ! Tedarikçinin paket içerisindeki ürünlerden bir ya da birkaçını güncellemek için kullanılır
     *
     * @param int $shipmentPackageId
     * @return object $response
     */
    public function updatePackage($shipmentPackageId)
    {
        $response = $this->client->put("https://stageapi.trendyol.com/stagesapigw/suppliers/{$this->merchantId}/shipment-packages/{$shipmentPackageId}");

        return $response;
    }
}
