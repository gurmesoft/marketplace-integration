<?php

namespace Gurmesoft\MarketplaceIntegration\Services\Trendyol;

use Gurmesoft\MarketplaceIntegration\Services\Trendyol\TrendyolService;
use GuzzleHttp\Psr7\Query;

class OrderService extends TrendyolService
{
    public function __construct($userInfo)
    {
        parent::__construct($userInfo);
    }

    /**
     * Siparişleri döndürür
     *
     * @param string $status Created, Picking, Invoiced, Shipped, Cancelled, Delivered, UnDelivered, Returned, Repack, UnPacked, UnSupplied
     * @param string $orderNumber
     * @param int $shipmentPackageIds
     * @param int $page
     * @param int $size max 200
     * @param string $orderByField PackageLastModifiedDate
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

        $response = $this->client->get("https://api.trendyol.com/sapigw/suppliers/{$this->sellerId}/orders", $query);

        return $response;
    }
}
