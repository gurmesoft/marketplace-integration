# marketplace-integration

Entegrasyon pazar yerleri için oluşturulmuş vendor paketi

## Adım 1

`composer.json` dosyası oluşturulur yada var olan dosyadaki uygun objelere ekleme yapılır.

```json
{
  "require": {
    "gurmesoft/marketplace-integration": "dev-master"
  },
  "repositories": [
    {
      "type": "github",
      "url": "https://github.com/gurmesoft/marketplace-integration"
    }
  ]
}
```

## Adım 2

`composer` kullanılarak paket çağırılır

```bash
composer require gurmesoft/marketplace-integration:dev-master
```

## Adım 3

`vendor/autoload.php` dosyası dahil edilir ve firma türetilerek hazır hale getirilir.

```php
<?php

require 'vendor/autoload.php';

use Gurmesoft\MarketplaceIntegration\Services\Trendyol\ProductService;

$trendyolService = new ProductService((object)[
    'merchantId' => 'xxx',
    'apiKey' => 'xxx',
    'apiSecret' => 'xxx',
]);


```

### Gönderi oluşturma

```php
<?php

$productproductService = new ProductService;

// Kayıtlı olan adresleri döndürür

$productproductService->getAddresses();

// Tüm kargo şirkerlerini döndürür

$productproductService->getProviders();

// Tüm kargo şirkerlerini döndürür

$productproductService->getBrands();

// Tüm kayıtlı kategorileri döndürür

$productproductService->getCategoryTree();

// Tüm kayıtlı kategorileri döndürür

$productproductService->getCategoryAttributes();


// Satıcının ürünlerini döndürür

$data = [
        $approved = true,
        $barcode = '',
        $page = 0,
        $size = 50,
        $dateQueryType = 'CREATED_DATE',
        $startDate = 0,
        $endDate = 0
];

$productproductService->filterProducts($approved, $barcode, $page, $size, $dateQueryType, $startDate, $endDate);


// Trenyol'a ürünlerini ekler 
// data eklenecek
$productproductService->createProducts($data);

// Trenyol'a ürünlerini ekler 
// data eklenecek
$productproductService->updateProducts($data);

// Trenyol'a ürünlerini ekler 
// data eklenecek
$productproductService->updatePriceAndInventor($data);

// POST ve PUT işlemlerinden sonra kuyruğa alınmış olan işlemin başarılı olup olmadığını döndürür
/**
* @param $batchRequestId
*/
$productproductService->getBatchRequestResult($batchRequestId);
