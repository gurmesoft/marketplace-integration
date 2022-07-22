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
     * @param array $query
     * 
     *  $query = [
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
    public function getShipmentPackages(array $query = [])
    {
        $response = $this->client->get("https://api.trendyol.com/sapigw/suppliers/{$this->merchantId}/orders", $query);

        return $response;
    }

    /**
     * ! Tedarikçinin paket içerisindeki ürünlerden bir ya da birkaçını güncellemek için kullanılır
     * ! yapim asamasinda\ fatutrra kesilen orderi belirmek icin
     *
     * @param int $shipmentPackageId
     * @return object $response
     */
    public function updatePackage($shipmentPackageId)
    {
        // $response = $this->client->put("https://api.trendyol.com/sapigw/suppliers/{$this->merchantId}/shipment-packages/{$shipmentPackageId}");

        // return $response;
    }
}
